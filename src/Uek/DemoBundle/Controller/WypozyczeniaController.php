<?php

namespace Uek\DemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Uek\DemoBundle\Entity\Wypozyczenia;
use Uek\DemoBundle\Entity\Koszyk;
use Symfony\Component\HttpFoundation\Request;

class WypozyczeniaController extends Controller
{
	public function indexAction() 
	{
		
		if ($this->getUser() == null)
		{
			$uzytkownik = "";
			$em = $this->getDoctrine()->getManager();
			$queryIlosc = $em->createQuery(
				'SELECT COUNT(k.idfilmu) AS ilosc FROM UekDemoBundle:Koszyk k WHERE k.uzytkownik = :uzytkownik'
			)
			->setParameter('uzytkownik', $uzytkownik);
			
			$ilosc = $queryIlosc->getResult();
			
			return $this->redirect($this->generateUrl('fos_user_security_login', array('ilosc' => $ilosc)));
			
		} else {
			
			if ($this->getUser() == null)
			{
				$uzytkownik2 = '';
				
			} else
			{
				$uzytkownik2 = $this->getUser()->getUsername();
			}
			
			$uzytkownik = $this->getUser()->getId();
		
			$em = $this->getDoctrine()->getManager();
			
			$query = $em->createQuery(
				'SELECT f.tytulfilmu, f.oplata, w.idwypozyczenia, u.username FROM UekDemoBundle:Filmy f 
				JOIN UekDemoBundle:Wypozyczenia w WHERE f.idfilmu = w.idfilmu JOIN UekDemoBundle:User u 
				WHERE w.iduzytkownika = u.id WHERE u.id = :id'
			)
			->setParameter('id', $uzytkownik);
	
			$wypozyczenia = $query->getResult();
	
			$queryIlosc = $em->createQuery(
				'SELECT COUNT(k.idfilmu) AS ilosc FROM UekDemoBundle:Koszyk k WHERE k.uzytkownik = :uzytkownik2'
			)
			->setParameter('uzytkownik2', $uzytkownik2);
		
			$ilosc = $queryIlosc->getResult();
			
			return $this->render(
				'UekDemoBundle:Wypozyczenia:index.html.twig',
				array(
					'wypozyczenia' => $wypozyczenia,
					'ilosc' => $ilosc
				)
			);
		}
	}
	
	public function seeAction($tytulfilmu)
	{
		 return $this->render('UekDemoBundle:Wypozyczenia:see.html.twig', 
		 array(
			'tytul' => $tytulfilmu
			)
		);
	}
	
}