<?php

namespace App\Controller\Admin;

use App\Entity\Candidate;
use App\Entity\Curriculum;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CandidateDashboardController extends AbstractDashboardController
{
    #[Route('/candidate', name: 'admin_candidate')]
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
            ->setTitle('Candidat');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Accueil', 'fa-solid fa-home');
        yield MenuItem::linkToRoute('Mon Profil','fa-solid fa-user','app_edit_candidate');
        yield MenuItem::LinkToRoute('Offres disponibles', 'fa-solid fa-newspaper', 'candidate_offers');
    }
}
