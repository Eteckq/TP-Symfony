<?php
namespace App\Controller;
use App\Service\BoutiqueService;
use App\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
* @Route("/{_locale}/boutique", requirements={"_locale"="fr|en|es"})
*/
class BoutiqueController extends AbstractController {
    
    /**
    * @Route("/", name="boutique")
    */
    public function index(BoutiqueService $boutique) {
        $categories = $boutique->findAllCategories();
        return $this->render('default/boutique.html.twig', [
            'menu' => "boutique",
            'categories' => $categories
        ]);
    }

    /**
    * @Route("/{id}", name="category.show")
    */
    public function show(Category $category) {
        return $this->render('default/category.html.twig', [
            'menu' => "boutique",
            'category' => $category
        ]);
    }
}
