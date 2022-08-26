<?php

namespace App\Controller;

use DateTime;
use App\Entity\Film;
use App\Form\FilmFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FilmController extends AbstractController
{
    #[Route('/ajouter-un-film', name: 'create_film', methods: ['GET', 'POST'])]
    public function createFilm(Request $request, EntityManagerInterface $entityManager): Response
    {

        $film = new Film();

        $form = $this->createForm(FilmFormType::class, $film);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $film->setCreatedAt(new DateTime());

            $entityManager->persist($film);

            $entityManager->flush();

            return $this->redirectToRoute('default_home');
        }

        return $this->render('form/create_film.html.twig', [
            'form_film' => $form->createView()
        ]);
    }
}
