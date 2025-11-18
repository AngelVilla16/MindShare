<?php
session_start();

if (!isset($_SESSION["Correo"])) {
    header("Location: index.php");
    exit();
}

$nombre = $_SESSION["Nombre"];
//$apellido = $_SESSION['Apellido'];


?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Perfil</title>
    <link rel="stylesheet" href="../CSS/estiloperfil.css">
</head>
<body>
    <div class="contenedorprincipalperfil">
        <div class="perfil">

            <h4> foto de perfil </h4>
            <div class="foto">
                <img src="fotoejemplo.png" alt="foto de perfil">

            </div>
            <input type="file" id="fotoperfil" accept="image/*">
            <label for="fotoperfil"> Cambiar foto</label>

            <div class="formularioperfil">
                <label for="nombredeusuario">
                    Nombre de usuario: 
                    <?php echo htmlspecialchars($nombre);
                    ?>
                </label>
                <input type="text" id="cambiarnombre" placeholder="Nuevo nombre">
                <button type="submit "> enviar cambio </button>

            </div>

        </div>

    </div>
</body>
</html>