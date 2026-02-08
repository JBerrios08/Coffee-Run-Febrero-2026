<?php
session_start();
if (!isset($_SESSION['logueado'])) {
    header("Location: login.php");  // Redirigir a la página de login si no está logueado
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $electrolit = $_POST['electrolit'];

    // Guardar en la base de datos
    $servername = "localhost";
    $username = "tu_usuario";
    $password = "tu_contraseña";
    $dbname = "coffee_run_2026";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    $sql = "INSERT INTO corredores (nombre, apellido) VALUES ('$nombre', '$apellido')";
    if ($conn->query($sql) === TRUE) {
        echo "Nuevo corredor registrado con éxito.<br>";
    }

    // Productos a rifar
    $productos = [
        ["nombre" => "Cajas de Electrolit", "cantidad" => $electrolit],
        ["nombre" => "Inscripciones en carrera la grupetta", "cantidad" => 2],
        ["nombre" => "Camisas Nike Grupetta", "cantidad" => 5],
        ["nombre" => "Pastel Gratis Lorena", "cantidad" => 1],
        ["nombre" => "Estadia Gratis", "cantidad" => 1]
    ];

    echo "<h3>Productos a Rifar:</h3>";
    foreach ($productos as $producto) {
        if ($producto['cantidad'] > 0) {
            echo $producto['nombre'] . " - " . $producto['cantidad'] . " disponibles.<br>";
        }
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Corredores</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2 class="my-4">Registro de Corredores</h2>
        
        <form id="formCorredores" method="POST">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <div class="mb-3">
                <label for="apellido" class="form-label">Apellido</label>
                <input type="text" class="form-control" id="apellido" name="apellido" required>
            </div>
            <div class="mb-3">
                <label for="electrolit" class="form-label">¿Cuántas cajas de Electrolit se van a rifar? (0 a 6)</label>
                <input type="number" class="form-control" id="electrolit" name="electrolit" min="0" max="6" required>
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
