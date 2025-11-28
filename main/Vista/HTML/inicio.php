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
        <link rel="stylesheet" href="../CSS/inicioestilo.css">
    </head>
    <body>
        <div class="contenedorprincipal">
            <nav class="navbar">
                <h2> Mindshare </h2>
                <ul class="menu">
                    <li> <a href="../HTML/mindshare.php"> Inicio </a></li>
                    <li> <a href="../HTML/carreras.php"> Carreras</a> </li>
                   </ul>
            </nav>
            <div class="mensajebienvenida">
                <h1> Bienvenido a mindshare</h1>
                <h2> Donde las ideas se unen y el aprendizaje fluye.</h2>
            </div>
            <div class="reglas">
                <h1> Reglamento </h1>
                <h4> Para fomentar la union entre la comunidad UTCJ</h4>
                <ol>
                    <li> No se aceptaran publicaciones ofensivas. </li>
                    <li> No se tolerara comportamiento inadecuado, +18 o denigracion de ningun tipo.</li>
                    <li> Se debe tener en cuenta fomentar la unión entre estudiantes.</li>
                    <li> Mantener un lenguaje adecuado.</li>
                </ol>
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