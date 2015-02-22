<?php

namespace Uek\DemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

class PlatnosciController extends Controller
{
	public function payAction() 
	{
		$uzytkownik = $this->getUser()->getUsername();
		
	}
	
}