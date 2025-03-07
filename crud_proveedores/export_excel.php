<?php 
include "../db.php";

header ("Content-Type: application/vnd.ms-excel");
header ("Content-Disposition: attachment; filename=proveedores.xls");

$search = isset($_GET['search']) ? $_GET['search'] : '';

$sql = "SELECT * FROM proveedores";

if (!empty($search)) {
    $sql .= " WHERE id LIKE '%$search%' OR nombre LIKE '%$search%' OR correo LIKE '%$search%' OR telefono LIKE '%$search%' OR direccion LIKE '%$search%'";
}
$result = $conn -> query($sql);

echo "<table border='1'>";
echo " 
<tr>
    <th>#</th>
    <th>Nombre proveedor</th>
    <th>Email</th>
    <th>Numero de Telefono</th>
    <th>Direccion</th>

</tr>";

while ($row = $result -> fetch_assoc()){


echo "
<tr>
                        <td>
                            " . $row['id'] . "
                        </td>

                        <td>
                            " . $row['nombre'] . "
                        </td>

                        <td>
                            " . $row['correo'] . "
                        </td>

                        <td>
                            " . $row['telefono'] . "
                        </td>

                        <td>
                            " . $row['direccion'] . "
                        </td>

                    </tr>";


                }
                
echo "</table>";
$conn ->close();
 ?>
