<?php
require_once 'config.php';
if (isset($_SESSION['usuario'])) { header("Location: index.php"); exit; }
$error = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (($_POST['user'] ?? '') === ADMIN_USER && ($_POST['pass'] ?? '') === ADMIN_PASS) {
        $_SESSION['usuario'] = ADMIN_USER;
        header("Location: index.php");
        exit;
    } else { $error = "Credenciales incorrectas."; }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Acceso | Sistema</title>
    <style>
        body { background: #0f172a; color: #e2e8f0; font-family: 'Segoe UI', sans-serif; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        form { background: #1e293b; padding: 40px; border-radius: 12px; width: 320px; border-top: 4px solid #3b82f6; box-shadow: 0 10px 25px rgba(0,0,0,0.3); }
        h2 { margin-top: 0; text-align: center; color: #3b82f6; }
        input { width: 100%; padding: 12px; margin: 10px 0; border: 1px solid #334155; background: #0f172a; color: white; border-radius: 5px; box-sizing: border-box; }
        button { width: 100%; padding: 12px; background: #3b82f6; border: none; color: white; font-weight: bold; cursor: pointer; border-radius: 5px; margin-top: 10px; }
    </style>
</head>
<body>
    <form method="POST">
        <h2>LOGIN</h2>
        <?php if ($error) echo "<p style='color:#f87171; text-align:center;'>$error</p>"; ?>
        <input type="text" name="user" required placeholder="Usuario">
        <input type="password" name="pass" required placeholder="Contraseña">
        <button type="submit">INGRESAR</button>
    </form>
</body>
</html>