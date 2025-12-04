<?php
session_start();
header("Content-Type: application/json");
require "conexionclases.php";

$data = json_decode(file_get_contents("php://input"), true);

$idPost = $data["idPost"] ?? 0;
$encabezado = $data["encabezado"] ?? "";
$cuerpo = $data["cuerpo"] ?? "";
$idUsuario = $_SESSION["IdAlumno"] ?? 0;

if (!$idPost || !$idUsuario || !$encabezado) {
    echo json_encode(["success" => false, "message" => "Datos inválidos"]);
    exit;
}

$db = new Conexion();
$con = $db->getConexion();

$sql = "UPDATE Post 
        SET Encabezado = :encabezado, Cuerpo = :cuerpo
        WHERE IdPost = :idPost AND IdAlumno = :idUsuario";

$stmt = $con->prepare($sql);
$stmt->bindParam(":encabezado", $encabezado);
$stmt->bindParam(":cuerpo", $cuerpo);
$stmt->bindParam(":idPost", $idPost, PDO::PARAM_INT);
$stmt->bindParam(":idUsuario", $idUsuario, PDO::PARAM_INT);

if ($stmt->execute()) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "message" => "Error al editar"]);
}
