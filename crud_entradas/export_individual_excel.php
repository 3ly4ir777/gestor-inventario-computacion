<?php
include '../db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Obtener los datos de entrada
    $sql = "SELECT entradas.*, productos.producto AS nombre_producto, proveedores.nombre AS nombre_proveedor
    FROM entradas
    LEFT JOIN productos ON entradas.producto_id = productos.id
    LEFT JOIN proveedores ON entradas.proveedor_id = proveedores.id WHERE entradas.id = $id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if ($row) {
        // Configurar las cabeceras para la descarga del archivo Excel
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=" . $row['fecha'] . ".xls");

        // Generar la tabla Excel
        echo "<table border='1'>";
        echo "<tr>
            <th>#</th>
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Proveedor</th>
            <th>Fecha</th>
        </tr>";
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['nombre_producto'] . "</td>";
        echo "<td>" . $row['cantidad'] . "</td>";
        echo "<td>" . $row['nombre_proveedor'] . "</td>";
        echo "<td>" . $row['fecha'] . "</td>";
        echo "</tr>";
        echo "</table>";
    } else {
        echo "Entrada no encontrada.";
    }
} else {
    echo "ID de entrada no proporcionada.";
}

$conn->close();
?>