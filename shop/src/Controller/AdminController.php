<?php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
* @Route("/{_locale}/admin", requirements={"_locale"="fr|en|es"})
* @IsGranted("ROLE_ADMIN")
*/
class AdminController extends AbstractController {

    /**
    * @Route("/", name="admin")
    */
    public function index() {
        return $this->render('admin/index.html.twig', [
            'menu' => "home",
        ]);
    }


    
}
