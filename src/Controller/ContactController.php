<?php

namespace App\Controller;

use App\Form\ContactFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function new(
        Request $request,
        MailerInterface $mailer,
    ): Response {
        $contactForm = $this->createForm(ContactFormType::class);
        $contactForm->handleRequest($request);

        if ($contactForm->isSubmitted() && $contactForm->isValid()) {
            $mail = (new Email())
                ->from($contactForm->getData()["origin"])
                ->to($this->getParameter('mailer_to'))
                ->subject($contactForm->getData()["subject"])
                ->html(
                    "From: " . $contactForm->getData()["origin"] . " <br> " .
                        "Body: " . $contactForm->getData()["body"]
                );

            $mailer->send($mail);
            $this->addFlash("success", "Envoyé!");

            unset($contactForm);
            $contactForm = $this->createForm(ContactFormType::class);
        }

        return $this->render('contact/index.html.twig', [
            "contactForm" => $contactForm,
        ]);
    }
}
