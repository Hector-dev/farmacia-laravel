<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Inventario Farmacéutico</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center">
                <h1 class="display-4 mb-4">Bienvenido al Sistema de Inventario Farmacéutico</h1>
                <p class="lead mb-4">Gestiona tu inventario de medicinas de manera eficiente</p>
                <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                    <a href="{{ route('medicines.index') }}" class="btn btn-primary btn-lg px-4 me-md-2">Ver Medicinas</a>
                    <a href="{{ route('inventory-movements.index') }}" class="btn btn-outline-primary btn-lg px-4">Ver Movimientos</a>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
