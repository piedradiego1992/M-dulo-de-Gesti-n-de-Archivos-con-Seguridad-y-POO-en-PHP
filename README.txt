[APEB2-30%] Actividad: Implementación de un Módulo de Gestión de Archivos con Seguridad y POO en PHP

# Sistema de Gestión de Archivos (POO)

## Descripción del Proyecto
Este sistema permite la administración segura de archivos (PDF, JPG, PNG) en un entorno de servidor. Fue desarrollado bajo **Programación Orientada a Objetos (POO)** en PHP, priorizando la seguridad, la usabilidad y un diseño moderno e intuitivo.

## Características Principales
* **Gestión Segura:** Validación de tipos MIME y límites de tamaño por servidor.
* **Diseño Moderno:** Interfaz de usuario inspirada en plataformas de streaming/galería con una paleta de colores "Deep Blue" para una experiencia visual profesional.
* **POO:** Lógica centralizada en la clase `GestorArchivos` para operaciones de subida, listado y eliminación.
* **Semántica:** Estructura HTML5 que garantiza un código limpio y accesible.

## Instrucciones de Uso
1.  **Login:** Ingresar al sistema con las credenciales predeterminadas (usuario: admin / contrasena: admin2026 ).
2.  **Carga:** * Escribir un nombre descriptivo en el campo de texto.
    * Seleccionar un archivo (PDF, JPG o PNG).
    * El límite máximo por archivo es de **5 MB**.
3.  **Visualización:** El sistema mostrará una vista previa automática del archivo.
4.  **Administración:** Cada archivo incluye botones de descarga y eliminación.

## Estructura de la Clase `GestorArchivos`
La clase se encuentra en `/clases/GestorArchivos.php` y encapsula los siguientes métodos:
* `subir($file, $nombreFinal)`: Maneja la validación de seguridad (MIME) y el movimiento del archivo al directorio de destino.
* `listar()`: Escanea el directorio, filtra archivos no permitidos y extrae metadatos (tamaño, fecha).
* `eliminar($nombre)`: Ejecuta la eliminación segura mediante `unlink`.
* `formatearTamano($bytes)`: Convierte el tamaño de bytes a KB para una visualización amigable.

## Medidas de Seguridad Implementadas
* **Validación de Tipo:** Uso de `finfo_open` para validar el tipo MIME real del archivo, evitando que un usuario malintencionado suba archivos con extensión falsa.
* **Protección contra Path Traversal:** Uso de `basename()` y `preg_replace()` para sanear los nombres de archivo y asegurar que no se manipulen rutas del servidor.
* **Control de Acceso:** Uso de sesiones PHP (`session_start`) para restringir el acceso a todas las rutas críticas (subir, eliminar, index).
* **Límites de Peso:** Configuración de `MAX_FILE_SIZE` a 10MB para prevenir ataques de denegación de servicio por agotamiento de disco.

## Tecnologías Utilizadas
* **Backend:** PHP 8+
* **Frontend:** HTML5, CSS3 (Diseño responsivo y oscuro)
* **Conceptos:** POO, Manejo de Sesiones, FileSystem API.

---
*Desarrollado por Diego Piedra - UTPL - 2026*