<?php

namespace Uek\DemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Uek\DemoBundle\Entity\Gatunki;
use Symfony\Component\HttpFoundation\Request;

class GatunkiController extends Controller
{
	public function indexAction(Request $request) 
	{
		$em = $this->getDoctrine()->getManager();
		$repository = $em->getRepository("UekDemoBundle:Gatunki");
		
		$collectionFilmy = $repository->findAll();
				
		return $this->render(
			'UekDemoBundle:Gatunki:index.html.twig',
			array(
				'gatunki' => $collectionFilmy
			)
		);
	}
	
}