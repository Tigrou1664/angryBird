<?php

namespace App\Controller;

use App\Model\BirdModel;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CartController extends AbstractController
{
    /**
     * @Route("/cart/add", name="cart_add", methods={"POST"})
     * 
     * @return Response La réponse à retourner
     */
    public function add(Request $request, SessionInterface $session): Response
    {
        // Notre id se trouve dans $_POST['id'], accessible via :
        $id = $request->request->get('id');

        // On récupère un oiseau selon l'id fourni, pour le mettre dans le panier
        $birdModel = new BirdModel();
        $bird = $birdModel->getBirdById($id);

        // /!\ C'est bien le rôle du contrôleur de gérer la 404
        // Oiseau non trouvé ?
        if ($bird === null) {
            throw $this->createNotFoundException('Bird not found.');
        }

        // On récupère le panier de la session
        // Le panier (tableau) existant OU un panier (tableau) vide (la première fois)
        // 'cart' = clé du tableau de session = en Symfony, attribut de session
        $cart = $session->get('cart', []); // $cart = $_SESSION['cart'];

        // A ce stade on a soit $cart = [] soit $cart = [ des choses dedans ]

        // On y ajoute l'id demandé si pas déja présent le tableau
        // On va stocker l'id de l'oiseau à la clé du tableau cart
        if ( !array_key_exists($id, $cart) ) {
            // On va ajouter 1 fois l'oiseau dans le panier

            // Via un tableau associatif qui va structurer le contenu du panier
            $birdAndQuantity = [
                'bird' => $bird, // $bird = toutes les infos de l'oiseau (via le Model)
                'quantity' => 1,
            ];

            // On ajoute l'oiseau et sa quantité dans le panier
            $cart[$id] = $birdAndQuantity;
        }
        else {
            // On ajoute 1 à la quantité
            $cart[$id]['quantity'] += 1;
        }

        // On remet le nouveau panier dans la session
        $session->set('cart', $cart);

        // On ajoute un Flash Message
        $this->addFlash('success', 'Bird added to cart.');

        // On redirige
        return $this->redirectToRoute('cart_show');
    }

    /**
     * @Route("/cart", name="cart_show", methods={"GET"})
     */
    public function show(SessionInterface $session)
    {
        // On récupère le panier (plein ou vide)
        $cart = $session->get('cart');

        // On rend la vue avec les données
        return $this->render('cart/show.html.twig', [
            'cart' => $cart,
        ]);
    }

    /**
     * @Route("/cart/clear", name="cart_clear")
     */
    public function clear(SessionInterface $session)
    {
        // On supprime l'attribur de session qui correspond au panier
        // @link https://symfony.com/doc/current/components/http_foundation/sessions.html#attributes
        $session->remove('cart');

        // On ajoute un Flash Message
        $this->addFlash('success', 'Cart emptied.');
        
        return $this->redirectToRoute('cart_show');
    }
}