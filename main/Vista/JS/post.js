async function cargarpost() {
    try {
        const respuesta = await fetch("../../Controlador/PHP/post.php");
        const posts = await respuesta.json();

        mostrarPost(posts)
    }
    catch (error) {
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
                
                <div class="post-info">
                <h4 class="post-user"> ${p.NombreUsuario} </h4>
                 <h3 class="post-title">${p.Encabezado}</h3>
                </div>
                
            </div>

            <p class="post-body">${p.Cuerpo}</p>
            ${p.Imagen ? `<img src="${p.Imagen}" alt="Post Image" class="post-img" style="max-width: 100%; margin-top: 10px; border-radius: 8px;">` : ''}

            <span class="fecha">${new Date(p.Fecha).toLocaleString()}</span>
        `;

        feed.appendChild(div);
    });
}
