<?php
include 'db.php';

$stmt = $conn->prepare("SELECT dependencias.*, empresas.nombre AS empresa_nombre FROM dependencias INNER JOIN empresas ON dependencias.empresa_id = empresas.id");
$stmt->execute();
$dependencias = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Dependencias</title>
    
</head>
<body>
    <h1>Dependencias</h1>
    <table border="1">
        <tr>
            <th>Nombre</th>
            <th>Código</th>
            <th>Teléfono</th>
            <th>Dirección</th>
            <th>Empresa</th>
        </tr>
        <?php foreach ($dependencias as $dependencia): ?>
            <tr>
                <td><?php echo $dependencia['nombre']; ?></td>
                <td><?php echo $dependencia['codigo']; ?></td>
                <td><?php echo $dependencia['telefono']; ?></td>
                <td><?php echo $dependencia['direccion']; ?></td>
                <td><?php echo $dependencia['empresa_nombre']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
