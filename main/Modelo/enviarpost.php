<?php 
session_start();
$_SESSION['Correo'];
include ("../Controlador/PHP/conexionclases.php");

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


$correo = $_SESSION['Correo'];

$stmt = $pdo->prepare("SELECT IdAlumno FROM Alumnos WHERE Correo = ? ");
$stmt -> execute([$correo]);
$idarray = $stmt->fetch(PDO::FETCH_ASSOC);
$idobtenido = $idarray['IdAlumno'];

if(isset($_POST['encabezado']) && isset($_POST['cuerpo'])){

    $encabezado = $_POST['encabezado'];
    $cuerpo = $_POST['cuerpo'];
    $fecha = date('Y-m-d H:i:s');
    
    $imagen = null;
    if(isset($_FILES['archivo']) && $_FILES['archivo']['error'] == 0){
        $nombre_archivo = uniqid() . "_" . basename($_FILES['archivo']['name']);
        $ruta_fisica = "../Vista/src/images/posts/" . $nombre_archivo;
        $ruta_db = "../src/images/posts/" . $nombre_archivo;
        
        if(move_uploaded_file($_FILES['archivo']['tmp_name'], $ruta_fisica)){
            $imagen = $ruta_db;
        }
    }

    $sql = "INSERT INTO Post(Encabezado, Cuerpo, IdAlumno, Fecha, Imagen) VALUES (?, ?, ?, ?, ?)";
    $stmtinsertar =  $pdo->prepare($sql);

    if ($stmtinsertar->execute([$encabezado, $cuerpo, $idobtenido, $fecha, $imagen])) {

        echo "<script>
            alert('Post subido exitosamente');
            window.location.href = '../Vista/HTML/nuevopost.html';
        </script>";
        exit();
    }
}
?>
