<?php

namespace Uek\DemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Uek\DemoBundle\Entity\Recenzje;
use Uek\DemoBundle\Form\RecenzjaType;
use Symfony\Component\HttpFoundation\Request;

class RecenzjaController extends Controller
{
	public function indexAction(Request $request) 
	{
		$em = $this->getDoctrine()->getManager();
		$repository = $em->getRepository("UekDemoBundle:Recenzje");
		
		$collectionRecenzja = $repository->findAll();
				
		return $this->render(
			'UekDemoBundle:Recenzje:index.html.twig',
			array(
				'recenzje' => $collectionRecenzja
			)
		);
	}
	
}