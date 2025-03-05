<?php
 include '../db.php';
//$result = $conn->query("SELECT * FROM salidas");

// Configuración de paginación
$registros_por_pagina = 3; // Número de registros por página
$pagina_actual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
$inicio = ($pagina_actual - 1) * $registros_por_pagina;

//sentencia para busqueda de productos

$search = isset($_GET['search']) ? $_GET['search'] : '';
$sql = "SELECT salidas.*, productos.producto AS nombre_producto
FROM salidas
LEFT JOIN productos ON salidas.producto_id = productos.id";
if (!empty($search)) {
    $sql .= " WHERE salidas.id LIKE '%$search%' OR productos.producto LIKE '%$search%' OR cantidad LIKE '%$search% OR salidas.motivo LIKE '%$search% OR salidas.fecha LIKE '%$search%'" ;
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


<!--estructura-->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salidas</title>
    <!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">-->
    <link rel="stylesheet" href="../bootstrap.css">
</head>
<body> 

    <div class="container mt-5">
        
        <h1 class = "text-center mb-4">Salidas de Inventario</h1>
            <a href="add.php" class="btn btn-primary mb-3">Nuevo Registro</a> 
            <a href="export_excel" class="btn btn-success mb-3">Exportar a Excel</a> 
            <a href="export_pdf" class="btn btn-danger mb-3">Exportar a PDF</a>
            <a href="../index.php" class="btn btn-primary mb-3">INICIO</a> 
            <form method="GET" action="" >
                <div class="input-group">
                    <input type="text" 
                    name="search"
                    class="form-control"
                    placeholder="Buscar Registro"
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
                    <th>Cantidad</th>
                    <th>Motivo</th>
                    <th>Fecha</th>
                    <th>Accion</th>

                </tr>
            </thead>

            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td>
                            <?= $row['id']?>
                        </td>

                        <td>
                            <?= $row['nombre_producto']?>
                        </td>

                        <td>
                            <?= $row['cantidad']?>
                        </td>

                        <td>
                            <?= $row['motivo']?>
                        </td>

                        <td>
                            <?= $row['fecha']?>
                        </td>

                        
                        <td>
                            <a href="edit.php?id=<?= $row['id']?>" class="btn btn-warning">Actualizar Salida</a>

                            <a href="delete.php?id=<?= $row['id'] ?>" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que quieres eliminar esta salida?')">Eliminar Salida</a>
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