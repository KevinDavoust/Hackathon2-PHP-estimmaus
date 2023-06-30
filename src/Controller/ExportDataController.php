<?php

namespace App\Controller;

use App\Repository\SmartphoneRepository;
use Doctrine\DBAL\Schema\Schema;
use League\Csv\Writer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ExportDataController extends AbstractController
{
    #[Route('/export/data', name: 'app_export_data')]
    public function exportData(SmartphoneRepository $smartphoneRepository): Response
    {
        $headers = ['id', 'Model_ID', 'Storage_Id', 'State_Id', 'category_id', 'total_id'];
        $smartphones = $smartphoneRepository->findAll();

        $csv = Writer::createFromFileObject(new \SplTempFileObject());

        $csv->insertOne($headers);

        foreach ($smartphones as $smartphone) {
            $arr[] = array($smartphone);
            $csv->insertOne($arr);
        }
//            $arr = json_decode(json_encode ($smartphone) , true);

        $csv->output('smartphones_exports.csv');

        return $this->render('export_data/index.html.twig', [
            'controller_name' => 'ExportDataController',
        ]);
    }
}
