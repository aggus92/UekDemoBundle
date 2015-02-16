<?php

namespace Uek\DemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Uek\DemoBundle\Entity\Recenzje;
//use Uek\DemoBundle\Form\RecenzjaType;
use Symfony\Component\HttpFoundation\Request;

class NajczesciejRecenzjeController extends Controller
{
	public function indexAction() 
	{
		$em = $this->getDoctrine()->getManager();
		$query = $em->createQuery(
			'SELECT f.idfilmu, f.tytulfilmu, COUNT(r.idfilmu) AS ilosc FROM UekDemoBundle:Recenzje r JOIN UekDemoBundle:Filmy f WHERE f.idfilmu = r.idfilmu GROUP BY f.idfilmu ORDER BY ilosc DESC'
		);

		$recenzjaNajwiecej = $query->getResult();
	
		return $this->render(
			'UekDemoBundle:NajczesciejRecenzje:index.html.twig',
			array(
				'recenzjaNajwiecej' => $recenzjaNajwiecej
				
			)
		);
	}	
}