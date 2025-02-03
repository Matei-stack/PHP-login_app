
<?php

$current_page = basename($_SERVER['PHP_SELF']);

?>

<nav>

    <ul>

        <li>
            <a class="<?php echo setActiveClass(pageName:'index.php'); ?>"href="index.php">Home</a>
        </li>

        <?php
        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true):
        ?>
            <li>
                <a class="<?php echo setActiveClass(pageName:'admin.php'); ?>" href="admin.php"> Admin </a>
            </li>

            <li>
                <a class="<?php echo setActiveClass(pageName:'logout.php'); ?>" href="logout.php"> Deconectare </a>
            </li>

        <?php else: ?>

            <li>
                <a class="<?php echo setActiveClass(pageName:'register.php'); ?>" href="register.php">Inregistrare</a>
            </li>

            <li>
                <a class="<?php echo setActiveClass(pageName:'login.php'); ?>" href="login.php"> Conectare </a>
            </li>

        <?php endif; ?>

    </ul>
</nav>