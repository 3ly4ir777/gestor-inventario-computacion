<?php
include '../db.php';

//obtener producto seleccionado

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM productos WHERE id= $id");
$objetoSeleccionado = $result->fetch_assoc();


// Obtener la lista de proveedores
$proveedoresResult = $conn->query("SELECT id, nombre FROM proveedores");
$proveedores = $proveedoresResult->fetch_all(MYSQLI_ASSOC);

//accion al actualizar

if ($_SERVER['REQUEST_METHOD'] === 'POST' ) {
    $producto = $_POST['producto'];
    $precio = $_POST['precio'];
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $caracteristicas = $_POST['caracteristicas'];
    $proveedor_id= $_POST['proveedor_id'];

    $conn->query("UPDATE productos SET producto='$producto', precio='$precio', marca='$marca', modelo='$modelo', caracteristicas='$caracteristicas', proveedor_id='$proveedor_id' WHERE id = $id");
    header('Location: index.php'); 
}
 ?>

<!--Estructura-->

<!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Producto</title>
    <link rel="stylesheet" href="../bootstrap.css">
 </head>
 <body>
    <div class="container btn-5">
        <h1 class = 'text-center mt-4'>Actualizar Producto</h1>
            <a href="index.php" class="btn btn-primary">Volver al Inicio</a>
        <form action="" method = "POST"> 
            <div class="bm-3">
                <label for="producto" class="form-label">Nombre del Producto</label>
                <input type="text" name="producto" class="form-control" 
                value= "<?=$objetoSeleccionado['producto'] ?>"
                required>
            </div>

            <div class="bm-3">
                <label for="precio" class="form-label">Precio</label>
                <input type="number" name="precio" class="form-control" value= "<?=$objetoSeleccionado['precio'] ?>" required>
            </div>

            <div class="bm-3">
                <label for="marca" class="form-label">Marca</label>
                <input type="text" name="marca" class="form-control" value= "<?=$objetoSeleccionado['marca'] ?>"  required>
            </div>

            <div class="bm-3">
                <label for="modelo" class="form-label">Modelo</label>
                <input type="text" name="modelo" class="form-control" value= "<?=$objetoSeleccionado['modelo'] ?>" required>
            </div>

            <div class="bm-3">
                <label for="caracteristicas" class="form-label">Caracteristicas</label>
                <input type="text" name="caracteristicas" class="form-control" value= "<?=$objetoSeleccionado['caracteristicas'] ?>" required>
            </div>

            <!--<div class="bm-3">
                <label for="proveedor_id" class="form-label">Proveedor</label>
                <input type="number" name="proveedor_id" class="form-control" value= "<?=$objetoSeleccionado['proveedor_id'] ?>" required>
            </div>-->

            <div class="bm-3">
                <label for="proveedor_id" class="form-label">Proveedor</label>
                <select name="proveedor_id" class="form-control" required>
                    <?php foreach ($proveedores as $proveedor): ?>
                        <option value="<?= $proveedor['id'] ?>" 
                                <?= $objetoSeleccionado['proveedor_id'] == $proveedor['id'] ? 'selected' : '' ?>>
                            <?= $proveedor['nombre'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button type="submit" class="btn btn-success">Actualizar producto</button>
        </form>


    </div>
    
 </body>
 </html>