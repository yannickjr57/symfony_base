<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Burger;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\BurgerRepository;

class BurgerController extends AbstractController
{
    private ManagerRegistry $registry;

    public function __construct(ManagerRegistry $registry)
    {
        $this->registry = $registry;
    }

    #[Route('/burger/create', name: 'app_burger_create')]

    public function create(EntityManagerInterface $entityManager) : Response
    {
        $burger = new Burger();
        $burger->setName('Burger classique');
     
        // Persister et sauvegarder le burger
        $entityManager->persist($burger);
        $entityManager->flush();
     
        return new Response('Oignon créé avec succès !');
    }
    
    #[Route('/burgers', name: 'app_burger')]
    public function index(BurgerRepository $burgerRepository): Response
    {
        $burgers =  $burgerRepository->findAllBurgers();
        return $this->render('burger/index.html.twig', [
            "burgers"=> $burgers
        ]);
    }

    #[Route('/burgers/{id}', name: 'app_burger_id')]
    public function show(BurgerRepository $burgerRepository, int $id): Response
    {

        $burger = $burgerRepository->findById($id);

        if (!$burger) {
            throw $this->createNotFoundException('Burger not found');
        }

        return $this->render('burger/burger_show.html.twig', [
            'burger' => $burger,
        ]);
    }

    

}
