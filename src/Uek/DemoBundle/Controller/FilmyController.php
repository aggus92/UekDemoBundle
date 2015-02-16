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
	
	public function showAction($gatunek)
	{
		$em = $this->getDoctrine()->getManager();
		$query = $em->createQuery(
			'SELECT f.tytulfilmu, f.opis, f.oplata FROM UekDemoBundle:Filmy f 
			JOIN f.gatunek fg
			WHERE fg.gatunek = :gatunek'
		)
		->setParameter('gatunek', $gatunek);

		$filmy = $query->getResult();
		
		return $this->render(
				'UekDemoBundle:Filmy:show.html.twig',
				array(
					'filmy' => $filmy
				
				)
			);
	}
	
}