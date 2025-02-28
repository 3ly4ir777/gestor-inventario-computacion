<?php
include 'db.php';

//declarar

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM productos WHERE id= $id");
$objetoSeleccionado = $result->fetch_assoc();

//accion al actualizar

if ($_SERVER['REQUEST_METHOD'] === 'POST' ) {
    $producto = $_POST['producto'];
    $precio = $_POST['precio'];
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $caracteristicas = $_POST['caracteristicas'];

    $conn->query("UPDATE productos SET producto='$producto', precio='$precio', marca='$marca', modelo='$modelo', caracteristicas='$caracteristicas' WHERE id = $id");
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
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

            <button type="submit" class="btn btn-success">Actualizar producto</button>
        </form>


    </div>
    
 </body>
 </html>