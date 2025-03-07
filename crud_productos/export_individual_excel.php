<?php
include '../db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Obtener los datos del producto
    $sql = "SELECT productos.*, proveedores.nombre AS nombre_proveedor FROM productos LEFT JOIN proveedores ON productos.proveedor_id = proveedores.id WHERE productos.id = $id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if ($row) {
        // Configurar las cabeceras para la descarga del archivo Excel
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=" . $row['producto'] . ".xls");

        // Generar la tabla Excel
        echo "<table border='1'>";
        echo "<tr>
            <th>#</th>
            <th>Producto</th>
            <th>Precio</th>
            <th>Marca</th>
            <th>Modelo</th>
            <th>Características</th>
            <th>Proveedor</th>
        </tr>";
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['producto'] . "</td>";
        echo "<td>" . $row['precio'] . "</td>";
        echo "<td>" . $row['marca'] . "</td>";
        echo "<td>" . $row['modelo'] . "</td>";
        echo "<td>" . $row['caracteristicas'] . "</td>";
        echo "<td>" . $row['nombre_proveedor'] . "</td>";
        echo "</tr>";
        echo "</table>";
    } else {
        echo "Producto no encontrado.";
    }
} else {
    echo "ID de producto no proporcionado.";
}

$conn->close();
?>