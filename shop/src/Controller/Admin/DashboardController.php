<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

use App\Service\OrderService;
use App\Entity\Command;

class DashboardController extends AbstractDashboardController
{
    private $order;

    public function __construct(OrderService $order) {
        $this->order = $order;
    }

    /**
    * @Route("/{_locale}/admin", requirements={"_locale"="fr|en|es"}, name="admin")
    * @IsGranted("ROLE_ADMIN")
     */
    public function index(): Response
    {
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
        return $this->redirectToRoute('admin');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Shop');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToRoute('Retour sur le site', 'fa fa-exit', "home");
        yield MenuItem::section('Articles');
        yield MenuItem::linkToCrud('Articles', 'fas fa-list', Article::class)->setController(ArticleCrudController::class);
        yield MenuItem::linkToCrud('Catégories', 'fas fa-list', Category::class)->setController(CategoryCrudController::class);

    }
}
