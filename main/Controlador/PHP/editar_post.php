<?php
session_start();
header("Content-Type: application/json");
require "conexionclases.php";

if (!isset($_SESSION['IdAlumno'])) {
    echo json_encode(['success' => false, 'message' => 'Usuario no autenticado']);
    exit();
}

$input = json_decode(file_get_contents('php://input'), true);

if (isset($input['idPost']) && isset($input['encabezado']) && isset($input['cuerpo'])) {
    $db = new Conexion();
    $pdo = $db->getConexion();
    
    $idPost = $input['idPost'];
    $encabezado = htmlspecialchars(trim($input['encabezado']));
    $cuerpo = htmlspecialchars(trim($input['cuerpo']));
    $idAlumno = $_SESSION['IdAlumno'];

    try {
        // Verify ownership
        $checkSql = "SELECT IdAlumno FROM Post WHERE IdPost = ?";
        $checkStmt = $pdo->prepare($checkSql);
        $checkStmt->execute([$idPost]);
        $post = $checkStmt->fetch(PDO::FETCH_ASSOC);

        if ($post && $post['IdAlumno'] == $idAlumno) {
            $sql = "UPDATE Post SET Encabezado = ?, Cuerpo = ? WHERE IdPost = ?";
            $stmt = $pdo->prepare($sql);
            if ($stmt->execute([$encabezado, $cuerpo, $idPost])) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Error al actualizar']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'No tienes permiso para editar este post']);
        }
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Error de base de datos']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Datos incompletos']);
}
?>
