<?php

namespace Uek\DemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Uek\DemoBundle\Entity\Filmy;
use Symfony\Component\HttpFoundation\Request;

class FilmyController extends Controller
{
	public function indexAction(Request $request) 
	{
		$em = $this->getDoctrine()->getManager();
		$repository = $em->getRepository("UekDemoBundle:Filmy");
		
		$collectionFilmy = $repository->findAll();
				
		return $this->render(
			'UekDemoBundle:Filmy:index.html.twig',
			array(
				'filmy' => $collectionFilmy
			)
		);
	}
	
}