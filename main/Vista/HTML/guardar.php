<?php

//Datos de conexion 



$Servidor = "localhost";
$Usuario = "root";
$Pass = "277353";
$Bd = "Mindshare";


$con = mysqli_connect($Servidor, $Usuario, $Pass, $Bd);

if(!$con){
    die("Error de conexion: ". mysqli_connect_error());
}


if (isset($_POST['Nombre'])) {

  
    $Nombre     = mysqli_real_escape_string($con, $_POST['Nombre'] ?? '');
    $Apellido   = mysqli_real_escape_string($con, $_POST['Apellido'] ?? '');
    $Correo     = mysqli_real_escape_string($con, $_POST['Email'] ?? '');
    $Contrasena = mysqli_real_escape_string($con, $_POST['password'] ?? '');
    $PassConfirmar = mysqli_real_escape_string($con, $_POST['passwordcon'] ?? '');

    if($Contrasena != $PassConfirmar){
        print("Contraseñas diferentes");
    }

    $contraseñaencriptada = password_hash($Contrasena, PASSWORD_DEFAULT);
    $sql = "INSERT INTO Alumnos(Nombre, Apellido, Correo, Password) 
            VALUES('$Nombre', '$Apellido', '$Correo', '$contraseñaencriptada')";


    if($con->query($sql) === TRUE){
        echo "Registro exitoso";
    }
    else {
 
        echo "Error al registrar: " . $con->error;
    }

} else {
    
    echo "Esperando datos del formulario.";
}


$con->close();
?>