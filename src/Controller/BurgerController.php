<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Burger;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\BurgerRepository;
use Doctrine\ORM\Mapping\Entity;
use App\Form\BurgerType;
use PhpParser\Node\Name;
use Symfony\Component\HttpFoundation\Request;

class BurgerController extends AbstractController
{
    private ManagerRegistry $registry;

    public function __construct(ManagerRegistry $registry)
    {
        $this->registry = $registry;
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

    #[Route('/burger/new', name: 'Burgercreation', methods: ['GET', 'POST'])]
    public function creation(Request $request, EntityManagerInterface $em): Response{

        $burger = new Burger();
        $form = $this->createForm(BurgerType::class, $burger);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($burger);
            $em->flush();

            $this->addFlash('success', 'Le burger a bien été crée');
            return $this->redirectToRoute('app_burger');
        }

        return $this->render('burger/creation.html.twig', [
            'burger' => $burger,
            'form' => $form->createView()
        ]);
    }

    

}
