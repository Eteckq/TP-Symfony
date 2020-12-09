<?php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController {

    /**
    * @Route("/{_locale}/admin", name="admin", requirements={"_locale": "fr|en|es"})
    */
    public function index() {
        return $this->render('admin/index.html.twig', [
            'menu' => "home",
        ]);
    }


    
}
