<?php

namespace App\Controller\Admin;

use App\Entity\Candidate;
use App\Entity\JobOffer;
use App\Entity\Recruiter;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RecruiterDashboardController extends AbstractDashboardController
{
    #[Route('/recruiter', name: 'admin_recruiter')]
    public function index(): Response
    {
      $user = $this->getUser();

      if($user->IsisChecked() !== false) {

        return $this->render('admin/Dashboard.html.twig', [
          'user' => $user,
        ]);
      }
      return $this->redirectToRoute('app_login');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Recruteur');
    }

    public function configureMenuItems(): iterable
    {

      yield MenuItem::linkToDashboard('Accueil', 'fa fa-home');

      yield MenuItem::linkToRoute('Mon Profil', 'fa-solid fa-user', 'app_edit_recruiter');

      yield MenuItem::section('Emplois');
      yield MenuItem::linkToCrud('Gérer mes offres', 'fa-solid fa-newspaper', JobOffer::class);
      yield MenuItem::linkToCrud('Créer une offre', 'fa-solid fa-plus', JobOffer::class)->setAction(Crud::PAGE_NEW);
    }
}
