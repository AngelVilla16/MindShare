
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
    

    $stmt = $pdo->prepare("SELECT IdAlumno, Nombre, Apellido, Correo, Password FROM Alumnos WHERE Correo = ?");
        $stmt->execute([$Correo]);
        $user_data = $stmt->fetch(PDO::FETCH_ASSOC);
        if(!$user_data){
             echo "<script>
                        alert('Usuario no existente ');
                        window.location.href='../../Vista/HTML/index.php';
                        </script>";
                exit();
        }
        if($user_data){

            $hash_almacenado = $user_data['Password']; // Hash guardado en la DB

           if(password_verify($Contrasena, $hash_almacenado)){
            $_SESSION["Correo"] = $user_data["Correo"];
            $_SESSION["Nombre"] = $user_data["Nombre"];
            $_SESSION["APellido"] = $user_data["Apellido"];
            
            
            $_SESSION["IdAlumno"] = $row["IdAlumno"]; 
            
            header("location: ../../Vista/HTML/mindshare.php" );
            exit();

           }
            else{
                echo "<script>
                        alert('Usuario y/o contraseña incorrectos');
                        window.location.href='../../Vista/HTML/index.php';
                        </script>";
                exit();
            }
         
            }

    
}



?>
