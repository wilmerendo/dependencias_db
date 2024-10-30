<?php 
include 'db.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Asociar Usuario a Dependencia</title>
    <link rel="stylesheet" href="estilos.css">
    <script>
        function showAlert(message) {
            let alertBox = document.createElement("div");
            alertBox.className = "alert";
            alertBox.textContent = message;
            document.body.insertBefore(alertBox, document.body.firstChild);
        }
    </script>
</head>
<body>
    <h1>Asociar o Cambiar Usuario de Dependencia</h1>
    <form id="asociarUsuarioForm" method="post" action="procesar_asociacion.php">
        <label for="usuario_id">Usuario:</label>
        <select name="usuario_id" id="usuario_id" required>
            <?php
            try {
                // Consulta para obtener todos los usuarios, incluyendo aquellos ya asociados a una dependencia
                $stmt = $conn->prepare("SELECT usuarios.id, usuarios.nombre, dependencias.nombre AS dependencia_nombre 
                                        FROM usuarios 
                                        LEFT JOIN dependencias ON usuarios.dependencia_id = dependencias.id");
                $stmt->execute();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $dependenciaNombre = $row['dependencia_nombre'] ? " (Dependencia actual: ".$row['dependencia_nombre'].")" : " (Sin dependencia)";
                    echo "<option value='".$row['id']."'>".$row['nombre'].$dependenciaNombre."</option>";
                }
            } catch (PDOException $e) {
                echo "<script>showAlert('Error en la consulta de usuarios: " . $e->getMessage() . "');</script>";
            }
            ?>
        </select><br>

        <label for="dependencia_id">Nueva Dependencia:</label>
        <select name="dependencia_id" id="dependencia_id" required>
            <?php
            try {
                // Consulta para obtener todas las dependencias
                $stmt = $conn->prepare("SELECT id, nombre FROM dependencias");
                $stmt->execute();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<option value='".$row['id']."'>".$row['nombre']."</option>";
                }
            } catch (PDOException $e) {
                echo "<script>showAlert('Error en la consulta de dependencias: " . $e->getMessage() . "');</script>";
            }
            ?>
        </select><br>

        <button type="submit">Asociar o Cambiar Dependencia</button>
    </form>
</body>
</html>
