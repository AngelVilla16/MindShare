
//Creamos un evento mas bien añadimos un evento con una funcion al documento
document.addEventListener("DOMContentLoaded", function(){


    const boton = document.getElementById("btnIniciarSesion");
    const inputCorreo = document.getElementById("Correo");
    const inputPassword = document.getElementById("Contraseña");


   
    boton.addEventListener("click", function(){



        const correo = inputCorreo.value.trim();
        const password = inputPassword.value.trim();
        const subcorreo = correo.slice(10,21);
        const valor = "@utcj.edu.mx";
        

       
        if (correo === "" || password === "") {
            alert("Por favor, llene todos los campos");
            return; // Detiene la ejecución si hay campos vacíos
        }

      
      

    });
});
