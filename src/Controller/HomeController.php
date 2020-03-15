<?php


namespace App\Controller;


use App\Filters\BookFilter;
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
        $filter = new BookFilter($request->query->all());

        $books = $repository->getPaginate($filter, $request->get('page', 1));

        return $this->render('home.html.twig', [
            'books' => $books
        ]);
    }
}