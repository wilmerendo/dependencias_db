<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario_id = $_POST['usuario_id'];
    $dependencia_id = $_POST['dependencia_id'];

    try {
        // Asociar o cambiar la dependencia del usuario
        $stmt = $conn->prepare("UPDATE usuarios SET dependencia_id = :dependencia_id WHERE id = :usuario_id");
        $stmt->execute(['dependencia_id' => $dependencia_id, 'usuario_id' => $usuario_id]);

        echo "<script>
                alert('Usuario asociado o cambiado exitosamente a la nueva dependencia.');
                window.location.href = 'index.php';
              </script>";
    } catch (PDOException $e) {
        echo "<script>
                alert('Error al asociar o cambiar usuario: " . $e->getMessage() . "');
                window.location.href = 'index.php';
              </script>";
    }
}
?>
