<?php
session_start();
if (!isset($_SESSION['id'])){
	header('Location: index.php');
	die();
}

require_once __DIR__ . '/tabele/Poruka.php';
$poruke = Poruka::sve_poruke();

require_once __DIR__ . '/tabele/Korisnik.php';
$korisnici = Korisnik::svi_korisnici();

?>


<!DOCTYPE html>
<html>
<head>
	<title>Razmena poruka</title>
	<link rel="stylesheet" type="text/css" href="css/styles2.css">
	<meta charset="utf-8">
	<script src="js/jquery-3.3.1.min.js"></script>
	<script>
		$(function() {
			$('#ostavi_poruku').on('submit', function(e){
				e.preventDefault();
				$.ajax({
					'method':$('#ostavi_poruku').attr('method'),
					'url':$('#ostavi_poruku').attr('action'), 
					'data': {
						'naslov':$('#naslov').val(),
						'sadrzaj':$('#sadrzaj').val(),
						'id': $('#id').val(),
						'prioritet': $('[name="prioritet"]:checked').val(), 
						'primalac': $('#primalac').val(),
						'ajax':true
					},
					'dataType':'json',
					'success':function(poruka) {
						console.log(poruka);
						var sadrzaj = '<div class="poruka">'+
						'<div class="message-info">'+
						'<div>';
						if (poruka.korisnik.slika !== ""){
							sadrzaj+='<img src="'+poruka.korisnik.slika +'" class="user-image">';
						}
						else{
							sadrzaj+='<img src="slike/user.png" class="user-image">';
						}
						sadrzaj+='</div>'+
						'<p class="ime-prezime">'+poruka.korisnik.ime_prezime+'</p>'+
						'<p>'+poruka.naslov+'</p>'+
						'<p>'+poruka.vreme+'</p>'+
						'<a href="logika/obrisiporuku.php?id='+poruka.id+'" class="btn delete-btn obrisi">Obriši</a>'+
						'</div>'+
						'<div class="message-content">';
						if (poruka.prioritet == 1){
							sadrzaj+= '<p class="red-text">'+poruka.sadrzaj+ '</p>';
						}else{
							sadrzaj+= '<p class="green-text">'+poruka.sadrzaj+'</p>';
						}
						sadrzaj+='</div>'+
						'</div>';
						$('#poruke').prepend(sadrzaj);
						$('#naslov').val('');
						$('#sadrzaj').val('');
						$('#primalac').val('izaberi');
						$('.obrisi').off('click');

						$('.obrisi').on('click', function (e){
							e.preventDefault();
							var url = $(this).attr('href');
							var poruka =  $(this).parent().parent();
							$.ajax({
								'method' : 'get',
								'url' : url,
								'data':{
									'ajax': true
								},
								'dataType': 'json',
								'success': function(odgovor){
									console.log(odgovor);
									if (odgovor.obrisi=="true"){
										poruka.fadeOut(1000, function(){
											poruka.remove();
										});
									}
								},
								'error': function(odgovor){
									console.log(odgovor);
								}
							});

							$('.procitaj').off('click');
							$('.procitaj').on('click', function (e){
								e.preventDefault();
								var url = $(this).attr('href');
								var procitano= $('#procitano').val();
								var procitaj =$(this);

								$.ajax({
									'method' : 'get',
									'url' : url,
									'data':
									{
										'ajax': true
									},
									'dataType': 'json',
									'success': function(odgovor){
										console.log(odgovor);
										if (odgovor.procitano=="true"){
											procitaj.fadeOut(1000, function(
												){
												procitaj.parent().parent().find('.message-content').append('<p class="procitana_poruka">Pročitano</p>');
												procitaj.remove();
											});
										}
									},
									'error': function(odgovor){
										console.log(odgovor);
									}
								})
							});	
						});

					},
					'error':function(odgovor) {
						console.log(odgovor);
					}
				});
			});

			$('.obrisi').on('click', function (e){
				e.preventDefault();
				var url = $(this).attr('href');
				var poruka =  $(this).parent().parent();
				$.ajax({
					'method' : 'get',
					'url' : url,
					'data':
					{
						'ajax': true
					},
					'dataType': 'json',
					'success': function(odgovor){
						console.log(odgovor);
						if (odgovor.obrisi=="true"){
							poruka.fadeOut(1000, function(
								){
								poruka.remove();
							});
						}
					},
					'error': function(odgovor){
						console.log(odgovor);
					}
				})
			});

			$('.procitaj').on('click', function (e){
				e.preventDefault();
				var url = $(this).attr('href');
				var procitano= $('#procitano').val();
				var procitaj =$(this);

				$.ajax({
					'method' : 'get',
					'url' : url,
					'data':
					{
						'ajax': true
					},
					'dataType': 'json',
					'success': function(odgovor){
						console.log(odgovor);
						if (odgovor.procitano=="true"){
							procitaj.fadeOut(1000, function(
								){
								procitaj.parent().parent().find('.message-content').append('<p class="procitana_poruka">Pročitano</p>');
								procitaj.remove();
							});
						}
					},
					'error': function(odgovor){
						console.log(odgovor);
					}
				})
			});

		});
	</script>
