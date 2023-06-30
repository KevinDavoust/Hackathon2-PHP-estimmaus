<?php

namespace App\Controller\Admin;

use App\Repository\CityRepository;
use App\Repository\SmartphoneRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;

class ChartController extends AbstractController
{
    #[Route('/admin/charts', name: 'app_admin_charts')]
    public function index(ChartBuilderInterface $chartBuilder, SmartphoneRepository $smartphoneRepository, CityRepository $cityRepository, UserRepository $userRepository): Response
    {
        $chart = $chartBuilder->createChart(Chart::TYPE_BAR);

        // Récupérer les données depuis la base de données
        $cities = $cityRepository->findAll();
        $data = [];

        $cityNames = [];
        foreach ($cities as $city) {
            $phoneCount = $smartphoneRepository->countByCity($city);
            $data[$city->getId()] = $phoneCount;
            $cityNames[] = $city->getName();
        }
        array_multisort($data, SORT_DESC, $cities);

        // Préparer les données pour le graphique
        $chart->setData([
            'labels' => $cityNames,
            'datasets' => [
                [
                    'label' => 'Nombre de téléphones dans chaque centre',
                    'data' => $data,
                    'backgroundColor' => 'rgb(255, 99, 132, .4)',
                    'borderColor' => 'rgb(255, 99, 132)',
                    'borderWidth' => 1
                ]
            ]
        ]);
        $chart->setOptions([
            'maintainAspectRatio' => false,
        ]);

        $chart2 = $chartBuilder->createChart(Chart::TYPE_BAR);

        // Récupérer les données depuis la base de données
        $cities = $cityRepository->findAll();
        $data2 = [];

        $cityNames = [];
        foreach ($cities as $city) {
            $memberCount = $userRepository->countByCity($city); // Supposons que tu aies une méthode countByCity() dans le SmartphoneRepository
            $data2[$city->getId()] = $memberCount;
            $cityNames[] = $city->getName();
        }

        array_multisort($data2, SORT_DESC, $cities);

        // Préparer les données pour le graphique
        $chart2->setData([
            'labels' => $cityNames,
            'datasets' => [
                [
                    'label' => 'Nombre de bénévoles enregistrés',
                    'data' => $data2,
                    'backgroundColor' => 'rgba(45, 220, 126, .4)',
                    'borderColor' => 'rgba(45, 220, 126)',
                    'borderWidth' => 1
                ]
            ]
        ]);
        $chart2->setOptions([
            'maintainAspectRatio' => false,
        ]);

        return $this->render('chart/index.html.twig', [
            'chart' => $chart,
            'data' => $data,
            'chart2' => $chart2,
            'data2' => $data2,
        ]);
    }
}