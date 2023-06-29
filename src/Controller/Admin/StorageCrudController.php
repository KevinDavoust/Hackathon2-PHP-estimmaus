<?php

namespace App\Controller\Admin;

use App\Entity\Storage;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;

class StorageCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Storage::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud->setPageTitle('index', 'Stockage')
            ->showEntityActionsInlined();
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            IntegerField::new('size', 'Quantité'),
        ];
    }

    public function configureAssets(Assets $assets): Assets
    {
        return $assets
            ->addCssFile('admin/admin-user.css');
    }

}
