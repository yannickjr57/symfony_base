<?php

namespace App\DataFixtures;

use App\Entity\Commentaire;
use App\Entity\Burger;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;


class CommentaireFixtures extends Fixture
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

        foreach ($comments as $comment) {
            $com = new Commentaire();
            $com->setName($comment);
            $com->setBurger($manager->getRepository(Burger::class)->find(rand(1, 8)));
            $manager->persist($com);
        }

        $manager->flush();
    }
}
