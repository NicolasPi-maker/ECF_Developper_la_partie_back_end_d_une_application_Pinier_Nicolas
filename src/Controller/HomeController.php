<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
  #[Route(path: '/home', name: 'app_home')]
  public function home()
  {

    $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

    /** @var \App\Entity\User $user */
    $user = $this->getUser();

    return new Response('Well hi there '.$user->getEmail());
  }

}