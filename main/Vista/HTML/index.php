


<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mindshare</title>
 <link rel="stylesheet" href="../CSS/login.css">
 <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>


</head>
<body>
  <div class="captcha-container"
     data-sitekey="0x4AAAAAACA2cfWM9xMG9_JL"
    data-callback="captchaValidado">
</div>
  <div class="contenedor">
    <div class="izquierda">
      <div class="logo">
        <img src="../src/images/Logo.png" width="200" height="200" alt="Logo Mindshare">
      </div>
      <h2>Donde las ideas se unen y el aprendizaje fluye.</h2>
    </div>

    <div class="derecha">
      <div class="login">
        <h2>Iniciar sesión</h2>
        <form action="../../Controlador/PHP/iniciar.php" method="POST">
          <div class="cf-turnstile" 
           
          </div>
        
    
          <hr>
          <?php
            if(isset($_GET["Error"])){
          ?>
            <p class="Error">
              <?php
              echo htmlspecialchars($_GET["Error"]); 
              ?>
            </p>
          <?php 
            }
          ?>
          <div class="input-group">
            <label for="correo">Correo institucional</label>
            <input type="email" name="correo" id="correo" placeholder="al0000000@utcj.edu.mx" required>
          </div>

          <div class="input-group">
            <label for="password">Contraseña</label>
            <input type="password" name="password" id="password" placeholder="Ingresa tu contraseña" required>
          </div>
      


          <button type="submit">Iniciar sesión</button>

          <p>¿No está registrado? <a href="../HTML/registro.html">Regístrate aquí</a></p>
        </form>
      </div>
    </div>

 


</body>
</html>