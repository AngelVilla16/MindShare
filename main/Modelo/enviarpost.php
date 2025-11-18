<?php 
session_start();
$_SESSION['Correo'];
include ("conexionclases.php");

$db_conexion = new Conexion();
$pdo = $db_conexion->getConexion();

if(isset($_POST['encabezado']) && isset($_POST['cuerpo'])){
    function validar($datos){
        $datos = trim($datos);
        $datos = stripslashes($datos);
        $datos = htmlspecialchars($datos);
        return $datos;
    }
}


$correo = $_SESSION['correo'];

$stmt = $pdo->prepare("SELECT IdAlumno FROM Alumnos WHERE Correo = ? ");
$stmt -> execute($correo);
$idarray = $stmt->fetch(PDO::FETCH_ASSOC);
$idobtenido = $idarray['IdAlumno'];

if(isset($_POST['encabezado']) && isset($_POST['cuerpo'])){

    $encabezado = $_POST['encabezado'];
    $cuerpo = $_POST['cuerpo'];

    $sql = "INSERT INTO Post(Encabezado, Cuerpo, IdAlumno) VALUES ($encabezado, $cuerpo, $idobtenido)";
    $stmtinsertar =  $pdo->prepare($sql);

    if($stmtinsertar->execute($encabezado, $cuerpo, $idobtenido)){

         echo "<script> alert('post subido exitosamente');
        window.location.href = 'nuevopost.html';
         </script>";
         exit();
        
    }
}



?>