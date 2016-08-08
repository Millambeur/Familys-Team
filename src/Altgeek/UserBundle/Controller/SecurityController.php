<?php
// src/Altgeek/UserBundle/Controller/SecurityController.php;

namespace Altgeek\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SecurityController extends Controller
{
  public function loginAction(Request $request)
  {
    if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
      return $this->redirectToRoute('altgeek_platform_accueil');
    }

    $authenticationUtils = $this->get('security.authentication_utils');

    return $this->render('AltgeekUserBundle:Security:login.html.twig', array(
      'last_username' => $authenticationUtils->getLastUsername(),
      'error'         => $authenticationUtils->getLastAuthenticationError(),
    ));
  }
}