<?php
session_start();
include_once '../kozos/adatbazis.php';
$db = new Database();
if (!isset($_SESSION['admin']) || $_SESSION['admin'] != 1) {
    header("Location: ../index.php");
    exit();
}
include_once("../header.php");

if (isset($_POST['change_password'])) {
    $user_id = $_POST['user_id'];
    $new_password = $_POST['new_password'];
    $jelszo_hash = password_hash($new_password, PASSWORD_DEFAULT);
    $sql = "UPDATE felhasznalo SET jelszo = '$jelszo_hash' WHERE id = $user_id";
    $db->RunSQL($sql);
}
    

$sql = "SELECT * FROM felhasznalo";
$result = $db->RunSQL($sql);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../kozos/elozmeny.css" rel="stylesheet" type="text/css" />

    <title>Beállítások</title>
</head>

<body>
    <div class="container">
        <?php if (mysqli_num_rows($result) > 0): ?>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Felhasználónév</th>
                    <th>E-mail cím</th>
                    <th>Admin jog</th>
                    <th></th>
                </tr>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td>
                            <?= $row["id"] ?>
                        </td>
                        <td>
                            <?= $row["felhasznalo"] ?>
                        </td>
                        <td>
                            <?= $row["email"] ?>
                        </td>
                        <td>
                        <?= $row["admin"] == 1 ? 'igen' : 'nem' ?>
                        </td>
                        <td>
                            <form method="POST" class="dsa">
                                <label for="new_password">Új jelszó:</label>
                                <input type="hidden" name="user_id" value="<?= $row['id'] ?>">
                                <input type="password" id="new_password" name="new_password" minlength="6">
                                <input type="submit" name="change_password" value="Változtatás" class="button-91">
                            </form>
                        </td>
                    </tr>
                <?php endwhile ?>
            </table>
        <?php else: ?>
            <p>Nincsenek felhasználók az adatbázisban.</p>
        <?php endif; ?>

    </div>
</body>

</html>
