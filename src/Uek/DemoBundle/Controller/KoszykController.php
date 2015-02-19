<?php

namespace Uek\DemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Uek\DemoBundle\Entity\Koszyk;
use Symfony\Component\HttpFoundation\Request;

class KoszykController extends Controller
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
			'SELECT f.idfilmu, f.tytulfilmu, f.oplata, k.uzytkownik FROM UekDemoBundle:Filmy f 
			JOIN UekDemoBundle:Koszyk k WHERE f.idfilmu = k.idfilmu AND k.uzytkownik = :uzytkownik'
		)
		->setParameter('uzytkownik', $uzytkownik);
			
		$koszyk = $query->getResult();
		
		$queryIlosc = $em->createQuery(
			'SELECT COUNT(k.idfilmu) AS ilosc FROM UekDemoBundle:Koszyk k WHERE k.uzytkownik = :uzytkownik'
		)
		->setParameter('uzytkownik', $uzytkownik);
		
		$ilosc = $queryIlosc->getResult();
		
		return $this->render(
			'UekDemoBundle:Koszyk:index.html.twig',
			array(
				'koszyk' => $koszyk,
				'ilosc' => $ilosc
			)
		);
	}
	
	public function addAction($idfilmu)
	{
		if ($this->getUser() == null)
		{
			$uzytkownik = '';
		} else
		{
			$uzytkownik = $this->getUser()->getUsername();
		}
		$dodano = "ok";
		$koszyk = new Koszyk();
		$koszyk->setUzytkownik($uzytkownik);
		
		$em = $this->getDoctrine()->getManager();
		$film = $em->getRepository("UekDemoBundle:Filmy")->findOneByIdfilmu($idfilmu);
		$koszyk->setIdfilmu($film);
		
		$em->persist($koszyk);
		$em->flush();
					
		return $this->redirect($this->generateUrl('uek_demo_filmy_seeRec', array('id' => $idfilmu, 'recenzja' => $dodano)));

		return $this->render(
			'UekDemoBundle:Koszyk:add.html.twig',
			array(
				'koszyk' => $koszyk
			)
		);	
	}
	
	public function deleteAction($idfilmu)
	{
		if ($this->getUser() == null)
		{
			$uzytkownik = '';
		} else
		{
			$uzytkownik = $this->getUser()->getUsername();
		}
		
		$em = $this->getDoctrine()->getManager();
		$film = $em->getRepository("UekDemoBundle:Filmy")->findOneByIdfilmu($idfilmu);
		$koszyk = $em->getRepository("UekDemoBundle:Koszyk")->findOneBy(array('idfilmu' => $film, 'uzytkownik' => $uzytkownik));
		
		$em->remove($koszyk);
		$em->flush();
					
		return $this->redirect($this->generateUrl('uek_demo_koszyk_index'));

		return $this->render(
			'UekDemoBundle:Koszyk:add.html.twig',
			array(
				'koszyk' => $koszyk
			)
		);	
	}
	
	public function cleanAction()
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
			'DELETE UekDemoBundle:Koszyk k WHERE k.uzytkownik = :uzytkownik'
			)
			->setParameter('uzytkownik', $uzytkownik);
		$koszyk = $query->getResult();
		
		return $this->redirect($this->generateUrl('uek_demo_koszyk_index'));

		return $this->render(
			'UekDemoBundle:Koszyk:add.html.twig',
			array(
				'koszyk' => $koszyk
			)
		);	
	}
}