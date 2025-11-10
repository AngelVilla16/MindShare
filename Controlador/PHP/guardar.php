<?php

//Datos de conexion 



$Servidor = "localhost";
$Usuario = "root";
$Pass = "";
$Bd = "Mindshare";

$con = mysqli_connect($Servidor, $Usuario, $Pass, $Bd);


if(!$con){
    die("Erro de conexion ". mysqli_connect_error());
}

//Recibir los datos del formulario

$Nombre     = $_POST['Nombre'] ?? '';
$Apellido   = $_POST['Apellido'] ?? '';
$Correo     = $_POST['Email'] ?? '';
$Contrasena = $_POST['password'] ?? '';


//Aplican consultas 

$sql = "INSERT INTO Alumnos(Nombre, ApellidoP,Correo, Password ) VALUES('$Nombre', '$Apellido','$Correo', '$Contrasena')";

//EJecutar consulta 
if($con->query($sql)===TRUE){
    echo"Registro exitoso";
}
else {
    echo "Error al registrar: " . $con->error;
}
?>