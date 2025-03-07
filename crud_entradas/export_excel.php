<?php 
include "../db.php";

header ("Content-Type: application/vnd.ms-excel");
header ("Content-Disposition: attachment; filename=entradas.xls");

$search = isset($_GET['search']) ? $_GET['search'] : '';

$sql = "SELECT entradas.*, productos.producto AS nombre_producto, proveedores.nombre AS nombre_proveedor
FROM entradas
LEFT JOIN productos ON entradas.producto_id = productos.id
LEFT JOIN proveedores ON entradas.proveedor_id = proveedores.id";

if (!empty($search)) {
    $sql .= " WHERE entradas.id LIKE '%$search%' OR productos.producto LIKE '%$search%' OR cantidad LIKE '%$search% OR proveedores.nombre LIKE '%$search% OR fecha LIKE '%$search%'" ;
}


$result = $conn -> query($sql);

echo "<table border='1'>";
echo "
<tr>
    <th>#</th>
    <th>Producto</th>
    <th>Cantidad</th>
    <th>Proveedor</th>
    <th>Fecha</th>
</tr>";

while ($row = $result -> fetch_assoc()){


echo "
<tr>
    <td>
        " . $row['id'] . "
    </td>

    <td>
        " . $row['nombre_producto'] . "
    </td>

    <td>
        " . $row['cantidad'] . "
    </td>

    <td>
        " . $row['nombre_proveedor'] . "
    </td>

    <td>
        " . $row['fecha'] . "
    </td>

</tr>";


}
echo "</table>";
$conn ->close();
?>
