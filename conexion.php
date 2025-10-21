<?php
    $servername = "localhost";
    $username = "root";
    $pass = "";
    $dbname = "senasoft";

    $con = new mysqli($servername, $username, $pass, $dbname);

    if ($con -> connect_error){
        die ("conexion fallida" . $con->connect_error);
    }else{
        echo("conexion exitosaA");
    }

?>