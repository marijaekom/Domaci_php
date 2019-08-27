<?php
session_start();

if (!isset($_SESSION['id'])) {
	header('Location: ../index.php');
	die();
}

if (!isset($_POST['naslov'])) {
	header('Location: ../korisnik.php');
	die();
}


require_once __DIR__ . '/../tabele/Poruka.php';

$id = Poruka::ostavi_poruku($_POST['naslov'], $_POST['sadrzaj'], $_SESSION['id'], $_POST['prioritet'], $_POST['primalac']);


if (isset($_POST['ajax'])){
	$poruka = Poruka::poruka_za_id($id);
	$poruka->korisnik = $poruka->korisnik();
	$poruka->vreme = $poruka->vreme();
	echo json_encode($poruka);
} else {
	header('Location: ../korisnik.php');
}

