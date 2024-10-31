<?php

    function save_data_supabase($email, $passwd){
        //Sapabasedatabase configuration
        $SUPABASE_URL = 'https://lisjhztpnosyihnaivef.supabase.co';
        $SUPABASE_KEY = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6Imxpc2poenRwbm9zeWlobmFpdmVmIiwicm9sZSI6ImFub24iLCJpYXQiOjE3MzAzODg2ODUsImV4cCI6MjA0NTk2NDY4NX0.btS7ZgcF3xdtn9vXx9I1AkxKc9-84DqkMJXCQpEfmBc';
        
        $url = "$SUPABASE_URL/rest/v1/users";


    $data = [
    'email' => $email,
    'password' => $passwd,
    ];      


    $options = [
    'http' => [
    'header' => [
    "Content-Type: application/json",
    "Authorization: Bearer $SUPABASE_KEY",
    "apikey: $SUPABASE_KEY"
    ],
    'method' => 'POST',
    'content' => json_encode($data),
    ]
    ];

    $context = stream_context_create($options);
    $response = file_get_contents($url, false, $context);

    if ($response === false) {
    echo "Error: unable to save data to Supabase";
    exit;
    } else {
    $responseData = json_decode($response, true);
    echo "User has been created: " . json_encode($responseData);
    }
    }
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
        save_data_supabase($email, $enc_pass);
        echo"<script>alert('Registration successful!')</script>";
        header('refresh:0; url=http://127.0.0.1/beta//api/src/login_form.html');     
    } else {echo"Registration failed!";}

    pg_close($conn);


    //echo "Email: " . $email;
    //echo " <br>Password: " . $pass;
    //echo "<br>Enc. Password:" .  $enc_pass;

?>