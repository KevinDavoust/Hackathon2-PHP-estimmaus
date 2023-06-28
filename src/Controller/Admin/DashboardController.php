<?php

namespace App\Controller\Admin;

use App\Entity\Brand;
use App\Entity\Category;
use App\Entity\Memory;
use App\Entity\Model;
use App\Entity\Smartphone;
use App\Entity\State;
use App\Entity\Storage;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{

    public function __construct(
        private AdminUrlGenerator $adminUrlGenerator
    ) {
    }
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $url = $this->adminUrlGenerator

            ->setController(UserCrudController::class)
            ->generateUrl();

        return $this->redirect($url);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Administration');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Panneau d\'administration', 'fa fa-home');

        yield MenuItem::subMenu('Utilisateurs', 'fas fa-bar')->setSubItems([
            MenuItem::linkToCrud('Créer un utilisateur', 'fas fa-plus-circle', User::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Voir utilisateurs', 'fas fa-eye', User::class),
        ]);

        yield MenuItem::subMenu('Marques', 'fas fa-bar')->setSubItems([
            MenuItem::linkToCrud('Ajouter une marque', 'fas fa-plus-circle', Brand::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Voir marques', 'fas fa-eye', Brand::class),
        ]);

        yield MenuItem::subMenu('Catégories', 'fas fa-bar')->setSubItems([
            MenuItem::linkToCrud('Ajouter une catégorie', 'fas fa-plus-circle', Category::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Voir catégories', 'fas fa-eye', Category::class),
        ]);

        yield MenuItem::subMenu('RAM', 'fas fa-bar')->setSubItems([
            MenuItem::linkToCrud('Ajouter RAM', 'fas fa-plus-circle', Memory::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Voir RAM', 'fas fa-eye', Memory::class),
        ]);

        yield MenuItem::subMenu('Modèles', 'fas fa-bar')->setSubItems([
            MenuItem::linkToCrud('Ajouter un modèle', 'fas fa-plus-circle', Model::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Voir modèles', 'fas fa-eye', Model::class),
        ]);

        yield MenuItem::subMenu('Smartphones', 'fas fa-bar')->setSubItems([
            MenuItem::linkToCrud('Ajouter un smartphone', 'fas fa-plus-circle', Smartphone::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Voir smartphones', 'fas fa-eye', Smartphone::class),
        ]);

        yield MenuItem::subMenu('États', 'fas fa-bar')->setSubItems([
            MenuItem::linkToCrud('Ajouter un état', 'fas fa-plus-circle', State::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Voir états', 'fas fa-eye', State::class),
        ]);

        yield MenuItem::subMenu('Stockage', 'fas fa-bar')->setSubItems([
            MenuItem::linkToCrud('Ajouter stockage', 'fas fa-plus-circle', Storage::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Voir stockage', 'fas fa-eye', Storage::class),
        ]);
    }
}
