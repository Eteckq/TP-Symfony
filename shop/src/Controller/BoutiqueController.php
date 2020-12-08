<?php
namespace App\Controller;
use App\Service\BoutiqueService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BoutiqueController extends AbstractController {

    /**
    * @Route("/")
    */
    public function index(BoutiqueService $boutique) {
        //$categories = $boutique->findAllCategories();
        return $this->render('default/index.html.twig', [
            'number' => 25,
        ]);
    }
}
