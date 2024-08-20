<?php

namespace App\Command;

use InvalidArgumentException;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

use function preg_match;
use function sprintf;

#[AsCommand(
    name: 'dto:generate',
    description: 'Generates DTOs from the TMDB OpenAPI file',
)]
class DtoGenerateCommand extends Command
{
    public function __construct(
        private readonly Environment $twig,
        #[Autowire(param: 'kernel.project_dir')]
        private readonly string $projectDir,
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('from', InputArgument::REQUIRED, 'The TMDB OpenAPI file to generate DTOs from')
            ->addArgument('to', InputArgument::REQUIRED, 'The directory to save the generated DTOs');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $from = $input->getArgument('from');
        $to = $input->getArgument('to');

        $this->generateDtos($from, $to, $io);

        return Command::SUCCESS;
    }

    private function generateDtos(string $from, string $to, SymfonyStyle $io): void
    {
        $from = ltrim($from, '/');

        $to = ltrim($to, '/');
        $to = rtrim($to, '/');

        if (!str_ends_with($from, '.json')) {
            throw new InvalidArgumentException(sprintf('File %s is not a json file', $from));
        }

        if (!file_exists($from)) {
            throw new InvalidArgumentException(sprintf('File %s does not exist', $from));
        }

        if (!is_dir($to)) {
            throw new InvalidArgumentException(sprintf('Directory %s does not exist', $to));
        }

        $openApi = file_get_contents($from);
        $openApi = json_decode($openApi, true);

        $paths = $openApi['paths'];

        $getDomains = [];
        foreach ($paths as $path => $methods) {
            if (array_key_exists('get', $methods)) {
                $data = $this->collectGetPathData($path, $methods['get']);
                $getDomains[$data['domain']][] = $data['pathData'];
            }
        }

        foreach ($getDomains as $domain => $paths) {
            $this->generateDto($domain, $paths, $to);
            $io->text(sprintf('DTOs for domain %s generated', $domain));
        }

        $io->success('DTOs generated');
    }

    /**
     * @return array{
     *     domain: string,
     *     pathData: array{
     *       path: string,
     *       operation: string,
     *       parameters: mixed,
     *       schema: mixed
     *    }
     * }
     */
    private function collectGetPathData(string $path, mixed $get): array
    {
        if (0 === preg_match('/^\/\w+\/\w+/', $path)) {
            throw new InvalidArgumentException(sprintf('Path %s does not match the expected format', $path));
        }
        $pathExploded = explode('/', $path);
        $domain = $pathExploded[2];

        $operation = $get['operationId'];
        $operationExploded = explode('-', $operation);
        $operation = $operationExploded[0];

        foreach (array_slice($operationExploded, 1) as $part) {
            $operation .= ucfirst($part);
        }

        $responses = $get['responses'];
        if (!array_key_exists('200', $responses)) {
            throw new InvalidArgumentException(sprintf('Path %s does not have a 200 response', $path));
        }

        $schema = $responses['200']['content']['application/json']['schema'];

        $pathData = [
            'path' => $path,
            'operation' => $operation,
            'parameters' => $get['parameters'] ?? [],
            'schema' => $schema,
        ];

        return [
            'domain' => $domain,
            'pathData' => $pathData,
        ];
    }

    private function generateDto(string $domain, mixed $paths, string $to): void
    {
        list($namespace, $dtoDirectory) = $this->generateDirectoryAndNamespace($to, $domain);

        $loader = $this->twig->getLoader();

        assert($loader instanceof FilesystemLoader);

        $loader->addPath($this->projectDir.'/dto');

        foreach ($paths as $path) {
            $className = ucfirst($path['operation']);
            $this->generateDtoRecursive($namespace, $dtoDirectory, $className, $path['schema'], '');
        }
    }

    private function generateDtoRecursive(string $namespace, string $directory, string $propertyName, mixed $schema, string $parentClassName): string
    {
        $schema = $this->checkMissingSchema($schema, $propertyName);

        // If there is an object, generate the DTO for the object and check if any of its properties are objects
        if ('object' === $schema['type']) {
            $schema['type'] = $parentClassName.ucfirst($propertyName);
            foreach ($schema['properties'] as $name => $nestedProperty) {
                $schema['properties'][$name]['type'] = $this->generateDtoRecursive($namespace, $directory, $name, $nestedProperty, $schema['type']);
            }
        }
        // If there is an array of objects, generate the DTO for the object (in case it is an array of scalars there is no items property)
        if ('array' === $schema['type'] && array_key_exists('items', $schema)) {
            $schema['items']['type'] = $this->generateDtoRecursive($namespace, $directory, $propertyName, $schema['items'], $parentClassName);

            return 'array<'.$schema['items']['type'].'>';
        }
        // If  it is a scalar type, return the type
        if ('object' !== $schema['type'] && ('array' !== $schema['type'] || !array_key_exists('items', $schema))) {
            return $schema['type'];
        }

        $schema['type'] = $this->snakeCaseToPascalCase($schema['type']);
        $dtoClass = $this->twig->render('dto_template.php.twig', [
            'namespace' => $namespace,
            'className' => $schema['type'],
            'properties' => $schema['properties'],
        ]);

        file_put_contents($directory.'/'.$schema['type'].'.php', $dtoClass);

        return $schema['type'];
    }

