<?php

namespace App\Controller;

use App\Model\BirdModel;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ApiController extends AbstractController
{
    /**
     * @Route("/api/birds", name="api_birds_get")
     */
    public function index(): Response
    {
        // Get birds
        $birdModel = new BirdModel();
        $birds = $birdModel->getBirds();
        
        // Renvoie les oiseaux sous forme de JSON
        return $this->json([$birds]);
    }
}
