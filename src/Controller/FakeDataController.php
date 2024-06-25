<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api')]
class FakeDataController extends AbstractController
{
    #[Route('/fake-data', name: 'fake_data', methods: ['GET'])]
    public function index(): Response
    {
        $fakeData = [
            'barChart' => [
                'labels' => ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                'data' => [65, 59, 80, 81, 56, 55, 40]
            ],
            'lineChart' => [
                'labels' => ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                'data' => [28, 48, 40, 19, 86, 27, 90]
            ],
            'pieChart' => [
                'labels' => ['Online', 'On the Spot', 'Other', 'Telephone'],
                'data' => [50, 20, 20, 10]
            ],
            'rateChart' => [
                'labels' => ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                'data' => [25, 49, 30, 19, 66, 47, 70]
            ],
            'tableData' => [
                'labels' => ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                'data' => [100, 200, 150, 300, 250, 400, 350]
            ],
            'activeUserChart' => [
                'labels' => ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
                'data' => [200, 250, 300, 280]
            ]
        ];

        return $this->json($fakeData, 200);
    }
}
