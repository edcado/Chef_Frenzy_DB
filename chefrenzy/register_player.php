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
$username = $_POST["username"];
$password = password_hash($_POST["password"], PASSWORD_DEFAULT);
$gameTag = $_POST["gameTag"]; // Asegúrate de que coincida con lo que envías desde Unity
$date_creation = date("Y-m-d H:i:s");

// Debugging para comprobar los valores recibidos
echo "Username: " . $username . "<br>";
echo "Password: " . $password . "<br>";
echo "GameTag: " . $gameTag . "<br>";
echo "Date Creation: " . $date_creation . "<br>";

// Insertar nuevo jugador
$sql = "INSERT INTO Player (Username, Password, GameTag, Date_Creation) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die("Error al preparar la consulta: " . $conn->error);
}

$stmt->bind_param("ssss", $username, $password, $gameTag, $date_creation);

if ($stmt->execute()) {
    echo "Registro exitoso";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
