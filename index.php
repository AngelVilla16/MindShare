<!DOCTYPE html>
<html lang="es">
    <head>
        
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>
            Iniciar sesión
        </title>
        <link href="EstiloLogin.css" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="Icono.png" type="image/x-icon">
        
    </head>
       <script src="scriptmostrar.js"></script>
    <script src="scriptlogin.js"></script>
    <body>
        
            <div class="contenedorprincipal">

                <div class=contenedor-formulario>
                    <img class="logo" src="LogoSinFondo.png" alt="MinShare logo" width="200" height="150"> 
                    <h1 class="titulo">
                        Bienvenido a MindShare!
                    </h1>
                    <p class="texto">
                        Inicia sesión con tu correo institucional
                    </p>
                   <p>
                     <label for="Usuario"> Correo:</label>
                    <input type="text" id="Correo" name="correo_institucional" placeholder="almatricula@utcj.edu.mx" required>
                   </p>
                   <p>
                   
                    <label for="Contraseña"> Contraseña: </label>
                    <input type="password" id="Contraseña" name="contraseña_usuario" placeholder="******" required>
                   </p>
                    <script>
                    document.addEventListener("DOMContentLoaded", function(){

                        const password = document.getElementById("Contraseña");
                        const mostrar = document.getElementById("btnMostrarContraseña");

                        mostrar.addEventListener("click", function(){

                        const tipo = password.getAttribute("type") == "password" ? "text" : "password";

                        password.setAttribute("type", tipo);

                        });

                        });
                    </script>
                   <p>
                    <button type="button" class="MostrarContraseña" id="btnMostrarContraseña"> Mostrar contraseña</button>
                   </p> 
                   <p>
                    <button type="submit" class="btnIniciarSesion" id="btnIniciarSesion" > Iniciar sesión  </button>
                   </p>

                   <p class="enlace">

                    ¿No esta registrado aun? Puede registrarse <a class="link" href="signin.html"> aqui </a>

                   </p>

                </div>
              <div class="contenedorfondo">
                  <div class="contenedorinfo">
                     <h1 class="tituloinfo">
                    Bienvenido a MindShare
                </h1>
                <p class="textoinfo">
                  MindShare es una red social diseñada especialmente para los estudiantes universitarios de la UTCJ, creada con el propósito de fortalecer la comunicación, la unión y la interacción dentro de la comunidad estudiantil.
                </p>
                <p class="textoinfo">
                    Nuestro objetivo es ofrecer un espacio seguro y colaborativo donde los alumnos puedan compartir experiencias, conocimientos, consejos y recursos académicos que contribuyan a su desarrollo personal y profesional.
                </p>
                <p class="textoinfo">
                      En MindShare fomentamos el apoyo mutuo entre compañeros, promoviendo un entorno positivo que ayude a reducir el estrés académico, fortalecer la empatía y construir redes de amistad y cooperación.
                </p>



             
                </div>

              </div>
            </div>
                
                  
     

    </body>




</html>