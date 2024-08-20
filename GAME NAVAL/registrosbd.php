<?php
// Configura los parámetros de conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "USUARIOS";

// Crea la conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica si la conexión fue exitosa
if ($conn->connect_error) {
    echo "<script>alert('Conexión fallida: " . $conn->connect_error . "');</script>";
    die();
} else {
    echo "<script>alert('Conexión exitosa a la base de datos.');</script>";
}

// Obtén los valores del formulario
$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';

// Verifica que los valores no sean NULL o vacíos
if (empty($nombre) || empty($email) || empty($password)) {
    echo "<script>alert('Todos los campos son obligatorios.');</script>";
    die();
}

// Hash de la contraseña para almacenarla de manera segura
$password_hash = password_hash($password, PASSWORD_DEFAULT);

// Prepara la sentencia SQL para la inserción
$stmt = $conn->prepare("INSERT INTO Login (nombre, email, contraseña) VALUES (?, ?, ?)");
if (!$stmt) {
    echo "<script>alert('Error en la preparación de la sentencia: " . $conn->error . "');</script>";
    die();
}

// Vincula los parámetros y ejecuta la sentencia
$stmt->bind_param("sss", $nombre, $email, $password_hash);

if ($stmt->execute()) {
    echo "<script>alert('Registro exitoso');</script>";
} else {
    echo "<script>alert('Error al registrar: " . $stmt->error . "');</script>";
}

// Cierra la sentencia y la conexión
$stmt->close();
$conn->close();
?>
