<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Oignon;
use App\Repository\OignonRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\HttpFoundation\Response;
use App\Form\OignonType;

class OignonController extends AbstractController
{
    private $entityManager;

    #[Route('/oignon/new', name: 'Oignoncreation', methods: ['GET', 'POST'])]
    public function creation(Request $request, EntityManagerInterface $em): Response{

        $oignon = new Oignon();
        $form = $this->createForm(OignonType::class, $oignon);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($oignon);
            $em->flush();
            return $this->redirectToRoute('app_oignon');
        }

        return $this->render('oignon/creation.html.twig', [
            'oignon' => $oignon,
            'form' => $form->createView()
        ]);
        
    }
    #[Route('/oignon', name: 'app_oignon')]
    public function index(OignonRepository $oignonRepository): Response
    {
       $oignons = $oignonRepository->findAll();
        return $this->render('oignon/index.html.twig', ['oignons' => $oignons]);
    }

 
}
