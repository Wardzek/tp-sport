<?php

namespace App\Controller;

use App\Repository\SportRepository;
use App\Repository\TeamRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(TeamRepository $teamRepo): Response
    {
        $teams = $teamRepo->findThreeLastTeam();
        $teamsMostAthetes = $teamRepo->findThreeTeamMostPeople();

        return $this->render('home/index.html.twig', [
            'teams' => $teams,
            'teamss' => $teamsMostAthetes,
         ]);
    }
}
