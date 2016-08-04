<?php

namespace Altgeek\ForumBundle\Controller;

use Altgeek\ForumBundle\Entity\UberTopic;
use Altgeek\ForumBundle\Entity\Topic;
use Altgeek\ForumBundle\Event\MessagePostEvent;
use Altgeek\ForumBundle\Event\ForumEvents;
use Altgeek\ForumBundle\Form\UberTopicEditType;
use Altgeek\ForumBundle\Form\UberTopicType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UberTopicController extends Controller
{
	public function indexAction($page)
  	{
	    if ($page < 1) {
	      throw new NotFoundHttpException('Page "'.$page.'" inexistante.');
	    }

	    $nbPerPage = 10;

	    $listUberTopics = $this->getDoctrine()
	      ->getManager()
	      ->getRepository('AltgeekForumBundle:UberTopic')
	      ->getUberTopics($page, $nbPerPage)
	    ;

	    $nbPages = ceil(count($listUberTopics) / $nbPerPage);

	    if ($page > $nbPages) {
	      throw $this->createNotFoundException("La page ".$page." n'existe pas.");
	    }

	    return $this->render('AltgeekForumBundle:UberTopic:index.html.twig', array(
	      'listUberTopics' => $listUberTopics,
	      'nbPages'     => $nbPages,
	      'page'        => $page,
	    ));
	}


	public function viewAction(UberTopic $uberTopic)
	{
	    $em = $this->getDoctrine()->getManager();

	    $listTopics = $em
	      ->getRepository('AltgeekForumBundle:Topic')
	      ->findBy(array('uberTopic' => $uberTopic))
	    ;

	    return $this->render('AltgeekForumBundle:UberTopic:view.html.twig', array(
	      'uberTopic'     	=> $uberTopic,
	      'listTopics' 		=> $listTopics,
	    ));
	}

	/**
	* @Security("has_role('ROLE_AUTEUR')")
	*/
	public function addAction(Request $request)
	{
		$uberTopic = new UberTopic();
		$form   = $this->get('form.factory')->create(UberTopicType::class, $uberTopic);
		if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
		  //$event = new MessagePostEvent($uberTopic->getCategory(), $uberTopic->getUser());
		  //$this->get('event_dispatcher')->dispatch(PlatformEvents::POST_MESSAGE, $event);

		  //$uberTopic->setContent($event->getMessage());
		  $em = $this->getDoctrine()->getManager();
		  $em->persist($uberTopic);
		  $em->flush();
		  $request->getSession()->getFlashBag()->add('notice', 'UberTopic bien enregistrée.');
		  return $this->redirectToRoute('altgeek_forum_ubertopic_view', array('id' => $uberTopic->getId()));
		}
		return $this->render('AltgeekForumBundle:UberTopic:add.html.twig', array(
		  'form' => $form->createView(),
		));
	}

	public function editAction(UberTopic $uberTopic, Request $request)
	{
		$form = $this->get('form.factory')->create(UberTopicType::class, $uberTopic);
		if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
			// Inutile de persister ici, Doctrine connait déjà notre annonce
			$em = $this->getDoctrine()->getManager();
			$em->flush();
			$request->getSession()->getFlashBag()->add('notice', 'UberTopic bien modifiée.');
			return $this->redirectToRoute('altgeek_forum_ubertopic_view', array('id' => $uberTopic->getId()));
		}

		return $this->render('AltgeekForumBundle:UberTopic:edit.html.twig', array(
		  'uberTopic' => $uberTopic,
		  'form'   => $form->createView(),
		));
	}

	public function deleteAction(Request $request, UberTopic $uberTopic)
	{
		$em = $this->getDoctrine()->getManager();

		$form = $this->get('form.factory')->create();
		if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
			$em->remove($uberTopic);
			$em->flush();
			$request->getSession()->getFlashBag()->add('info', "Le UberTopic a bien été supprimée.");
			return $this->redirectToRoute('altgeek_forum_ubertopic_index');
		}

		return $this->render('AltgeekForumBundle:UberTopic:delete.html.twig', array(
		  'uberTopic' => $uberTopic,
		  'form'   => $form->createView(),
		));
	}


}