</head>
<body>
	<div class="my-form">
		<div class="my-header">
			<?php foreach ($korisnici as $korisnik): ?>
				<?php if ($korisnik->id == $_SESSION['id']) :?>
					<h3>Prijavljeni ste kao <span class="my-name"><?=$korisnik->ime_prezime ?> </span></h3>
					<?php if ($korisnik->slika != "") :?>
						<img src="<?=$korisnik->slika ?>" class="profile-image">
					<?php endif ?>
					<?php if ($korisnik->slika == "") :?>
						<img src="slike/user.png" class="profile-image">
					<?php endif ?>
				<?php endif ?>
			<?php endforeach ?>
			<a href="logika/odjavise.php">Odjavi se</a>
		</div>
		<h2>Razmena poruka</h2>
		<form method="post" action="logika/ostaviporuku.php" id="ostavi_poruku">
			<input type="text" name="naslov" id="naslov" placeholder="Unesite naslov poruke" required>
			<textarea name="sadrzaj" id="sadrzaj" placeholder="Unesite vašu poruku." maxlength="160" required></textarea>
			<p>Izaberite korisnika za razmenu poruka.</p>
			<select name="primalac" id="primalac" required>
				<option></option>
				<?php foreach ($korisnici as $korisnik): ?>
					<?php if ($korisnik->id != $_SESSION['id']) :?>
						<option value="<?=$korisnik->id?>"><?=$korisnik->ime_prezime?></option>
					<?php endif ?>
				<?php endforeach ?>
			</select>
			<input type="hidden" id="id" name="id" value="<?= $_SESSION['id']?>">
			<div class="radio-buttons">
				<span>Hitno</span><input type="radio" name="prioritet" value="1" required checked>
				<span>Nije hitno</span><input type="radio" name="prioritet" value="0">
			</div>
			<input type="submit" value="Pošalji" class="my-button" id="posalji">
		</form>
	</div>

	<div id="poruke" class="my-message">
		<?php foreach ($poruke as $poruka): ?> 
			<?php if ( $poruka->korisnik()->id==$_SESSION['id'] || $poruka->primalac==$_SESSION['id']): ?>
				<div class="poruka">
					<div class="message-info">
						<?php if($poruka->korisnik()->slika !==""): ?>
							<div >
								<img src="<?=$poruka->korisnik()->slika ?>" class="user-image">
							</div>
						<?php endif ?>
						<?php if($poruka->korisnik()->slika ===""): ?>
							<div >
								<img src="slike/user.png" class="user-image">
							</div>
						<?php endif ?>
						<p class="ime-prezime"><?= $poruka->korisnik()->ime_prezime ?></p>
						<p><?= $poruka->naslov ?></p>
						<p><?= $poruka->vreme() ?></p>
						<?php if ( $poruka->korisnik()->id==$_SESSION['id']): ?>
							<a href="logika/obrisiporuku.php?id=<?=
							$poruka->id ?>" class="btn delete-btn obrisi">Obriši</a>
						<?php endif ?>
						<?php if ( $poruka->korisnik()->id!=$_SESSION['id']): ?>
							<input type="hidden" name="procitano" id="procitano" value="<?=$poruka->procitano?>">
							<?php if ( $poruka->procitano==0): ?>
								<a href="logika/procitajporuku.php?id=<?=
								$poruka->id?>" class="btn procitaj">Pročitaj</a>
							<?php endif ?>
						<?php endif ?>
					</div>
					<div class="message-content">
						<?php if($poruka->prioritet==1): ?>
							<p class="red-text"><?= $poruka->sadrzaj ?></p>
						<?php endif ?>
						<?php if($poruka->prioritet==0): ?>
							<p class="green-text"><?= $poruka->sadrzaj ?></p>
						<?php endif ?>
						<?php if ( $poruka->procitano==1): ?>
							<p class="procitana_poruka">Pročitano</p>
						<?php endif ?>
					</div>
				</div>
			<?php endif ?>
		<?php endforeach ?>
	</div>
</body>
</html>