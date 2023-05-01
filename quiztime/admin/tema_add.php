<?php
session_start();
if (!isset($_SESSION['admin']) || $_SESSION['admin'] != 1) {
    header("Location: ../index.php");
    exit();
}

include_once("../kozos/quiz.php");
include_once("../header.php");
if (isset($_POST) && count($_POST) > 0) {

    //quiz::debug($_POST);
    //quiz::debug($_FILES);


    $quiz = new quiz();

    $quiz->save_quiz($_POST);

    $_SESSION['message'] = "Kvíz mentve.";
    header("Location: ../admin");
    exit;

}

$max_questions = 15;
$max_answers = 3;
?>
<!doctype html>
<html lang="en">

<head>
<meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../kozos/bootstrap.min.css">
    <link href="../kozos/tema.css" rel="stylesheet" type="text/css" />
    <title>Téma Hozzáadása</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Téma Hozzáadása</h1><br>
            </div>
        </div>
        <div class="card-body">
        <div class="row">
            <div class="col-12">
                <form action="" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <div class="mb-3">
                            <label for="nev"  class="form-label">Mi legyen a téma neve?</label>
                            <input type="text" required class="form-control" id="nev" placeholder="Nev" name="nev">
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Válaszd ki a téma hátterét</label>
                            <input required class="form-control" type="file" id="kep" placeholder="Nev" name="kep_url"
                                accept="image/*">
                        </div>

                        <?php for ($q = 0; $q < $max_questions; $q++) { ?>
                            <div class="mb-3">
                                <h2>Kérdés
                                    <?= $q + 1 ?>
                                </h2>
                                <label for="q<?= $q + 1 ?>" class="form-label">Kérdés:</label>
                                <input id="q<?= $q + 1 ?>" type="text" name="question[q<?= $q + 1 ?>][text]"
                                required class="form-control">
                            </div>
                            <?php for ($a = 0; $a < $max_answers; $a++) { ?>
                                <div class="mb-3">
                                    <label for="a<?= $a + 1 ?>" class="form-label">Válasz <?= $a + 1 ?>:</label>
                                    <div style="display: flex; align-items: center;">
                                        <input id="a<?= $a + 1 ?>_correct" type="radio" value="a<?= $a + 1 ?>" required
                                            name="question[q<?= $q + 1 ?>][correct]">
                                        <input id="a<?= $a + 1 ?>" type="text" 
                                            name="question[q<?= $q + 1 ?>][answers][a<?= $a + 1 ?>]" required
                                            class="form-control ">
                                    </div>
                                </div>
                            <?php } ?>
                            <hr>
                        <?php } ?>

                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Hozzáadás</button>
                            <a href="../index.php" class="btn btn-danger">Mégse</a>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
        </div>

    </div>
</body>

</html>