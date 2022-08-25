<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class WaitingRoomController extends AbstractController
{
  #[Route(path: '/waiting-room', name: 'app_waiting_room')]
  public function index()
  {
    return $this->render('admin/waitingUserValidation.html.twig');
  }
}