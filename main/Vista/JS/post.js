async function cargarpost(){
    try{
        const respuesta = await fetch("../../Controlador/PHP/post.php");
        const posts = await respuesta.json();

        mostrarPost(posts)
    }
    catch(error){
        console.error("Error al cargar publicaciones ", error);

    }
}

function mostrarPost(posts) {
    const feed = document.getElementById("publicaciones");
    feed.innerHTML = "";

    posts.forEach(p => {
        const div = document.createElement("div");
        div.classList.add("post");

        div.innerHTML = `
    <h3>${p.Encabezado}</h3>
    <p>${p.Cuerpo}</p>
    <span class="fecha">${new Date(p.Fecha).toLocaleString()}</span>
`;


        feed.appendChild(div);
    });
}