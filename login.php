<?php
include "partials/header.php";
include "partials/navigation.php";


if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true){
    header(header:"Location:admin.php");
}

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    $sql = "SELECT * FROM users WHERE username='$username' LIMIT  1";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) === 1) {
        $user = mysqli_fetch_assoc($result);

        if(password_verify($password, $user['password'])){

            $_SESSION['logged_in']= true;
            $_SESSION['username']=$user['username'];
            header(header:"Location:admin.php");
            exit;
            

        }else{

            $error =  "Parola invalida!";

        }
        
    } else {
        $error = "Utilizator neinregistrat!";
    }
}


?>
<div class="container">


  


    <div class="form-container">
    
    <form method="POST" action="">

    <h2>Conectare</h2>

    <?php if ($error): ?>
        <p style="color:red">

            <?php echo $error; ?>

        </p>

    <?php endif; ?>

        <label for="username">Username:</label><br>
        <input type="text" name="username" required><br>

        <label for="password">Parola:</label><br>
        <input type="password" name="password" required><br><br><br>



        <input type="submit" value="Conectare">
    </form>
</div>
</div>
<?php
include "partials/footer.php";
mysqli_close($con);
?>