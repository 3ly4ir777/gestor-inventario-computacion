<?php 
include "../db.php";

header ("Content-Type: application/vnd.ms-excel");
header ("Content-Disposition: attachment; filename=salidas.xls");

$search = isset($_GET['search']) ? $_GET['search'] : '';

$sql = "SELECT salidas.*, productos.producto AS nombre_producto
FROM salidas
LEFT JOIN productos ON salidas.producto_id = productos.id";

if (!empty($search)) {
    $sql .= " WHERE salidas.id LIKE '%$search%' OR productos.producto LIKE '%$search%' OR cantidad LIKE '%$search% OR salidas.motivo LIKE '%$search% OR salidas.fecha LIKE '%$search%'" ;
}


$result = $conn -> query($sql);

echo "<table border='1'>";
echo "
<tr>
    <th>#</th>
    <th>Producto</th>
    <th>Cantidad</th>
    <th>Motivo</th>
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
        " . $row['motivo'] . "
    </td>

    <td>
        " . $row['fecha'] . "
    </td>

</tr>";


}
echo "</table>";
$conn ->close();
?>
