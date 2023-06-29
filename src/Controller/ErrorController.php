<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class ErrorController extends AbstractController
{
    #[Route('/error404', name: 'app_error404')]
    public function showException(): Response
    {
        return $this->render('errors/error404.html.twig');
    }
}