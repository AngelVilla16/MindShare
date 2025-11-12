<?php 
session_start();
//Traer la conexion con la palabra reservada include
include("conexionclases.php");
$db_conexion = new Conexion();
$pdo = $db_conexion->getConexion();
if(isset($_POST['correo']) && isset($_POST['password'])){
    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $Correo = validate($_POST['correo']);
    $Contrasena = validate($_POST['password']);
    $error_redirect = "../Vista/HTML/index.php?error="; 
    $success_redirect = "../../Vista/HTML/mindshare.html";

    if(empty($Correo)){
        header("location: " .$error_redirect. "Se requiere que ingrese su correo");
        exit();

    }elseif(empty($Contrasena)){
        header("location: " .$error_redirect. "Se requiere que ingrese su contraseña");
        exit();

    }
    else{

        //$Contrasena = password_hash($Contrasena, PASSWORD_DEFAULT);

      $stmt = $pdo->prepare("SELECT IdAlumno, Nombre, Apellido, Correo, Password FROM Alumnos WHERE Correo = ?");
        $stmt->execute([$Correo]);
        $user_data = $stmt->fetch(PDO::FETCH_ASSOC);
        if($user_data){

            $hash_almacenado = $user_data['Password']; // Hash guardado en la DB

           if(password_verify($Contrasena, $hash_almacenado)){
            $_SESSION["Correo"] = $user_data["Correo"];
            $_SESSION["Nombre"] = $user_data["Nombre"];
            $_SESSION["APellido"] = $user_data["Apellido"];
            
            
            $_SESSION["IdAlumno"] = $row["IdAlumno"]; 
            
            header("location: " . $success_redirect);
            exit();

           }
            else{
                header("location: ../Vista/HTML/index.php?error=El usuario o la contraseña son incorrectos");
                exit();
            }
         
            }
            
        }
}



?>