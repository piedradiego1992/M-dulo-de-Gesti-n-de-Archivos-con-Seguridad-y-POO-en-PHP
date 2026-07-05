<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

define('ADMIN_USER', 'admin');
define('ADMIN_PASS', 'admin2026');
define('BASE_URL', '/GestorArchivosPOO/');
define('UPLOAD_DIR', __DIR__ . '/uploads/');
define('MAX_FILE_SIZE', 5 * 1024 * 1024);
define('ALLOWED_TYPES', ['image/jpeg', 'image/png', 'application/pdf']);

session_start();
require_once __DIR__ . '/clases/GestorArchivos.php';

$gestor = new GestorArchivos(UPLOAD_DIR);
?>