    private function snakeCaseToPascalCase(string $string): string
    {
        // Replace - with _ (needed for CA-QC in CertificationMovieListCertifications)
        $string = str_replace('-', '_', $string);

        return str_replace('_', '', ucwords($string, '_'));
    }

    public function checkMissingSchema(mixed $schema, string $propertyName): mixed
    {
        $valueIsScalar = array_key_exists('type', $schema) && !in_array($schema['type'], ['array', 'object'], true);
        // Also allow empty arrays
        $isDefinedArray = array_key_exists('type', $schema) && 'array' === $schema['type'];
        // Do not allow undefined objects
        $isDefinedObject = array_key_exists('type', $schema) && 'object' === $schema['type'] && array_key_exists('properties', $schema) && !empty($schema['properties']);
        if ($valueIsScalar || $isDefinedArray || $isDefinedObject) {
            return $schema;
        }
        // belongs_to_collection (sometimes) does not have a property definition, although it is an object
        if ('belongs_to_collection' === $propertyName) {
            return [
                'type' => 'object',
                'properties' => [
                    'id' => [
                        'type' => 'int',
                    ],
                    'name' => [
                        'type' => 'string',
                    ],
                    'poster_path' => [
                        'type' => 'string',
                    ],
                    'backdrop_path' => [
                        'type' => 'string',
                    ],
                ],
            ];
        }

        // MovieRecommendations is an object but does not have a property definition
        if ('MovieRecommendations' === $propertyName) {
            return [
                'type' => 'object',
                'properties' => [
                    'page' => [
                        'type' => 'int',
                    ],
                    'results' => [
                        'type' => 'array',
                        'items' => [
                            'type' => 'object',
                            'properties' => [
                                'adult' => [
                                    'type' => 'bool',
                                ],
                                'backdrop_path' => [
                                    'type' => 'string',
                                ],
                                'genre_ids' => [
                                    'type' => 'array',
                                    'items' => [
                                        'type' => 'int',
                                    ],
                                ],
                                'id' => [
                                    'type' => 'int',
                                ],
                                'original_language' => [
                                    'type' => 'string',
                                ],
                                'original_title' => [
                                    'type' => 'string',
                                ],
                                'overview' => [
                                    'type' => 'string',
                                ],
                                'popularity' => [
                                    'type' => 'float',
                                ],
                                'poster_path' => [
                                    'type' => 'string',
                                ],
                                'release_date' => [
                                    'type' => 'string',
                                ],
                                'title' => [
                                    'type' => 'string',
                                ],
                                'video' => [
                                    'type' => 'bool',
                                ],
                                'vote_average' => [
                                    'type' => 'float',
                                ],
                                'vote_count' => [
                                    'type' => 'int',
                                ],
                            ],
                        ],
                    ],
                    'total_pages' => [
                        'type' => 'int',
                    ],
                    'total_results' => [
                        'type' => 'int',
                    ],
                ],
            ];
        }

        if ($this->isStringEdgeCase($propertyName)) {
            return [
                'type' => 'string',
            ];
        }

        throw new InvalidArgumentException(sprintf('Property %s does not have a valid type definition', $propertyName));
    }

    private function isStringEdgeCase(string $propertyName): bool
    {
        // The following properties are strings but are not defined as such in the OpenAPI file
        return match ($propertyName) {
            'iso_639_1', 'wikidata_id', 'instagram_id', 'twitter_id', 'poster_path', 'rating', 'backdrop_path',
            'imdb_id', 'next_episode_to_air', 'runtime', 'still_path', 'air_date', 'profile_path', 'tvrage_id',
            'deathday', 'homepage', 'youtube_id', 'birthday', 'known_for_department', 'place_of_birth',
            'parent_company' => true,
            default => false,
        };
    }

    /**
     * @return array{0: string, 1: string}
     */
    public function generateDirectoryAndNamespace(string $to, string $domain): array
    {
        // Create namespace from $to directory which is a relative path from the project directory
        // First: Remove leading directory (e.g. for src/Dto/Tmdb/Movie, remove src/)
        $toParts = explode('/', $to);
        array_shift($toParts);
        $toNamespace = implode('\\', $toParts);
        $toNamespace = '' !== $toNamespace ? '\\'.$toNamespace.'\\' : '\\';

        $namespace = 'App'.$toNamespace.'Tmdb\\'.ucfirst($domain);
        $dtoDirectory = $this->projectDir.'/'.$to.'/Tmdb/'.ucfirst($domain);

        if (0 === preg_match('/^[a-zA-Z0-9_\\\\]+$/', $namespace)) {
            throw new InvalidArgumentException(sprintf('Generated namespace %s from %s does not match the expected format', $namespace, $to));
        }

        if (!is_dir($dtoDirectory)) {
            mkdir($dtoDirectory, recursive: true);
        }

        return [$namespace, $dtoDirectory];
    }
}
