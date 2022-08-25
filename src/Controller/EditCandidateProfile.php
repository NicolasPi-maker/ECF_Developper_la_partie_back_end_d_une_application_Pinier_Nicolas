<?php

namespace App\Controller;

use App\Entity\Candidate;
use App\Form\CandidateType;
use App\Repository\CandidateRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class EditCandidateProfile extends AbstractController
{
  #[Route(path: 'candidate/editProfile', name: 'app_edit_candidate')]
  public function editProfile(Request $request, ManagerRegistry $doctrine, CandidateRepository $candidateRepository, SluggerInterface $slugger)
  {

    $user = $this->getUser();


    $currentCandidate = $candidateRepository->findOneBy(['user_id' => $user]);

    if($currentCandidate) {
      $candidate = $currentCandidate;
    } else {
      $candidate = new Candidate();
    }

    $form = $this->createForm(CandidateType::class, $candidate);

    $form->handleRequest($request);
    if($form->isSubmitted() && $form->isValid())
    {
      $curriculumFile = $form->get('fileName')->getData();

      if($curriculumFile)
      {
        $originalFileName = pathinfo($curriculumFile->getClientOriginalName(), PATHINFO_FILENAME);

        $safeFileName = $slugger->slug($originalFileName);
        $newFileName = $safeFileName.'-'.uniqid().'.'.$curriculumFile->guessExtension();

        try {
          $curriculumFile->move(
            $this->getParameter('curriculum_files'),
            $newFileName
          );
        } catch (FileException $e) {
          echo $e;
        }
        $candidate->setUserId($user);

        $candidate->setFileName($newFileName);
        $entityManager = $doctrine->getManager();
        $entityManager->persist($candidate);
        $entityManager->flush();

        $this->addFlash('success', 'Vos données ont bien été modifiées');
      }
    }



    return $this->render('Candidate/profile.html.twig', [
      'form' => $form->createView(),
      'currentCandidate' => $candidate,
      'currentUser' => $user,
    ]);
  }

}