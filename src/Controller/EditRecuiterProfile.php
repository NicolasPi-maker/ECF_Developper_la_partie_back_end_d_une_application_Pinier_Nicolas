<?php

namespace App\Controller;

use App\Entity\Company;
use App\Entity\Recruiter;
use App\Form\CompanyType;
use App\Repository\CompanyRepository;
use App\Repository\RecruiterRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class EditRecuiterProfile extends AbstractController
{
 #[Route(path:'recruiter/editProfile', name: 'app_edit_recruiter')]
 public function editProfile(Request $request, ManagerRegistry $doctrine, RecruiterRepository $recruiterRepository, CompanyRepository $companyRepository, UserInterface $userTest)
 {

   $user = $this->getUser();
   $currentRecruiter = $recruiterRepository->findOneBy(['user_id_recruiter' => $user->getId()]);

   $company = new Company();
   $recruiter = new Recruiter();

   if($currentRecruiter) {
    $company = $companyRepository->findOneBy(['id' => $currentRecruiter->getIdCompany()]);
    $recruiter = $currentRecruiter;
   }

   $form = $this->createForm(CompanyType::class, $company);

   $form->handleRequest($request);
   if($form->isSubmitted() && $form->isValid())
   {
     $data = $form->getData();

     $recruiter->setUserId($user);
     $recruiter->setIdCompany($data);

     $entityManager = $doctrine->getManager();
     $entityManager->persist($recruiter);
     $entityManager->persist($company);
     $entityManager->flush();

     $this->addFlash('success', 'Vos données ont bien été modifiées');
   }

   return $this->render('recruiter/profile.html.twig', [
     'form' => $form->createView(),
     'currentUser' => $user,
     'currentCompany' => $company,
   ]);
 }

}