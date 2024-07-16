<?php

namespace App\Controller\Admin\Crud;

use App\Entity\Movie;
use App\Hydrator\Movie\MovieHydrator;
use App\Repository\MovieRepository;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\CodeEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\RedirectResponse;

class MovieCrudController extends DefaultCrudController
{
    public function __construct(
        private readonly MovieRepository $movieRepository,
        private readonly MovieHydrator $hydrator,
        private readonly EntityManagerInterface $entityManager,
        private readonly AdminUrlGenerator $adminUrlGenerator,
    ) {
    }

    public static function getEntityFqcn(): string
    {
        return Movie::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('movie.label.singular')
            ->setEntityLabelInPlural('movie.label.plural')
            ->setDefaultSort(
                ['id' => 'ASC']
            )
            ->renderContentMaximized();
    }

    /**
     * @SuppressWarnings(PHPMD.StaticAccess)
     */
    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')
            ->hideOnForm();

        yield IdField::new('tmdbId')
            ->setFormTypeOptions(
                [
                    'autocomplete' => 'true',
                    'autocomplete_url' => $this->generateUrl('app_movie_autocomplete'),
                    'attr' => [
                        'data-controller' => 'symfony/ux-autocomplete/autocomplete',
                    ],
                    'tom_select_options' => [
                        'maxItems' => 1,
                    ],
                ]
            );

        yield TextField::new('title')
            ->setLabel('movie.attributes.title')
            ->setRequired(false)
            ->setDisabled();

        yield DateField::new('releaseDate')
            ->setLabel('movie.attributes.release_date')
            ->setRequired(false)
            ->setDisabled();

        yield NumberField::new('popularity')
            ->setLabel('movie.attributes.popularity')
            ->setRequired(false)
            ->setDisabled();

        yield IntegerField::new('likes')
            ->setLabel('movie.attributes.likes')
            ->setRequired(false);

        yield CodeEditorField::new('tmdbDataJson')
            ->onlyOnDetail();

        yield CodeEditorField::new('tmdbDetailsDataJson')
            ->onlyOnDetail();
    }

    public function configureActions(Actions $actions): Actions
    {
        return parent::configureActions($actions)
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            ->add(Crud::PAGE_EDIT, Action::DELETE)
            ->add(
                Crud::PAGE_INDEX,
                Action::new('movie_hydrate', 'movie.actions.movie_hydrate')
                    ->linkToCrudAction('movieHydrate')
                    ->createAsGlobalAction()
            );
    }

    public function movieHydrate(): RedirectResponse
    {
        foreach ($this->movieRepository->findAll() as $movie) {
            $this->hydrator->hydrate($movie);
            $this->entityManager->persist($movie);
        }
        $this->entityManager->flush();

        return $this->redirect(
            $this->adminUrlGenerator
                ->setController(self::class)
                ->setAction(Action::INDEX)
                ->generateUrl()
        );
    }
}
