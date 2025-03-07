<?php 
include "../db.php";

header ("Content-Type: application/vnd.ms-excel");
header ("Content-Disposition: attachment; filename=productos.xls");

$search = isset($_GET['search']) ? $_GET['search'] : '';

$sql = "SELECT productos.*, proveedores.nombre AS nombre_proveedor FROM productos LEFT JOIN proveedores ON productos.proveedor_id = proveedores.id ";

if (!empty($search)){
    $sql .= " WHERE productos.id LIKE '%$search%' OR productos.producto LIKE '%$search%' OR productos.precio LIKE '%$search%' OR productos.marca LIKE '%$search%' OR productos.modelo LIKE '%$search%' OR productos.caracteristicas LIKE '%$search%' OR proveedores.nombre LIKE '%$search%'";
}

$result = $conn -> query($sql);

echo "<table border='1'>";
echo 
"<tr>
    <th>#</th>
    <th>Producto</th>
    <th>Precio</th>
    <th>Marca</th>
    <th>Modelo</th>
    <th>Caracteristicas</th>
    <th>Proveedores</th> 
</tr>";

while ($row = $result -> fetch_assoc()){

echo 
"<tr>
    <td>
        " . $row['id'] . "
    </td>

    <td>
        " . $row['producto'] . "
    </td>

    <td>
        " . $row['precio'] . "
    </td>

    <td>
        " . $row['marca'] . "
    </td>

    <td>
        " . $row['modelo'] . "
    </td>

    <td>
        " . $row['caracteristicas'] . "
    </td>

    <td>
        " . $row['nombre_proveedor']  . "
    </td>
                    
</tr>";
}
echo "</table>";

$conn ->close();
?>
