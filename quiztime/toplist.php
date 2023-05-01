<!DOCTYPE html>
<html lang="en">
<?php
session_start();
include 'kozos/adatbazis.php';
$db = new Database();
?>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="kozos/toplist.css" rel="stylesheet" type="text/css" />

  <title>Toplista</title>

</head>
<?php include_once("header.php"); ?>


<body>
  <div class="container">
    <h1>Legjobb 10</h1>

    <form method="get" action="">
      <select class="select" name="tema" id="tema">

        <option value="" class="betu">--- Téma ---</option>
        <?php

        $sql = "SELECT * FROM tema";
        $result = $db->RunSQL($sql);

        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            echo '<option value="' . $row["id"] . '">' . $row["nev"] . '</option>';
          }
        }
        ?>
      </select>

      <select class="select" name="nehezseg" id="nehezseg">
        <option value="" class="betu">-- Nehézség --</option>
        <?php
        $sql = "SELECT * FROM nehezseg";
        $result = $db->RunSQL($sql);

        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            echo '<option class = "betu" value="' . $row["id"] . '">' . $row["nev"] . '</option>';
          }
        }
        ?>

      </select>
      <button type="submit" class="buttona">Szűrés</button>
    </form>
    <br>

    <?php
    $where = "";
    if (isset($_GET["tema"]) && !empty($_GET["tema"])) {
      $where .= " WHERE tema_id = " . $_GET["tema"];
    }
    if (isset($_GET["nehezseg"]) && !empty($_GET["nehezseg"])) {
      if (empty($where)) {
        $where .= " WHERE nehezseg_id = " . $_GET["nehezseg"];
      } else {
        $where .= " AND nehezseg_id = " . $_GET["nehezseg"];
      }
    }

    if (isset($_GET["tema"]) && !empty($_GET["tema"])) {
      if (empty($where)) {
        $where .= " WHERE tema_id = " . $_GET["tema"];
      } else {
        $where .= " AND tema_id = " . $_GET["tema"];
      }
    }

    $sql = "SELECT eredmeny.*, felhasznalo.felhasznalo, tema.nev AS tema_nev, nehezseg.nev AS nehezseg_nev
    FROM eredmeny 
    JOIN felhasznalo ON eredmeny.felhasznalo_id = felhasznalo.id 
    JOIN tema ON eredmeny.tema_id = tema.id
    JOIN nehezseg ON eredmeny.nehezseg_id = nehezseg.id";

    if (!empty($where)) {
      $sql .= $where;
    }

    $sql .= " ORDER BY pontszam DESC, ido ASC, id ASC LIMIT 10";

    $result = $db->RunSQL($sql);
    if ($result->num_rows > 0): ?>
      <div class='container'>
      <table class="table table-dark table-striped">
          <thead>
            <tr>
              <th>#</th>
              <th>Téma</th>
              <th>Nehézség</th>
              <th>Idő</th>
              <th>Dátum</th>
              <th>Pontszám</th>
              <th>Felhasználó</th>
            </tr>
          </thead>
          <tbody>
            <?php $counter = 1;
            while ($row = $result->fetch_assoc()): ?>
              <tr>
                <td>
                  <?= $counter ?>
                </td>
                <td>
                  <?= $row["tema_nev"] ?>
                </td>
                <td>
                  <?= $row["nehezseg_nev"] ?>
                </td>
                <td>
                  <?= $row["ido"] ?>
                </td>
                <td>
                  <?= $row["mikor"] ?>
                </td>
                <td>
                  <?= $row["pontszam"] ?>
                </td>
                <td>
                  <?= $row["felhasznalo"] ?>
                </td>
              </tr>
              <?php
              $counter++;
            endwhile; ?>

          </tbody>
        </table>
      </div>
    <?php endif; ?>