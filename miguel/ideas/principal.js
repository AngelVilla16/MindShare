// principal.js

// ------------------------------------
// 1. CARGA DE POSTS (FUNCIÓN PRINCIPAL)
// ------------------------------------
function loadPostsFromAPI() {
    const feedContainer = document.querySelector('.feed-posts-container');
    feedContainer.innerHTML = 'Cargando posts...'; // Mostrar un mensaje de carga

    fetch('feed_api.php?action=load_posts')
        .then(response => response.json())
        .then(data => {
            feedContainer.innerHTML = ''; // Limpiar el mensaje de carga
            if (data.success && data.posts.length > 0) {
                data.posts.forEach(post => {
                    feedContainer.appendChild(createPostElement(post));
                });
            } else {
                feedContainer.innerHTML = '<p>Aún no hay publicaciones en este foro.</p>';
            }
        })
        .catch(error => {
            console.error('Error al cargar los posts:', error);
            feedContainer.innerHTML = '<p>Error de conexión al servidor.</p>';
        });
}

// Función que toma un objeto post y lo convierte en HTML
function createPostElement(post) {
    const postDiv = document.createElement('div');
    postDiv.className = 'post-card';
    postDiv.setAttribute('data-post-id', post.id);

    postDiv.innerHTML = `
        <div class="post-header">
            <div class="user-profile-pic"></div>
            <span class="post-username">${post.username}</span>
        </div>
        <div class="post-content">
            <p>${post.content}</p>
        </div>
        <div class="post-footer">
            <button class="btn-like" data-post-id="${post.id}">👍 Reaccionar (${post.likes})</button>
            <button class="btn-comment" data-post-id="${post.id}">💬 Comentar (${post.comments_count})</button>
            <button class="btn-share" data-post-id="${post.id}">🔗 Compartir (${post.shares_count})</button>
        </div>
    `;

    // Añadir el escuchador de eventos para el botón de Like
    const likeButton = postDiv.querySelector('.btn-like');
    likeButton.addEventListener('click', handleReaction);

    return postDiv;
}

// ------------------------------------
// 2. MANEJO DE LIKES (REACCIÓN)
// ------------------------------------
function handleReaction(event) {
    const postId = event.target.getAttribute('data-post-id');
    const button = event.target;
    
    // Evitar múltiples clics rápidos
    button.disabled = true;

    // Usar FormData para enviar datos por POST
    const formData = new FormData();
    formData.append('post_id', postId);

    fetch('feed_api.php?action=react', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Actualizar el texto del botón con el nuevo conteo
            button.textContent = `👍 Reaccionar (${data.new_likes})`;
        } else {
            alert('No se pudo registrar la reacción.');
        }
        button.disabled = false;
    })
    .catch(error => {
        console.error('Error de red:', error);
        button.disabled = false;
    });
}

// ------------------------------------
// 3. COMPARTIR/CREAR POST
// ------------------------------------
function handleCreatePost() {
    const inputElement = document.getElementById('post-input-text'); // Asegúrate de darle este ID al input
    const content = inputElement.value.trim();

    if (!content) {
        alert('Por favor, escribe algo antes de publicar.');
        return;
    }

    const formData = new FormData();
    formData.append('content', content);

    fetch('feed_api.php?action=create_post', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Post publicado con éxito!');
            inputElement.value = ''; // Limpiar el input
            loadPostsFromAPI(); // Recargar el feed para mostrar el nuevo post
        } else {
            alert('Error al publicar: ' + data.message);
        }
    })
    .catch(error => console.error('Error de red al publicar:', error));
}


// Ejecutar al cargar la página
document.addEventListener('DOMContentLoaded', () => {
    // 1. Carga inicial de posts
    loadPostsFromAPI();

    // 2. Asignar evento al botón de Compartir
    const shareButton = document.querySelector('.post-button'); // Botón 'Compartir' del área de creación
    if (shareButton) {
        shareButton.addEventListener('click', handleCreatePost);
    }
    
function loadRecomendaciones() {
    const contenedor = document.getElementById('latest-discussions-section');
    contenedor.innerHTML = '<p style="text-align: center;">Buscando las publicaciones más relevantes...</p>';

    fetch('feed_api.php?action=load_relevantes')
        .then(response => response.json())
        .then(data => {
            contenedor.innerHTML = '';
            
            if (data.success && data.posts.length > 0) {
                // Agregar un título visual si es necesario (ya lo tienes en HTML)
                
                data.posts.forEach(post => {
                    // Usamos la misma función de renderizado de post del feed
                    const postElement = createPostElement(post); 
                    contenedor.appendChild(postElement);
                });
            } else {
                contenedor.innerHTML = '<p style="text-align: center;">Aún no hay discusiones relevantes.</p>';
            }
        })
        .catch(error => {
            console.error('Error al cargar recomendaciones:', error);
            contenedor.innerHTML = '<p style="text-align: center; color: red;">Error de red al obtener las discusiones.</p>';
        });
}


document.addEventListener('DOMContentLoaded', () => {

    if (document.getElementById('latest-discussions-section')) {
        loadRecomendaciones();
    }
});
});
