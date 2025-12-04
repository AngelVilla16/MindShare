<?php
session_start();
header("Content-Type: application/json");
require "conexionclases.php";

if (!isset($_SESSION['IdAlumno'])) {
    echo json_encode(['success' => false, 'message' => 'Usuario no autenticado']);
    exit();
}

$data = json_decode(file_get_contents("php://input"), true);

$idPost = $data['idPost'];
$comentario = trim($data['comentario']);
$idAlumno = $_SESSION['IdAlumno'];

if ($comentario == "") {
    echo json_encode(['success' => false, 'message' => 'Comentario vacío']);
    exit();
}

$db = new Conexion();
$pdo = $db->getConexion();

$sql = "INSERT INTO Comentarios (IdPost, IdAlumno, Comentario) VALUES (?, ?, ?)";
$stmt = $pdo->prepare($sql);
$stmt->execute([$idPost, $idAlumno, $comentario]);

echo json_encode(['success' => true]);
