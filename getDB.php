<?php
    
$servername = "localhost";
$ausername = "xingyang";
$apassword = "password";
$conn = new PDO("mysql:host=$servername;dbname=contacts", $ausername, $apassword);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//echo "Successful!";

 ?>