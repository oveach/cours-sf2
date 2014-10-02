<?php

namespace OC\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        // truc pour éviter le problème du trailing slash...
        // si on détecte un / final, on redirige vers la même url sans / final...
        // sauf pour l'url racine de prod (uniquement /)
        $requestUri = $request->getRequestUri();
        if (strlen($requestUri) > 1 and strrpos($requestUri, "/") === strlen($requestUri) - 1) {
            $url = rtrim($requestUri, '/');
            return $this->redirect($url, 301);
        }

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
