<?php
// Crear la conexión a la base de datos
$cn = new mysqli("localhost", "root", "250602", "usuarios1", 3306); // Cambia "empleado1" a "usuarios1"

// Verificar si la conexión fue exitosa
if ($cn->connect_error) {
    die("Conexión fallida: " . $cn->connect_error);
}

echo "Conexión exitosa.<br>";
?>
