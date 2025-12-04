async function cargarpost(q = "") {
    try {
        const url = q 
            ? `../../Controlador/PHP/post.php?q=${encodeURIComponent(q)}`
            : "../../Controlador/PHP/post.php";

        const res = await fetch(url);
        const data = await res.json();

        mostrarPost(data);
    } catch (error) {
        console.error("Error al cargar publicaciones", error);
    }
}


function mostrarPost(posts) {
    const feed = document.getElementById("publicaciones");
    feed.innerHTML = "";

    posts.forEach(p => {
        const div = document.createElement("div");
        div.classList.add("post");
        div.dataset.id = p.IdPost;

        div.innerHTML = `
            <div class="post-header">
                <img src="../src/images/usuario.png" alt="user" class="user-img">
                
                <div class="post-info">
                <h4 class="post-user"> ${p.NombreUsuario} </h4>
                 <h3 class="post-title">${p.Encabezado}</h3>
                </div>

                ${p.EsMio ? `
                    <div class="post-actions" style="margin-left: auto;">
                        <button onclick="editarPost(${p.IdPost}, '${p.Encabezado}', '${p.Cuerpo}')" class="btn-edit-post" style="background:none; border:none; cursor:pointer; color:#ffc107; font-size:1.2rem;">✎</button>
                        <button onclick="eliminarPost(${p.IdPost})" class="btn-delete-post" style="background:none; border:none; cursor:pointer; color:#dc3545; font-size:1.2rem;">x</button>
                    </div>
                ` : ''}
                
            </div>

            <p class="post-body">${p.Cuerpo}</p>
            ${p.Imagen ? `<img src="${p.Imagen}" alt="Post Image" class="post-img" style="max-width: 100%; margin-top: 10px; border-radius: 8px;">` : ''}

            <span class="fecha">${new Date(p.Fecha).toLocaleString()}</span>
            
            <div class="comments-section">
                <button onclick="toggleComments(${p.IdPost})" class="btn-toggle-comments">Comentarios</button>
                <div id="comments-${p.IdPost}" class="comments-container" style="display: none;">
                    <div class="comments-list" id="list-${p.IdPost}"></div>
                    <div class="add-comment">
                        <input type="text" id="input-${p.IdPost}" placeholder="Escribe un comentario...">
                        <button onclick="enviarComentario(${p.IdPost})">Enviar</button>
                    </div>
                </div>
            </div>
        `;

        feed.appendChild(div);
    });
}

async function toggleComments(idPost) {
    const container = document.getElementById(`comments-${idPost}`);
    if (container.style.display === "none") {
        container.style.display = "block";
        await cargarComentarios(idPost);
    } else {
        container.style.display = "none";
    }
}

async function cargarComentarios(idPost) {
    try {
        const res = await fetch(`../../Controlador/PHP/obtener_comentarios.php?idPost=${idPost}`);
        const comentarios = await res.json();
        const list = document.getElementById(`list-${idPost}`);
        list.innerHTML = "";

        comentarios.forEach(c => {
            const div = document.createElement("div");
            div.classList.add("comment");
            div.innerHTML = `
                <strong>${c.Nombre} ${c.Apellido}:</strong> ${c.Comentario}
                ${c.EsMio ? `
                    <button onclick="eliminarComentario(${c.IdComentario}, ${idPost})" class="btn-delete-comment">x</button>
                    <button onclick="editarComentario(${c.IdComentario}, ${idPost}, '${c.Comentario}')" class="btn-edit-comment">✎</button>
                ` : ''}
            `;
            list.appendChild(div);
        });
    } catch (e) {
        console.error("Error cargando comentarios", e);
    }
}

async function enviarComentario(idPost) {
    const input = document.getElementById(`input-${idPost}`);
    const comentario = input.value;

    if (!comentario) return;

    try {
        const res = await fetch("../../Controlador/PHP/agregar_comentario.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ idPost, comentario })
        });
        const data = await res.json();

        if (data.success) {
            input.value = "";
            cargarComentarios(idPost);
        } else {
            alert(data.message || "Error al comentar");
        }
    } catch (e) {
        console.error("Error enviando comentario", e);
    }
}

async function eliminarComentario(idComentario, idPost) {
    if (!confirm("¿Eliminar comentario?")) return;

    try {
        const res = await fetch("../../Controlador/PHP/eliminar_comentario.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ idComentario })
        });
        const data = await res.json();

        if (data.success) {
            cargarComentarios(idPost);
        } else {
            alert(data.message || "Error al eliminar");
        }
    } catch (e) {
        console.error("Error eliminando comentario", e);
    }
}

async function editarComentario(idComentario, idPost, textoActual) {
    const nuevoTexto = prompt("Editar comentario:", textoActual);
    if (nuevoTexto === null || nuevoTexto === textoActual) return;

    try {
        const res = await fetch("../../Controlador/PHP/editar_comentario.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ idComentario, nuevoComentario: nuevoTexto })
        });
        const data = await res.json();

        if (data.success) {
            cargarComentarios(idPost);
        } else {
            alert(data.message || "Error al editar");
        }
    } catch (e) {
        console.error("Error editando comentario", e);
    }
}

async function eliminarPost(idPost) {
    if (!confirm("¿Estás seguro de que quieres eliminar esta publicación?")) return;

    try {
        const res = await fetch("../../Controlador/PHP/eliminarpost.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ idPost })
        });
        const data = await res.json();

        if (data.success) {
            alert("Publicación eliminada");
            cargarpost(); // Reload feed
        } else {
            alert(data.message || "Error al eliminar publicación");
        }
    } catch (e) {
        console.error("Error eliminando post", e);
    }
}

async function editarPost(idPost, encabezadoActual, cuerpoActual) {
    
    const nuevoEncabezado = prompt("Editar título:", encabezadoActual);
    if (nuevoEncabezado === null) return;

    const nuevoCuerpo = prompt("Editar contenido:", cuerpoActual);
    if (nuevoCuerpo === null) return;

    if (nuevoEncabezado === encabezadoActual && nuevoCuerpo === cuerpoActual) return;

    try {
        const res = await fetch("../../Controlador/PHP/editarpost.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ idPost, encabezado: nuevoEncabezado, cuerpo: nuevoCuerpo })
        });
        const data = await res.json();

        if (data.success) {
            alert("Publicación actualizada");
            cargarpost(); // Reload feed
        } else {
            alert(data.message || "Error al actualizar publicación");
        }
    } catch (e) {
        console.error("Error editando post", e);
    }
}
const searchInput = document.querySelector(".search-input");

if (searchInput) {

    searchInput.addEventListener("input", debounce(async (e) => {
        const q = e.target.value.trim();
        await cargarpost(q);
    }, 300));

    searchInput.addEventListener("keyup", async function (e) {
        if (e.key === "Enter") {
            e.preventDefault();
            const q = searchInput.value.trim();
            await cargarpost(q);
        }
    });
}

function debounce(fn, delay) {
    let timer;
    return (...args) => {
        clearTimeout(timer);
        timer = setTimeout(() => fn(...args), delay);
    };
}


