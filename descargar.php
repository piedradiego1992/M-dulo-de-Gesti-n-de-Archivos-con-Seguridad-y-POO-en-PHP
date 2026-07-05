<?php
require_once 'config.php';

// Validar que el usuario esté logueado
if (!isset($_SESSION['usuario'])) {
    die("Acceso denegado.");
}

if (isset($_GET['file'])) {
    $file = UPLOAD_DIR . basename($_GET['file']);
    if (file_exists($file)) {
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="'.basename($file).'"');
        readfile($file);
        exit;
    } else {
        echo "Archivo no encontrado.";
    }
}
?>