<?php

namespace App\Controller\Admin\Crud;

use App\Entity\EmailLog;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class EmailLogCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return EmailLog::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return Crud::new()
            ->setEntityLabelInSingular('entity.email_log.label.singular')
            ->setEntityLabelInPlural('entity.email_log.label.plural');
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')
            ->setLabel('entity.email_log.attributes.id');

        yield TextField::new('subject')
            ->setLabel('entity.email_log.attributes.subject');

        yield DateTimeField::new('sentAt')
            ->setLabel('entity.email_log.attributes.sent_at');

        yield EmailField::new('sender')
            ->setLabel('entity.email_log.attributes.sender');

        yield EmailField::new('recipient')
            ->setLabel('entity.email_log.attributes.receiver');

        yield TextareaField::new('html')
            ->setLabel('entity.email_log.attributes.html')
            ->hideOnIndex()
            ->renderAsHtml();
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->disable(Action::NEW, Action::EDIT, Action::DELETE, Action::BATCH_DELETE)
            ->add(Crud::PAGE_INDEX, Action::DETAIL);
    }
}
