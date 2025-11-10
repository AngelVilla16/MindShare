<?php
//Primero creamos variables para atraer cada valor necesario

$servidor="localhost";
$bd="Mindshare";
$usuario="root";
$pass="";

try{
    //Crear conexion pdo
    $pdo= new PDO("mysql:host=$servidor;dbname=$bd;charset=utf8", $usuario, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "conexion exitosa";
}
catch (PDOException $ex){
    echo "Error de conexion ". $ex->getMessage();


}

?>