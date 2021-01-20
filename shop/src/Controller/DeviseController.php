<?php
namespace App\Controller;

use App\Service\DeviseService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DeviseController extends AbstractController
{


    /**
    * @Route("/{_locale}/changeDevise/{devise}", requirements={"_locale"="fr|en|es"}, name="devise")
    */
    public function change(DeviseService $deviseService, $devise) {
        $deviseService->setUserDevise($devise);
        // FIXME: Refresh current page instead of going to the cart
        return $this->redirectToRoute("cart");
    }
}