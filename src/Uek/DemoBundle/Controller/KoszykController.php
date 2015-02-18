<?php

namespace Uek\DemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Uek\DemoBundle\Entity\Koszyk;
use Symfony\Component\HttpFoundation\Request;

class KoszykController extends Controller
{	

	public function indexAction() 
	{
		$uzytkownik = $this->getUser()->getUsername();
		$em = $this->getDoctrine()->getManager();
				
		$query = $em->createQuery(
			'SELECT f.tytulfilmu, f.oplata, k.uzytkownik FROM UekDemoBundle:Filmy f 
			JOIN UekDemoBundle:Koszyk k WHERE f.idfilmu = k.idfilmu AND k.uzytkownik = :uzytkownik'
		)
		->setParameter('uzytkownik', $uzytkownik);
		
		$koszyk = $query->getResult();
			
		return $this->render(
			'UekDemoBundle:Koszyk:index.html.twig',
			array(
				'koszyk' => $koszyk
			)
		);
	}
	
	public function showAction(Request $request)
	{
		$uzytkownik = $this->getUser()->getUsername();
		if ($this->getUser() == null)
		{
			$uzytkownik = '';
			
		} else {
			$em = $this->getDoctrine()->getManager();
			$query = $em->createQuery(
				'SELECT f. idfilmu, f.tytulfilmu, f.oplata, k.uzytkownik FROM UekDemoBundle:Filmy f
				JOIN UekDemoBundle:Koszyk k WHERE f.idfilmu = k.idfilmu AND k.uzytkownik = :uzytkownik'
			)
			->setParameter('uzytkownik', $uzytkownik);

			$koszyk = $query->getResult();
			
			return $this->render(
					'UekDemoBundle:Koszyk:show.html.twig',
					array(
						'koszyk' => $koszyk
					
					)
				);
		}
	}
	
	public function addAction($idfilmu)
	{
		if ($this->getUser() == null)
		{
			$uzytkownik = '';
		}
			
			$koszyk = new Koszyk();
			$koszyk->setUzytkownik($this->getUser()->getUsername());
			$em = $this->getDoctrine()->getManager();
			$film = $em->getRepository("UekDemoBundle:Filmy")->findOneBydfilmu($idfilmu);
			$koszyk->setIdfilmu($film->getIdfilmu());
		
//			if ($request->isMethod('POST'))
//			{
					$em = $this->getDoctrine()->getManager();
					$em->persist($koszyk);
					$em->flush();
					
					return $this->redirect($this->generateUrl('uek_demo_koszyk_index'));
//					return $this->redirect($this->generateUrl('uek_demo_filmy_see', ($koszyk->getIdfilmu())));
//			}
		
			return $this->render(
				'UekDemoBundle:Koszyk:add.html.twig',
				array(
					'koszyk' => $koszyk
				)
			);
		
		
	}
}