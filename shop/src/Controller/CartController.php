<?php
namespace App\Controller;

use App\Entity\Article;
use App\Service\PanierService;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
* @Route("/{_locale}/cart", requirements={"_locale"="fr|en|es"})
*/
class CartController extends AbstractController {

    /**
    * @Route("/", name="cart", requirements={"_locale": "fr|en|es"})
    */
    public function index(PanierService $panier) {

        return $this->render('default/cart.html.twig', [
            'menu' => "cart",
            'panier' =>  $panier->getContenu()
        ]);
    }

    /**
    * @Route("/add/{id}", name="cart.add")
    */
    public function addToCart(Article $article) {
        return $this->redirectToRoute("cart");
    }

    /**
    * @Route("/remove/{id}", name="cart.remove")
    */
    public function removeFromCart(Article $article) {
        return $this->redirectToRoute("cart");
    }

    /**
    * @Route("/delete/{id}", name="cart.delete")
    */
    public function deleteFromCart(Article $article) {
        return $this->redirectToRoute("cart");
    }

    /**
    * @Route("/empty", name="cart.empty")
    */
    public function emptyCart() {
        return $this->redirectToRoute("cart");
    }
}
