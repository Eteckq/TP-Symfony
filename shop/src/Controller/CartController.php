<?php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController {

    /**
    * @Route("/{_locale}/cart", name="cart", requirements={"_locale": "fr|en|es"})
    */
    public function index() {
        return $this->render('default/index.html.twig', [
            'menu' => "cart",
        ]);
    }
}
