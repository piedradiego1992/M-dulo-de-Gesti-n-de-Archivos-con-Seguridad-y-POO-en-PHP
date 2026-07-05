<?php
require_once 'config.php';
if (!isset($_SESSION['usuario'])) { header("Location: login.php"); exit; }

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['archivo']) && !empty($_POST['nombre_personalizado'])) {
    $ext = pathinfo($_FILES['archivo']['name'], PATHINFO_EXTENSION);
    $nombreBase = preg_replace('/[^a-z0-9_-]/i', '_', $_POST['nombre_personalizado']);
    $nombreFinal = $nombreBase . '.' . $ext;
    try {
        if ($gestor->subir($_FILES['archivo'], $nombreFinal)) {
            header("Location: index.php?status=success");
            exit;
        }
    } catch (Exception $e) { 
        echo "<!DOCTYPE html><html lang='es'><head><meta charset='UTF-8'><style>
            body { background: #0f172a; color: #e2e8f0; font-family: sans-serif; display: flex; justify-content: center; align-items: center; height: 100vh; }
            .box { background: #1e293b; padding: 40px; border-radius: 12px; border-left: 5px solid #3b82f6; text-align: center; }
            .btn { display: inline-block; padding: 10px 20px; background: #3b82f6; color: white; text-decoration: none; margin-top: 20px; border-radius: 5px; font-weight:bold; }
        </style></head><body>
            <div class='box'><h1>¡Error de Carga!</h1><p>".htmlspecialchars($e->getMessage())."</p><a href='index.php' class='btn'>VOLVER AL PANEL</a></div>
        </body></html>";
        exit;
    }
}
header("Location: index.php");
?>