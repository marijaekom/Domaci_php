<!DOCTYPE html>
<html>
<head>
	<title>Promena lozinke</title>
	<link rel="stylesheet" type="text/css" href="css/styles2.css">
	<meta charset="utf-8">
</head>
<body>
	<div class="my-form">
		<h2>Promena lozinke</h2>
		<form method="post" action="logika/izmenilozinku.php">
			<input type="email" name="email" placeholder="Unesi e-mail" required>
			<input type="password" name="password_old" placeholder="Unesi staru lozinku" required>
			<input type="password" name="password" placeholder="Unesi novu lozinku" required>
			<input type="password" name="password_repeat" placeholder="Ponovo unesi novu lozinku" required>
			<input type="submit" value="Promeni lozinku" class="my-button">
			<?php if (isset($_GET['pass'])): ?>
				<p style="color:red; font-weight: bold">Nove lozinke se ne podudaraju.</p>
			<?php endif ?>
			<?php if (isset($_GET['error'])): ?>
				<p style="color:red; font-weight: bold">Pogrešni podaci za prijavu.</p>
			<?php endif ?>
		</form>
		<a href="index.php">Prijavi se</a>
		<a href="registracija.php">Registruj se</a>
	</div>
</body>
</html>