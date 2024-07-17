<?php

namespace App\Controller\Admin\Crud;

use App\Entity\Movie;
use App\Message\MovieMessage;
use App\Repository\MovieRepository;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\CodeEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\LocaleField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Messenger\MessageBusInterface;

class MovieCrudController extends AbstractCrudController
{
    public function __construct(
        private readonly MovieRepository $movieRepository,
        private readonly AdminUrlGenerator $adminUrlGenerator,
        private readonly MessageBusInterface $messageBus,
        /**
         * @var array<int, string>
         */
        #[Autowire(param: 'kernel.enabled_locales')]
        private readonly array $enabledLocales,
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

        yield LocaleField::new('locale')
            ->setLabel('movie.attributes.locale')
            ->includeOnly($this->enabledLocales);

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
                Action::new('movieHydrate', 'movie.actions.movie_hydrate')
                    ->linkToCrudAction('movieHydrate')
                    ->createAsGlobalAction()
            );
    }

    public function movieHydrate(): RedirectResponse
    {
        $ids = $this->movieRepository->findAllIds();

        foreach ($ids as $id) {
            $this->messageBus->dispatch(new MovieMessage($id));
        }

        return $this->redirectToIndex();
    }

    private function redirectToIndex(): RedirectResponse
    {
        return $this->redirect(
            $this->adminUrlGenerator
                ->setController(self::class)
                ->setAction(Action::INDEX)
                ->generateUrl()
        );
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('tmdbId')
            ->add('locale')
            ->add('releaseDate')
            ->add('popularity')
            ->add('likes');
    }
}
