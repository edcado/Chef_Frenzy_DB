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
$game_name = $_POST["game_name"];
$date_creation = date("Y-m-d H:i:s");

echo "Username: " . $username . "<br>";
echo "Password: " . $password . "<br>";
echo "Game Name: " . $game_name . "<br>";
echo "Date Creation: " . $date_creation . "<br>";

// Insertar nuevo jugador
$sql = "INSERT INTO Player (Username, Password, Game_Name, Date_Creation) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

if ($stmt === false){
    die("Error al preparar la consulta: " . $conn->error);
}

$stmt->bind_param("ssss", $username, $password, $game_name, $date_creation);

if ($stmt->execute()) {
    echo "Registro exitoso";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>