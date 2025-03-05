<?php
 include '../db.php';

 //Instruccion

 if ($_SERVER['REQUEST_METHOD'] === 'POST' ) {
    $producto_id = $_POST['producto_id'];
    $cantidad = $_POST['cantidad'];
    $motivo = $_POST['motivo'];

    $conn->query("INSERT INTO salidas (producto_id, cantidad, motivo) VALUES ('$producto_id', '$cantidad', '$motivo')");
    header('Location: index.php');
}
 ?>

 <!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva Salida</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
 </head>
 <body>
    <div class="container btn-5">
        <h1 class = 'text-center mt-4'>Nueva Salida</h1>
            <a href="index.php" class="btn btn-primary">Volver</a>
        <form action=""method = "POST">
            <div class="bm-3">
                <label for="producto_id" class="form-label">Producto</label>
                <input type="number" name="producto_id" class="form-control"  required>
            </div>

            <div class="bm-3">
                <label for="cantidad" class="form-label">Cantidad</label>
                <input type="number" name="cantidad" class="form-control"  required>
            </div>

            <div class="bm-3">
                <label for="motivo" class="form-label">Motivo</label>
                <input type="text" name="motivo" class="form-control"  required>
            </div>


            <button type="submit" class="btn btn-success">Registar Nueva Salida</button>
            

        </form>


    </div>
    
 </body>
 </html>