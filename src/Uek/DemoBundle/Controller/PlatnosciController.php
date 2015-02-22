<?php

namespace Uek\DemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Uek\DemoBundle\Entity\Wypozyczenia;

class PlatnosciController extends Controller
{
	public function payAction() 
	{

		$uzytkownik = $this->getUser()->getUsername();
		
		$em = $this->getDoctrine()->getManager();
			
		$query = $em->createQuery(
			'SELECT u.id, u.username, u.email FROM UekDemoBundle:User u
			WHERE u.username  = :username'
			)
			->setParameter('username', $uzytkownik);
	
		$userName = $query->getResult();
		
		$query2 = $em->createQuery(
			'SELECT f.idfilmu, f.tytulfilmu, f.oplata FROM UekDemoBundle:Filmy f 
				JOIN UekDemoBundle:Koszyk k WHERE f.idfilmu = k.idfilmu
				WHERE k.uzytkownik = :uzytkownik'
			)
			->setParameter('uzytkownik', $uzytkownik);
	
		$filmcost = $query2->getResult();
		
		$idfilmow = array_column($filmcost, "idfilmu");
		$koszty = array_column($filmcost, "oplata");
		$tytuly = array_column($filmcost, "tytulfilmu");
		$idfilm = $idfilmow[0];
		$koszt = $koszty[0];
		$tytul = $tytuly[0];
		
		$idU = array_column($userName, "id");
		$mail = array_column($userName, "email");
		$idUser = $idU[0];
		$email = $mail[0];
		
		$request = $this->getRequest();
		$urlDotPay = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath(). 'app_dev.php/payment/pay';
		$urlHome = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath(). '/app_dev.php/';
	
		$data = [
			'id' => 72890,
			'kwota' => $koszt,
			'waluta' => 'PLN',
			'kanal' => 3,
			'opis' => 'Płatność za wypożyczenie: '.$tytul,
			'control' => 'WZP0000012',
			'URLC' => $urlDotPay,
			'firstname' => $uzytkownik,
			'email' => $email,
			'URL' => $urlHome,
			'typ' => 3
		];
		
		$params = http_build_query($data);
		
		$url = sprintf(
			'%s?%s',
			'https://ssl.dotpay.pl/',
			$params
		);
		
		$film = $em->getRepository("UekDemoBundle:Filmy")->findOneByIdfilmu($idfilm);
		$user = $em->getRepository("UekDemoBundle:User")->findOneById($idUser);
		
		$koszyk = $em->getRepository("UekDemoBundle:Koszyk")->findOneBy(array('idfilmu' => $film, 'uzytkownik' => $uzytkownik));
		
		$em->remove($koszyk);
		$em->flush();
		
		$wypozyczenie = new Wypozyczenia();
		$wypozyczenie->setIdfilmu($film);
		$wypozyczenie->setIduzytkownika($user);
		
		$em->persist($wypozyczenie);
		$em->flush();

		return new RedirectResponse($url);

	}
	
	
	
}