<!DOCTYPE html>
<html>

<link href="kozos/index.css" rel="stylesheet" type="text/css" />
<?php
session_start();
?>

<head>
	<title>Kezdőlap</title>
</head>
<?php include_once("header.php"); ?>

<body>
	<h1>Válassz nehézséget és témát!</h1>

	<div class="container2">
		<?php
		include_once 'kozos/adatbazis.php';
		$db = new Database();

		$tantargy = $db->FetchData("SELECT * FROM tema");
		$nehez = $db->FetchData("SELECT * FROM nehezseg");

		foreach ($tantargy as $targy): ?>
			<?php
			if (!is_null($targy['kep_url']) && $targy['kep_url'] != "" && file_exists($targy['kep_url'])) {

				$bg_kep = $targy['kep_url'];
			} else {
				$bg_kep = 'kozos/' . $targy['nev'] . '.jpg';
			}
			?>
			<div class="card" style="background-image: url('<?= $bg_kep ?>');">
				<div class="card__inner">
					<?php foreach ($nehez as $i => $asd): ?>
						<a href="quiz.php?targy=<?= $targy['nev'] ?>&nehez=<?= $asd['id'] ?>"><button class="button-31">
								<?= $asd['nev'] ?>
							</button></a>
					<?php endforeach ?>
				</div>
			</div>
		<?php endforeach ?>
	</div>
	<div class="container2">
	</div>
</body>

</html>