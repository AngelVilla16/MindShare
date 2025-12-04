<?php

//Datos de conexion 

include("../Controlador/PHP/conexionclases.php");



function repetir(){
   
   $db_conexion = new Conexion();
    $pdo = $db_conexion->getConexion();
    
   $correo = $_POST["Email"];
    $nombreusuario = $_POST["Usuario"];
   $stmt = $pdo->prepare("SELECT Correo, NombreUsuario FROM Alumnos WHERE Correo = ? AND NombreUsuario = ?");

   $stmt -> execute([$correo, $nombreusuario]);

   $datoobtenido = $stmt->fetch(PDO::FETCH_ASSOC) ;
   
   if($datoobtenido){

    echo "<script>
            alert('El correo o el nombre de usuario ya esta registrado');
            window.location.href = '../Vista/HTML/registro.html';
            </script>";
    exit();
   }

}

if (isset($_POST['Nombre'])) {
    $Nombre = $_POST['Nombre'] ?? '';
    $Apellido = $_POST['Apellido'] ?? '';
    $User = $_POST['Usuario'] ?? '';
    $Correo = $_POST['Email'] ?? '';
    $Contrasena = $_POST['password'] ?? '';
    $PassConfirmar = $_POST['passwordcon'] ?? '';
    

  
    if(mb_strlen($Contrasena)<8){

        echo "<script> 
            alert('Tu contraseña debe tener al menos 8 caracteres');
            window.location.href = '../Vista/HTML/registro.html';
        
        </script>";
        exit();
    }



    if($Contrasena != $PassConfirmar){
        echo "<script>
            alert('Las contraseñas no coinciden');
            window.location.href = '../Vista/HTML/registro.html';
          </script>";
        exit();
        
    }



    $contraseñaencriptada = password_hash($Contrasena, PASSWORD_DEFAULT);
    repetir();
    $sql = "INSERT INTO Alumnos(Nombre, Apellido, NombreUsuario, Correo, Password) VALUES (?,?,?,?,?)";
    $con = new Conexion();
    $pdo = $con->getConexion();
    $insertar = $pdo->prepare($sql);

    //El execute no me permite usar valores individuales

    $datos = [
        $Nombre,
        $Apellido,
        $User,
        $Correo,
        $contraseñaencriptada
    ]  ;


  if($insertar->execute($datos)){
    $idAlumno = $pdo->lastInsertId();

    // NO volver a poner session_start() aquí

    $_SESSION['Nombre'] = $Nombre;
    $_SESSION['IdAlumno'] = $idAlumno;
    $_SESSION['Apellido'] = $Apellido;
    $_SESSION['Correo'] = $Correo;
    $_SESSION['Usuario'] = $User;

    echo "<script> 
        alert('Registro exitoso');
        window.location.href = '../Vista/HTML/index.php';
    </script>";

    exit();
}
    else {
 
        echo "Error al registrar: " . $pdo->error;
    }

} else {
    
    echo "Esperando datos del formulario.";
}



?>