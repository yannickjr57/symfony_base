<?php

namespace App\DataFixtures;

 
use App\Entity\Pain;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
class PainFixtures extends Fixture

{
    public const PAIN_REFERENCE = 'pain_';
    public function load(ObjectManager $manager): void
    {
        $pains = [
            'Blanc',
            'Complet',
            'Pain de seigle',
            'Pain de campagne',
            'Pain aux céréales',
            'Pain de mie',
            'Baguette',
        ];

       
        foreach ($pains as $index => $painName) {
            $pain = new Pain();
            $pain->setName($painName);
            $manager->persist($pain);

            // Enregistrer une référence pour ce pain
            $this->addReference(self::PAIN_REFERENCE . $index, $pain);
        }

        $manager->flush();
    }
}
