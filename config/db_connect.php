<?php
    $server_name="localhost";
    $username="shaun";
    $password="test1234";
    $database_name="ninja_pizza";

    $conn=mysqli_connect($server_name,$username,$password,$database_name);
    //now check the connection
    if(!$conn)
    {
        echo "Connection Failed:" . mysqli_connect_error();
    }
?>