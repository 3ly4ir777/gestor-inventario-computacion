<?php
include '../db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Obtener los datos de entrada
    $sql = "SELECT salidas.*, productos.producto AS nombre_producto 
    FROM salidas
    LEFT JOIN productos ON salidas.producto_id = productos.id WHERE salidas.id = $id";
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
            <th>motivo</th>
            <th>Fecha</th>
        </tr>";
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['nombre_producto'] . "</td>";
        echo "<td>" . $row['cantidad'] . "</td>";
        echo "<td>" . $row['motivo'] . "</td>";
        echo "<td>" . $row['fecha'] . "</td>";
        echo "</tr>";
        echo "</table>";
    } else {
        echo "salida no encontrada.";
    }
} else {
    echo "ID de salida no proporcionado.";
}

$conn->close();
?>