document.addEventListener('DOMContentLoaded', () => {
    // 1. Obtener referencias
    const btnEnviar = document.getElementById('btnEnviarCambios');
    const inputNombre = document.getElementById('cambiarnombre');
    const inputFoto = document.getElementById('fotoperfil');

    btnEnviar.addEventListener('click', async () => {
        // Objeto para enviar datos, incluyendo la foto
        const formData = new FormData();
        
        // 2. Recolectar datos
        const nuevoNombre = inputNombre.value.trim();
        const nuevaFoto = inputFoto.files[0];

        // Añadir solo los datos que el usuario modificó
        if (nuevoNombre) {
            // El backend PHP esperará una variable llamada 'nombre'
            formData.append('nombre', nuevoNombre); 
        }
        if (nuevaFoto) {
            // El backend PHP esperará una variable llamada 'foto'
            formData.append('foto', nuevaFoto);
        }

        if (!nuevoNombre && !nuevaFoto) {
            alert("No hay cambios para guardar.");
            return;
        }

        // 3. Enviar a tu script PHP de backend (Ruta desde editarperfil.html)
        // ../../main/Controlador/PHP/actualizarperfil.php
        const rutaBackend = '../../main/Controlador/PHP/actualizarperfil.php'; 

        try {
            const response = await fetch(rutaBackend, { 
                method: 'POST',
                body: formData 
            });

            const data = await response.json();

            if (data.success) {
                alert('Perfil actualizado con éxito.');
                // 4. Actualizar la imagen en el frontend si se subió una nueva
                if (data.nueva_foto_url) {
                    document.querySelector('.foto img').src = data.nueva_foto_url;
                }
                // Opcional: limpiar el campo de nombre
                inputNombre.value = ''; 
            } else {
                alert('Error al actualizar: ' + data.message);
            }
        } catch (error) {
            console.error('Error de conexión o de red:', error);
            alert('Error de conexión con el servidor.');
        }
    });
});