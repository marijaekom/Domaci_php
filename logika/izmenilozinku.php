<?php

require_once __DIR__ . '/../tabele/Korisnik.php';
$email = $_POST['email'];
$password_old = $_POST['password_old'];

$password = $_POST['password'];
$password_repeat = $_POST['password_repeat'];


$korisnik = Korisnik::proveri($email, $password_old);

if ($korisnik != null){
	session_start();
	$_SESSION['id'] = $korisnik->id;
	session_destroy();
}
else{
	header('Location: ../lozinka.php?error=0');
	die();
}

if ($password !== $password_repeat){
	header('Location: ../lozinka.php?pass=0');
	die();
}

$korisnik = Korisnik::promeni_password($password, $_SESSION['id']);
session_destroy();
header('Location: ../index.php?success=0');
die();
