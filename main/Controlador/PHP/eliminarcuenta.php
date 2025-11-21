<?php
session_start();
require "conexionclases.php";


if (!isset($_SESSION['Correo'])) {
    echo "<script>
            alert('No hay sesión activa.');
            window.location.href = '../../Vista/HTML/index.php';
         </script>";
    exit();
}

$Correo = $_SESSION['Correo'];

$con = new Conexion();
$pdo = $con->getConexion();


$sqlUser = "SELECT IdAlumno FROM Alumnos WHERE Correo = ?";
$stmt = $pdo->prepare($sqlUser);
$stmt->execute([$Correo]);

$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$usuario) {
    echo "<script>
            alert('El usuario no existe.');
            window.location.href = '../../Vista/HTML/editarperfil.html';
         </script>";
    exit();
}

$IdAlumno = $usuario['IdAlumno'];


$pdo->beginTransaction();

try {

   
    $sqlDeletePosts = "DELETE FROM Post WHERE IdAlumno = ?";
    $stmtPosts = $pdo->prepare($sqlDeletePosts);
    $stmtPosts->execute([$IdAlumno]);

 
    $sqlDeleteUser = "DELETE FROM Alumnos WHERE IdAlumno = ?";
    $stmtUser = $pdo->prepare($sqlDeleteUser);
    $stmtUser->execute([$IdAlumno]);


    $pdo->commit();


    session_unset();
    session_destroy();

    echo "<script>
            alert('Tu cuenta y tus publicaciones fueron eliminadas.');
            window.location.href = '../../Vista/HTML/index.php';
         </script>";
    exit();

} catch (Exception $e) {

   
    $pdo->rollBack();

    echo "<script>
            alert('Error al eliminar la cuenta: " . $e->getMessage() . "');
            window.location.href = '../../Vista/HTML/editarperfil.html';
         </script>";
    exit();
}
?>
