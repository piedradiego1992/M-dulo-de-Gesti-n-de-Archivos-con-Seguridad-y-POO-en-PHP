<?php
require_once 'config.php';

// 1. Verificación de seguridad: Solo usuarios logueados pueden borrar
if (!isset($_SESSION['usuario'])) {
    die("Acceso no autorizado.");
}

// 2. Procesar el borrado
if (isset($_GET['file'])) {
    $gestor->eliminar($_GET['file']);
}

// 3. Redirigir siempre de vuelta al panel
header("Location: index.php");
exit;
?>