<header>
    <div class="topnav">
        <?php if (isset($_SESSION['felhasznalo']) && $_SESSION['admin'] == 0): ?>
            <a class="active" href="/quiztime/index.php">Kezdőlap</a>
            <a href="/quiztime/toplist.php">Toplista</a>
            <a href="/quiztime/elozmenyek.php">Előzmények</a>
            <a class="btn btn-outline-light ms-3" href="logout.php" role="button">
                Kijelentkezés (
                <?= $_SESSION['felhasznalo']; ?>)
            </a>
                <?php endif; ?>
                <?php if (!isset($_SESSION['felhasznalo'])): ?>
                    <a class="active" href="index.php">Kezdőlap</a>
                    <a href="/quiztime/toplist.php">Toplista</a>
                    <a href="/quiztime/register.php">Regisztráció</a>
                    <a href="/quiztime/login.php">Bejelentkezés</a>
                <?php endif; ?>
                <?php if (isset($_SESSION['felhasznalo']) && $_SESSION['admin'] == 1): ?>
                    <a class="active" href="/quiztime/index.php">Kezdőlap</a>
                    <a href="/quiztime/toplist.php">Toplista</a>
                    <a href="/quiztime/elozmenyek.php">Előzmények</a>
                    <a href="/quiztime/admin/index.php">Admin panel</a>
                    <a class="btn btn-outline-light ms-3" href="/quiztime/logout.php" role="button">
                Kijelentkezés (
                <?= $_SESSION['felhasznalo']; ?>)
            </a>
                    <?php endif; ?>
    </div>
</header>