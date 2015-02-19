<?php

namespace Uek\DemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Uek\DemoBundle\Entity\Gatunki;
use Uek\DemoBundle\Entity\Koszyk;
use Symfony\Component\HttpFoundation\Request;

class GatunkiController extends Controller
{
	public function indexAction(Request $request) 
	{
		if ($this->getUser() == null)
		{
			$uzytkownik = '';
			
		} else
		{
			$uzytkownik = $this->getUser()->getUsername();
		}
		
		$em = $this->getDoctrine()->getManager();
		$repository = $em->getRepository("UekDemoBundle:Gatunki");
		
		$collectionFilmy = $repository->findAll();
		
		$queryIlosc = $em->createQuery(
			'SELECT COUNT(k.idfilmu) AS ilosc FROM UekDemoBundle:Koszyk k WHERE k.uzytkownik = :uzytkownik'
		)
		->setParameter('uzytkownik', $uzytkownik);
		
		$ilosc = $queryIlosc->getResult();
		
		return $this->render(
			'UekDemoBundle:Gatunki:index.html.twig',
			array(
				'gatunki' => $collectionFilmy,
				'ilosc' => $ilosc
			)
		);
	}
	
}