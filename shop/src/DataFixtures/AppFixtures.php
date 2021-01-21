<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // FRUITS
        $fruits = new Category();
        $fruits->setLibelle("Fruits")
                 ->setTexte("De la passion ou de ton imagination")
                 ->setVisuel("fruits.jpg");


        $peche = new Article();
        $peche->setLibelle("Pêche ")
                ->setTexte("Elle va te la donner")
                ->setVisuel("peche.jpg")
                ->setPrix(2.84);
        $fruits->addArticle($peche);
        $manager->persist($peche);

        $poire = new Article();
        $poire->setLibelle("Poire ")
                ->setTexte("Ici tu n'en es pas une")
                ->setVisuel("poires.jpg")
                ->setPrix(2.11);
        $fruits->addArticle($poire);
        $manager->persist($poire);

        $pomme = new Article();
        $poire->setLibelle("Pomme ")
                ->setTexte("Elle est bonne pour la tienne")
                ->setVisuel("pommes.jpg")
                ->setPrix(3.42);
        $fruits->addArticle($poire);
        $manager->persist($poire);
        
        $manager->persist($fruits);

        // Junk Food
        $junk = new Category();
        $junk->setLibelle("Fruits")
                ->setTexte("Chère et cancérogène, tu es prévenu(e)")
                ->setVisuel("junk_food.jpg");


        $nutella = new Article();
        $nutella->setLibelle("Nutella ")
                ->setTexte("C'est bon, sauf pour ta santé")
                ->setVisuel("nutella.jpg")
                ->setPrix(4.5);
        $junk->addArticle($nutella);
        $manager->persist($nutella);

        $oreo = new Article();
        $oreo->setLibelle("Oreo ")
                ->setTexte("Seulement si tu es un smartphone")
                ->setVisuel("oreo.jpg")
                ->setPrix(2.5);
        $junk->addArticle($oreo);
        $manager->persist($oreo);

        $pizza = new Article();
        $pizza->setLibelle("Pizza ")
                ->setTexte("Y'a pas pire que za")
                ->setVisuel("pommes.jpg")
                ->setPrix(8.25);
        $junk->addArticle($pizza);
        $manager->persist($pizza);

        $manager->persist($junk);

        // Legume
        $legume = new Category();
        $legume->setLibelle("Légumes")
                ->setTexte("Plus tu en manges, moins tu en es un")
                ->setVisuel("legumes.jpg");


        $carotte = new Article();
        $carotte->setLibelle("Carotte")
                ->setTexte("C'est bon pour ta vue")
                ->setVisuel("carottes.jpg")
                ->setPrix(2.9);
        $legume->addArticle($carotte);
        $manager->persist($carotte);

        $chou = new Article();
        $chou->setLibelle("Oreo ")
                ->setTexte("Mange des fractales")
                ->setVisuel("romanesco.jpg")
                ->setPrix(1.81);
        $legume->addArticle($chou);
        $manager->persist($chou);

        $tomate = new Article();
        $tomate->setLibelle("Tomate")
                ->setTexte("Fruit ou légume ? légume")
                ->setVisuel("tomates.jpg")
                ->setPrix(8.25);
        $legume->addArticle($tomate);
        $manager->persist($tomate);

        $manager->persist($legume);


        $manager->flush();
    }
}
