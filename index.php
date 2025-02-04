<?php

include "partials/header.php";
include "partials/navigation.php";

?>
<div class="container">

<div class="hero">

<div class="hero-content">

<h1> Bun venit pe prima pagina a aplicatiei</h1>
<p>Conectati-va in siguranta</p>
<div class="hero-buttons">
    <?php if(!isUser_logged_in()): ?>

    <a class="btn" href="login.php">Conectare </a>
    <a class="btn" href="register.php">Inregistrare </a>

    <?php endif; ?>

</div>

</div>

</div>
</div>

<?php include "partials/footer.php"; ?>