<?php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\BoutiqueService;

class BoutiqueController extends AbstractController {

    /**
    * @Route("/boutique")
    */
    public function index(BoutiqueService $boutique) {
        //$categories = $boutique->findAllCategories();
        return $this->render('guest/index.html.twig', [
            'number' => 25,
        ]);
    }
}
