<?php
session_start();
header("Content-Type: application/json");
require "conexionclases.php";

if (!isset($_SESSION['IdAlumno'])) {
    echo json_encode(['success' => false, 'message' => 'Usuario no autenticado']);
    exit();
}

$input = json_decode(file_get_contents('php://input'), true);

if (isset($input['idPost']) && isset($input['comentario'])) {
    $db = new Conexion();
    $pdo = $db->getConexion();
    
    $idPost = $input['idPost'];
    $comentario = htmlspecialchars(trim($input['comentario']));
    $idAlumno = $_SESSION['IdAlumno'];
    
    if (empty($comentario)) {
        echo json_encode(['success' => false, 'message' => 'El comentario no puede estar vacío']);
        exit();
    }

    try {
        $sql = "INSERT INTO Comentarios (IdPost, IdAlumno, Comentario) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute([$idPost, $idAlumno, $comentario])) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al guardar el comentario']);
        }
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Error de base de datos: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Datos incompletos']);
}
?>
