<?php

namespace Uek\DemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Uek\DemoBundle\Entity\Filmy;
use Symfony\Component\HttpFoundation\Request;

class PopularneFilmyController extends Controller
{
	public function indexAction() 
	{
		$em = $this->getDoctrine()->getManager();
		$query = $em->createQuery(
			'SELECT f.idfilmu, f.tytulfilmu, COUNT(w.idfilmu) AS ilosc FROM UekDemoBundle:Wypozyczenia w JOIN UekDemoBundle:Filmy f WHERE f.idfilmu = w.idfilmu GROUP BY f.idfilmu ORDER BY ilosc DESC'
		);

		$popularneFilmy = $query->getResult();
	
		return $this->render(
			'UekDemoBundle:PopularneFilmy:index.html.twig',
			array(
				'popularneFilmy' => $popularneFilmy
				
			)
		);
	}	
}
