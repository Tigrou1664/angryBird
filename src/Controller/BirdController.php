<?php

namespace App\Controller;

use App\Model\BirdModel;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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
        // On récupère nos oiseaux
        $birdModel = new BirdModel();
        $birds = $birdModel->getBirds();
        //dump($birds);

        // On range le template dans un dossier qui correspond
        // au nom du contrôleur
        // Chemin à partir de templates/
        return $this->render('bird/home.html.twig', [
            'birds' => $birds,
        ]);
    }

    /**
     * Page d'un oiseau
     * 
     * @Route("/bird/{id}", name="bird_show", requirements={"id"="\d+"})
     */
    public function show($id)
    {
        // On récupère un oiseau selon l'id fourni
        $birdModel = new BirdModel();
        $bird = $birdModel->getBirdById($id);

        // /!\ C'est bien le rôle du contrôleur de gérer la 404
        // Oiseau non trouvé ?
        if ($bird === null) {
            throw $this->createNotFoundException('Bird not found.');
        }
        
        return $this->render('bird/show.html.twig', [
            'bird' => $bird,
        ]);
    }

    /**
     * @Route("/theme/dark", name="dark_theme")
     */
    public function darkTheme(SessionInterface $session, Request $request)
    {
        // Définir le thème dark en session si pas présent
        if ($session->get('theme') == null) {
            // Définissons un attribut de session, disons 'theme' à 'dark'
            $session->set('theme', 'dark'); // $_SESSION['theme'] = 'dark';
        } else {
            // Sinon, on le supprime
            $session->remove('theme');
        }

        // On redirige vers la page d'origine
        // grâce un header de requête qui contient l'URL d'origine, qu'on appelle le referer
        return $this->redirect($request->headers->get('referer'));
    }
}