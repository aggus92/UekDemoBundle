<?php

namespace Uek\DemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Uek\DemoBundle\Entity\Wypozyczenia;
use Uek\DemoBundle\Form\RecenzjaType;
use Symfony\Component\HttpFoundation\Request;

class WypozyczeniaController extends Controller
{
	public function indexAction() 
	{
		
		if ($this->getUser() == null)
		{
			return $this->redirect($this->generateUrl('fos_user_security_login', array()));
			
		} else {
			$em = $this->getDoctrine()->getManager();
			$query = $em->createQuery(
				'SELECT w.idwypozyczenia, f.tytulfilmu, f.oplata FROM UekDemoBundle:Wypozyczenia w JOIN UekDemoBundle:Filmy f WHERE f.idfilmu = w.idfilmu'
			);

			$wypozyczenia = $query->getResult();
	
			return $this->render(
				'UekDemoBundle:Wypozyczenia:index.html.twig',
				array(
					'wypozyczenia' => $wypozyczenia
				
				)
			);
		}
	}
	
}