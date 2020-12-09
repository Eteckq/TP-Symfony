<?php
namespace App\Controller;

use App\Entity\Article;
use App\Service\PanierService;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController {

    /**
    * @Route("/{_locale}/cart", name="cart", requirements={"_locale": "fr|en|es"})
    */
    public function index(PanierService $panier) {

        return $this->render('default/cart.html.twig', [
            'menu' => "cart",
            'panier' =>  $panier->getContenu()
        ]);
    }

    /**
    * @Route("/cart/add/{id}", name="cart.add")
    */
    public function addToCart(Article $article) {
        return $this->redirectToRoute("cart");
    }

    /**
    * @Route("/cart/remove/{id}", name="cart.remove")
    */
    public function removeFromCart(Article $article) {
        return $this->redirectToRoute("cart");
    }

    /**
    * @Route("/cart/delete/{id}", name="cart.delete")
    */
    public function deleteFromCart(Article $article) {
        return $this->redirectToRoute("cart");
    }

    /**
    * @Route("/cart/empty", name="cart.empty")
    */
    public function emptyCart() {
        return $this->redirectToRoute("cart");
    }
}
