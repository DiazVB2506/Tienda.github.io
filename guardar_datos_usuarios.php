<?php
// Crear la conexión a la base de datos
$cn = new mysqli("localhost", "root", "250602", "usuarios1", 3306);

// Verificar si la conexión fue exitosa
if ($cn->connect_error) {
    die("Conexión fallida: " . $cn->connect_error);
}
echo "Conexión exitosa.<br>";

// Comprobar si se enviaron datos por POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
    $nombre = $_POST['nombre'] ?? '';
    $primer_apellido = $_POST['primer_apellido'] ?? '';
    $segundo_apellido = $_POST['segundo_apellido'] ?? '';
    $email = $_POST['email'] ?? '';
    $contrasena = password_hash($_POST['contrasena'] ?? '', PASSWORD_BCRYPT);

    // Validar que los campos requeridos no estén vacíos
    if (!empty($nombre) && !empty($primer_apellido) && !empty($email) && !empty($contrasena)) {
        // Preparar la consulta de inserción
        $stmt = $cn->prepare("INSERT INTO usuarios (nombre, primer_apellido, segundo_apellido, email, contrasena) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $nombre, $primer_apellido, $segundo_apellido, $email, $contrasena);

        // Ejecutar la consulta y verificar si fue exitosa
        if ($stmt->execute()) {
            echo "Registro exitoso.";
        } else {
            echo "Error al registrar los datos: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Por favor, completa todos los campos obligatorios.";
    }
} else {
    echo "Método no permitido.";
}

// Cerrar la conexión
$cn->close();
?>
