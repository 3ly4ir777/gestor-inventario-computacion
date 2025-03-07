<?php
include '../db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Obtener los datos del producto
    $sql = "SELECT * FROM proveedores WHERE id = $id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if ($row) {
        // Configurar las cabeceras para la descarga del archivo Excel
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=" . $row['nombre'] . ".xls");

        // Generar la tabla Excel
        echo "<table border='1'>";
        echo "<tr>
            <th>#</th>
            <th>Nombre proveedor</th>
            <th>Email</th>
            <th>Numero de Telefono</th>
            <th>Direccion</th>
        </tr>";
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['nombre'] . "</td>";
        echo "<td>" . $row['correo'] . "</td>";
        echo "<td>" . $row['telefono'] . "</td>";
        echo "<td>" . $row['direccion'] . "</td>";
        echo "</tr>";
        echo "</table>";
    } else {
        echo "Proveedor no encontrado.";
    }
} else {
    echo "ID del proveedor no proporcionado.";
}

$conn->close();
?>