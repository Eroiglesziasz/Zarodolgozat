<?php 
session_start();
if (!isset($_SESSION['admin']) || $_SESSION['admin'] != 1) {
    header("Location: ../index.php");
    exit();
}
?>
<?php include_once("../header.php"); ?>



<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../kozos/bootstrap.min.css">
    <link href="../kozos/adminindex.css" rel="stylesheet" type="text/css" />
    <title>Admin Menü</title>
</head>

<body>
<h1>Beállítások</h1>
<div class="container">
    <?php
    if(isset($_SESSION['message'])) {?>
    <div class="row">
        <div class="col-12 alert alert-success"">
        <p><?=$_SESSION['message']?></p>
    </div>
</div>
<?php
unset($_SESSION['message']);
}
?>
    <div class="row">
        <div class="col-xs-12 offset-md-3 col-md-6 ">
            <div class="card">
                <div class="card-body text-center">
                    <p>
                        <a href="newpw.php"><button class="btn btn-custom">Új jelszó</button></a>
                    </p>
                    <p>
                        <a href="tema_add.php"><button class="btn btn-custom">Új Téma hozzáadása</button></a>
                    </p>
                    <p>
                        <a href="users.php"><button class="btn btn-custom">Felhasználó Beállítások</button></a>
                    </p>



                </div>
            </div>
        </div>
    </div>
</body>
</html>