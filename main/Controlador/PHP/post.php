<?php
session_start();
header("Content-Type: application/json");
require "conexionclases.php";

$db = new Conexion();
$con = $db->getConexion();

$idUsuario = $_SESSION['IdAlumno'] ?? 0;
$q = $_GET['q'] ?? '';
$q = trim($q);

if ($q !== '') {
    $like = "%{$q}%";
    $sql = "SELECT 
                IdPost, 
                Alumnos.NombreUsuario, 
                Encabezado, 
                Cuerpo, 
                Imagen, 
                Fecha,
                CAST(Post.IdAlumno = :idUsuario AS UNSIGNED) AS EsMio
            FROM Post
            INNER JOIN Alumnos ON Post.IdAlumno = Alumnos.IdAlumno
            WHERE Encabezado LIKE :like 
               OR Cuerpo LIKE :like 
               OR Alumnos.NombreUsuario LIKE :like
            ORDER BY Fecha DESC
            LIMIT 100";

    $stmt = $con->prepare($sql);
    $stmt->bindParam(":idUsuario", $idUsuario, PDO::PARAM_INT);
    $stmt->bindParam(":like", $like, PDO::PARAM_STR);
} else {
    $sql = "SELECT 
                IdPost, 
                Alumnos.NombreUsuario, 
                Encabezado, 
                Cuerpo, 
                Imagen, 
                Fecha,
                CAST(Post.IdAlumno = :idUsuario AS UNSIGNED) AS EsMio
            FROM Post
            INNER JOIN Alumnos ON Post.IdAlumno = Alumnos.IdAlumno
            ORDER BY Fecha DESC
            LIMIT 20";

    $stmt = $con->prepare($sql);
    $stmt->bindParam(":idUsuario", $idUsuario, PDO::PARAM_INT);
}

$stmt->execute();
$post = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($post);
