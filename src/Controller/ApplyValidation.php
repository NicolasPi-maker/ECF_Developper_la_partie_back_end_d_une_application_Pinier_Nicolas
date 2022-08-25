<?php

namespace App\Controller;

use App\Repository\CandidateJobOfferRepository;
use App\Repository\CandidateRepository;
use App\Repository\JobOfferRepository;
use App\Repository\RecruiterRepository;
use App\Repository\UserRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;

class ApplyValidation extends AbstractController
{

  #[Route(path: 'consultant/validation', name: 'consultant_apply_validation')]
  public function applyValidation(
    CandidateJobOfferRepository $candidateJobOfferRepository,
    CandidateRepository $candidateRepository,
    RecruiterRepository $recruiterRepository,
    JobOfferRepository $jobOfferRepository,
    UserRepository $userRepository,
    MailerInterface $mailer,
    ManagerRegistry $doctrine
  ) : Response
  {
    $candidateJobOffers = $candidateJobOfferRepository->findAllApply();

    if(isset($_POST['valid-apply-btn'])) {

      if(isset($_POST['current-apply'])) {

        $currentApplyId = $_POST['current-apply'];
        $currentApply = $candidateJobOfferRepository->findOneBy(['id'=> $currentApplyId]);

        $currentApply->setIsChecked(true);

        $entityManager = $doctrine->getManager();
        $entityManager->persist($currentApply);
        $entityManager->flush();

        $this->addFlash('success', 'La candidature a bien été validée');


        $candidate = $candidateRepository->findOneBy(['id' => $currentApply->getCandidate()->getId()]);
        $jobOffer = $jobOfferRepository->findOneBy(['id' => $currentApply->getJobOffersId()->getId()]);
        $recruiter = $recruiterRepository->findOneBy(['id' => $jobOffer->getRecruiterId()]);

         $userId = $recruiter->getUserId();

         $currentRecruiterApply = $userRepository->findOneBy(['id' => $userId]);

         $recruiterEmail = $currentRecruiterApply->getEmail();


         $email = (new TemplatedEmail())
           ->from('trtconseil@conseil.com')
           ->to($recruiterEmail)
           //->cc('cc@example.com')
           //->bcc('bcc@example.com')
           //->replyTo('fabien@example.com')
           //->priority(Email::PRIORITY_HIGH)
           ->attachFromPath('../public/uploads/files/'.$candidate->getFileName())
           ->subject('Un nouveau candidat a été validé pour votre offre')
           ->text('Le candidat est '.$candidate->getName().' '.$candidate->getLastName())
           ->htmlTemplate('email/ValidationApplyByEmail.html.twig')

           // pass variables (name => value) to the template
           ->context([
             'candidate' => $candidateRepository->findOneBy(['id' => $currentApply->getCandidate()]),
             'offer' => $jobOfferRepository->findOneBy(['id' => $currentApply->getJobOffersId()]),
           ]);

         $mailer->send($email);

      }
    }

    #Delete current apply on press delete button
    if(isset($_POST['delete-apply-btn'])) {
      if(isset($_POST['current-apply'])) {
        $currentApplyId = $_POST['current-apply'];
        $currentApply = $candidateJobOfferRepository->findOneBy(['id'=> $currentApplyId]);

        $entityManager = $doctrine->getManager();
        $entityManager->remove($currentApply);
        $entityManager->flush();
      }
    }
    #dump($candidateJobOffers);

    return $this->render('consultant/applyValidation.html.twig', [
      'candidateJobOffers' => $candidateJobOffers,
    ]);
  }
}

