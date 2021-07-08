<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BirdController
{
    /**
     * Page d'accueil
     * 
     * @Route("/")
     */
    public function home()
    {
        return new Response('home');
    }
}