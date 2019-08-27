<?php

if (!isset($_POST['email'])){
	header('Location: ../registracija.php');
	die();
}

$email = $_POST['email'];
$password = $_POST['password'];
$password_repeat = $_POST['password_repeat'];
$ime_prezime = $_POST['ime_prezime'];
$telefon = $_POST['telefon'];

if ($password !== $password_repeat){
	header('Location: ../registracija.php?pass=0');
	die();
}

require_once __DIR__ .  '/../includes/Upload.php';

$fajl = Upload::factory("../slike");

$fajl->set_allowed_mime_types(
[
	'image/jpg',
	'image/jpeg',
	'image/png',
	'image/gif',

]
);

$fajl->set_max_file_size(2);

$fajl->file($_FILES['slika']);



$fajl->set_filename(
	time() . 
	$_FILES['slika']['name']
);

$putanja = $fajl->upload();
$path = str_replace("\\", "/", $putanja['path']);
$path = str_replace("../", "", $path);


/*if(isset($_FILES['slika'])) {
    if($_FILES['slika']['size'] > 2) { 
       	header('Location: ../registracija.php?image=0');
		die();
    } 
}*/
//ovde sam htela da proverim da li je ucitana slika veca od 2mb ali mi ne radi

require_once __DIR__ . '/../tabele/Korisnik.php';
$id = Korisnik::registracija($email, $password, $ime_prezime, $telefon, $path);


if ($id !== false){
	header('Location: ../index.php');
	die();
}
else{
	header('Location: ../registracija.php?error=0');
	die();
}
