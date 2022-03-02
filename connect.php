<?php 
    session_start();
      $host="localhost";
      $user="root";
      $password="";
      $db="newcnelle";
     
      
       
    $con = mysqli_connect($host,$user,$password,$db);
        if(!$con){
            die('error connecting to database');
        }
?>