<?php

// Configuración
$targetDir = "subidos/";
$allowedTypes = array('pdf'); // Solo se permiten archivos PDF

// Verificar si se ha enviado un archivo
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES["file"])) {
    $fichero = $_FILES["file"];
    $originalFileName = $fichero["name"];

    // Validación del tipo de archivo
    $fileType = strtolower(pathinfo($originalFileName, PATHINFO_EXTENSION));
    if (!in_array($fileType, $allowedTypes)) {
        die("Error: Solo se permiten archivos PDF.");
    }

    // Validación del tamaño del archivo (opcional)
    $maxFileSize = 5000000; // 5 MB (ajusta según tus necesidades)
    if ($fichero["size"] > $maxFileSize) {
        die("Error: El archivo es demasiado grande.");
    }

    // Evitar sobrescribir archivos existentes
    $targetFileName = $originalFileName;
    $i = 1;
    while (file_exists($targetDir . $targetFileName)) {
        $targetFileName = pathinfo($originalFileName, PATHINFO_FILENAME) . "_$i.$fileType";
        $i++;
    }

    $targetFile = $targetDir . $targetFileName;

    // Mover el archivo subido a la carpeta de destino
    if (move_uploaded_file($fichero["tmp_name"], $targetFile)) {
        header("Location: index.html?mensaje=Archivo subido correctamente");
        exit; // Importante para detener la ejecución después del redireccionamiento
    } else {
        die("Error al subir el archivo.");
    }
} else {
    die("Error: No se ha enviado ningún archivo.");
}
