<?php

require_once __DIR__ . '/../tabele/Korisnik.php';

$email = $_POST['email'];
$password = $_POST['password'];

$korisnik = Korisnik::proveri($email, $password);

if ($korisnik != null){
	session_start();
	$_SESSION['id'] = $korisnik->id;
	header('Location: ../korisnik.php');
	die();
}
else{
	header('Location: ../index.php?error=login');
	die();
}
