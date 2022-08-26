<?php

namespace App\Controller\Admin;

use App\Entity\Candidate;
use App\Entity\CandidateJobOffer;
use App\Entity\Company;
use App\Entity\Consultant;
use App\Entity\JobOffer;
use App\Entity\Recruiter;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

class DashboardController extends AbstractDashboardController
{

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
      $user = $this->getUser();

      return $this->render('admin/Dashboard.html.twig', [
        'user' => $user,
      ]);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Tableau de bord');
    }

    public function configureMenuItems(): iterable
    {

        yield MenuItem::linkToDashboard('Accueil', 'fa fa-home');


        yield MenuItem::section('Utilisateurs');
        yield MenuItem::subMenu('Listes des utilisateurs', 'fa-solid fa-users')->setSubItems([
          MenuItem::linkToCrud('Tous les utilisateurs', 'fa-solid fa-user', User::class),
          MenuItem::linkToCrud('Consultants', 'fa-solid fa-crown', Consultant::class),
          MenuItem::linkToCrud('Recruteurs', 'fa-solid fa-chalkboard-user', Recruiter::class),
          MenuItem::linkToCrud('Sociétés', 'fa-solid fa-building', Company::class),
          MenuItem::linkToCrud('Candidats', 'fa-solid fa-graduation-cap', Candidate::class),
        ]);
    }
}
