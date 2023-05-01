<?php
session_start();
include 'kozos/adatbazis.php';
$db = new Database();
$targy = $_GET['targy'];
$nehez = ($_GET['nehez'] * 5);

$sql = "SELECT kerdesek.id,LOWER(tema.nev) as tema_nev, `szoveg` FROM `kerdesek` join tema on tema_id=tema.id having tema_nev = ?  order by RAND()  LIMIT $nehez;";

$kerdesk = $db->FetchData($sql, [$targy]);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $felhasznalo_id = $_SESSION['felhasznalo_id'];
    $tema_id = $_POST['tema_id'];
    $pontszam = 0;
    $nehezseg_id = $_POST['nehezseg'];

    foreach ($_POST as $key => $value) {
        if (strpos($key, 'radio') === 0) {
            $kerdes_id = str_replace('radio ', '', $key);
            $sql = "SELECT jovalasz FROM valasztas WHERE id = $value";
            $result = $db->RunSQL($sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                if ($row['jovalasz'] == 1) {
                    $pontszam++;
                }
            }
        }
    }

    $ma = date("Y-m-d");
    if (isset($_SESSION['felhasznalo'])) {
        $sql = "INSERT INTO eredmeny (felhasznalo_id, tema_id, pontszam, mikor) VALUES ($felhasznalo_id, $tema_id, $pontszam, '$ma')";
        $db->RunSQL($sql);
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="kozos/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="kozos/quiz.css" rel="stylesheet" type="text/css" />
    <title>Kvíz</title>
</head>

<body>
    <div class="container ">
        <div class="row pb-4">
        <div class="col-md-12 offset-lg-3 col-lg-6 col-xs-12 col-sm-12">
                <?php if (isset($_SESSION['felhasznalo'])): ?>
                    <h1 class="text-center">
                        <?= $_SESSION['felhasznalo']; ?>
                    </h1>
                <?php else: ?>
                    <h1 class="text-center">Vendég</h1>
                <?php endif; ?>
                <?php if (count($kerdesk) > 0): ?>


                    <form method='post' id='forma' action='eredmeny.php'>
                        <input type="hidden" name="tema_id" value="<?= $_GET['targy'] ?>">
                        <input type="hidden" name="ido" id="countera" value="60">
                        <input type="hidden" name="nehezseg" value="<?= $_GET['nehez'] ?>">
                        <h2 class="text-center">Hátralévő idő: <span id='counter'>60</span></h2><br>

                        <?php foreach ($kerdesk as $q):

                            $id = $q["id"];
                            $sql = "SELECT * FROM valasztas WHERE kerdes_id = ?";
                            $valaszok = $db->FetchData($sql, [$id]) ?>
                            <div class="card my-3">
                                <div class="card-body">
                                    <h3 class="card-title">
                                        <?= $q["szoveg"] ?>
                                    </h3>
                                    <?php shuffle($valaszok); ?>
                                    <?php foreach ($valaszok as $a): ?>
                                        <div class="form-check">
                                            <input class="form-check-input" type='radio' name='radio_<?= $id ?>'
                                                id='radio_<?= $a["id"] ?>' value='<?= $a["id"]  ?>'>
                                            <label class="form-check-label" for='radio_<?= $a["id"] ?>'><?= $a["szoveg"] ?></label>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <br><button class='buttona btn btn-blue-black' id='beadas' name='beadas'
                            type='submit'>Beadás</button>
                    </form>


                <?php else: ?>
                    Nincs kérdés.
                <?php endif; ?>
            </div>
        </div>
    </div>
    <script>
        var count = 60, timer = setInterval(function () {
            document.getElementById("counter").innerHTML = (count--) - 1;
            document.getElementById("countera").value = count;
            if (count == 0) {
                clearInterval(timer);
                document.getElementById("forma").submit();
            }
        }, 1000);
    </script>
</body>

</html>