<?php
session_start();
header("Content-Type: application/json");
require "conexionclases.php";

if (!isset($_SESSION['IdAlumno'])) {
    echo json_encode(['success' => false, 'message' => 'Usuario no autenticado']);
    exit();
}

$input = json_decode(file_get_contents('php://input'), true);

if (isset($input['idComentario'])) {
    $db = new Conexion();
    $pdo = $db->getConexion();
    
    $idComentario = $input['idComentario'];
    $idAlumno = $_SESSION['IdAlumno'];

    try {
        // Verify ownership
        $checkSql = "SELECT IdAlumno FROM Comentarios WHERE IdComentario = ?";
        $checkStmt = $pdo->prepare($checkSql);
        $checkStmt->execute([$idComentario]);
        $comment = $checkStmt->fetch(PDO::FETCH_ASSOC);

        if ($comment && $comment['IdAlumno'] == $idAlumno) {
            $sql = "DELETE FROM Comentarios WHERE IdComentario = ?";
            $stmt = $pdo->prepare($sql);
            if ($stmt->execute([$idComentario])) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Error al eliminar']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'No tienes permiso para eliminar este comentario']);
        }
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Error de base de datos']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'ID de comentario faltante']);
}
?>
