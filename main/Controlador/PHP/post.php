<?php
session_start();
$usuario = $_SESSION['Usuario'] ?? '';
header("Content-Type: application/json");
require "conexionclases.php";

$db = new Conexion();
$con = $db->getConexion();

$sql= "SELECT IdPost, Alumnos.NombreUsuario, Encabezado, Cuerpo, Imagen, Fecha 
       FROM Post 
       INNER JOIN Alumnos ON Post.IdAlumno = Alumnos.IdAlumno 
       ORDER BY Fecha DESC LIMIT 20";

$resultado = $con->query($sql);

$post = array();
while ($fila = $resultado->fetch(PDO::FETCH_ASSOC)) {
    $post[] = $fila;
}

echo json_encode($post);
?>
