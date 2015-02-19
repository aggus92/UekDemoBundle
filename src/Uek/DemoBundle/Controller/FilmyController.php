<?php

namespace Uek\DemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Uek\DemoBundle\Entity\Filmy;
use Uek\DemoBundle\Entity\Aktorzy;
use Uek\DemoBundle\Entity\Koszyk;
use Symfony\Component\HttpFoundation\Request;

class FilmyController extends Controller
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
		$repository = $em->getRepository("UekDemoBundle:Filmy");
		
		$collectionFilmy = $repository->findAll();
		
		$queryIlosc = $em->createQuery(
			'SELECT COUNT(k.idfilmu) AS ilosc FROM UekDemoBundle:Koszyk k WHERE k.uzytkownik = :uzytkownik'
		)
		->setParameter('uzytkownik', $uzytkownik);
		
		$ilosc = $queryIlosc->getResult();
		
		return $this->render(
			'UekDemoBundle:Filmy:index.html.twig',
			array(
				'filmy' => $collectionFilmy,
				'ilosc' => $ilosc
			)
		);
	}
	
	public function showAction($gatunek)
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
			'SELECT f.idfilmu, f.tytulfilmu, f.opis, f.oplata FROM UekDemoBundle:Filmy f 
			JOIN f.gatunek fg
			WHERE fg.gatunek = :gatunek'
		)
		->setParameter('gatunek', $gatunek);

		$filmy = $query->getResult();
		
		$queryIlosc = $em->createQuery(
			'SELECT COUNT(k.idfilmu) AS ilosc FROM UekDemoBundle:Koszyk k WHERE k.uzytkownik = :uzytkownik'
		)
		->setParameter('uzytkownik', $uzytkownik);
		
		$ilosc = $queryIlosc->getResult();
		
		return $this->render(
				'UekDemoBundle:Filmy:show.html.twig',
				array(
					'filmy' => $filmy,
					'ilosc' =>$ilosc
				
				)
			);
	}
	
	public function seeAction($id)
	{
		if ($this->getUser() == null)
		{
			$uzytkownik = '';
			
		} else
		{
			$uzytkownik = $this->getUser()->getUsername();
		}
		
		$em = $this->getDoctrine()->getManager();
		$film = $em->getRepository("UekDemoBundle:Filmy")->findOneByIdfilmu($id);
		
		$query2 = $em->createQuery(
			'SELECT f.idfilmu, a.nazwiskoaktora, a.imieaktora FROM UekDemoBundle:Aktorzy a 
			JOIN a.idfilmu f
			WHERE f.idfilmu = :id'
		)
		->setParameter('id', $id);

		$aktor = $query2->getResult();
		
		$queryIlosc = $em->createQuery(
			'SELECT COUNT(k.idfilmu) AS ilosc FROM UekDemoBundle:Koszyk k WHERE k.uzytkownik = :uzytkownik'
		)
		->setParameter('uzytkownik', $uzytkownik);
		
		$ilosc = $queryIlosc->getResult();
				
		return $this->render(
				'UekDemoBundle:Filmy:see.html.twig',
				array(
					'film' => $film,
					'aktor' => $aktor,
					'ilosc' => $ilosc
				)
			);
	}
	
	public function seeRecAction($id, $recenzja)
	{
		if ($this->getUser() == null)
		{
			$uzytkownik = '';
			
		} else
		{
			$uzytkownik = $this->getUser()->getUsername();
		}
		
		$em = $this->getDoctrine()->getManager();
		$film = $em->getRepository("UekDemoBundle:Filmy")->findOneByIdfilmu($id);
		
		$query2 = $em->createQuery(
			'SELECT f.idfilmu, a.nazwiskoaktora, a.imieaktora FROM UekDemoBundle:Aktorzy a 
			JOIN a.idfilmu f
			WHERE f.idfilmu = :id'
		)
		->setParameter('id', $id);

		$aktor = $query2->getResult();
		
		$queryIlosc = $em->createQuery(
			'SELECT COUNT(k.idfilmu) AS ilosc FROM UekDemoBundle:Koszyk k WHERE k.uzytkownik = :uzytkownik'
		)
		->setParameter('uzytkownik', $uzytkownik);
		
		$ilosc = $queryIlosc->getResult();
				
		return $this->render(
				'UekDemoBundle:Filmy:seeRec.html.twig',
				array(
					'film' => $film,
					'aktor' => $aktor,
					'recenzja' => $recenzja,
					'ilosc' => $ilosc
				)
			);
	}
	
}