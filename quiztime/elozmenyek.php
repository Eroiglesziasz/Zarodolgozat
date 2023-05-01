<!DOCTYPE html>
<html lang="en">
<?php
session_start();
?>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="kozos/elozmeny.css" rel="stylesheet" type="text/css" />

  <title>Előzmények</title>

</head>
<?php include_once("header.php"); ?>


<body>
  <div class="container">
    <h1>Előzmények</h1>
    <?php

    include 'kozos/adatbazis.php';
    $db = new Database();
    $sql = "SELECT * FROM eredmeny WHERE felhasznalo_id = ? ORDER BY mikor DESC";
    $result = $db->RunSQL($sql, $_SESSION['felhasznalo_id']);
    if ($result->num_rows > 0): ?>
      <table>
        <thead>
          <tr>
            <th>Téma</th>
            <th>Nehézség</th>
            <th>Idő</th>
            <th>Dátum</th>
            <th>Pontszám</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
              <td>
                <?php
                $sql_tema = "SELECT nev FROM tema WHERE id = ?";
                $tema_result = $db->RunSQL($sql_tema, $row["tema_id"]);
                $tema = $tema_result->fetch_assoc();
                echo $tema["nev"];
                ?>
              </td>
              <td>
                <?php

                $sql_nehezseg = "SELECT nev FROM nehezseg WHERE id = ?";
                $nehezseg_result = $db->RunSQL($sql_nehezseg, $row["nehezseg_id"]);
                $nehezseg = $nehezseg_result->fetch_assoc();
                echo $nehezseg["nev"];
                ?>
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
            </tr>
          <?php endwhile; ?>

        </tbody>
      </table>
    <?php else: ?>
      <p>Nincsenek rögzített adatok az adatbázisban.</p>
    <?php endif; ?>

  </div>
</body>

</html>