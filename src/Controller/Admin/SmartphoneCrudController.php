<?php

namespace App\Controller\Admin;

use App\Entity\Smartphone;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;

class SmartphoneCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Smartphone::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud->setPageTitle('index', 'Smartphones')
            ->showEntityActionsInlined();
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            AssociationField::new('model', 'Modèle'),
            AssociationField::new('memory', 'RAM'),
            AssociationField::new('storage', 'Stockage'),
            AssociationField::new('state', 'État'),
            AssociationField::new('category', 'Catégorie')->hideOnForm(),
            IntegerField::new('totalIndice', 'Indice total')->hideOnForm(),
        ];
    }

}
