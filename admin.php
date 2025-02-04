<?php 
include "partials/header.php";
include "partials/navigation.php";

if(!isUser_logged_in()){
    redirect(location: "login.php");
}

$result=mysqli_query($con, query:"SELECT id, username, email, reg_date FROM users");
//var_dump($result);
if($_SERVER['REQUEST_METHOD']==="POST"){
    if(isset($_POST['edit_user'])){
        $user_id = mysqli_real_escape_string($con,$_POST['user_id']);
        $new_username = mysqli_real_escape_string($con, $_POST['username']);
        $new_email = mysqli_real_escape_string($con, $_POST['email']);

       
        $query_status = check_query(update_user($con, $user_id, $new_username, $new_email));

        if($query_status === true){
            $_SESSION['message'] = "Utilizator editat cu succes in {$new_username}";
            $_SESSION['msg_type'] = "success";
            redirect(location:'admin.php');
        }
     
    }elseif(isset($_POST['delete_user'])){
        $user_id = mysqli_real_escape_string($con,$_POST['user_id']);
        $query_status = check_query( delete_user($con, $user_id));

        if($query_status === true){
            $_SESSION['message'] = "Utilizatorul {$user_id} a fost sters cu succes";
            $_SESSION['msg_type'] = "success";
            redirect(location:'admin.php');
        }
    }
}

?>



<h1>Manage Users</h1>



<div class="container">

    <?php if(isset($_SESSION['message'])):  ?>
            <div class="notification <?php echo $_SESSION['msg_type']?>">

            <?php 
            
                echo $_SESSION['message'];
                unset( $_SESSION['message']);
                unset($_SESSION['msg_type']);
            ?>

            </div>
    
   
    <?php endif; ?>

    <table class="user-table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Registration Date</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>

            <?php 
            
                while ($user = mysqli_fetch_assoc($result)): 
            
            ?>

        <tr>
            <td><?php echo $user['id'] ?></td>
            <td><?php echo $user['username'] ?></td>
            <td><?php echo $user['email'] ?></td>
            <td><?php echo full_month_date($user['reg_date']); ?></td>
            <td>
                <form method="POST" style="display:inline-block;">
                    <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                    <input type="text" name="username" value="<?php echo $user['username']; ?>" required>
                    <input type="email" name="email" value="<?php echo $user['email']; ?>" required>
                    <button class="edit" type="submit" name="edit_user">Editare</button>
                </form>
                <form method="POST" style="display:inline-block;" onsubmit="return confirm('Esti sigur ca vrei sa stergi acest utilizator?');">
                    <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                    <button class="delete" type="submit" name="delete_user">Sterge</button>
                </form>
            </td>
        </tr>
    
        <?php endwhile; ?>


        <!-- Additional user rows can go here -->
        </tbody>
    </table>
</div>

<!-- Include Footer -->
<?php include "partials/footer.php"?>
