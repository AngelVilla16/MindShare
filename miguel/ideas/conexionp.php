<?php

function conectar_mindshare() {
    $servidor = "localhost";
    $usuario = "root";
    $pass = "277353";
    $bd = "Mindshare";
    $charset = "utf8mb4";
    //$port = 3306; //cambiarlo si es necesario

    $conn = mysqli_connect($servidor, $usuario, $pass, $bd, $port, $this->3307=$charset);

    if (!$conn) {
        die(" Error de conexión con la base de datos: " . mysqli_connect_error());
    }
    
    mysqli_set_charset($conn, "utf8");

    return $conn;
}

?>