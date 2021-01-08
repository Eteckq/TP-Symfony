<?php
namespace App\Controller;

use App\Entity\Article;
use App\Entity\Command;
use App\Entity\CommandLine;

use App\Service\PanierService;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
* @Route("/{_locale}/cart", requirements={"_locale"="fr|en|es"})
*/
class CartController extends AbstractController {

    private $panier;

    public function __construct(PanierService $panier) {
        $this->panier = $panier;
    }

    /**
    * @Route("/", name="cart")
    */
    public function index() {
        return $this->render('default/cart.html.twig', [
            'menu' => "cart",
            'panier' =>  $this->panier->getContenu(),
            'produits' => $this->panier->getNbProduits(),
            'price' => $this->panier->getTotal(),
        ]);
    }

    /**
    * @Route("/add/{id}", name="cart.add")
    */
    public function addToCart(Article $article) {
        $this->panier->ajouterProduit($article->getId());
        return $this->redirectToRoute("cart");
    }

    /**
    * @Route("/remove/{id}", name="cart.remove")
    */
    public function removeFromCart(Article $article) {
        $this->panier->enleverProduit($article->getId());
        return $this->redirectToRoute("cart");
    }

    /**
    * @Route("/delete/{id}", name="cart.delete")
    */
    public function deleteFromCart(Article $article) {
        $this->panier->supprimerProduit($article->getId());
        return $this->redirectToRoute("cart");
    }

    /**
    * @Route("/order", name="cart.order")
    * @IsGranted("ROLE_USER")
    */
    public function orderCart(\Swift_Mailer $mailer) {
        $cartContent = $this->panier->getContenu();
        if(count($cartContent) == 0){
            $this->addFlash('error', 'Panier vide');
            return $this->redirectToRoute("cart");
        }
        $entityManager = $this->getDoctrine()->getManager();

        $command = new Command();
        foreach ($cartContent as $cartProduct) {
            $commandLine = new CommandLine();
            $commandLine->setIdArticle($cartProduct["produit"]);
            $commandLine->setQuantite($cartProduct["quantite"]);
            $commandLine->setPrix($cartProduct["produit"]->getPrix() * $cartProduct["quantite"]);
            $command->addCommandLine($commandLine);

            $entityManager->persist($commandLine);
        }

        $command->setStatut("En attente");
        $command->setIdUser($this->getUser());
        $entityManager->persist($command);
        $entityManager->flush();

        $this->panier->vider();

        // Send Mail
        $message = (new \Swift_Message('Commande acceptée'))
        ->setFrom('yohan.g99@gmail.com')
        ->setTo('yohan.g99@gmail.com')
        ->setBody(
            $this->renderView(
                'email/order.html.twig',
                ['name' => 'Yoo']
            ),
            'text/html'
        );
        

        $mailer->send($message);



        
        return $this->redirectToRoute("cart");
    }

    /**
    * @Route("/empty", name="cart.empty")
    */
    public function emptyCart() {
        $this->panier->vider();
        return $this->redirectToRoute("cart");
    }
}
