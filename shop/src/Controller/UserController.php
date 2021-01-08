<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

use App\Service\OrderService;
/**
* @Route("/{_locale}/user", requirements={"_locale"="fr|en|es"})
* @IsGranted("ROLE_USER")
*/
class UserController extends AbstractController {

    private $order;

    public function __construct(OrderService $order) {
        $this->order = $order;
    }


    /**
    * @Route("/", name="user.index")
    */
    public function index() {
        return $this->render('user/index.html.twig', [
            'menu' => "account"
        ]);
    }

    /**
    * @Route("/orders", name="user.orders")
    */
    public function orders() {
        return $this->render('user/orders.html.twig', [
            'menu' => 'account',
            'orders' => $this->order->getOrdersByUserId($this->getUser()->getId()),
        ]);
    }
    
}