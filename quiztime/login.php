<?php
include 'kozos/adatbazis.php';
$db = new Database();
session_start();
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $jelszo = $_POST['jelszo'];

    $sql = "SELECT * FROM felhasznalo WHERE email = '$email';";
    $result = $db->RunSQL($sql);
    $user = $result->fetch_assoc();

    if ($user != false && password_verify($jelszo, $user['jelszo'])) {
        $_SESSION['email'] = $user['email'];
        $_SESSION['felhasznalo'] = $user['felhasznalo'];
        $_SESSION['felhasznalo_id'] = $user['id'];
        $_SESSION['admin'] = $user['admin'];
        header('Location: index.php');
    } else {
        echo '<div class="alert alert-danger text-center" role="alert">A felhasznaló név '
            . ' és/vagy a jelszó nem megfelelő <br><strong>Próbálkozzon újra</strong></div>';
    }
}
?>
<link href="kozos/style.css" rel="stylesheet" type="text/css" media="all" />
<link href="kozos/bootstrap.min.css" rel="stylesheet" type="text/css" />
<?php include_once("header.php"); ?>
<title>Bejelentkezés</title>
<div class="container">
    <h1>Bejelentkezés</h1>
    <hr class="hre">
    <main>
        <article class="d-flex flex-wrap">
            <div class="col-6 offset-3 my-3">
                <div class="card mb-3 text-center h-100 mx-2">
                    <div class="card-body">
                        <form method="POST">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email cím</label>
                                <input type="email" class="form-control" id="email" name="email">
                            </div>
                            <div class="mb-3">
                                <label for="jelszo" class="form-label">Jelszó</label>
                                <input type="password" class="form-control" id="jelszo" name="jelszo">
                            </div>
                            <button type="submit" class="button-31" id="login" name="login">Bejelentkezés</button><br><br>
                            <a class="asd" href="register.php">Nincs fiókod?</a>
                    </div>


                    </form>
                </div>

            </div>
</div>

</main>
</div>
<?php
?>