<?php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
* @Route("/{_locale}/user", requirements={"_locale"="fr|en|es"})
* @IsGranted("ROLE_USER")
*/
class UserController extends AbstractController {

    /**
    * @Route("/", name="user")
    */
    public function index() {
        return $this->render('user/index.html.twig', [
            'menu' => "home",
        ]);
    }


    
}
