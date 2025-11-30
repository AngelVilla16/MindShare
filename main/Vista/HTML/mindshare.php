<?php
session_start();

if (!isset($_SESSION["Correo"])) {
    header("Location: index.php");
    exit();
}

$nombre = $_SESSION["Nombre"];
//$apellido = $_SESSION["Apellido"];


?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/estilomain.css"> 
    <link rel="stylesheet" href="../CSS/estilocomentarios.css"> 
    <script src="../JS/post.js"></script>
    <title>MindShare - Feed</title>
</head>
<body onload="cargarpost()">
  <div class="contenedorprincipal">
 <nav class="navbar">    
    <ul class="menu">
        <li class="user-options-container">
             <a href="#">
                 <img src="../src/images/navbar.png" alt="Menu" width="40" height="40">
            </a>
            
            <ul class="submenu-options">
                <li><a href="../HTML/editarperfil.html">Editar Perfil</a></li>
                <li><a href="../HTML/nuevopost.html">Crear Publicación</a></li>
                <li><a href="../../Controlador/PHP/cerrar.php">Cerrar sesión</a></li>
            </ul>
        </li>
        
        <li class="search-item"> 
            <input type="text" placeholder="buscar por palabra clave" class="search-input">
        </li>
        
        </ul>
</nav>
    <div class="main">

        <div  id="publicaciones">
            
                
                
            
        </div>

    </div>
  </div>
</body>
</html>