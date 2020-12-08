<?php
namespace App\Controller;
use App\Service\BoutiqueService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController {


    public function topSales(BoutiqueService $boutique, $max){
        $articles = $boutique->getTopSales($max);
        return $this->render('_partials/_top-products.html.twig', [
            'articles' => $articles
            ]);
    }
}
