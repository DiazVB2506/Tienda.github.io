<?php
// Conectar a la base de datos
$cn = new mysqli("localhost", "root", "250602", "usuarios1", 3306);

// Verificar si la conexión fue exitosa
if ($cn->connect_errno) {
    echo json_encode(['success' => false, 'message' => "Fallo la Conexión: " . $cn->connect_error]);
    exit();
}

// Recoger datos del formulario
$email = $_POST['email_php'];
$contrasena = $_POST['contrasena_php'];

// Preparar la consulta para evitar inyecciones SQL
$stmt = $cn->prepare("SELECT contrasena FROM usuarios WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();

// Verificar si el email existe
if ($stmt->num_rows > 0) {
    $stmt->bind_result($hashed_password);
    $stmt->fetch();
    
    // Verificar la contraseña
    if (password_verify($contrasena, $hashed_password)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => "Credenciales incorrectas."]);
    }
} else {
    echo json_encode(['success' => false, 'message' => "Credenciales incorrectas."]);
}

// Cerrar la declaración y la conexión
$stmt->close();
$cn->close();
?>
