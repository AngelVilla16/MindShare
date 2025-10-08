<?php

include("conexion.php");

//recibir datos del formulario
$nombre = $_POST["correo_institucional"];
$password = $_POST["contraseña_usuario"];

$sql = "INSERT INTO Alumnos (Correo, Contraseña) VALUES ('$nombre', '$password') ";

if($conn->query($sql) == TRUE){
    echo" usuario registrado con exito";
    echo "<a href='index.html'> Volver </a>";
}
else{
    echo "Error " . $conn->error;
}

$conn->Close();

?>