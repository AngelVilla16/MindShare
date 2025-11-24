<?php
// Asegúrate de que tu archivo de conexión esté en el mismo directorio o ajusta la ruta.
include 'conexionp.php';

// Establecer la cabecera para que el navegador sepa que la respuesta es JSON
header('Content-Type: application/json');

// Función para obtener la conexión a la base de datos
function getConnection() {
    $conn = conectar_mindshare(); // Asumiendo que esta función está en conexionp.php
    return $conn;
}

// Determinar qué acción se está solicitando (CRUD: Crear, Leer, Actualizar, Borrar)
$action = $_GET['action'] ?? '';

// ------------------------------------
// 1. LECTURA DE POSTS (Cargar Feed)
// ------------------------------------
if ($action === 'load_posts') {
    $conn = getConnection();
    // Ordenar por ID descendente para ver los más nuevos primero
    $sql = "SELECT p.*, u.username FROM posts p JOIN users u ON p.user_id = u.id ORDER BY p.id DESC";
    $result = mysqli_query($conn, $sql);

    $posts = [];
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $posts[] = $row;
        }
    }
    mysqli_close($conn);
    echo json_encode(['success' => true, 'posts' => $posts]);
    exit;
}

// ------------------------------------
// 2. ACTUALIZAR REACCIONES (Likes)
// ------------------------------------
if ($action === 'react') {
    $conn = getConnection();
    $post_id = $_POST['post_id'] ?? 0;
    
    // Incrementa el contador de likes en la tabla 'posts'
    $sql = "UPDATE posts SET likes = likes + 1 WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $post_id);

    if (mysqli_stmt_execute($stmt)) {
        // En un entorno real, también verificarías si el usuario ya reaccionó.
        $new_likes = mysqli_fetch_assoc(mysqli_query($conn, "SELECT likes FROM posts WHERE id = $post_id"))['likes'];
        echo json_encode(['success' => true, 'new_likes' => $new_likes]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al registrar el like']);
    }
    
    mysqli_close($conn);
    exit;
}

// ------------------------------------
// 3. CREAR NUEVO POST (Compartir Contenido)
// ------------------------------------
if ($action === 'create_post') {
    $conn = getConnection();
    // En un entorno real, obtendrías el ID del usuario logueado desde la sesión.
    // Usaremos un ID fijo (1) para la simulación.
    $user_id = 1; 
    $content = $_POST['content'] ?? '';

    if (empty($content)) {
        echo json_encode(['success' => false, 'message' => 'El contenido no puede estar vacío.']);
        exit;
    }

    $sql = "INSERT INTO posts (user_id, content, likes, comments_count, shares_count) VALUES (?, ?, 0, 0, 0)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'is', $user_id, $content);

    if (mysqli_stmt_execute($stmt)) {
        $new_post_id = mysqli_insert_id($conn);
        echo json_encode(['success' => true, 'message' => 'Post creado con éxito.', 'post_id' => $new_post_id]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al crear el post.']);
    }

    mysqli_close($conn);
    exit;
}

// Manejar acción no válida
echo json_encode(['success' => false, 'message' => 'Acción no válida']);
?>