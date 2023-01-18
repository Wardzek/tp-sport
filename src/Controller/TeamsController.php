<?php

namespace App\Controller;

use App\Entity\Athete;
use App\Entity\Team;
use App\Form\EditType;
use App\Form\SearchNameType;
use App\Form\TeamType;
use App\Repository\SportRepository;
use App\Repository\TeamRepository;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TeamsController extends AbstractController
{
    #[Route('/teams', name: 'app_teams')]
    public function index(TeamRepository $teamRepo, Request $request): Response
    {

        $form = $this->createForm(SearchNameType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $test = $form->getData();
            $teams = $teamRepo->searchTeam($test->getName());
        } else {
            $teams = $teamRepo->findAll();
        }

        return $this->render('teams/index.html.twig', [
            'controller_name' => 'TeamsController',
            'teams'=>$teams,
            'form'=>$form->createView()
        ]);
    }

    #[Route('/teams/{id}', name: 'app_teams_details')]
    public function details(string $id, TeamRepository $teamRepo): Response
    {
        $team = $teamRepo->find($id);

        return $this->render('teams/details.html.twig', [
            'team' => $team,
        ]);
    }

    #[Route('/new', name: 'new_teams')]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(TeamType::class, new Team());

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($form->getData());
            $em->flush();

            $this->addFlash('success', 'Team ajoutée !');

            return  $this->redirectToRoute('app_teams');
        }

        return $this->render('integrated/team/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/admin/edit/{id}', name: 'edit_teams')]
    public function edit(Request $request, EntityManagerInterface $em, string $id, TeamRepository $teamRepo): Response
    {
        $team = $teamRepo->find($id);
        $forms = $this->createForm(EditType::class, $team);

        $forms->handleRequest($request);
        if ($forms->isSubmitted() && $forms->isValid()) {
            $em->persist($forms->getData());
            $em->flush();

            $this->addFlash('success', 'Team modifiée !');

            return  $this->redirectToRoute('app_teams');
        }

        return $this->render('integrated/team/edit.html.twig', [
            'form' => $forms->createView(),
        ]);
    }

    #[Route('/admin/delete/{id}', name: 'delete_teams')]
    public function delete(string $id, TeamRepository $teamRepo, EntityManagerInterface $em): Response
    {
        $team = $teamRepo->find($id);
        $em->remove($team);
        $em->flush();

        return  $this->redirectToRoute('app_teams');
    }

    #[Route('/sport', name: 'app_sport')]
    public function sport(SportRepository $sportRepo): Response
    {
        $sport = $sportRepo->findAll();

        return $this->render('integrated/sport/index.html.twig', [
            'controller_name' => 'SportController',
            'sports'=>$sport
        ]);
    }

    #[Route('/sport/{id}', name: 'app_sport_details')]
    public function detailSport(string $id, SportRepository $sportRepository): Response
    {
        $sport = $sportRepository->find($id);

        return $this->render('integrated/sport/details.html.twig', [
            'sports' => $sport,
        ]);
    }

}
