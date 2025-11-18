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
include("../Controlador/PHP/conexionclases.php");
function repetir(){
   
   $db_conexion = new Conexion();
    $pdo = $db_conexion->getConexion();
   $correo = $_POST["Email"];

   $stmt = $pdo->prepare("SELECT Correo FROM Alumnos WHERE Correo = ?");

   $stmt -> execute([$correo]);

   $datoobtenido = $stmt->fetch(PDO::FETCH_ASSOC) ;
   
   if($datoobtenido){

    echo "<script>
            alert('El usuario ya esta registrado');
            window.location.href = '../Vista/HTML/registro.html';
            </script>";
    exit();
   }

}

if (isset($_POST['Nombre'])) {

  
    $Nombre     = mysqli_real_escape_string($con, $_POST['Nombre'] ?? '');
    $Apellido   = mysqli_real_escape_string($con, $_POST['Apellido'] ?? '');
    $Correo     = mysqli_real_escape_string($con, $_POST['Email'] ?? '');
    $Contrasena = mysqli_real_escape_string($con, $_POST['password'] ?? '');
    $PassConfirmar = mysqli_real_escape_string($con, $_POST['passwordcon'] ?? '');



    if($Contrasena != $PassConfirmar){
        echo "<script>
            alert('Las contraseñas no coinciden');
            window.location.href = 'registro.html';
          </script>";
        exit();
        
    }



    $contraseñaencriptada = password_hash($Contrasena, PASSWORD_DEFAULT);
    repetir();
    $sql = "INSERT INTO Alumnos(Nombre, Apellido, Correo, Password) 
            VALUES('$Nombre', '$Apellido', '$Correo', '$contraseñaencriptada')";


    if($con->query($sql) === TRUE){
        echo "<script> alert('Registro exitoso');
        window.location.href = 'index.php';
         </script>";
         exit();

         session_start();
        $_SESSION['Nombre'] = $Nombre;
        $_SESSION['Apellido'] = $Apellido;
        $_SESSION['Correo'] = $Correo;

    }
    else {
 
        echo "Error al registrar: " . $con->error;
    }

} else {
    
    echo "Esperando datos del formulario.";
}


$con->close();
?>