<?php
// Recoger datos del formulario de manera segura
$nombre = $_POST['nombre_php'];
$primer_apellido = $_POST['primer_apellido_php'];
$segundo_apellido = $_POST['segundo_apellido_php'];
$email = $_POST['email_php'];
$contrasena = password_hash($_POST['contrasena_php'], PASSWORD_DEFAULT); // Cifrar la contraseña

// Conectar a la base de datos
require('conexion1.php');

// Verificar si la conexión fue exitosa
if ($cn->connect_errno) {
    echo "Fallo la Conexión: " . $cn->connect_error;
    exit(); // Termina el script si hay un error de conexión
}


// Preparar la consulta para evitar inyecciones SQL
$stmt = $cn->prepare("INSERT INTO usuarios (nombre, primer_apellido, segundo_apellido, email, contrasena) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $nombre, $primer_apellido, $segundo_apellido, $email, $contrasena);

// Ejecutar la consulta
if ($stmt->execute()) {
    echo "El registro se guardó correctamente.";
} else {
    echo "No se guardó el registro: " . $stmt->error;
}

// Cerrar la declaración y la conexión
$stmt->close();
$cn->close();
?>
