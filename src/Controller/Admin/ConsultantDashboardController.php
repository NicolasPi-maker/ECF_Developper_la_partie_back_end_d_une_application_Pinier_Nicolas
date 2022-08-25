<?php

namespace App\Controller\Admin;

use App\Entity\Candidate;
use App\Entity\JobOffer;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ConsultantDashboardController extends AbstractDashboardController
{
    #[Route('/consultant', name: 'admin_consultant')]
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
            ->setTitle('consultant');
    }

    public function configureMenuItems(): iterable
    {
      yield MenuItem::linkToDashboard('Accueil', 'fa fa-home');

      yield MenuItem::subMenu('Utilisateurs', 'fa-solid fa-users')->setSubItems([
        MenuItem::linkToCrud('Liste des Recruteurs', 'fa-solid fa-chalkboard-user', User::class),
        MenuItem::linkToCrud('Liste des candidats', 'fa-solid fa-user', Candidate::class),
      ]);

      yield MenuItem::subMenu('Emplois', 'fa-solid fa-newspaper')->setSubItems([
        MenuItem::linkToCrud('Liste des offres', 'fa-solid fa-newspaper', JobOffer::class),
        MenuItem::LinkToRoute('Offres avec candidats','fa-solid fa-circle-check', 'consultant_apply_validation'),
      ]);
    }
}
