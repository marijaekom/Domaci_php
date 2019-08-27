<?php
session_start();
if (isset($_SESSION['id'])){
	header('Location: korisnik.php');
	die();
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Prijava</title>
	<link rel="stylesheet" type="text/css" href="css/styles2.css">
	<meta charset="utf-8">
</head>
<body>
	<div class="my-form">
		<h2>Prijava</h2>
		<?php if (isset($_GET['success'])): ?>
			<p>Uspešno ste promenili lozinku!</p>
		<?php endif ?>
		<form action="logika/prijavise.php" method="post">
			<input type="email" name="email" placeholder="Unesi e-mail" required>
			<input type="password" name="password" placeholder="Unesi lozinku" required>
			<input type="submit" value="Prijavi se" class="my-button">
			<?php if (isset($_GET['error'])): ?>
				<p style="color:red; font-weight: bold">Pogrešni podaci za prijavu.</p>
			<?php endif ?>
		</form>
		<a href="lozinka.php">Promeni lozinku</a>
		<a href="registracija.php">Registruj se</a>
	</div>
</body>
</html>