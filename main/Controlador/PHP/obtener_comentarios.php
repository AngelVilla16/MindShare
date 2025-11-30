<?php
session_start();
header("Content-Type: application/json");
require "conexionclases.php";

$idPost = $_GET['idPost'] ?? null;
$currentUserId = $_SESSION['IdAlumno'] ?? null;

if ($idPost) {
    $db = new Conexion();
    $pdo = $db->getConexion();

    try {
        $sql = "SELECT c.IdComentario, c.Comentario, c.Fecha, a.Nombre, a.Apellido, a.IdAlumno 
                FROM Comentarios c 
                INNER JOIN Alumnos a ON c.IdAlumno = a.IdAlumno 
                WHERE c.IdPost = ? 
                ORDER BY c.Fecha ASC";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$idPost]);
        
        $comentarios = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $row['EsMio'] = ($row['IdAlumno'] == $currentUserId);
            $comentarios[] = $row;
        }
        
        echo json_encode($comentarios);
    } catch (PDOException $e) {
        echo json_encode(['error' => 'Error de base de datos']);
    }
} else {
    echo json_encode([]);
}
?>
