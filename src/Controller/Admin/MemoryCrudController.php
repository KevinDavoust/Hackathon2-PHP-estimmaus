<?php

namespace App\Controller\Admin;

use App\Entity\Memory;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class MemoryCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Memory::class;
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
