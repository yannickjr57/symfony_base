<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class BurgerController extends AbstractController
{
    const burgers=[
        ["id" => 1, "nom" => "Le Classique"],
        ["id" => 2, "nom" => "Le Spicy"],
        ["id" => 3, "nom" => "Le Veggie"],
    ];
    #[Route('/burgers', name: 'app_burger')]
    public function liste(): Response
    {
        return $this->render('burger/index.html.twig', [
            "burgers"=> self::burgers
        ]);
    }

    #[Route('/burgers/{id}', name: 'app_burger_id')]
    public function show($id): Response
    {

        $burger = null;
        foreach (self::burgers as $b) {
            if ($b['id'] == $id) {
                $burger = $b;
                break;
            }
        }

        return $this->render('burger/burger_show.html.twig', [
            "burger"=> $burger
        ]);
    }
}
