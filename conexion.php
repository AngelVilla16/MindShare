<?php



$host = "localhost";
$port = 3306;
$usuario ="root";
$pass = "277353";
$bd = "ForoU";

$conn = new mysqli($host, $usuario, $pass, $bd, $port);

if($conn->connect_error){
    die("Error de conexion " . $conn->connect_error);
}

echo "Conexion establecida";

?>