
<?php
$host = "localhost";
$username = "root";
$password ="";
$database ="login_app";

$con = mysqli_connect($host , $username, $password, $database);

if(!$con){
    die("Conexiune esuata" . mysqli_connect_error());
 
}else {
    //echo "Conectat";
}

function check_query($result){
    global $con;
    if(!$result){
        return "Eroare" . mysqli_error($con);
    }
    return true;
}

function user_exist($con, $username){
    $sql = "SELECT * FROM users WHERE username='$username' LIMIT 1";
        $result = mysqli_query($con, $sql);
        return mysqli_num_rows($result)>0;

}
function create_user($con, $username, $email, $password){

    $passwordHash = password_hash($password, algo: PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, password, email) VALUES ('$username', '$passwordHash', '$email')";

    return (mysqli_query($con, $sql));

}

function update_user($con, $user_id, $new_username, $new_email){

    $sql = "UPDATE users SET email= '$new_email', username = '$new_username' WHERE id = $user_id";
return mysqli_query($con, $sql);
}

function delete_user($con, $user_id){
    $sql = "DELETE FROM users WHERE id= $user_id";
        return mysqli_query($con, $sql);
}
//mysqli_close($con);
?>
