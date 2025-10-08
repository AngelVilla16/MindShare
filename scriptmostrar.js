document.addEventListener("DOMContentLoaded", function(){
//Obtener elementos de la contraseña
const contraseña = document.getElementById("contraseña");
const confirm = document.getElementById("contraseñaconfirm")
const confirmar_contraseña = document.getElementById("mostrarcontraseña");


//Listener de evento para el boton
confirmar_contraseña.addEventListener("click", function(){

    //Verificar el campo actual
    const type = contraseña.getAttribute("type") == "password" ? "text" : "password";
    const type2 = confirm.getAttribute("type") == "passowrd" ? "text" : "password";
    //Cambiar atributo
    contraseña.setAttribute("type", type);
    confirm.setAttribute("type", type2);


});



});