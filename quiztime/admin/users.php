<?php
session_start();
include_once '../kozos/adatbazis.php';
$db = new Database();
if (!isset($_SESSION['admin']) || $_SESSION['admin'] != 1) {
    header("Location: ../index.php");
    exit();
}
include_once("../header.php");
if (isset($_POST['change_admin_status'])) {
    $user_id = $_POST['user_id'];
    $new_admin_status = $_POST['new_admin_status'];
    $sql = "UPDATE felhasznalo SET admin = '$new_admin_status' WHERE id = $user_id";
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
    <link href="kozos/bootstrap.min.css" rel="stylesheet" type="text/css" />


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
                    <th>Admin(igen/nem)</th>
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
                                <input type="hidden" name="user_id" value="<?= $row['id'] ?>">
                                <select name="new_admin_status" class="akka">
                                    <option value="0" <?= $row['admin'] == 0 ? 'selected' : '' ?>>Nem</option>
                                    <option value="1" <?= $row['admin'] == 1 ? 'selected' : '' ?>>Igen</option>
                                </select>
                                <input type="submit" name="change_admin_status" value="Mentés" class="button-91">
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