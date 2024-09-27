<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Oignon;
use App\Repository\OignonRepository;
use Doctrine\ORM\EntityManagerInterface;

class OignonController extends AbstractController
{
    private $entityManager;

    #[Route('/oignon/create', name: 'app_oignon_create')]
    public function create(EntityManagerInterface $entityManager) : Response
    {
        $oignon = new Oignon();
        $oignon->setName('Oignon de test');
 
        // Persister et sauvegarder l'image
        $entityManager->persist($oignon);
        $entityManager->flush();
 
        return new Response('Oignon ajouté avec succès !');
    }
    #[Route('/oignon', name: 'app_oignon')]
    public function index(OignonRepository $oignonRepository): Response
    {
       $oignons = $oignonRepository->findAll();
        return $this->render('oignon/index.html.twig', ['oignons' => $oignons]);
    }

 
}
