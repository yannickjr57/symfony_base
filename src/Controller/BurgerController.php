<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Burger;

class BurgerController extends AbstractController
{
    private $entityManager;

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
    const burgers=[
        ["id" => 1, "nom" => "Le Classique"],
        ["id" => 2, "nom" => "Le Spicy"],
        ["id" => 3, "nom" => "Le Veggie"],
    ];
    #[Route('/burgers', name: 'app_burger')]
    public function liste(): Response
    {
        return $this->render('burger/index.html.twig', [
            "burgers"=> self::burgers
        ]);
    }

    #[Route('/burgers/{id}', name: 'app_burger_id')]
    public function show($id): Response
    {

        $burger = null;
        foreach (self::burgers as $b) {
            if ($b['id'] == $id) {
                $burger = $b;
                break;
            }
        }

        return $this->render('burger/burger_show.html.twig', [
            "burger"=> $burger
        ]);
    }

    
#[Route('/burgers/liste', name: 'app_burger_liste')]
    public function listeBurgers()
    {
        $burgers= $this->entityManager->getRepository(Burger::class)->findAll();
        return $this->render('burger/liste.html.twig', ['burger' => $burgers]);
    }

}
