<?php

include "partials/header.php";
include "partials/navigation.php";
$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($con, $_POST['confirm_password']);

    if ($password !== $confirm_password) {

        $error = "Parolele nu se potrivesc!";
    } else {


        $sql = "SELECT * FROM users WHERE username='$username' LIMIT  1";
        $result = mysqli_query($con, $sql);

        if (mysqli_num_rows($result) === 1) {
            $error = "Utilizator existent! Va rugam alegeti alt username.";
        } else {

            $passwordHash = password_hash($password, algo: PASSWORD_DEFAULT);

            $sql = "INSERT INTO users (username, password, email) VALUES ('$username', '$passwordHash', '$email')";

            if (mysqli_query($con, $sql)) {
    
                $_SESSION['logged_in']= true;
                $_SESSION['username']=$username;
                header(header:"Location:admin.php");
                exit;
                
            } else {
    
                $error = "Ceva nu a mers bine. Eroare: " . mysqli_error($con);
            }
        }
        }

        //    if($result){
        //     echo "<pre>";
        //     var_dump($result);
        //     echo "</pre>";
        //    }

   
}

?>

<div class="container">


    


<div class="form-container">

    <form method="POST" action="">
    <h2>Creeaza propriul tau utilizator</h2>
    <?php if ($error): ?>
        <p style="color:red">

            <?php echo $error; ?>

        </p>

    <?php endif; ?>
        
        <label for="username">Username:</label>
        <input value="<?php echo isset($username) ? $username : ''; ?>" placeholder="Introduceti utiliatorul" type="text" name="username" required>

        <label for="email">Email:</label>
        <input value="<?php echo isset($email) ? $email : ''; ?>" placeholder="Introduceti e-mailul" type="email" name="email" required>

        <label for="password">Parola:</label>
        <input placeholder="Introduceti parola" type="password" name="password" required>

        <label for="confirm_password">Confirma parola:</label>
        <input placeholder="Confirmati parola" type="password" name="confirm_password" required>

        <input type="submit" value="Inregistrare">
    </form>
</div>
</div>

<?php
    include "partials/footer.php";

mysqli_close($con);
?>