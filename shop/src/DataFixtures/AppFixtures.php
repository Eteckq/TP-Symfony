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
        $category = new Category();

        $category->setLibelle("Fourtou")
                 ->setTexte("Yatoudedans")
                 ->setVisuel("junk_food.jpg");

        for ($i = 0; $i < 10; $i++) {
            $article = new Article();
            $article->setLibelle("article ".$i)
                    ->setTexte("texte")
                    ->setVisuel("pizza.jpg")
                    ->setPrix(52.2);

            $category->addArticle($article);
            $manager->persist($article);
        }

        $manager->persist($category);
        $manager->flush();
    }
}
