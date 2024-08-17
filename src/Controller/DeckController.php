<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Deck;

class DeckController extends AbstractController
{
    #[Route('/deck/{id}', name: 'app_deck', requirements: ['id' => '\d+'])]
    public function index(?Deck $deck): Response
    {
        return $this->render('deck/index.html.twig', [
            "deck" => $deck
        ]);
    }
}
