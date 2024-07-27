<?php

namespace App\Controller\Admin\Crud;

use App\Entity\MovieTmdbData;
use App\Message\Movie\MovieBatchHydrationMessage;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CodeEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\LocaleField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Messenger\MessageBusInterface;

class MovieTmdbDataCrudController extends AbstractCrudController
{
    public function __construct(
        private readonly AdminUrlGenerator $adminUrlGenerator,
        private readonly MessageBusInterface $messageBus,
        /**
         * @var string[]
         */
        #[Autowire(param: 'kernel.enabled_locales')]
        private readonly array $enabledLocales,
    ) {
    }

    public static function getEntityFqcn(): string
    {
        return MovieTmdbData::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('entity.movie_tmdb_data.label.singular')
            ->setEntityLabelInPlural('entity.movie_tmdb_data.label.plural')
            ->setDefaultSort(
                ['id' => 'ASC']
            )
            ->renderContentMaximized()
            ->overrideTemplates([
                'crud/index' => '/admin/crud/movie/index.html.twig',
                'crud/detail' => '/admin/crud/movie/tmdb_detail.html.twig',
            ]);
    }

    /**
     * @SuppressWarnings(PHPMD.StaticAccess)
     */
    public function configureFields(string $pageName): iterable
    {
        yield FormField::addTab('entity.movie_tmdb_data.tabs.main')
            ->hideOnForm();

        yield IdField::new('id')
            ->hideOnForm();

        yield IdField::new('movie.tmdbId')
            ->setLabel('entity.movie.attributes.tmdb_id')
            ->hideOnForm();

        yield AssociationField::new('movie')
            ->setLabel('entity.movie.label.singular');

        yield LocaleField::new('locale')
            ->setLabel('entity.movie_tmdb_data.attributes.locale')
            ->includeOnly($this->enabledLocales);

        yield TextField::new('title')
            ->setLabel('entity.movie_tmdb_data.attributes.title')
            ->hideOnForm();

        yield DateField::new('movie.releaseDate')
            ->setLabel('entity.movie.attributes.release_date')
            ->onlyOnDetail();

        yield NumberField::new('movie.popularity')
            ->setLabel('entity.movie.attributes.popularity')
            ->onlyOnDetail();

        yield IntegerField::new('movie.likes')
            ->setLabel('entity.movie.attributes.likes')
            ->onlyOnDetail();

        yield FormField::addTab('entity.movie_tmdb_data.tabs.json_data')
            ->onlyOnDetail();

        yield CodeEditorField::new('tmdbDataJson')
            ->setLabel('entity.movie_tmdb_data.attributes.tmdb_data_json')
            ->onlyOnDetail();

        yield CodeEditorField::new('tmdbDetailsDataJson')
            ->setLabel('entity.movie_tmdb_data.attributes.tmdb_details_data_json')
            ->onlyOnDetail();
    }

    public function configureActions(Actions $actions): Actions
    {
        return parent::configureActions($actions)
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            ->add(Crud::PAGE_EDIT, Action::DELETE)
            ->add(
                Crud::PAGE_INDEX,
                Action::new('movieHydrate', 'entity.movie.actions.movie_hydrate')
                    ->linkToCrudAction('movieHydrate')
                    ->createAsGlobalAction()
            );
    }

    public function movieHydrate(): RedirectResponse
    {
        $this->messageBus->dispatch(new MovieBatchHydrationMessage());

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
            ->add('title')
            ->add('locale');
    }
}
