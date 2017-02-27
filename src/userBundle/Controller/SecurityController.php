<?php

namespace userBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class SecurityController extends Controller
{
    /**
     * @Route("/login", name="login")
     */
    public function loginAction(Request $request)
    {
        // si le visiteur est déjà identifié, on le redirige vers l'accueil
        if($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED')){
            return $this->redirectToRoute('hackzilla_ticket_create');
        }
        /* le service authentification_utils permet de récupérer le nom d'utilisateur
        et l'erreur dans le cas où le formulaire a déjà été soumis mais était invalide
        */

        $authenticationUtil = $this->get('security.authentication_utils');

        return $this->render('userBundle:Security:login.html.twig', array(
            'last_username' => $authenticationUtil->getLastUsername(),
            'error' => $authenticationUtil->getLastAuthenticationError(),
            ));
    }
}
