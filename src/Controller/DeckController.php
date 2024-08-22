<?php

namespace App\Controller;

use App\Form\DeckType;
use App\Entity\Deck;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DeckController extends AbstractController
{
    #[Route('/deck/{id}', name: 'app_deck', requirements: ['id' => '\d+'])]
    public function index(?Deck $deck): Response
    {
        return $this->render('deck/index.html.twig', [
            "deck" => $deck
        ]);
    }



    #[Route('/deck/new', name: 'app_deck_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $manager): Response
    {
        $deck = new Deck;
        $form = $this->createForm(DeckType::class, $deck);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($deck);
            $manager->flush();

            return $this->redirectToRoute('app_account');
        }

        return $this->render('deck/new.html.twig', [
            'form' => $form,
        ]);
    }
}
