<?php
    // Conexión a la base de datos
    $host = 'localhost';
    $user = 'root';
    $password = '';
    $database = 'chef_frenzy';

    $conn = new mysqli($host, $user, $password, $database);

    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    // Recibir los datos enviados desde Unity
    $username = $_POST['username'];
    $platesDelivered = $_POST['platesDelivered'];
    $gamesPlayed = $_POST['gamesPlayed'];
    $wins = $_POST['wins'];

    // Actualizar los datos del jugador en la base de datos
    $sql = "UPDATE player_stats SET platesDelivered = platesDelivered + $platesDelivered, 
                                gamesPlayed = gamesPlayed + $gamesPlayed, 
                                wins = wins + $wins
            WHERE username = '$username'";

    if ($conn->query($sql) === TRUE) {
        echo "Datos actualizados correctamente.";
    } else {
        echo "Error al actualizar datos: " . $conn->error;
    }

    $conn->close();
?>
