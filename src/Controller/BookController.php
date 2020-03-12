<?php


namespace App\Controller;


use App\Entity\Book;
use App\Form\BookCreateType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookController extends AbstractController
{
    /**
     * @Route("/books/create")
     *
     * @param Request $request
     * @return Response
     */
    public function create(Request $request)
    {
        $entity = new Book();

        $form = $this->createForm(BookCreateType::class, $entity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($entity);
            $entityManager->flush();

        }

        return $this->render('books/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    public function update()
    {

    }

    public function delete()
    {

    }
}