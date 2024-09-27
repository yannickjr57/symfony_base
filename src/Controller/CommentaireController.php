<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Commentaire;
use Doctrine\ORM\EntityManagerInterface;

class CommentaireController extends AbstractController
{
    private $entityManager;


    #[Route('/commentaire/create', name: 'app_commentaire_create')]
    public function create (EntityManagerInterface $entityManager) : Response
    {
        $commentaire = new Commentaire();
        $commentaire->setName('Commentaire de test');
 
        // Persister et sauvegarder le commentaire
        $entityManager->persist($commentaire);
        $entityManager->flush();
 
        return new Response('Commentaire ajouté avec succès !');
    }
    #[Route('/commentaire', name: 'app_commentaire')]
    public function index(): Response
    {
        return $this->render('commentaire/index.html.twig', [
            'controller_name' => 'CommentaireController',
        ]);
    }

    #[Route('/commentaire/liste', name: 'app_commentaire_liste')]
    public function listeCommentaires()
    {
        $commentaires= $this->entityManager->getRepository(Commentaire::class)->findAll();
        return $this->render('commentaire/liste.html.twig', ['commentaires' => $commentaires]);
    }
}
