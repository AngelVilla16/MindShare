async function toggleComments(idPost) {
    const cont = document.getElementById(`comments-${idPost}`);

    if (cont.style.display === "none") {
        cont.style.display = "block";
        cargarComentarios(idPost);
    } else {
        cont.style.display = "none";
    }
}

async function cargarComentarios(idPost) {
    const res = await fetch(`../../Controlador/PHP/obtener_comentarios.php?idPost=${idPost}`);
    const comentarios = await res.json();

    const list = document.getElementById(`list-${idPost}`);
    list.innerHTML = "";

    comentarios.forEach(c => {
        list.innerHTML += `
            <div class="comment">
                <strong>${c.Nombre} ${c.Apellido}</strong>: ${c.Comentario}
            </div>
        `;
    });
}
