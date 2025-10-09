
//Creamos un evento mas bien añadimos un evento con una funcion al documento
document.addEventListener("DOMContentLoaded", function(){

    //Obtenemos el elemento del documento al que se le va a agregar la funcion 
const boton = document.getElementById("btnIniciarSesion");
const correo = document.getElementById("Correo");
let valor = correo.value;

let dominio = valor.split("@")[1];
//creamos un evento de click en el boton anteriormente obtenido
boton.addEventListener("click", function(){

    //mensaje de inicio de sesion.

    if(dominio == "utcj.edu.mx"){

        alert("inicio de sesion correcto");
        return;
    }
    else{
         alert("Inicio de sesión denegado");
         return;
    }

   
});

});

