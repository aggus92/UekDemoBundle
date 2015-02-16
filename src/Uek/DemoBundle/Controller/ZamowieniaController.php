<?php

namespace Uek\DemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Uek\DemoBundle\Entity\Recenzje;
use Uek\DemoBundle\Form\RecenzjaType;
use Symfony\Component\HttpFoundation\Request;

class RecenzjaController extends Controller
{
	public function indexAction() 
	{
		$em = $this->getDoctrine()->getManager();
		$query = $em->createQuery(
			'SELECT r.idrecenzji, f.tytulfilmu, r.tresc, r.autor FROM UekDemoBundle:Recenzje r JOIN UekDemoBundle:Filmy f WHERE f.idfilmu = r.idfilmu'
		);

		$recenzja = $query->getResult();
	
		return $this->render(
			'UekDemoBundle:Recenzje:index.html.twig',
			array(
				'recenzja' => $recenzja
				
			)
		);
	}
	
}