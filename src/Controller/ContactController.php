<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request, EntityManagerInterface $entityManagerInterface, MailerInterface $mailerInterface): Response
    {


        /**
         * récupération des données issus service yaml
         * view du formulaire de contact via 
         * de sa création aussi 
         * 
         */
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);
        /**
         * controle du formulaire de contact 
         * sauvegarde de l'email en bdd et envoie de message à l'utilisateur 
         * managerinterface dans l'index 
         * envoie de l'amail vers la personne 
         * donc on doit faire appeller le maillerinterface 
         * 
         */
        if ($form->isSubmitted() && $form->isValid() ) {
            //imporrt entiy pour faire le persist 
            //et du flush dans bdd 
            $entityManagerInterface->persist($contact);
            $entityManagerInterface->flush();
            /**
             * pour le mail :: 
             * entity mailer interface, appelle de classe native Email(), 
             * 
             */
            $mail = new Email();
            $mail->from($contact->getEmail());
            $mail->to($this->getParameter('app.contact.email'));
            $mail->replyTo($this->getParameter('app.contact.email'));
            $mail->subject($this->getParameter('app.contact.subject'));
            $mail->html($contact->getMessage());
            
            //envoie de masse vers le user 
            $mailerInterface->send($mail);

            $this->addFlash('Success', 'Votre message a bien été envoyé');
            //redirection après envoie de message 
            return $this->redirectToRoute('app_home');
        }
        return $this->render('contact/index.html.twig', [
            'contact_adress' => $this->getParameter('app.contact.adress'),
            'contact_phone' => $this->getParameter('app.contact.phone'),
            'contact_email' => $this->getParameter('app.contact.email'),
            'form' => $form->createView()

        ]);
    }
}
