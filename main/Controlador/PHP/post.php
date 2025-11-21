<?php
header("Content-Type: application/json");
require "conexionclases.php";

$db = new Conexion();
$con = $db->getConexion();

$sql= "SELECT Encabezado, Cuerpo, Imagen, Fecha FROM Post ORDER BY Fecha DESC LIMIT 20";
$resultado = $con->query($sql);

$post = array();

while ($fila = $resultado->fetch(PDO::FETCH_ASSOC)) {
    $post[] = $fila;
}

echo json_encode($post);
?>