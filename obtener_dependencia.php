<?php
include 'db.php';

if (isset($_GET['id'])) {
    $dependencia_id = $_GET['id'];

    try {
        $stmt = $conn->prepare("SELECT nombre, codigo, telefono, direccion FROM dependencias WHERE id = :id");
        $stmt->execute(['id' => $dependencia_id]);
        $dependencia = $stmt->fetch(PDO::FETCH_ASSOC);

        echo json_encode($dependencia);
    } catch (PDOException $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
} else {
    echo json_encode(['error' => 'ID de dependencia no proporcionado']);
}
?>
