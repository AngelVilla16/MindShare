<?php
session_start();

if (!isset($_SESSION["Correo"])) {
    header("Location: index.php");
    exit();
}

$nombre = $_SESSION["Nombre"];
$apellido = $_SESSION["Apellido"];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/estilomain.css"> 
    <script src="../JS/post.js"></script>
    <title>MindShare - Feed</title>
</head>
<body onload="cargarpost()">
 <div class="contenedorprincipal">

     <nav class="navbar"> 	
         <ul class="menu">
             <li><a href="mindshare.php" class="logo-container"> MindShare <img src="../src/images/Logo.png" alt="Logo" width="30px" height="30px"></a></li>
             
             <li class="search-item"> 
                 <input type="text" placeholder="Buscar por palabra clave" class="search-input">
             </li>
             
             <li class="user-options-container">
                 <a href="#">
                      <img src="../src/images/navbar.png" alt="Menu" width="40" height="40">
                 </a>
                 
                 <ul class="submenu-options">
                     <li><a href="../HTML/editarperfil.html">Editar Perfil</a></li>
                     <li><a href="../HTML/nuevopost.html">Crear Publicación</a></li>
                     <li><a href="../../Controlador/PHP/cerrar.php">Cerrar sesión</a></li>
                     <li><a href="../HTML/carreras.php">Carreras</a>
                 </ul>
             </li>
         </ul>
     </nav>

     <div class="main">
         <div class="mensajebienvenida">
             <h1>¡Bienvenido, 
             <?php
             
             echo $nombre;
             ?>!
             </h1>
             <h2>Mira lo que tu comunidad ha compartido hoy.</h2>
         </div>

         <div id="publicaciones">
            </div>
     </div>
    
 </div>
  <footer class="footer">
            <p>&copy; 2025 Mindshare UTCJ. Todos los derechos reservados.</p>
            <div class="enlaces-footer">
                <a href="../src/docs/Reglamento de conducta Mindshare.pdf">Reglamento</a>
                <a href="#">Contacto: astrosoft06@gmail.com</a>
            </div>
        </footer>
</body>
</html>