<?php

namespace Uek\DemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Uek\DemoBundle\Entity\Recenzje;
use Uek\DemoBundle\Entity\Koszyk;
use Symfony\Component\HttpFoundation\Request;

class NajczesciejRecenzjeController extends Controller
{
	public function indexAction() 
	{
		if ($this->getUser() == null)
		{
			$uzytkownik = '';
			
		} else
		{
			$uzytkownik = $this->getUser()->getUsername();
		}
		
		$em = $this->getDoctrine()->getManager();
		$query = $em->createQuery(
			'SELECT f.idfilmu, f.tytulfilmu, COUNT(r.idfilmu) AS ilosc FROM UekDemoBundle:Recenzje r 
			JOIN UekDemoBundle:Filmy f WHERE f.idfilmu = r.idfilmu GROUP BY f.idfilmu ORDER BY ilosc DESC'
		);

		$recenzjaNajwiecej = $query->getResult();
	
		$queryIlosc = $em->createQuery(
			'SELECT COUNT(k.idfilmu) AS ilosc FROM UekDemoBundle:Koszyk k WHERE k.uzytkownik = :uzytkownik'
		)
		->setParameter('uzytkownik', $uzytkownik);
		
		$ilosc = $queryIlosc->getResult();
	
		return $this->render(
			'UekDemoBundle:NajczesciejRecenzje:index.html.twig',
			array(
				'recenzjaNajwiecej' => $recenzjaNajwiecej,
				'ilosc' => $ilosc
				
			)
		);
	}	
}