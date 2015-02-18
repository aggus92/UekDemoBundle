<?php

namespace Uek\DemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Uek\DemoBundle\Entity\Filmy;
use Uek\DemoBundle\Entity\Aktorzy;
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
			'SELECT f.idfilmu, f.tytulfilmu, f.opis, f.oplata FROM UekDemoBundle:Filmy f 
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
	
	public function seeAction($id)
	{
		$em = $this->getDoctrine()->getManager();
		$film = $em->getRepository("UekDemoBundle:Filmy")->findOneByIdfilmu($id);
		
		$query2 = $em->createQuery(
			'SELECT f.idfilmu, a.nazwiskoaktora, a.imieaktora FROM UekDemoBundle:Aktorzy a 
			JOIN a.idfilmu f
			WHERE f.idfilmu = :id'
		)
		->setParameter('id', $id);

		$aktor = $query2->getResult();
				
		return $this->render(
				'UekDemoBundle:Filmy:see.html.twig',
				array(
					'film' => $film,
					'aktor' => $aktor
				)
			);
	}
	
}