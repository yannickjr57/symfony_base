<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Sauce;
use Doctrine\ORM\EntityManagerInterface;

class SauceController extends AbstractController
{
    private $entityManager;

    #[Route('/sauce/create', name: 'app_sauce_create')]
    public function create(EntityManagerInterface $entityManager) : Response
    {
        $sauce = new Sauce();
        $sauce->setName('Sauce de test');
 
        // Persister et sauvegarder la sauce
        $entityManager->persist($sauce);
        $entityManager->flush();
 
        return new Response('Sauce ajoutée avec succès !');
    }
    #[Route('/sauce', name: 'app_sauce')]
    public function index(): Response
    {
        return $this->render('sauce/index.html.twig', [
            'controller_name' => 'SauceController',
        ]);
    }

    #[Route('/sauce/liste', name: 'app_sauce_liste')]
    public function listeSauces()
    {
        $sauces= $this->entityManager->getRepository(Sauce::class)->findAll();
        return $this->render('sauce/liste.html.twig', ['sauces' => $sauces]);
    }
}
