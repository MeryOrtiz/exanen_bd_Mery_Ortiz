<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "examen_pr2";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if (isset($_POST['eliminar'])) {
    $id = $_POST['id'];
    $sql = "DELETE FROM personas WHERE id=$id";
    $conn->query($sql);
}

$result = $conn->query("SELECT * FROM personas");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REGISTRO DE PERSONAS</title>
    <link rel="stylesheet" href="css.css">
</head>
<body>
    <div class="container">
        <h2>Lista de Personas</h2>
        <table>
            <tr>
                <th>Nombre</th>
                <th>Email</th>
                <th>Edad</th>
                <th></th>
                <th></th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['nombre'] ?></td>
                    <td><?= $row['email'] ?></td>
                    <td><?= $row['edad'] ?></td>
                    <td><?= ($row['edad'] >= 18) ? 'Sí es mayor de edad' : 'No es amyor de edad' ?></td>
                    <td>
                        <button class="b modificar" type="button" onclick="abrirVentanaModificar(<?= $row['id'] ?>)">Modificar</button>
                        <form method="post" class="inline-form">
                            <input type="hidden" name="id" value="<?= $row['id'] ?>">
                            <button class="b eliminar" type="submit" name="eliminar" onclick="return confirm('¿Eliminar este registro?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
        
        <button class="b agregar" onclick="abrirVentanaAgregar()">Agregar Persona</button>
    </div>

    <script>
        function abrirVentanaAgregar() {
            window.open('agregar.php', 'Agregar Persona', 'width=400,height=300');
        }
        
        function abrirVentanaModificar(id) {
            window.open('modificar.php?id=' + id, 'Modificar Persona', 'width=400,height=300');
        }
    </script>
</body>
</html>
<?php $conn->close(); ?>
