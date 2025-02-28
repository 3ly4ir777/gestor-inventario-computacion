<?php
 include 'db.php';
$result = $conn->query("SELECT * FROM productos");

//sentencia para busqueda de productos

$search = isset($_GET['search']) ? $_GET['search'] : '';
$sql = "SELECT * FROM productos";
if (!empty($search)) {
    $sql .= " WHERE id LIKE '%$search%' OR producto LIKE '%$search%' OR modelo LIKE '%$search%' OR caracteristicas LIKE '%$search%'";
}
$result = $conn->query($sql);

 ?>


<!--estructura-->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda Computacion</title>
    <!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">-->
    <link rel="stylesheet" href="bootstrap.css">
</head>
<body> 

    <div class="container mt-5">
        
        <h1 class = "text-center mb-4">Inventario de Productos</h1>
            <a href="add.php" class="btn btn-primary mb-3">Agregar Nuevo Producto</a> 
            <a href="export_excel" class="btn btn-success mb-3">Exportar a Excel</a> 
            <a href="export_pdf" class="btn btn-danger mb-3">Exportar a PDF</a>
            <a href="../index.php" class="btn btn-primary mb-3">INICIO</a> 

            <form method="GET" action="" >
                <div class="input-group">
                    <input type="text" 
                    name="search"
                    class="form-control"
                    placeholder="Buscar Productos"
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
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Caracteristicas</th>
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
                            <?= $row['producto']?>
                        </td>

                        <td>
                            <?= $row['precio']?>
                        </td>

                        <td>
                            <?= $row['marca']?>
                        </td>

                        <td>
                            <?= $row['modelo']?>
                        </td>

                        <td>
                            <?= $row['caracteristicas']?>
                        </td>

                        <td>
                            <a href="edit.php?id=<?= $row['id']?>" class="btn btn-warning">Actualizar Producto</a>

                            <a href="delete.php?id=<?= $row['id']?>" class="btn btn-danger">Eliminar Produto</a>
                        </td>

                    </tr>
                <?php endwhile; ?>
            </tbody>

        </table>

    </div>
    
</body>
</html>