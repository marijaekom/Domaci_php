<!DOCTYPE html>
<html>
<head>
	<title>Registracija</title>
	<link rel="stylesheet" type="text/css" href="css/styles2.css">
	<meta charset="utf-8">
</head>
<body>
	<div class="my-form">
		<h2>Registracija</h2>
		<form action="logika/registrujse.php" method="post" enctype="multipart/form-data">
			<input type="email" name="email" placeholder="Unesi e-mail" required>
			<input type="password" name="password" placeholder="Unesi  lozinku" required>
			<input type="password" name="password_repeat" placeholder="Ponovo unesi  lozinku" required>
			<input type="text" name="ime_prezime" placeholder="Unesi ime i prezime" required>
			<input type="text" name="telefon" placeholder="Unesi broj telefona" required>
			<label for="slika">Odaberi profilnu sliku</label>
			<input type="file" name="slika" id="slika" onchange="loadFile(event)">

			<img id="output" class="profile-image" style="display: none" />

			<script>
				var loadFile = function(event) {
					var output = document.getElementById('output');
					output.src = URL.createObjectURL(event.target.files[0]);

					var pic_size = event.target.files[0].size;
					var obavestenje = document.getElementById('img-too-big');
					if (pic_size > 2000000){
						obavestenje.style.display = "inline";
						output.style.display = "none";
					}
					else {
						obavestenje.style.display = "none";
						output.style.display = "inline";
					}
				};
			</script>
			<input type="submit" value="Registruj se" class="my-button">
			<?php if (isset($_GET['pass'])): ?>
				<p style="color:red; font-weight: bold">Lozinke se ne podudaraju.</p>
			<?php endif ?>
			<?php if (isset($_GET['error'])): ?>
				<p style="color:red; font-weight: bold">Već je registrovan nalog sa tom imejl adresom.</p>
			<?php endif ?>
			<p style="color:red; font-weight: bold; display: none" id="img-too-big">Slika je veća od 2mb i neće biti učitana. Molimo izaberite drugu sliku ukoliko želite.</p>
		</form>
		<a href="index.php">Prijavi se</a>
		<a href="lozinka.php">Promeni lozinku</a>
	</div>
</body>
</html>