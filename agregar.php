<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "examen_pr2";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if (isset($_POST['agregar'])) {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $edad = $_POST['edad'];

    if ($edad >= 0 && $edad <= 120) {
        $sql = "INSERT INTO personas (nombre, email, edad) VALUES ('$nombre', '$email', '$edad')";
        if ($conn->query($sql)) {
            echo "<script>window.opener.location.reload(); window.close();</script>";
            exit();
        }
    } else {
        echo "<script>alert('La edad debe estar entre 0 y 120.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Persona</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="form-container">
        <h2>Agregar Persona</h2>
        <form method="post">
            <div class="input-group">
                <label>Nombre:</label>
                <input type="text" name="nombre" required>
            </div>
            <div class="input-group">
                <label>Email:</label>
                <input type="email" name="email" required>
            </div>
            <div class="input-group">
                <label>Edad:</label>
                <input type="number" name="edad" min="0" max="120" required oninput="validarNumero(this)">
            </div>
            <button type="submit" name="agregar" class="btn-submit">Agregar</button>
            <button type="button" class="btn-cancel" onclick="window.close();">Cancelar</button>
        </form>
    </div>

    <script>
        function validarNumero(input) {
            if (input.value < 0) {
                input.value = 0;
            } else if (input.value > 120) {
                input.value = 120;
            }
        }
    </script>
</body>
</html>
