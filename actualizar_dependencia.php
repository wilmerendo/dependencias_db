<?php
include 'db.php'; 
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Actualizar Dependencia</title>
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
        <h1>Actualizar Dependencia</h1>
        <form id="actualizarDependenciaForm" method="post" action="procesar_actualizar_dependencia.php">
            <label for="dependencia_id">Seleccione la Dependencia a Actualizar:</label>
            <select name="dependencia_id" id="dependencia_id" required onchange="cargarDatosDependencia(this.value)">
                <option value="">Seleccione una dependencia</option>
                <?php
                try {
                    $stmt = $conn->prepare("SELECT id, nombre FROM dependencias");
                    $stmt->execute();
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value='".$row['id']."'>".$row['nombre']."</option>";
                    }
                } catch (PDOException $e) {
                    echo "<script>showAlert('Error al cargar dependencias: " . $e->getMessage() . "', 'error');</script>";
                }
                ?>
            </select><br>

            <label for="nombre">Nombre de la Dependencia:</label>
            <input type="text" id="nombre" name="nombre" required><br>

            <label for="codigo">Código de la Dependencia:</label>
            <input type="text" id="codigo" name="codigo" required><br>

            <label for="telefono">Teléfono:</label>
            <input type="text" id="telefono" name="telefono"><br>

            <label for="direccion">Dirección:</label>
            <input type="text" id="direccion" name="direccion"><br>

            <button type="submit">Actualizar Dependencia</button>
        </form>
    </div>

    <script>
        function cargarDatosDependencia(dependencia_id) {
            if (dependencia_id === "") {
                document.getElementById("nombre").value = "";
                document.getElementById("codigo").value = "";
                document.getElementById("telefono").value = "";
                document.getElementById("direccion").value = "";
                return;
            }
            
            fetch(`obtener_dependencia.php?id=${dependencia_id}`)
                .then(response => response.json())
                .then(data => {
                    if (data) {
                        document.getElementById("nombre").value = data.nombre;
                        document.getElementById("codigo").value = data.codigo;
                        document.getElementById("telefono").value = data.telefono;
                        document.getElementById("direccion").value = data.direccion;
                    } else {
                        showAlert("No se encontraron datos para la dependencia seleccionada.", "error");
                    }
                })
                .catch(error => showAlert("Error al cargar datos de la dependencia: " + error, "error"));
        }
    </script>
</body>
</html>
