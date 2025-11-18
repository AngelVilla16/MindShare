 document.addEventListener("DOMContentLoaded", () =>{

    const pass = document.querySelector('#pass');
    const  passconfirm = document.querySelector('#passcon');
    const checkpasso = document.querySelector("#check");

    function vercontraseña(){
        if (pass.type === 'password' || passconfirm.type === 'password' ) {
            pass.type = 'text';
            passconfirm.type = 'text';

        }
        else{
              pass.type = 'password';
            passconfirm.type = 'password';
        }

       

    }

    checkpasso.addEventListener('change', vercontraseña);


 });