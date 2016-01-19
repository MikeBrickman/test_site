<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Form\UserType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class ProfileController extends Controller
{
    /**
     * Edit the user
     */
    public function editAction(Request $request)
    {
        $uid = $this->container->get('security.context')->getToken()->getUser()->getId();
        $em = $this->getDoctrine()->getEntityManager();
        $u_obj = $em->getRepository('AppBundle:User')->find($uid);
        if (!$u_obj) {
            throw $this->createNotFoundException('No product found for id '.$uid);
        }

        $form = $this->createForm(new UserType(), $u_obj);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $pass = $this->get('security.password_encoder')
                ->encodePassword($u_obj, $u_obj->getPassword());
            $u_obj->setPassword($pass);
            $em->flush();

            return $this->redirectToRoute('user_homepage');
        }

        return $this->render(
            'AppBundle:Registration:register.html.twig',
            array('form' => $form->createView())
        );
    }
}