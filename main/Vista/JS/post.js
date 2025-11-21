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
            <div class="post-header">
                <img src="../src/images/usuario.png" alt="user" class="user-img">
                <h3 class="post-title">${p.Encabezado}</h3>
            </div>

            <p class="post-body">${p.Cuerpo}</p>

            <span class="fecha">${new Date(p.Fecha).toLocaleString()}</span>
        `;

        feed.appendChild(div);
    });
}
