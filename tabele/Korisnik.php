<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../includes/Database.php';

class Korisnik
{
	public $id;
	public $email;
	public $password;
	public $ime_prezime;
	public $telefon;

	public static function registracija($email, $password, $ime_prezime, $telefon, $slika)
	{
		$password = hash('sha512', $password);
		$db = Database::getInstance();
		try {
		$db-> insert('Korisnik',
			'INSERT INTO `korisnici` (`email`, `password`, `ime_prezime`, `telefon`, `slika`) VALUES (:email, :password, :ime_prezime, :telefon, :slika)',
			[
				':email' => $email,
				':password' => $password,
				':ime_prezime' =>$ime_prezime,
				':telefon' => $telefon,
				':slika' => $slika
			]); } catch (Exception $e){
			return false;
		}
		return $id = $db->lastInsertId();
	}

	public static function proveri($email, $password)
	{
		$password = hash('sha512', $password);
		$db = Database::getInstance();
		$korisnici = $db-> select('Korisnik', 
		'SELECT * FROM `korisnici` WHERE `email` LIKE :email AND `password` LIKE :password',
		[
			':email' => $email,
			':password' => $password
		]);
		foreach ($korisnici as $korisnik) {
			return $korisnik;
		}
		return null;
	}


	public static function promeni_password($password, $id)
	{
		$password = hash('sha512', $password);
		$db = Database::getInstance();
		$db -> update('Korisnik', 'UPDATE `korisnici` SET `password` = :password WHERE `korisnici`.`id` = :id',
			[
				':password' => $password,
				':id' => $id
			]);
	}

	public static function vrati_za_id($id)
	{
		$db = Database::getInstance();

		$korisnici = $db->select('Korisnik',
			'SELECT * FROM `korisnici` WHERE `id` = :id',
			[
				':id' => $id
			]);

		foreach ($korisnici as $korisnik) {
			return $korisnik;
		}

		return null;
	}

public static function svi_korisnici()
{
	$db = Database::getInstance();

	$korisnici = $db->select('Korisnik',
	 				'SELECT * FROM `korisnici` '
	 			);

	return $korisnici;
}

	

} 