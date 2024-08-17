<?php

namespace App\Controller;

use App\Entity\Deck;
use App\Form\DeckType;
use App\Repository\DeckRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AccountController extends AbstractController
{
    #[Route('/account', name: 'app_account', methods: ['GET', 'POST'])]
    public function index(DeckRepository $repository): Response
    {
        $decks = $repository->findAll();
        return $this->render('account/index.html.twig', ["decks" => $decks]);
    }

    #[Route('/account/new', name: 'app_account_new', methods: ['GET', 'POST'])]
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

        return $this->render('account/new.html.twig', [
            'form' => $form,
        ]);
    }
}
