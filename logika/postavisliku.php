<?php

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
var_dump($path);

require_once __DIR__ . '/../tabele/Korisnik.php';
Korisnik::unesi_sliku($path, $_SESSION['id']);

header('Location: ../registracija.php');
die();