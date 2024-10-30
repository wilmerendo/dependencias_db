<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $dependencia_id = $_POST['dependencia_id'];
    $nombre = $_POST['nombre'];
    $codigo = $_POST['codigo'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];

    try {
        // Verificar si el nuevo nombre o código ya existen en otra dependencia de la misma empresa
        $stmt = $conn->prepare("SELECT COUNT(*) FROM dependencias WHERE (nombre = :nombre OR codigo = :codigo) AND id != :dependencia_id");
        $stmt->execute(['nombre' => $nombre, 'codigo' => $codigo, 'dependencia_id' => $dependencia_id]);
        $count = $stmt->fetchColumn();

        if ($count > 0) {
            echo "<script>
                    alert('Error: Ya existe una dependencia con este nombre o código.');
                    window.location.href = 'index.php';
                </script>";
        } else {
            // Actualizar los datos de la dependencia
            $stmt = $conn->prepare("UPDATE dependencias SET nombre = :nombre, codigo = :codigo, telefono = :telefono, direccion = :direccion WHERE id = :dependencia_id");
            $stmt->execute(['nombre' => $nombre, 'codigo' => $codigo, 'telefono' => $telefono, 'direccion' => $direccion, 'dependencia_id' => $dependencia_id]);
            echo "<script>
                    alert('Dependencia actualizada exitosamente.');
                    window.location.href = 'index.php';
                </script>";
        }
    } catch (PDOException $e) {
        echo "<script>
                alert('Error al actualizar dependencia: " . $e->getMessage() . "');
                window.location.href = 'index.php';
            </script>";
    }
}
?>
