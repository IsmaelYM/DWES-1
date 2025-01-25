<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $articulo = isset($_POST['articulo']) ? $_POST['articulo'] : null;
    $cantidad = isset($_POST['cantidad']) ? $_POST['cantidad'] : null;

    if ($articulo !== null && $cantidad !== null) {
        // Crear o actualizar la sesión del carrito
        if (!isset($_SESSION['carrito'])) {
            $_SESSION['carrito'] = [];
        }

        $productos = [
            'producto1' => ['nombre' => 'Lápiz', 'precio' => 10.00],
            'producto2' => ['nombre' => 'Rotulador', 'precio' => 15.00],
            'producto3' => ['nombre' => 'Compás', 'precio' => 20.00],
            'producto4' => ['nombre' => 'Regla', 'precio' => 5.00],
            
        ];

        if (array_key_exists($articulo, $productos)) {
            $_SESSION['carrito'][$articulo] = [
                'nombre' => $productos[$articulo]['nombre'],
                'cantidad' => $cantidad,
                'precio' => $productos[$articulo]['precio']
            ];
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compra</title>
</head>
<body>
    <h1>Carrito de Compra</h1>

    <?php
    if (isset($_SESSION['carrito']) && count($_SESSION['carrito']) > 0) {
        echo '<ul>';
        $totalCarrito = 0;

        foreach ($_SESSION['carrito'] as $articulo => $infoProducto) {
            $nombre = $infoProducto['nombre'];
            $cantidad = $infoProducto['cantidad'];
            $precio = $infoProducto['precio'];
            $subtotal = $cantidad * $precio;
            $totalCarrito += $subtotal;

            echo "<li>$nombre - Cantidad: $cantidad - Precio: $precio € </br> Subtotal: $subtotal €</li>";
        }
        echo '</ul>';

        echo "<p>Total: $totalCarrito €</p>";

        echo '<form action="pedidos.php" method="post">';
        echo '<input type="submit" name="procesar" value="Procesar pedido">';
        echo '</form>';
        echo '<a href="inicio.php">Seguir comprando</a>';
    } else {
        echo '<p>El carrito está vacío.</p>';
        echo '<a href="inicio.php">Volver a la página de inicio</a>';
    }
    ?>
</body>
</html>

