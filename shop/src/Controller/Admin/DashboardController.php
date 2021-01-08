<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class DashboardController extends AbstractDashboardController
{
    /**
    * @Route("/{_locale}/admin", requirements={"_locale"="fr|en|es"}, name="admin")
    * @IsGranted("ROLE_ADMIN")
     */
    public function index(): Response
    {
        return parent::index();
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
