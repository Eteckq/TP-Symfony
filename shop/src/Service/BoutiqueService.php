<?php
namespace App\Service;
use Symfony\Component\HttpFoundation\RequestStack;

class BoutiqueService {

    public function __construct(RequestStack $requestStack) {
        $this->requestStack = $requestStack;
    }

    // renvoie toutes les catégories
    public function findAllCategories() {
        return $this->categories;
    }


    private $requestStack; // Le service RequestStack qui sera injecté
    // Le catalogue de la boutique, codé en dur dans un tableau associatif
    private $categories = [
        [
            "id" => 1,
            "libelle" => "Fruits",
            "visuel" => "images/fruits.jpg",
            "texte" => "De la passion ou de ton imagination",
        ],
        [
            "id" => 3,
            "libelle" => "Junk Food",
            "visuel" => "images/junk_food.jpg",
            "texte" => "Chère et cancérogène, tu es prévenu(e)",
        ],
        [
            "id" => 2,
            "libelle" => "Légumes",
            "visuel" => "images/legumes.jpg",
            "texte" => "Plus tu en manges, moins tu en es un"],
    ];
    private $produits = [
        [
            "id" => 1,
            "idCategorie" => 1,
            "libelle" => "Pomme",
            "texte" => "Elle est bonne pour la tienne",
            "visuel" => "images/pommes.jpg",
            "prix" => 3.42
        ],
        [
            "id" => 2,
            "idCategorie" => 1,
            "libelle" => "Poire",
            "texte" => "Ici tu n'en es pas une",
            "visuel" => "images/poires.jpg",
            "prix" => 2.11
        ],
        [
            "id" => 3,
            "idCategorie" => 1,
            "libelle" => "Pêche",
            "texte" => "Elle va te la donner",
            "visuel" => "images/peche.jpg",
            "prix" => 2.84
        ],
        [
            "id" => 4,
            "idCategorie" => 2,
            "libelle" => "Carotte",
            "texte" => "C'est bon pour ta vue",
            "visuel" => "images/carottes.jpg",
            "prix" => 2.90
        ],
        [
            "id" => 5,
            "idCategorie" => 2,
            "libelle" => "Tomate",
            "texte" => "Fruit ou Légume ? Légume",
            "visuel" => "images/tomates.jpg",
            "prix" => 1.70
        ],
        [
            "id" => 6,
            "idCategorie" => 2,
            "libelle" => "Chou Romanesco",
            "texte" => "Mange des fractales",
            "visuel" => "images/romanesco.jpg",
            "prix" => 1.81
        ],
        [
            "id" => 7,
            "idCategorie" => 3,
            "libelle" => "Nutella",
            "texte" => "C'est bon, sauf pour ta santé",
            "visuel" => "images/nutella.jpg",
            "prix" => 4.50
        ],
        [
            "id" => 8,
            "idCategorie" => 3,
            "libelle" => "Pizza",
            "texte" => "Y'a pas pire que za",
            "visuel" => "images/pizza.jpg",
            "prix" => 8.25
        ],
        [
            "id" => 9,
            "idCategorie" => 3,
            "libelle" => "Oreo",
            "texte" => "Seulement si tu es un smartphone",
            "visuel" => "images/oreo.jpg",
            "prix" => 2.50
        ],
    ];
}
