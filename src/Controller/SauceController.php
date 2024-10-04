<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Sauce;
use App\Repository\SauceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use App\Form\SauceType;

class SauceController extends AbstractController
{
    private ManagerRegistry $registry;

    public function __construct(ManagerRegistry $registry)
    {
        $this->registry = $registry;
    }

    #[Route('/sauce/new', name: 'Saucecreation', methods: ['GET', 'POST'])]
    public function creation(Request $request, EntityManagerInterface $em): Response{

        $sauce = new Sauce();
        $form = $this->createForm(SauceType::class, $sauce);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($sauce);
            $em->flush();
            return $this->redirectToRoute('app_sauce');
        }

        return $this->render('sauce/creation.html.twig', [
            'sauce' => $sauce,
            'form' => $form->createView()
        ]);
        
    }
    #[Route('/sauce', name: 'app_sauce')]
    public function index(SauceRepository $sauceRepository): Response
    {
        $sauces = $sauceRepository->findAllSauces();
        return $this->render('sauce/index.html.twig', ['sauces' => $sauces]);
    }

   
}
