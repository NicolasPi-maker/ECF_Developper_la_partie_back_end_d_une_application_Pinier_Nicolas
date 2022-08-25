<?php

namespace App\Controller;

use App\Entity\CandidateJobOffer;
use App\Repository\CandidateJobOfferRepository;
use App\Repository\CandidateRepository;
use App\Repository\JobOfferRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ApplyController extends AbstractController
{
  #[Route('/candidate/offers', name: 'candidate_offers')]
  public function index(
    JobOfferRepository $jobOfferRepository,
    CandidateRepository $candidateRepository,
    ManagerRegistry $doctrine,
    CandidateJobOfferRepository $candidateJobOfferRepository,
  ): Response
  {
    $offers = $jobOfferRepository->findBy(['is_checked'=>true]);

    $user = $this->getUser();
    $candidate = $candidateRepository->findOneBy(['user_id'=> $user->getId()]);


    if(isset($_POST['apply-btn'])) {
      $appliedOffer = $jobOfferRepository->findOneBy(['id'=> $_POST['jobOfferId']]);

      $isApplied = $candidateJobOfferRepository->findOneByCandidateId($candidate, $appliedOffer);

      if($isApplied !== []) {
        $isAppliedCandidate = $isApplied[0]->getCandidate()->getId();
        $isAppliedJobOffer = $isApplied[0]->getJobOffersId()->getId();

        if($isAppliedCandidate === $candidate->getId() && $isAppliedJobOffer === $appliedOffer->getId()) {
          $this->addFlash('danger', 'Vous avez déjà postulé à cette annonce');
        }

        } else {
        $candidateJobOffer = new CandidateJobOffer();

        $candidateJobOffer->setIsChecked(false);
        $candidateJobOffer->setCandidate($candidate);
        $candidateJobOffer->setJobOffersId($appliedOffer);

        $entityManager = $doctrine->getManager();
        $entityManager->persist($candidateJobOffer);
        $entityManager->flush();

        $this->addFlash('success', 'Vous candidature a bien été prise en compte elle est en attente de validation');
      }
    }

    return $this->render('Candidate/apply.html.twig', [
      'offers' => $offers,
      'user' => $user,
      'currentCandidate' => $candidate
    ]);
  }
}