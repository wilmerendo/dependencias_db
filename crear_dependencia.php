<?php 
include 'db.php'; 
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Dependencia</title>
    <link rel="stylesheet" href="estilos.css">
    <script>
        function showAlert(message, type) {
            let alertBox = document.createElement("div");
            alertBox.className = `alert ${type}`;
            alertBox.textContent = message;
            document.body.insertBefore(alertBox, document.body.firstChild);
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>Crear Dependencia</h1>
        <form id="crearDependenciaForm" method="post" action="procesar_dependencia.php">
            <label for="empresa_id">Empresa:</label>
            <select name="empresa_id" id="empresa_id" required>
                <?php
                $stmt = $conn->prepare("SELECT id, nombre FROM empresas");
                $stmt->execute();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<option value='".$row['id']."'>".$row['nombre']."</option>";
                }
                ?>
            </select><br>

            <label for="nombre">Nombre de la dependencia:</label>
            <input type="text" id="nombre" name="nombre" required><br>

            <label for="codigo">Código de la dependencia:</label>
            <input type="text" id="codigo" name="codigo" required><br>

            <label for="telefono">Teléfono:</label>
            <input type="text" id="telefono" name="telefono"><br>

            <label for="direccion">Dirección:</label>
            <input type="text" id="direccion" name="direccion"><br>

            <button type="submit">Crear Dependencia</button>
        </form>
    </div>
</body>
</html>
