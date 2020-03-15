<?php


namespace App\Controller;


use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Request\RegistrationRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistrationController extends AbstractController
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * @Route("/registration", name="app_register")
     * @param Request $request
     * @return Response
     */
    public function __invoke(Request $request)
    {
        if ($this->isGranted('IS_AUTHENTICATED_FULLY')) {
            return $this->redirectToRoute('home');
        }

        $registrationRequest = new RegistrationRequest();
        $form = $this->createForm(RegistrationFormType::class, $registrationRequest);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = new User($registrationRequest->username);
            $user->setPassword($this->passwordEncoder->encodePassword($user, $registrationRequest->password));

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('app_login');
        }

        return $this->render('security/register.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
