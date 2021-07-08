<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * AbstractController est le contrôleur du FW Symfony
 * qui nous donne les supers-pouvoirs
 * par ex. rendre un template Twig
 */
class BirdController extends AbstractController
{
    /**
     * Page d'accueil
     * 
     * @Route("/", name="home")
     */
    public function home()
    {
        // On range le template dans un dossier qui correspond
        // au nom du contrôleur
        // Chemin à partir de templates/
        return $this->render('bird/home.html.twig');
    }

    /**
     * Page d'un oiseau
     * 
     * @Route("/bird/{id}", name="bird_show")
     */
    public function show($id)
    {
        return $this->render('bird/show.html.twig');
    }
}