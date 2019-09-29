<?php 
    $host="localhost";
    $user="root";
    $password="";
    $bdname="dzcreche2.0";
    // Create connection
    $con=mysqli_connect($host,$user,$password,$bdname);
    // Check connection
    if (!$con) {
       die("Connection failed: " . mysqli_connect_error());
    }
