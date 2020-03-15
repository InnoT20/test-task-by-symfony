<?php


namespace App\Controller;


use App\Entity\Book;
use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @param BookRepository $repository
     * @param Request $request
     * @return Response
     */
    public function index(BookRepository $repository, Request $request)
    {
        $books = $repository->getPaginate($request->get('page', 1));

        return $this->render('home.html.twig', [
            'books' => $books
        ]);
    }
}