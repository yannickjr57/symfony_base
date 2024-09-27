<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Sauce;
use App\Repository\SauceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;


class SauceController extends AbstractController
{
    private ManagerRegistry $registry;

    public function __construct(ManagerRegistry $registry)
    {
        $this->registry = $registry;
    }

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
    public function index(SauceRepository $sauceRepository): Response
    {
        $sauces = $sauceRepository->findAllSauces();
        return $this->render('sauce/index.html.twig', ['sauces' => $sauces]);
    }

   
}
