<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Image;
use Doctrine\ORM\EntityManagerInterface;
class ImageController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/image/create', name: 'app_image_create')]
    public function create () : Response
    {
        $image = new Image();
        $image->setName('Image de test');
 
        // Persister et sauvegarder l'image
        $this->entityManager->persist($image);
        $this->entityManager->flush();
 
        return new Response('Image ajoutée avec succès !');
    }
    #[Route('/image', name: 'app_image')]
    public function index(): Response
    {
        return $this->render('image/index.html.twig', [
            'controller_name' => 'ImageController',
        ]);
    }

    #[Route('/image/liste', name: 'app_image_liste')]
    public function listeImages()
    {
        $images= $this->entityManager->getRepository(Image::class)->findAll();  
        return $this->render('image/liste.html.twig', ['images' => $images]);
    }
}
