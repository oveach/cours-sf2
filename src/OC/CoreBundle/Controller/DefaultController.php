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
        $requestUri = $request->getRequestUri();
        if (strrpos($requestUri, "/") === strlen($requestUri) - 1) {
            $url = rtrim($requestUri, '/');
            return $this->redirect($url, 301);
        }

        return $this->render('OCCoreBundle:Default:index.html.twig');
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
