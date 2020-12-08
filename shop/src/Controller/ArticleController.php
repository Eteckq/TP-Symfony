<?php
namespace App\Controller;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController {

    /**
    * @Route("/articles")
    */
    public function index(ArticleRepository $repository) {
        //$categories = $boutique->findAllCategories();
        return $this->render('default/index.html.twig', [
            'number' => 25,
        ]);
    }
}
