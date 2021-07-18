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
     * @Route("/", name="home", methods={"GET"})
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
     * @Route("/bird/{id}", name="bird_show", requirements={"id"="\d+"}, methods={"GET"})
     */
    public function show($id, SessionInterface $session)
    {

        dump ($session->get('wishlist'));

        // On récupère un oiseau selon l'id fourni
        $birdModel = new BirdModel();
        $bird = $birdModel->getBirdById($id);

        // /!\ C'est bien le rôle du contrôleur de gérer la 404
        // Oiseau non trouvé ?
        if ($bird === null) {
            throw $this->createNotFoundException('Bird not found.');
        }
        
        return $this->render('bird/show.html.twig', [
            // Données de l'oiseau pour affichage
            'bird' => $bird,
            // Id de l'oiseau pour le panier
            'id' => $id,
        ]);
    }

    /**
     * @Route("/bird/wishlist", name="wishlist", methods={"GET"})
     */
    public function whislist(SessionInterface $session, Request $request)
    {
        dump ($session->get('wishlist'));
        //$session->remove('wishlist');
        // Vérifie si la wishlist existe
        if ( $session->get('wishlist') == null ) {
            $birds = null;
        }
        else {
            $wishlist = $session->get('wishlist');
            $birdModel = new BirdModel();
            // On récupère la liste des oiseaux
            foreach($wishlist as $id)
            {
                $birds[] = $birdModel->getBirdById($id);
            }
        }

        return $this->render('bird/wishlist.html.twig', [
            'wishlist' => $birds,
        ]);
    }

    /**
     * @Route("/wishlist/add/{id}", name="wishlist_add", methods={"POST"})
     */
    public function wishlistAdd($id, SessionInterface $session, Request $request)
    {
        // Récupère la valeur de la session
        $sessionVal = $session->get('wishlist');

        // Récupère la valeur postée
        //$item = $request->request->get('id');
        $item = $id;

        if ( !empty($sessionVal) ) 
        {
            if ( !in_array($item, $sessionVal) ) {
                // Ajoute la nouvelle valeur
                $sessionVal[] = (int)$item;

                // Redéfini la session avec les nouvelles valeurs
                $session->set('wishlist', $sessionVal);

                $this->addFlash(
                    'success',
                    'Item added to your wishlist with success!'
                );
            } else {

                $this->addFlash(
                    'info',
                    'Item already in your wishlist!'
                );
            }
        } else {
            // Ajoute la nouvelle valeur
            $sessionVal[] = (int)$item;
            $session->set('wishlist', $sessionVal);

            $this->addFlash(
                'success',
                'Item added to your wishlist with success!'
            );
        }

        // On redirige vers la page d'origine
        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * @Route("/wishlist/delete/{id}", name="wishlist_delete", requirements={"id"="\d+"}, methods={"GET"})
     */
    public function wishlistDelete($id, SessionInterface $session, Request $request)
    {
        // Récupère la valeur de la session
        $sessionVal = $session->get('wishlist');

        // Supprime la valeur postée
        if (($key = array_search($id, $sessionVal)) !== false) {
            unset($sessionVal[$key]);

            $this->addFlash(
                'success',
                'Item deleted from your wishlist with success!'
            );
        }

        // Redéfini la session avec les nouvelles valeurs
        $session->set('wishlist', $sessionVal);

        // On redirige vers la page d'origine
        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * @Route("/theme/dark", name="dark_theme", methods={"GET"})
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