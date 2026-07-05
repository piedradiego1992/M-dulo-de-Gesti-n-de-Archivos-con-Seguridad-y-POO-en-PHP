<?php
class GestorArchivos {
    private $directorio;
    public function __construct($directorio) { $this->directorio = $directorio; }

    public function subir($file, $nombreFinal) {
        if ($file['size'] > MAX_FILE_SIZE) throw new Exception("Archivo muy pesado, máximo 5MB.");
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $file['tmp_name']);
        finfo_close($finfo);
        if (!in_array($mime, ALLOWED_TYPES)) throw new Exception("Solo PDF, JPG o PNG.");
        return move_uploaded_file($file['tmp_name'], $this->directorio . $nombreFinal);
    }

    public function listar() {
        if (!is_dir($this->directorio)) return [];
        $archivos = scandir($this->directorio);
        $lista = [];
        foreach ($archivos as $archivo) {
            if ($archivo !== '.' && $archivo !== '..' && $archivo !== '.htaccess') {
                $ruta = $this->directorio . $archivo;
                if (is_file($ruta)) {
                    $lista[] = [
                        'nombre' => $archivo,
                        'tamano' => filesize($ruta),
                        'fecha'  => date("d/m/Y H:i", filemtime($ruta))
                    ];
                }
            }
        }
        return $lista;
    }

    public function eliminar($nombre) {
        $ruta = $this->directorio . basename($nombre);
        if (file_exists($ruta)) unlink($ruta);
    }

    public function totalArchivos() { return count($this->listar()); }

    public function espacioUtilizado() {
        $total = 0;
        foreach (glob($this->directorio . "/*") as $f) if (is_file($f)) $total += filesize($f);
        return $total;
    }

    public function formatearTamano($bytes) { return round($bytes / 1024, 2) . ' KB'; }
}
?>