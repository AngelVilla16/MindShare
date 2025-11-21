<?php
session_start();

include("../Controlador/PHP/conexionclases.php");

function verificar($NuevoUsuario, $Correo){
    $con = new Conexion();
    $pdo = $con->getConexion();

    // 👇 Esta consulta excluye al usuario actual
    $sql = "SELECT NombreUsuario FROM Alumnos WHERE NombreUsuario = ? AND Correo != ?";
    $consultar = $pdo->prepare($sql);
    $consultar->execute([$NuevoUsuario, $Correo]);

    $resultado = $consultar->fetch(PDO::FETCH_ASSOC);

    if($resultado){
        echo "<script>
        alert('El nombre de usuario ya está en uso, ingrese otro');
        window.location.href = '../Vista/HTML/editarperfil.html';
        </script>";
        exit();
    }
}

if(isset($_POST['NuevoUsuario'])){
    $NuevoUsuario = $_POST['NuevoUsuario'];
    $Correo = $_SESSION['Correo'];

    // Verificar si ya existe (excluyendo al usuario actual)
    verificar($NuevoUsuario, $Correo);

    $con = new Conexion();
    $pdo = $con->getConexion();

    $sql = "UPDATE Alumnos SET NombreUsuario = ? WHERE Correo = ?";
    $actualizar = $pdo->prepare($sql);
    $actualizar->execute([$NuevoUsuario, $Correo]);

    echo "<script>
    alert('El nombre de usuario ha sido actualizado');
    window.location.href = '../Vista/HTML/editarperfil.html';
    </script>";
    exit();
}
?>
