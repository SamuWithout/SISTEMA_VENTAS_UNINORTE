<?php
header('Content-Type: application/json');

// Leer los datos JSON enviados desde JavaScript
$input = file_get_contents('php://input');
$data = json_decode($input, true);

if (isset($data['nombre']) && isset($data['edad'])) {
    $nombre = htmlspecialchars(trim($data['nombre']));
    $edad = intval($data['edad']);

    // Formato de la línea a guardar
    $linea = "Nombre: " . $nombre . " | Edad: " . $edad . " | Fecha: " . date('Y-m-d H:i:s') . PHP_EOL;

    // Guardar en el archivo datos.txt (FILE_APPEND evita que se sobrescriba)
    if (file_put_contents('datos.txt', $linea, FILE_APPEND | LOCK_EX)) {
        echo json_encode(['status' => 'exito', 'mensaje' => 'Datos guardados correctamente.']);
    } else {
        echo json_encode(['status' => 'error', 'mensaje' => 'No se pudo escribir en el archivo.']);
    }
} else {
    echo json_encode(['status' => 'error', 'mensaje' => 'Datos incompletos.']);
}
?>