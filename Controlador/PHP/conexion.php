<?php
//Comentario en linea
//Conexion por conector
//Servidor usuario, password, bd

$servidor = "localhost";

$usuario="root";

$pass="";

$bd="Mindshare";

$conn= mysqli_connect($servidor, $usuario, $pass, $bd);

if(!$conn){
die("Error de conexion: ".mysqli_connect_error());
}
echo("conexion a la base de datos exitosa");
mysqli_Close($conn);

?>