<?php include 'conexion.php'; ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Eliminar Dependencia</title>
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
    <div class="container">
        <h1>Eliminar Dependencia</h1>
        <form id="eliminarDependenciaForm" method="post" action="procesar_eliminar_dependencia.php">
            <label for="dependencia_id">Seleccione la Dependencia a Eliminar:</label>
            <select name="dependencia_id" id="dependencia_id" required>
                <?php
                try {
                    $stmt = $conn->prepare("SELECT dependencias.id, dependencias.nombre 
                                            FROM dependencias 
                                            LEFT JOIN usuarios ON dependencias.id = usuarios.dependencia_id 
                                            WHERE usuarios.id IS NULL");
                    $stmt->execute();
                    $dependencias = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    if (count($dependencias) > 0) {
                        foreach ($dependencias as $row) {
                            echo "<option value='".$row['id']."'>".$row['nombre']."</option>";
                        }
                    } else {
                        echo "<option value=''>No hay dependencias disponibles para eliminar</option>";
                    }
                } catch (PDOException $e) {
                    echo "<script>showAlert('Error en la consulta: " . $e->getMessage() . "');</script>";
                }
                ?>
            </select><br>

            <button type="submit">Eliminar Dependencia</button>
        </form>
    </div>
</body>
</html>
