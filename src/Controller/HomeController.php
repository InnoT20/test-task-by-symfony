<?php


namespace App\Controller;


use App\Entity\Book;
use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @param BookRepository $repository
     * @return Response
     */
    public function index(BookRepository $repository)
    {
        $books = $repository->findWithLimit();

        return $this->render('home.html.twig', [
            'books' => $books
        ]);
    }
}