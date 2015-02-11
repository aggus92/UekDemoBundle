<?php

namespace Uek\DemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('UekDemoBundle:Default:index.html.twig', array());
    }
}
