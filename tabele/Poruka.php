<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../includes/Database.php';

class Poruka 
{
	public $id;
	public $naslov;
	public $sadrzaj;
	public $vreme;
	public $korisnik_id;
	public $prioritet;
	public $primalac;
	public $procitano;


public function korisnik()
{
	require_once __DIR__ . '/Korisnik.php';
	return Korisnik::vrati_za_id($this->korisnik_id);
}


public function vreme()
{
	$broj_sekundi = strtotime($this->vreme);

	$formatirano_vreme = date('d.m.Y. H:i:s', $broj_sekundi);

	return $formatirano_vreme;
}

public static function ostavi_poruku($naslov, $sadrzaj, $korisnik_id, $prioritet, $primalac)
{
	$db = Database::getInstance();

	$db->insert('Poruka', 'INSERT INTO `poruke` (`naslov`, `sadrzaj`, `korisnik_id`, `prioritet`, `primalac`) VALUES (:naslov, :sadrzaj, :korisnik_id, :prioritet, :primalac);',
		[
			':naslov' => $naslov,
			':sadrzaj' => $sadrzaj,
			':korisnik_id' => $korisnik_id,
			':prioritet' => $prioritet,
			':primalac' => $primalac,

		]
	);

	return $db->lastInsertId();
}


public static function sve_poruke()
{
	$db = Database::getInstance();

	$poruke = $db->select('Poruka',
	 				'SELECT * FROM `poruke` ORDER BY `poruke`.`id` DESC');

	return $poruke;
}


public static function obrisi_poruku($id, $korisnik_id)
	{
		$db = Database::getInstance();

		$db->delete("DELETE FROM `poruke` WHERE `id` = :id AND `korisnik_id` = :korisnik_id",
					[
						':id' => $id,
						':korisnik_id' => $korisnik_id,
					]);
	}

public static function procitaj_poruku($id, $procitano)
	{
		$db = Database::getInstance();


		$db -> update('Poruka', 'UPDATE `poruke` SET `procitano` = :procitano WHERE `poruke`.`id` = :id',
			[
				':procitano' => $procitano,
				':id' => $id
			]);
	}

	public static function poruka_za_id($id)
	{
		$db = Database::getInstance();

		$poruke = $db->select('Poruka',
			'SELECT * FROM `poruke` WHERE `id` = :id',
			[
				':id' => $id
			]);

		foreach ($poruke as $poruka) {
			return $poruka;
		}

		return null;
	}





}