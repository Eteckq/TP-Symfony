<?php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

use App\Service\OrderService;
use App\Entity\Command;
/**
* @Route("/{_locale}/adminOld", requirements={"_locale"="fr|en|es"})
* @IsGranted("ROLE_ADMIN")
*/
class AdminController extends AbstractController {

    private $order;

    public function __construct(OrderService $order) {
        $this->order = $order;
    }

    /**
    * @Route("/", name="adminOld.index")
    */
    public function index() {
        return $this->render('admin/index.html.twig', [
            'menu' => "back",
        ]);
    }

    /**
    * @Route("/orders", name="admin.orders")
    */
    public function orders() {
        return $this->render('admin/orders.html.twig', [
            'menu' => 'back',
            'orders' => $this->order->findAllCommandsToValidate(),
        ]);
    }

    /**
     * @Route("order/{id}/validate", name="admin.validate", methods={"GET"})
     */
    public function edit(Command $command)
    {
        $command->setStatut("Validée");
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($command);
        $entityManager->flush();
        return $this->redirectToRoute('admin.orders');
    }
    
}
