<?php
session_start();
header("Content-Type: application/json");
require "conexionclases.php";

$data = json_decode(file_get_contents("php://input"), true);
$idPost = $data["idPost"] ?? 0;
$idUsuario = $_SESSION["IdAlumno"] ?? 0;

if (!$idPost || !$idUsuario) {
    echo json_encode(["success" => false, "message" => "Datos inválidos"]);
    exit;
}

$db = new Conexion();
$con = $db->getConexion();

$sql = "DELETE FROM Post WHERE IdPost = :idPost AND IdAlumno = :idUsuario";
$stmt = $con->prepare($sql);
$stmt->bindParam(":idPost", $idPost, PDO::PARAM_INT);
$stmt->bindParam(":idUsuario", $idUsuario, PDO::PARAM_INT);

if ($stmt->execute()) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "message" => "Error al eliminar"]);
}
