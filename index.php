<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Administración de Dependencias</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        h1 { text-align: center; }
        .container { max-width: 600px; margin: auto; }
        .menu { list-style-type: none; padding: 0; }
        .menu li { margin: 10px 0; }
        .menu a {
            display: block;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
        }
        .menu a:hover { background-color: #45a049; }
    </style>
</head>
<body>
    <h1>Administración de Dependencias</h1>
    <div class="container">
        <ul class="menu">
            <li><a href="crear_dependencia.php">Crear Dependencia</a></li>
            <li><a href="listar_dependencias.php">Ver Lista de Dependencias</a></li>
            <li><a href="asociar_usuario.php">Asociar Usuario a Dependencia</a></li>
            <li><a href="actualizar_dependencia.php">Actualizar Dependencia</a></li>

        </ul>
    </div>
</body>
</html>
