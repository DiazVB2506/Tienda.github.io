<?php
// Crear la conexión a la base de datos
$cn = new mysqli("localhost", "root", "tu_contraseña", "usuarios1", 3306); // Asegúrate de que la contraseña y el nombre de la base de datos sean correctos

// Verificar si la conexión fue exitosa
if ($cn->connect_error) {
    die("Conexión fallida: " . $cn->connect_error);
}
?>
