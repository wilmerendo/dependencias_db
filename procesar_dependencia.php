<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $empresa_id = $_POST['empresa_id'];
    $nombre = $_POST['nombre'];
    $codigo = $_POST['codigo'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];

    // Validación para evitar duplicados
    try {
        $stmt = $conn->prepare("SELECT COUNT(*) FROM dependencias WHERE (nombre = :nombre OR codigo = :codigo) AND empresa_id = :empresa_id");
        $stmt->execute(['nombre' => $nombre, 'codigo' => $codigo, 'empresa_id' => $empresa_id]);
        $count = $stmt->fetchColumn();

        if ($count > 0) {
            echo "<script>
                    alert('Error: Ya existe una dependencia con este nombre o código en la empresa seleccionada.');
                    window.location.href = 'index.php';
                  </script>";
        } else {
            // Inserción de nueva dependencia
            $stmt = $conn->prepare("INSERT INTO dependencias (nombre, codigo, telefono, direccion, empresa_id) VALUES (:nombre, :codigo, :telefono, :direccion, :empresa_id)");
            $stmt->execute(['nombre' => $nombre, 'codigo' => $codigo, 'telefono' => $telefono, 'direccion' => $direccion, 'empresa_id' => $empresa_id]);
            echo "<script>
                    alert('Dependencia creada exitosamente.');
                    window.location.href = 'index.php';
                  </script>";
        }
    } catch (PDOException $e) {
        echo "<script>
                alert('Error al crear dependencia: " . $e->getMessage() . "');
                window.location.href = 'index.php';
              </script>";
    }
}
?>