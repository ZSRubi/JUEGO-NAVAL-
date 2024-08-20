<?php
// Configuración de la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "USUARIOS";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    echo "<script>alert('Conexión fallida: " . $conn->connect_error . "');</script>";
    die();
}

// Verifica si los datos del formulario están presentes
if (isset($_POST['email']) && isset($_POST['contraseña'])) {
    // Recibir datos del formulario
    $email = $_POST['email'];
    $password = $_POST['contraseña'];

    // Consultar usuario
    $sql = "SELECT contraseña FROM Login WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        $stmt->bind_result($password_hash);
        $stmt->fetch();
        
        // Verificar contraseña
        if (password_verify($password, $password_hash)) {
            echo "<script>alert('Inicio de sesión exitoso.');</script>";
        } else {
            echo "<script>alert('Contraseña incorrecta.');</script>";
        }
    } else {
        echo "<script>alert('No existe un usuario con ese correo electrónico.');</script>";
    }

    // Cerrar sentencia
    $stmt->close();
} else {
    echo "<script>alert('Por favor, complete todos los campos.');</script>";
}

// Cerrar conexión
$conn->close();
?>
