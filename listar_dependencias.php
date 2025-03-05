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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Dependencias</title>
    <!-- Importar Materialize CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
</head>
<body>
    <div class="container">
        <div class="card-panel green white-text center-align" style="max-width: 500px; margin: 20px auto;">
            <h3>Lista de Dependencias</h3>
        </div>
        <table class="highlight responsive-table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Código</th>
                    <th>Teléfono</th>
                    <th>Dirección</th>
                    <th>Empresa</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($dependencias as $dependencia): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($dependencia['nombre']); ?></td>
                        <td><?php echo htmlspecialchars($dependencia['codigo']); ?></td>
                        <td><?php echo htmlspecialchars($dependencia['telefono']); ?></td>
                        <td><?php echo htmlspecialchars($dependencia['direccion']); ?></td>
                        <td><?php echo htmlspecialchars($dependencia['empresa_nombre']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Importar Materialize JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>
</html>
