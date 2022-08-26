<?php

namespace App\Controller;

use App\Entity\Film;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'default_home')]
    public function home(EntityManagerInterface $entityManager): Response
    {   
        $films = $entityManager->getRepository(Film::class)->findAll();
        
        //On passe le variable $employes a render Twig pour les afficher
        return $this->render('default/home.html.twig', [
            'films' => $films
        ]);
    }
}
