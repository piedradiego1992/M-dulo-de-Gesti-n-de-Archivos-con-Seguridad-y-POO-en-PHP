<?php
require_once 'config.php';
if (!isset($_SESSION['usuario'])) { header("Location: login.php"); exit; }
$archivos = $gestor->listar();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Control</title>
    <style>
        body { background: #0f172a; color: #e2e8f0; font-family: 'Segoe UI', sans-serif; padding: 40px; }
        header { display: flex; justify-content: space-between; border-bottom: 1px solid #1e293b; padding-bottom: 20px; margin-bottom: 30px; align-items: center; }
        .stats-bar { color: #3b82f6; font-size: 0.9em; font-weight: bold; }
        .instructions { background: #1e293b; padding: 20px; border-radius: 12px; border-left: 4px solid #3b82f6; margin-bottom: 30px; }
        .card { background: #1e293b; padding: 15px; border-radius: 10px; width: 170px; display: inline-block; margin: 10px; text-align: center; border: 1px solid #334155; }
        input { padding: 10px; border-radius: 5px; border: 1px solid #334155; background: #0f172a; color: white; }
        button { background: #3b82f6; border: none; padding: 10px 20px; color: white; cursor: pointer; border-radius: 5px; font-weight: bold; }
        img, embed { width: 100%; height: 140px; border-radius: 5px; margin-bottom: 10px; background: #0f172a; }
        a { color: #94a3b8; text-decoration: none; font-size: 0.85em; margin: 0 5px; display: block; margin-top: 5px; }
        .fecha-text { color: #64748b; font-size: 0.75em; margin-bottom: 5px; display: block; }
    </style>
</head>
<body>
    <header>
        <h1>PANEL DE CONTROL</h1>
        <div class="stats-bar">
            📂 ARCHIVOS: <?= $gestor->totalArchivos() ?> | 💾 ESPACIO: <?= $gestor->formatearTamano($gestor->espacioUtilizado()) ?>
        </div>
        <a href="logout.php">CERRAR SESIÓN</a>
    </header>

    <section class="instructions">
        <h3>Instrucciones de carga:</h3>
        <p>1. Escribe el nombre a asignar | 2. Elige tu archivo PDF/JPG/PNG (Máx: 5MB) | 3. Pulsa SUBIR.</p>
        <form action="subir.php" method="POST" enctype="multipart/form-data">
            <input type="text" name="nombre_personalizado" placeholder="Nombre" required>
            <input type="file" name="archivo" required>
            <button type="submit">SUBIR</button>
        </form>
    </section>

    <main>
        <?php foreach ($archivos as $f): ?>
            <div class="card">
                <?php $ext = strtolower(pathinfo($f['nombre'], PATHINFO_EXTENSION)); ?>
                <?php if ($ext === 'pdf'): ?>
                    <embed src="<?= BASE_URL . 'uploads/' . urlencode($f['nombre']) ?>">
                <?php else: ?>
                    <img src="<?= BASE_URL . 'uploads/' . urlencode($f['nombre']) ?>">
                <?php endif; ?>
                
                <strong style="display:block; font-size: 0.85em;"><?= htmlspecialchars($f['nombre']) ?></strong>
                <span class="fecha-text">Subido: <?= $f['fecha'] ?></span>
                <span class="fecha-text">Peso: <?= $gestor->formatearTamano($f['tamano']) ?></span>
                
                <a href="descargar.php?file=<?= urlencode($f['nombre']) ?>">📥 Descargar</a>
                <a href="eliminar.php?file=<?= urlencode($f['nombre']) ?>" onclick="return confirm('¿Seguro?')">🗑 Eliminar</a>
            </div>
        <?php endforeach; ?>
    </main>
</body>
</html>