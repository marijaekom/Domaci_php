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
Poruka::procitaj_poruku($_GET['id'], 1);


if(isset($_GET['ajax'])) {
	echo '{"procitano":"true"}';
} else {
	header('Location: ../korisnik.php');
	die();
}
