<?php

namespace App\Controller;

use \App\Entity\Message;
use App\Form\MessageType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    public function index(Request $request, EntityManagerInterface $entityManager, MailerInterface $mailer): Response
    {
        $message = new Message();
        $message->setUsers($this->getUser())
                ->setCreatedAt(new \DateTime('now'));

        $form = $this->createForm(MessageType::class, $message);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $message = $form->getData();
            $entityManager->persist($message);
            $entityManager->flush();

            /*
             * Send mail
             */
            $email = (new Email())
                ->from($message->getUsers()->getEmail())
                ->to('you@exemple.com')
                ->subject('New message' .$message->getId() . ' - ' . $message->getUsers()->getEmail())
                ->html('<p>' . $message->getDescription() . '</p>');

            sleep(1);

                $mailer->send($email);

            return $this->redirectToRoute('home');

        }


        return $this->render('home/index.html.twig', [
            'form' => $form->createView(),
            'controller_name' => 'HomeController',
        ]);
    }
}
