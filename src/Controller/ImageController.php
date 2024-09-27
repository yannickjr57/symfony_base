<?php

namespace App\Controller;

use App\Entity\Image;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Routing\Annotation\Route;

class ImageController extends AbstractController
{
    #[Route('/images', name: 'app_image_upload')]
    public function upload(Request $request, EntityManagerInterface $entityManager): Response
    {
        // Vérifiez si un fichier a été téléchargé
        if ($request->files->has('image')) {
            /** @var UploadedFile $file */
            $file = $request->files->get('image');
            if ($file) {
                // Générez un nom de fichier unique
                $filename = uniqid() . '.' . $file->guessExtension();
                // Déplacez le fichier dans le répertoire souhaité
                $file->move($this->getParameter('images_directory'), $filename);

                // Créez et enregistrez l'entité Image
                $image = new Image();
                $image->setName($filename);
                $entityManager->persist($image);
                $entityManager->flush();

                // Redirigez ou affichez un message de succès
                return $this->redirectToRoute('app_image_upload');
            }
        }

        // Récupérez toutes les images pour les afficher
        $images = $entityManager->getRepository(Image::class)->findAll();

        return $this->render('image/index.html.twig', [
            'images' => $images,
        ]);
    }
}
