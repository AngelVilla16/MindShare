<?php


$servidor = "localhost";

$usuario="root";

$pass="contraseña;

$bd="mindshare";

$conn= mysqli_connect($servidor, $usuario, $pass, $bd);

if(!$conn){
die("Error de conexion: ".mysqli_connect_error());
}

mysqli_Close($conn);

?>
