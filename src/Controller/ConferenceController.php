<?php

namespace App\Controller;

use App\Entity\Conference;
use App\Form\ConferenceType;
use App\Repository\ConferenceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/conference')]
class ConferenceController extends AbstractController
{
    #[Route('', name: 'app_conference_list', methods: ['GET'])]
    public function list(Request $request, ConferenceRepository $repository): Response
    {
        $page = $request->query->getInt('page', 1);
        $limit = 10;
        $conferences = $repository->findBy([], limit: $limit, offset: ($page - 1) * $limit);

        return $this->render('conference/list.html.twig', [
            'conferences' => $conferences,
        ]);
    }

    #[Route('/{id<\d+>}', name: 'app_conference_show', methods: ['GET'])]
    public function show(Conference $conference): Response
    {
        return $this->render('conference/show.html.twig', [
            'conference' => $conference,
        ]);
    }

    #[Route('/new', name: 'app_conference_new', methods: ['GET', 'POST'])]
    public function newConference(EntityManagerInterface $manager): Response
    {
        $conference = new Conference();
        $form = $this->createForm(ConferenceType::class, $conference);

        return $this->render('conference/new.html.twig', [
            'form' => $form,
        ]);
    }
}
