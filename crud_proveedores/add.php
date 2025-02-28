<?php
 include 'db.php';

 //Instruccion

 if ($_SERVER['REQUEST_METHOD'] === 'POST' ) {
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];

    $conn->query("INSERT INTO proveedores (nombre, correo, telefono, direccion) VALUES ('$nombre', '$correo', '$telefono', '$direccion')");
    header('Location: index.php');
}
 ?>

 <!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
 </head>
 <body>
    <div class="container btn-5">
        <h1 class = 'text-center mt-4'>Agregar Nuevo Proveedor</h1>
            <a href="index.php" class="btn btn-primary">Volver</a>
        <form action=""method = "POST">
            <div class="bm-3">
                <label for="nombre" class="form-label">Nombre Proveedor</label>
                <input type="text" name="nombre" class="form-control"  required>
            </div>

            <div class="bm-3">
                <label for="correo" class="form-label">Email</label>
                <input type="email" name="correo" class="form-control"  required>
            </div>

            <div class="bm-3">
                <label for="telefono" class="form-label">Numero de telefono</label>
                <input type="number" name="telefono" class="form-control"  required>
            </div>

            <div class="bm-3">
                <label for="direccion" class="form-label">Direccion</label>
                <input type="text" name="direccion" class="form-control"  required>
            </div>

            <button type="submit" class="btn btn-success">Guardar Nuevo Proveedor</button>
            

        </form>


    </div>
    
 </body>
 </html>