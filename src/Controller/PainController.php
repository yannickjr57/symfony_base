<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Pain;
use App\Repository\PainRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\PainType;
class PainController extends AbstractController
{
    private ManagerRegistry $registry;

    public function __construct(ManagerRegistry $registry)
    {
        $this->registry = $registry;
    }

    #[Route('/pain/new', name: 'paincreation', methods: ['GET', 'POST'])]
    public function creation(Request $request, EntityManagerInterface $em): Response{

        $pain = new Pain();
        $form = $this->createForm(PainType::class, $pain);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($pain);
            $em->flush();
            return $this->redirectToRoute('app_pain_liste');
        }

        return $this->render('pain/creation.html.twig', [
            'pain' => $pain,
            'form' => $form->createView()
        ]);
        
    }

    #[Route('/pain', name: 'app_pain_liste')]
    public function index(PainRepository $painRepository): Response
    {
        $pains = $painRepository->findAllPains();
        return $this->render('pain/index.html.twig', ['pains' => $pains]);
    }
}
