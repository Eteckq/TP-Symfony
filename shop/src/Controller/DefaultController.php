<?php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class DefaultController extends AbstractController {

    /**
    * @Route("/{_locale<\d+>?fr}", name="home", requirements={"_locale": "fr|en|es"})
    */
    public function index() {
        return $this->render('default/index.html.twig', [
            'menu' => "home",
        ]);
    }

    /**
    * @Route("/{_locale}/contact", name="contact", requirements={"_locale": "fr|en|es"})
    */
    public function contact() {
        return $this->render('default/contact.html.twig', [
            'menu' => "contact",
        ]);
    }

    
}
