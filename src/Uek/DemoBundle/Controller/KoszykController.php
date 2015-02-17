<?php

namespace Uek\DemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Uek\DemoBundle\Entity\Filmy;
use Symfony\Component\HttpFoundation\Request;

class KoszykController extends Controller
{	

	public function indexAction(Request $request) 
	{
		$em = $this->getDoctrine()->getManager();
		$repository = $em->getRepository("UekDemoBundle:Filmy");
		
		$collectionFilmy = $repository->findAll();
				
		return $this->render(
			'UekDemoBundle:Koszyk:index.html.twig',
			array(
				'koszyk' => $collectionFilmy
			)
		);
	}
	
	public function showAction($idfilmu)
	{
		$em = $this->getDoctrine()->getManager();
		$query = $em->createQuery(
			'SELECT f. idfilmu, f.tytulfilmu, f.oplata FROM UekDemoBundle:Filmy f
			WHERE f.idfilmu = :idfilmu'
		)
		->setParameter('idfilmu', $idfilmu);

		$koszyk = $query->getResult();
		
		return $this->render(
				'UekDemoBundle:Koszyk:show.html.twig',
				array(
					'koszyk' => $koszyk
				
				)
			);
	}	
}