<?php
 include '../db.php';

// Obtener la lista de productos
$productosResult = $conn->query("SELECT id, producto FROM productos");
$productos = $productosResult->fetch_all(MYSQLI_ASSOC);

// Obtener la lista de proveedores
$proveedoresResult = $conn->query("SELECT id, nombre FROM proveedores");
$proveedores = $proveedoresResult->fetch_all(MYSQLI_ASSOC);

// Obtener proveedor_id de la URL si está presente
// $proveedor_id_seleccionado = isset($_GET['proveedor_id']) ? $_GET['proveedor_id'] : '';

// Obtener producto_nombre de la URL si está presente
$producto_nombre_seleccionado = isset($_GET['producto_nombre']) ? urldecode($_GET['producto_nombre']) : '';
$producto_id_seleccionado = null;

// Obtener proveedor_nombre de la URL si está presente
$proveedor_nombre_seleccionado = isset($_GET['proveedor_nombre']) ? urldecode($_GET['proveedor_nombre']) : '';
$proveedor_id_seleccionado = null;

// Buscar el ID del producto basado en el nombre
if (!empty($producto_nombre_seleccionado)) {
    foreach ($productos as $producto) {
        if ($producto['producto'] === $producto_nombre_seleccionado) {
            $producto_id_seleccionado = $producto['id'];
            break;
        }
    }
}

// Buscar el ID del proveedor basado en el nombre
if (!empty($proveedor_nombre_seleccionado)) {
    foreach ($proveedores as $proveedor) {
        if ($proveedor['nombre'] === $proveedor_nombre_seleccionado) {
            $proveedor_id_seleccionado = $proveedor['id'];
            break;
        }
    }
}

//Instrucción para guardar la entrada

if ($_SERVER['REQUEST_METHOD'] === 'POST' ) {
    $producto_id = $_POST['producto_id'];
    $cantidad = $_POST['cantidad'];
    $proveedor_id = $_POST['proveedor_id'];

    $conn->query("INSERT INTO entradas (producto_id, cantidad, proveedor_id) VALUES ('$producto_id', '$cantidad', '$proveedor_id')");
    header('Location: index.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva Entrada</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container btn-5">
        <h1 class = 'text-center mt-4'>Nueva Entrada</h1>
            <a href="index.php" class="btn btn-primary">Volver</a>
        <form action=""method = "POST">
            <!-- <div class="bm-3">
                <label for="producto_id" class="form-label">Producto</label>
                <input type="number" name="producto_id" class="form-control"  required>
            </div> -->
            <div class="bm-3">
                <label for="producto_id" class="form-label">Producto</label>
                <select name="producto_id" class="form-control" required>
                    <?php foreach ($productos as $producto): ?>
                        <option value="<?= $producto['id'] ?>" <?= ($producto['id'] == $producto_id_seleccionado) ? 'selected' : '' ?>><?= $producto['producto'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="bm-3">
                <label for="cantidad" class="form-label">Cantidad</label>
                <input type="number" name="cantidad" class="form-control"  required>
            </div>

            <!-- <div class="bm-3">
                <label for="proveedor_id" class="form-label">Proveedor</label>
                <input type="number" name="proveedor_id" class="form-control" value="<?= $proveedor_id_seleccionado ?>" required>
            </div> -->

            <div class="bm-3">
                <label for="proveedor_id" class="form-label">Proveedor</label>
                <select name="proveedor_id" class="form-control" required>
                    <?php foreach ($proveedores as $proveedor): ?>
                        <option value="<?= $proveedor['id'] ?>" <?= ($proveedor['id'] == $proveedor_id_seleccionado) ? 'selected' : '' ?>><?= $proveedor['nombre'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button type="submit" class="btn btn-success">Guardar Nueva Entrada</button>
            

        </form>


    </div>
    
</body>
</html>