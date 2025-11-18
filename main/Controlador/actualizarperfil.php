<?php
session_start();
header('Content-Type: application/json');
$user_id = '' . ($_SESSION['user_id'] ?? ''); // Asegúrate de que el ID del usuario esté en la sesión
if (empty($user_id)) {
    echo json_encode(['success' => false, 'message' => 'Usuario no autenticado.']);
    exit;
}

require_once 'conexion.php';

// Usaremos sentencias preparadas para seguridad
$conn = new mysqli($Servidor, $Usuario, $Pass, $Bd);

if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Error de conexión DB.']);
    exit;
}

$updates = [];
$params = [];
$types = '';
$nueva_foto_url = null;

if (isset($_POST['nombre']) && !empty($_POST['nombre'])) {
    $nuevoNombre = trim($_POST['nombre']);
    
    $updates[] = 'Nombre = ?'; 
    $params[] = $nuevoNombre;
    $types .= 's'; 
}
if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['foto']['tmp_name'];
    $fileName = $_FILES['foto']['name'];
    $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    $allowedfileExtensions = array('jpg', 'gif', 'png', 'jpeg');
    
    if (in_array($fileExtension, $allowedfileExtensions)) {
        // Generar nombre único: user_ID_timestamp.ext
        $newFileName = $user_id . '_' . time() . '.' . $fileExtension;
        // DIRECTORIO DE SUBIDA (relativo a este script PHP)
        // Puedes crear una carpeta dentro de main/uploads/
        $uploadFileDir = '../../uploads/perfiles/'; 
        $dest_path = $uploadFileDir . $newFileName;

        // Asegúrate de que el directorio exista (crearlo si es necesario)
        if (!is_dir($uploadFileDir)) {
            mkdir($uploadFileDir, 0777, true);
        }

        if (move_uploaded_file($fileTmpPath, $dest_path)) {
            // Guardar la ruta en la base de datos
            $updates[] = 'FotoURL = ?'; // ASUME QUE TIENES UNA COLUMNA LLAMADA 'FotoURL'
            $params[] = $dest_path;
            $types .= 's';
            $nueva_foto_url = $dest_path; 
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al guardar la foto en el servidor.']);
            exit;
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Tipo de archivo de foto no permitido.']);
        exit;
    }
}

if (empty($updates)) {
    echo json_encode(['success' => false, 'message' => 'No se detectaron cambios para guardar.']);
    exit;
}

$sql = "UPDATE Alumnos SET " . implode(', ', $updates) . " WHERE ID_Alumno = ?"; // ASUME QUE TU ID ES 'ID_Alumno'
$params[] = $user_id; // Añadir el ID del usuario al final de los parámetros
$types .= 'i'; // El ID es un entero 'i'

// Preparar y ejecutar
$stmt = $conn->prepare($sql);

// Usar una función dinámica para enlazar los parámetros variables (necesario para bind_param)
$bindParams = array_merge([$types], $params);
$refs = [];
foreach($bindParams as $key => $value) {
    $refs[$key] = &$bindParams[$key]; 
}

call_user_func_array([$stmt, 'bind_param'], $refs);

if ($stmt->execute()) {
    $response = ['success' => true, 'message' => 'Perfil actualizado.'];
    if ($nueva_foto_url) {
        // La URL que el frontend necesita para actualizar la imagen mostrada
        // Asegúrate que esta ruta funcione desde el navegador (puede ser necesario un / al inicio)
        $response['nueva_foto_url'] = '/MindShare/' . $nueva_foto_url; 
    }
    echo json_encode($response);
} else {
    echo json_encode(['success' => false, 'message' => 'Error de base de datos al actualizar: ' . $stmt->error]);
}

$stmt->close();
$conn->close();
?>