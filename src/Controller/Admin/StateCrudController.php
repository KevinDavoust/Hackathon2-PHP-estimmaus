<?php

namespace App\Controller\Admin;

use App\Entity\State;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class StateCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return State::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud->setPageTitle('index', 'États')
            ->showEntityActionsInlined();
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('type', 'Type'),
            TextField::new('description', 'Description')->hideOnForm(),
            IntegerField::new('percentage', 'Pourcentage de réduction associé'),
        ];
    }

    public function configureAssets(Assets $assets): Assets
    {
        return $assets
            ->addCssFile('admin/admin-user.css');
    }

}
