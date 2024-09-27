<?php

namespace App\DataFixtures;

use App\Entity\Commentaire;
use App\Entity\Burger;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class CommentaireFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $comments = [
            'C\'est délicieux !',
            'Je recommande !',
            'Très bon burger',
            'Je suis un peu déçu...',
            'C\'est trop salé...',
        ];

        // Trouver le burger avec l'ID 1
       // $burger = $manager->getRepository(Burger::class)->find(1);

       // if ($burger === null) {
        //    throw new \LogicException('Burger with ID 1 not found. Ensure that the burger exists in the database.');
      //  }

       // foreach ($comments as $comment) {
          //  $com = new Commentaire();
            //$com->setName($comment);

            // Associer le burger trouvé (ID 1) à chaque commentaire
           // $com->setBurger($burger);

           // $manager->persist($com);
        //}

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            BurgerFixtures::class,
        ];
    }
}
