<?php
if (isset($_GET['name'])) {
    $fileToDelete = $_GET['name'];

    // Verificar que el archivo exista y esté dentro de la carpeta "subidos"
    if (file_exists($fileToDelete) && strpos($fileToDelete, "subidos/") === 0) {
        unlink($fileToDelete);
        header("Location: index.html?mensaje=Archivo eliminado correctamente");
    } else {
        die("Error: Archivo no válido.");
    }
} else {
    die("Error: No se especificó un archivo.");
}
?>
