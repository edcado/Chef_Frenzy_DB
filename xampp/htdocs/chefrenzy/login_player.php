<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "chef_frenzy";

// Conectar a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Comprobar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener datos desde Unity
$playerUsername = $_POST["username"];
$playerPassword = $_POST["password"];

// Verificar si el usuario existe y obtener su Game_Name
$sql = "SELECT Password, Game_Name FROM Player WHERE Username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $playerUsername);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $stmt->bind_result($hashedPassword, $gameName);
    $stmt->fetch();

    // Verificar la contraseña
    if (password_verify($playerPassword, $hashedPassword)) {
        echo "success:$gameName";  // Respuesta concatenada con ":" para separar el estado y el nombre del juego
    } else {
        echo "error:Contraseña incorrecta";
    }
} else {
    echo "error:Usuario no encontrado";
}

$stmt->close();
$conn->close();
?>