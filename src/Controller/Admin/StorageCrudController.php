<?php

namespace App\Controller\Admin;

use App\Entity\Storage;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class StorageCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Storage::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
