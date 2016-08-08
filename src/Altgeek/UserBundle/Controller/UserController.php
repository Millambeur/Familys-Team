<?php

namespace Altgeek\UserBundle\Controller;

use Altgeek\UserBundle\Entity\User;
use Altgeek\UserBundle\Form\UserEditType;
use Altgeek\UserBundle\Form\UserType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UserController extends Controller
{
	/**
	 * function indexAction($page)
	 *
	 * Render the page $page of the list of the users
	 */
    public function indexAction($page)
  	{
	    if ($page < 1) {
	      throw new NotFoundHttpException('Page "'.$page.'" inexistante.');
	    }

	    $nbPerPage = 10;

	    $listUsers = $this->getDoctrine()
	      ->getManager()
	      ->getRepository('AltgeekUserBundle:User')
	      ->getUsers($page, $nbPerPage)
	    ;

	    $nbPages = ceil(count($listUsers) / $nbPerPage);

	    if ($page > $nbPages) {
	      throw $this->createNotFoundException("La page ".$page." n'existe pas.");
	    }

	    return $this->render('AltgeekUserBundle:User:index.html.twig', array(
	      'listUsers' 	=> $listUsers,
	      'nbPages'     => $nbPages,
	      'page'        => $page,
	    ));
	}


	/**
	 * function viewAction(User $user)
	 *
	 * Render the profile page of the user $user
	 */
	public function viewAction(User $user)
	{
	    $em = $this->getDoctrine()->getManager();

	    return $this->render('AltgeekUserBundle:User:view.html.twig', array(
	      'user'     	=> $user,
	    ));
	}


	/**
	 * function addAction(Request $request)
	 *
	 * Add a user
	 */
	public function addAction(Request $request)
	{
		$user = new user();
		$form   = $this->get('form.factory')->create(UserType::class, $user);
		if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
		  $em = $this->getDoctrine()->getManager();
		  $em->persist($user);
		  $em->flush();
		  $request->getSession()->getFlashBag()->add('notice', 'User bien enregistré.');
		  return $this->redirectToRoute('altgeek_user_view', array('id' => $user->getId()));
		}
		return $this->render('AltgeekUserBundle:User:add.html.twig', array(
		  'form' => $form->createView(),
		));
	}


	/**
	 * function editAction(User $user, Request $request)
	 *
	 * render the page of modification of a user
	 */
	public function editAction(User $user, Request $request)
	{
		$form = $this->get('form.factory')->create(UserType::class, $user);
		if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->flush();
			$request->getSession()->getFlashBag()->add('notice', 'User bien modifié.');
			return $this->redirectToRoute('altgeek_user_view', array('id' => $user->getId()));
		}

		return $this->render('AltgeekUserBundle:User:edit.html.twig', array(
		  'user' => $user,
		  'form'   => $form->createView(),
		));
	}


	/**
	 * function deleteAction(Request $request, User $user)
	 *
	 * delete the user $user
	 */
	public function deleteAction(Request $request, User $user)
	{
		$em = $this->getDoctrine()->getManager();

		$form = $this->get('form.factory')->create();
		if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
			$em->remove($user);
			$em->flush();
			$request->getSession()->getFlashBag()->add('info', "Le user a bien été supprimée.");
			return $this->redirectToRoute('altgeek_user_index');
		}

		return $this->render('AltgeekUserBundle:User:delete.html.twig', array(
		  'user' => $user,
		  'form'   => $form->createView(),
		));
	}
}
