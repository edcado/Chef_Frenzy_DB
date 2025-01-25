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

error_log("Jugador buscado: " . $playerUsername);

// Verificar si el usuario existe y obtener su Game_Name
$sql = "SELECT p.Username,
               p.GameTag,
               p.Password,
               s.gamesPlayed,
               s.wins,
               s.platesDelivered 
        FROM Player p
        INNER JOIN player_stats s
        ON p.Username = s.Username
        WHERE p.Username = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    error_log("Error en la preparación de la consulta: " . $conn->error);
    echo json_encode(["error" => "Error interno del servidor"]);
    exit;
}

$stmt->bind_param("s", $playerUsername);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $data = $result->fetch_assoc();

    // Verificar si la contraseña enviada coincide con la almacenada en la base de datos
    if (password_verify($playerPassword, $data['Password'])) {
        unset($data['Password']); // Eliminar la contraseña antes de enviarla
        echo json_encode($data);
    } else {
        echo json_encode(["error" => "Contraseña incorrecta"]);
    }
} else {
    error_log("Jugador no encontrado: " . $playerUsername);
    echo json_encode(["error" => "Jugador no encontrado"]);
}

$stmt->close();
$conn->close();
?>
