<?php

namespace OC\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        return $this->render('OCCoreBundle:Default:index.html.twig');
    }
    
    public function menuAction($activeRoute)
    {
        $menuItems = array(
            "Accueil" => 'oc_core_homepage',
            "Annonces" => 'oc_platform_home',
            "Contact" => 'oc_core_contact',
        );
        return $this->render('OCCoreBundle:Default:menu-global.html.twig', array(
            'menuItems' => $menuItems,
            'active_route' => $activeRoute,
        ));
    }

    public function contactAction()
    {
        $this->get('session')->getFlashBag()->add(
            'info',
            "La page contact n'est pas encore disponible, merci de revenir plus tard"
        );
        return $this->redirect($this->generateUrl('oc_core_homepage'));
    }
}
