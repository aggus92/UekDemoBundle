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
			'SELECT f.idfilmu, r.idrecenzji, f.tytulfilmu, r.tresc, r.autor FROM UekDemoBundle:Recenzje r JOIN UekDemoBundle:Filmy f WHERE f.idfilmu = r.idfilmu ORDER BY r.idrecenzji'
		);

		$recenzja = $query->getResult();
	
		return $this->render(
			'UekDemoBundle:Recenzje:index.html.twig',
			array(
				'recenzja' => $recenzja
				
			)
		);
	}
	
	public function createAction(Request $request)
	{
		
		
		if ($this->getUser() == null)
		{
			return $this->redirect($this->generateUrl('fos_user_security_login', array()));
		} else {
			
			$recenzje = new Recenzje();
			$recenzje->setAutor($this->getUser()->getUsername());
			$form = $this->createForm(
				new RecenzjaType(),
				$recenzje
			);
		
			if ($request->isMethod('POST')
				&& $form->handleRequest($request)
				&& $form->isValid()
				) {
					$em = $this->getDoctrine()->getManager();
					$em->persist($recenzje);
					$em->flush();
						return $this->redirect($this->generateUrl('uek_demo_homepage', array()));
			}
		
			return $this->render(
				'UekDemoBundle:Recenzje:create.html.twig',
				array(
					'form' => $form->createView(),
				)
			);
		}
		
	}
	
}