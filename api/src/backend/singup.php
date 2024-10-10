<?php

require('../../config/db_connection.php');

//GET data from 

$email = $_POST['email'];
$pass =  $_POST['passwd'];
$enc_pass = md5($pass);

//validate if email already exist
$query ="SELECT * from users where email='$email'";

$result = pg_query($conn, $query);
$row =pg_fetch_assoc($result);
if ($row) {
    echo"<script>alert('Email already exist')</script>";
    header('refresh:0; url=http://127.0.0.1/beta//api/src/register_form.html'); 
    exit();	
} 
$query = "INSERT INTO users (email,password)
 VALUES ('$email', '$enc_pass')";

$result= pg_query($conn, $query);

if ($result) {
    echo"<script>alert('Registration successful!')</script>";
    header('refresh:0; url=http://127.0.0.1/beta//api/src/login_form.html');     
} else {echo"Registration failed!";}

pg_close($conn);


//echo "Email: " . $email;
//echo " <br>Password: " . $pass;
//echo "<br>Enc. Password:" .  $enc_pass;

?>