<?php
 include '../db.php';
// $result = $conn->query("SELECT * FROM proveedores")

// Configuración de paginación
$registros_por_pagina = 3; // Número de registros por página
$pagina_actual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
$inicio = ($pagina_actual - 1) * $registros_por_pagina;

//sentencia para busqueda de proveedores

$search = isset($_GET['search']) ? $_GET['search'] : '';
$sql = "SELECT * FROM proveedores";
if (!empty($search)) {
    $sql .= " WHERE id LIKE '%$search%' OR nombre LIKE '%$search%' OR correo LIKE '%$search%' OR telefono LIKE '%$search%' OR direccion LIKE '%$search%'";
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
                            <a href="../crud_entradas/add.php?proveedor_id=<?= $row['id']?>" class="btn btn-success mb-3">Agregar Mercancia</a>

                            <a href="edit.php?id=<?= $row['id']?>" class="btn btn-warning">Editar</a>

                            <a href="delete.php?id=<?= $row['id'] ?>" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que quieres eliminar a este proveedor?')">Eliminar Proveedor</a>
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