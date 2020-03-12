<?php


namespace App\Controller;


use App\Entity\Book;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function index()
    {
        $books = $this->getDoctrine()->getRepository(Book::class)->findWithLimit();

        return $this->render('home.html.twig', [
            'books' => $books
        ]);
    }
}