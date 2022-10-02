<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Conference;
use App\Form\CommentType;
use App\Repository\CommentRepository;
use DateTimeImmutable;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;

class CommentController extends AbstractController {

    #[Route('/conferences/{id}/comments', name: 'app_comments')]
    public function index(ManagerRegistry $doctrine, Request $request, Conference $conference, CommentRepository $commentsRepository, PaginatorInterface $paginator): Response {

        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $comment = $form->getData();
            $comment->setCreatedAt(new DateTimeImmutable());
            $comment->setConference($conference);
            
            $em = $doctrine->getManager();
            $em->persist($comment);
            $em->flush();
        }

        $comments = $paginator->paginate(
            $commentsRepository->findBy(['conference' => $conference], ['createdAt' => 'DESC']), 
            $request->query->getInt('page', 1), 
            2   
        );

        return $this->render('comment/index.html.twig', [
            'conference' => $conference,
            'comments' => $comments,
            'commentForm' => $form->createView()
        ]);
    }   

}
