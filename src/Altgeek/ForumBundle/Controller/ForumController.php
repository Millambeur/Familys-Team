<?php

namespace Altgeek\ForumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ForumController extends Controller
{
    public function indexAction()
    {
        return $this->render('AltgeekForumBundle::layout.html.twig');
    }
}
