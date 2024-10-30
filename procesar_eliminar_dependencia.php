<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $dependencia_id = $_POST['dependencia_id'];

    try {
        // Verificar si la dependencia tiene usuarios asociados
        $stmt = $conn->prepare("SELECT COUNT(*) FROM usuarios WHERE dependencia_id = :dependencia_id");
        $stmt->execute(['dependencia_id' => $dependencia_id]);
        $userCount = $stmt->fetchColumn();

        if ($userCount > 0) {
            // Si hay usuarios asociados, no permitir la eliminación y mostrar un mensaje
            echo "<script>
                    alert('Error: No se puede eliminar la dependencia porque tiene usuarios asociados.');
                    window.location.href = 'index.php';
                  </script>";
        } else {
            // Eliminar la dependencia si no tiene usuarios asociados
            $stmt = $conn->prepare("DELETE FROM dependencias WHERE id = :dependencia_id");
            $stmt->execute(['dependencia_id' => $dependencia_id]);
            echo "<script>
                    alert('Dependencia eliminada exitosamente.');
                    window.location.href = 'index.php';
                  </script>";
        }
    } catch (PDOException $e) {
        echo "<script>
                alert('Error al eliminar dependencia: " . $e->getMessage() . "');
                window.location.href = 'index.php';
              </script>";
    }
}
?>
