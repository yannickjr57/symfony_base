<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Pain;
use App\Repository\PainRepository;
use Doctrine\Persistence\ManagerRegistry;

class PainController extends AbstractController
{
    private ManagerRegistry $registry;

    public function __construct(ManagerRegistry $registry)
    {
        $this->registry = $registry;
    }

    #[Route('/pain/create', name: 'app_pain_create')]
    public function create(): Response
    {
        $pain = new Pain();
        $pain->setName('Pain de test');

        // Persister et sauvegarder le pain
        $entityManager = $this->registry->getManager();
        $entityManager->persist($pain);
        $entityManager->flush();

        return new Response('Pain ajouté avec succès !');
    }

    #[Route('/pain', name: 'app_pain_liste')]
    public function index(PainRepository $painRepository): Response
    {
        $pains = $painRepository->findAllPains();
        return $this->render('pain/index.html.twig', ['pains' => $pains, 'test' => 9 * 9]);
    }
}
