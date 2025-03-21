<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "examen_pr2";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$id = $_GET['id'] ?? '';

if ($id) {
    $query = "SELECT * FROM personas WHERE id = $id";
    $result = $conn->query($query);
    $persona = $result->fetch_assoc();
}

if (isset($_POST['guardar'])) {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $edad = $_POST['edad'];

    if ($edad >= 0 && $edad <= 120) {
        $sql = "UPDATE personas SET nombre='$nombre', email='$email', edad='$edad' WHERE id=$id";
        if ($conn->query($sql)) {
            echo "<script>window.opener.location.reload(); window.close();</script>";
            exit();
        }
    } else {
        echo "<script>alert('La edad debe estar entre 0 y 120 años.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Persona</title>
   
</head>
<body>
    <div class="form-container">
        <h2>Modificar Persona</h2>
        <form method="post">
            <div class="input-group">
                <label>Nombre:</label>
                <input type="text" name="nombre" value="<?= $persona['nombre'] ?>" required>
            </div>
            <div class="input-group">
                <label>Email:</label>
                <input type="email" name="email" value="<?= $persona['email'] ?>" required>
            </div>
            <div class="input-group">
                <label>Edad:</label>
                <input type="number" name="edad" value="<?= $persona['edad'] ?>" min="0" max="120" required>
            </div>
            <button type="submit" name="guardar" class="bsubmit">Guardar cambios</button>
            <button type="button" class="bcancel" onclick="window.close();">Cancelar</button>
        </form>
    </div>
</body>
</html>

<?php $conn->close(); ?>
