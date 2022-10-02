<?php

namespace App\Controller;

use App\Repository\ConferenceRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ConferenceController extends AbstractController {


    
    #[Route('/', name: 'app_home')]
    public function home(): Response {
        return $this->redirectToRoute('app_conferences');
    }

    #[Route('/conferences', name: 'app_conferences')]
    public function index(Request $request, ConferenceRepository $conferenceRepository, PaginatorInterface $paginator): Response {
        
        $conferences = $paginator->paginate(
            $conferenceRepository->findAll(), 
            $request->query->getInt('page', 1), 
            2   /*limit per page*/
        );

        return $this->render('conference/index.html.twig', [
            'conferences' => $conferences
        ]);
    }
}
