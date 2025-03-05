<?php
 include '../db.php';
//$result = $conn->query("SELECT * FROM productos");

// Configuración de paginación
$registros_por_pagina = 3; // Número de registros por página
$pagina_actual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
$inicio = ($pagina_actual - 1) * $registros_por_pagina;

//sentencia para busqueda de productos

$search = isset($_GET['search']) ? $_GET['search'] : '';
//$sql = "SELECT * FROM productos";
$sql = "SELECT productos.*, proveedores.nombre AS nombre_proveedor FROM productos LEFT JOIN proveedores ON productos.proveedor_id = proveedores.id";
if (!empty($search)) {
    //$sql .= " WHERE id LIKE '%$search%' OR producto LIKE '%$search%' OR precio LIKE '%$search%' OR marca LIKE '%$search%' OR modelo LIKE '%$search%' OR caracteristicas LIKE '%$search%'";
    $sql .= " WHERE productos.id LIKE '%$search%' OR productos.producto LIKE '%$search%' OR productos.precio LIKE '%$search%' OR productos.marca LIKE '%$search%' OR productos.modelo LIKE '%$search%' OR productos.caracteristicas LIKE '%$search%' OR proveedores.nombre LIKE '%$search%'";
}

// Sentencia para contar el total de registros
$sql_total = $sql;
$result_total = $conn->query($sql_total);
$total_registros = $result_total->num_rows;

// Agregar LIMIT a la consulta SQL
$sql .= " LIMIT $inicio, $registros_por_pagina";
$result = $conn->query($sql); //muestra el resultado final de nuestra consulta

// Calcular el total de páginas
$total_paginas = ceil($total_registros / $registros_por_pagina);

 ?>


<!--estructura HTML-->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda Computacion</title>
    <!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">-->
    <link rel="stylesheet" href="../bootstrap.css">
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
                    <th>Proveedores</th> 
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

                        <!-- <td>
                            <?= $row['proveedor_id']?>
                        </td>  -->

                        <td>
                            <?= $row['nombre_proveedor'] ?>
                        </td>

                        <td>
                            <a href="edit.php?id=<?= $row['id']?>" class="btn btn-warning">Actualizar Producto</a>

                            <!-- <a href="delete.php?id=<?= $row['id']?>" class="btn btn-danger">Eliminar Produto</a> -->
                            <a href="delete.php?id=<?= $row['id'] ?>" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que quieres eliminar este producto?')">Eliminar Producto</a>
                        </td>

                    </tr>
                <?php endwhile; ?>
            </tbody>

        </table>

        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                <?php if ($pagina_actual > 1): ?>
                    <li class="page-item"><a class="page-link" href="?pagina=<?= $pagina_actual - 1 ?><?= !empty($search) ? '&search=' . $search : '' ?>">Anterior</a></li>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $total_paginas; $i++): ?>
                    <li class="page-item <?= $i == $pagina_actual ? 'active' : '' ?>">
                        <a class="page-link" href="?pagina=<?= $i ?><?= !empty($search) ? '&search=' . $search : '' ?>"><?= $i ?></a>
                    </li>
                <?php endfor; ?>

                <?php if ($pagina_actual < $total_paginas): ?>
                    <li class="page-item"><a class="page-link" href="?pagina=<?= $pagina_actual + 1 ?><?= !empty($search) ? '&search=' . $search : '' ?>">Siguiente</a></li>
                <?php endif; ?>
            </ul>
        </nav>

    </div>
    
</body>
</html>