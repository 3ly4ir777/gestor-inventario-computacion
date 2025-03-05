<?php
include '../db.php';

//declarar

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM salidas WHERE id= $id");
$objetoSeleccionado = $result->fetch_assoc();

//accion al actualizar

if ($_SERVER['REQUEST_METHOD'] === 'POST' ) {
    $producto_id = $_POST['producto_id'];
    $cantidad = $_POST['cantidad'];
    $motivo = $_POST['motivo'];

    $conn->query("UPDATE salidas SET producto_id='$producto_id', cantidad='$cantidad', motivo='$motivo' WHERE id = $id");
    header('Location: index.php'); 
}
 ?>

<!--Estructura-->

<!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Registro</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
 </head>
 <body>
    <div class="container btn-5">
        <h1 class = 'text-center mt-4'>Actualizar Registro</h1>
            <a href="index.php" class="btn btn-primary">Volver al Inicio</a>
        <form action="" method = "POST"> 
            <div class="bm-3">
                <label for="producto_id" class="form-label">Producto</label>
                <input type="number" name="producto_id" class="form-control" 
                value= "<?=$objetoSeleccionado['producto_id'] ?>"
                required>
            </div>

            <div class="bm-3">
                <label for="cantidad" class="form-label">Cantidad</label>
                <input type="number" name="cantidad" class="form-control" value= "<?=$objetoSeleccionado['cantidad'] ?>" required>
            </div>

            <div class="bm-3">
                <label for="motivo" class="form-label">Motivo</label>
                <input type="text" name="motivo" class="form-control" value= "<?=$objetoSeleccionado['motivo'] ?>"  required>
            </div>



            <button type="submit" class="btn btn-success">Actualizar Registro</button>
        </form>


    </div>
    
 </body>
 </html>