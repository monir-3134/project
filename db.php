<?php
   #$host="localhost";
   #$dbname="login";
   #$user="root";
   #$pass="";
try{
$pdo =new PDO("mysql:host=localhost;dbname=login;charset=utf8","root","");
     echo "1";
    } catch(PDOException $e){
      echo "0";
    }
?>
