<?php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\BoutiqueService;

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

    public function topSales(BoutiqueService $boutique, $max){
        $articles = $boutique->getTopSales($max);
        return $this->render('_partials/_top-products.html.twig', [
            'articles' => $articles
        ]);
    }
    
}
