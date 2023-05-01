<?php
include 'kozos/adatbazis.php';

function reg()
{
    $db = new Database();
    session_start();
    if (isset($_POST['register'])) {
        $email = $_POST['email'];
        $jelszo = $_POST['jelszo'];
        $felhasznalo = $_POST['felhasznalo'];

        if (strlen($jelszo) < 6) {
            echo '<div class="alert alert-danger text-center" role="alert">A jelszónak minimum 6 karakterből kell állnia!</div>';
            return;
        }
        $jelszo_hash = password_hash($jelszo, PASSWORD_DEFAULT);


        $sql = "SELECT * FROM felhasznalo WHERE email = ?;";
        $result = $db->RunSQL($sql, $email);
        $chk_email = $result->fetch_assoc();

        $sql = "SELECT * FROM felhasznalo WHERE felhasznalo = ?;";
        $result = $db->RunSQL($sql, $felhasznalo);
        $chk_user = $result->fetch_assoc();

        if ($chk_email != false) {
            echo '<div class="alert alert-danger text-center" role="alert">Ezzel az email címmel '
                . 'már regisztráltak! <br><strong>Próbálkozzon újra</strong></div>';
            return;

        } elseif ($chk_user != false) {
            echo '<div class="alert alert-danger text-center" role="alert"> Az email cím megfelelő, de a felhasznaló név már foglalt! '
                . '<br><strong>Próbálkozzon újra</strong></div>';
            return;

        } else {
            $sql = "INSERT INTO felhasznalo VALUES ('null', ?, ?, ?,0);";
            $result = $db->RunSQL($sql, $felhasznalo, $jelszo_hash, $email);
        }
        header('Location: login.php');
    }
}
reg();
?>
<link href="kozos/style.css" rel="stylesheet" type="text/css" media="all" />
<link href="kozos/bootstrap.min.css" rel="stylesheet" type="text/css" />
<title>Regisztráció</title>
<?php include_once("header.php"); ?>


<div class="container">
    <h1>Regisztráció</h1>
    <hr class="hre">
    <main>
        <article class="d-flex flex-wrap">
            <div class="col-6 offset-3 my-3">
                <div class="card mb-3 text-center h-100 mx-2">
                    <div class="card-body">
                        <form method="POST">
                            <div class="mb-3">
                                <label for="felhasznalo" class="form-label">Felhasználónév</label>
                                <input type="text" required class="form-control" id="felhasznalo" name="felhasznalo">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email cím</label>
                                <input type="email" required class="form-control" id="email" name="email">
                            </div>
                            <div class="mb-3">
                                <label for="jelszo" class="form-label">Jelszó</label>
                                <input type="password" minlength="6" required class="form-control" id="jelszo"
                                    name="jelszo">
                            </div>
                            <button type="submit" class="button-31" id="register" name="register">Regisztráció</button>
                            <br><br>
                            <label></label>
                    </div>
                    </form>
                </div>
            </div>
</div>

</main>
</div>

<?php
?>