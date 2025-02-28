<?php
 include 'db.php';
// $result = $conn->query("SELECT * FROM proveedores")

//sentencia para busqueda de proveedores

$search = isset($_GET['search']) ? $_GET['search'] : '';
$sql = "SELECT * FROM proveedores";
if (!empty($search)) {
    $sql .= " WHERE id LIKE '%$search%' OR nombre LIKE '%$search%' OR correo LIKE '%$search%' OR telefono LIKE '%$search%' OR direccion LIKE '%$search%'";
}
$result = $conn->query($sql);

 ?>


<!--estructura-->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proveedores</title>
    <!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">-->
    <link rel="stylesheet" href="bootstrap.css">
</head>
<body> 

    <div class="container mt-5">
        
        <h1 class = "text-center mb-4">Lista de Proveedores</h1>
            <a href="add.php" class="btn btn-primary mb-3">Agregar Proveedor</a> 
            <a href="export_excel" class="btn btn-success mb-3">Exportar a Excel</a> 
            <a href="export_pdf" class="btn btn-danger mb-3">Exportar a PDF</a> 
            <a href="../index.php" class="btn btn-primary mb-3">INICIO</a> 
            <form method="GET" action="" >
                <div class="input-group">
                    <input type="text" 
                    name="search"
                    class="form-control"
                    placeholder="Buscar Proveedor"
                    value="<?= $search ?>">
                    <button
                    type="submit"
                    class= "btn btn-outline-secondary"
                    >
                    Buscar    
                    </button>
                </div>
            </form>
        <table class = "table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre proveedor</th>
                    <th>Email</th>
                    <th>Numero de Telefono</th>
                    <th>Direccion</th>
                    <th>Acción</th>

                </tr>
            </thead>

            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td>
                            <?= $row['id']?>
                        </td>

                        <td>
                            <?= $row['nombre']?>
                        </td>

                        <td>
                            <?= $row['correo']?>
                        </td>

                        <td>
                            <?= $row['telefono']?>
                        </td>

                        <td>
                            <?= $row['direccion']?>
                        </td>

                        <td>
                            <a href="edit.php?id=<?= $row['id']?>" class="btn btn-warning">Editar</a>

                            <a href="delete.php?id=<?= $row['id']?>" class="btn btn-danger">Eliminar</a>
                        </td>

                    </tr>
                <?php endwhile; ?>
            </tbody>

        </table>


    </div>
    
</body>
</html>