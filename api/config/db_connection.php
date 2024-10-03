<?php
//PostgresSQl Database connection
//Developer:Jorge 

$host = "localhost";      
$user = "postgres";
$password = "unicesmag";
$dbname = "beta";
$port   = "5432";

$data_connection="
host =$host
port = $port
dbname = $dbname
user= $user
password = $password

";
$conn = pg_connect($data_connection);


    if (!$conn) {
        die("Connection failed: ". pg_last_error());
    }else{
        echo"conected successfully";
    }

/*  pg_close($conn); */
?>
