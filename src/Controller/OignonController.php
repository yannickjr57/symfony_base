<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Oignon;
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
    public function index(): Response
    {
        return $this->render('oignon/index.html.twig', [
            'controller_name' => 'OignonController',
        ]);
    }

    #[Route('/oignon/liste', name: 'app_oignon_liste')]
    public function listeOignons()
    {
        $oignons= $this->entityManager->getRepository(Oignon::class)->findAll();
        return $this->render('oignon/liste.html.twig', ['oignons' => $oignons]);
    }
}
