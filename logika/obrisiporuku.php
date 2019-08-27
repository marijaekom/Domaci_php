<?php
session_start();
if (!isset($_SESSION['id'])) {
	header('Location: ../index.php');
	die();
}

if (!isset($_GET['id'])) {
	header('Location: ../korisnik.php');
	die();
}

require_once __DIR__ . '/../tabele/Poruka.php';
Poruka::obrisi_poruku($_GET['id'], $_SESSION['id']);


if(isset($_GET['ajax'])) {
	echo '{"obrisi":"true"}';
} else {
	header('Location: ../korisnik.php');
	die();
}

