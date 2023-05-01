<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="kozos/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="kozos/eredmeny.css" rel="stylesheet" type="text/css" />

  <title>Eredmények</title>
</head>

<body>
  <?php
  session_start();
  include 'kozos/adatbazis.php';
  $db = new Database();



  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_SESSION['felhasznalo'])) {
      $felhasznalo_id = $_SESSION['felhasznalo'];
      $sql = "SELECT id from felhasznalo where felhasznalo = '" . $felhasznalo_id . "'";
      $res = $db->RunSQL($sql);
      $user_id = ($res->fetch_assoc())["id"];
    }
    $tema_nev = $_POST['tema_id'];

    $tema_result = $db->RunSQL("SELECT * FROM tema WHERE nev = ?", $tema_nev);
    $tema_id = ($tema_result->fetch_assoc())["id"];


    $pontszam = 0;
    $nehezseg_id = $_POST['nehezseg'];

    $nehezseg_result = $db->RunSQL("SELECT * FROM nehezseg WHERE id = ?", $nehezseg_id);
    $nehezseg_nev = ($nehezseg_result->fetch_assoc())["nev"];



    foreach ($_POST as $key => $value) {
      if (strpos($key, 'radio') === 0) {
        $kerdes_id = str_replace('radio_', '', $key);
        $sql = "SELECT * FROM valasztas WHERE kerdes_id = $kerdes_id";
        $result = $db->RunSQL($sql);
        while ($row = $result->fetch_assoc()) {
          if ($row['jovalasz']) {
            if ($row['id'] == $value)
              $pontszam++;
          }
        }
      }
    }
    $ido = $_POST['ido'];
    $ido = 60 - $ido;
    if (isset($_SESSION['felhasznalo_id'])) {
      $user_id = $_SESSION['felhasznalo_id'];
      $sql = "INSERT INTO eredmeny (felhasznalo_id, tema_id, pontszam,ido,nehezseg_id) VALUES ($user_id, $tema_id, $pontszam,$ido,$nehezseg_id)";
      $db->RunSQL($sql);
    }
  } ?>
  <div class='container'>
    <div class='box'>
      <br>
      <p>Téma:
        <?= $tema_nev ?>
      </p>
      <p>Nehézség:
        <?= $nehezseg_nev ?>
      </p>
      <p>Idő:
        <?= $ido ?> másodperc
      </p>
      <p>Pontszám:
        <?= $pontszam ?>
      </p>
      <p>Dátum:
        <?= date("Y/m/d") ?>
      </p>
      <?php
      if (isset($_SESSION['felhasznalo'])) {
        $link = 'index.php';
      } else {
        $link = 'index.php';
      }
      ?>
      <a href='<?php echo $link; ?>'><button class='gomb'>Vissza</button></a>

    </div>
  </div>


</body>

</html>