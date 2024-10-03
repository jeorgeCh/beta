<?php

require('../../config/db_connection.php');

//GET data from 

$email = $_POST['email'];
$pass =  $_POST['passwd'];
$enc_pass = md5($pass);
$query = "INSERT INTO users (email,password) VALUES ('$email', '$enc_pass')";

$result = pg_query($conn, $query);
if ($result) {
    echo"Registration succesful!";
} else {echo"Registration failed!";}

pg_close($conn);


//echo "Email: " . $email;
//echo " <br>Password: " . $pass;
//echo "<br>Enc. Password:" .  $enc_pass;

?>