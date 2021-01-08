<?php

// src/Service/PanierService.php
namespace App\Service;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Service\BoutiqueService;
// Service pour manipuler le panier et le stocker en session
class PanierService {
    ////////////////////////////////////////////////////////////////////////////
    const PANIER_SESSION = 'panier'; // Le nom de la variable de session du panier
    private $session;  // Le service Session
    private $boutique; // Le service Boutique
    private $panier;   // Tableau associatif idProduit => quantite
	                   //  donc $this->panier[$i] = quantite du produit dont l'id = $i
    // constructeur du service
    public function __construct(SessionInterface $session, BoutiqueService $boutique) {
        // Récupération des services session et BoutiqueService
        $this->boutique = $boutique;
        $this->session = $session;
        $this->panier = $session->get(self::PANIER_SESSION, array());
    }
    // getContenu renvoie le contenu du panier
    //  tableau d'éléments [ "produit" => un produit, "quantite" => quantite ]
    public function getContenu() {
        // var_dump($this->boutique->getProductById(43)->getVisuel());
        $content = array();
        foreach ($this->panier as $panierProduct => $value) {
            $product = $this->boutique->getProductById($panierProduct);
            $quantity = $value;
            $content[] = ["produit" => $product, "quantite" =>  $quantity];
        }
        return $content;
    }
    // getTotal renvoie le montant total du panier
    public function getTotal() {
        $totalPrice = 0;
        foreach ($this->panier as $panierProduct => $value) {
            $product = $this->boutique->getProductById($panierProduct);
            $totalPrice += $product->getPrix() * $value;
        }
        return $totalPrice;
       
    }
    // getNbProduits renvoie le nombre de produits dans le panier
    public function getNbProduits() {
        return count($this->panier);
    }
    // ajouterProduit ajoute au panier le produit $idProduit en quantite $quantite 
    public function ajouterProduit(int $idProduit, int $quantite = 1) {
        if(!isset($this->panier[$idProduit])){
            $this->panier[$idProduit] = 0;
        }
        $this->panier[$idProduit] += $quantite;
        $this->session->set(self::PANIER_SESSION, $this->panier);
    }
    // enleverProduit enlève du panier le produit $idProduit en quantite $quantite 
    public function enleverProduit(int $idProduit, int $quantite = 1) {
        if($this->panier[$idProduit] == 1){
            $this->supprimerProduit($idProduit);
        } else {
            $this->panier[$idProduit] -= 1;
            $this->session->set(self::PANIER_SESSION, $this->panier);
        }
    }
    // supprimerProduit supprime complètement le produit $idProduit du panier
    public function supprimerProduit(int $idProduit) {
        unset($this->panier[$idProduit]);
        $this->session->set(self::PANIER_SESSION, $this->panier);
    }
    // vider vide complètement le panier
    public function vider() {
        $this->panier = array();
        $this->session->set(self::PANIER_SESSION, $this->panier);
    }

    // Passer la commande
    public function order(){
        $cartContent = $this->getContenu();
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
    }

    // Send Mail
    public function sendMail(){
        $message = (new \Swift_Message('Hello Email'))
        ->setFrom('send@example.com')
        ->setTo('recipient@example.com')
        ->setBody(
            $this->renderView(
                // templates/emails/registration.html.twig
                'emails/registration.html.twig',
                ['name' => $this->getUser().getNom()]
            ),
            'text/html'
        );
        

        $mailer->send($message);
    }
}
