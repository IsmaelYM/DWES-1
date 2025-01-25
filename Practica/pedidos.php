<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['procesar'])) {
    // Guardar historial
    $numPedidos = isset($_COOKIE['num_pedidos']) ? $_COOKIE['num_pedidos'] + 1 : 1;
    setcookie('num_pedidos', $numPedidos, time() + (365 * 24 * 60 * 60));

    $fechaUltimoPedido = date('Y-m-d H:i:s');
    setcookie('fecha_ultimo_pedido', $fechaUltimoPedido, time() + (365 * 24 * 60 * 60));

    // Obtener sesión
    $carrito = isset($_SESSION['carrito']) ? $_SESSION['carrito'] : [];

    // Borrar sesión
    unset($_SESSION['carrito']);
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reducir_pedidos'])) {
    // Reducir historial
    $numPedidos = isset($_COOKIE['num_pedidos']) ? $_COOKIE['num_pedidos'] - 1 : 0;
    setcookie('num_pedidos', max(0, $numPedidos), time() + (365 * 24 * 60 * 60));
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de Pedidos</title>
</head>
<body>
    <h1>Historial de Pedidos</h1>

    <?php
    if (isset($_COOKIE['num_pedidos'])) {
        $numPedidos = $_COOKIE['num_pedidos'];
        $fechaUltimoPedido = isset($_COOKIE['fecha_ultimo_pedido']) ? $_COOKIE['fecha_ultimo_pedido'] : '';

        echo "<p>Número total de pedidos: $numPedidos</p>";
        echo "<p>Fecha del último pedido: $fechaUltimoPedido</p>";
    } else {
        echo '<p>No hay historial de pedidos.</p>';
    }

    if (!empty($carrito)) {
        echo '<h2>Carrito procesado:</h2>';
        echo '<ul>';
        $totalCarrito = 0;

        foreach ($carrito as $producto) {
            $nombre = $producto['nombre'];
            $cantidad = $producto['cantidad'];
            $precio = $producto['precio'];
            $subtotal = $cantidad * $precio;
            $totalCarrito += $subtotal;

            echo "<li>$nombre - Cantidad: $cantidad - Precio: $precio € - Subtotal: $subtotal €</li>";
        }
        echo '</ul>';

        echo "<p>Total del carrito: $totalCarrito €";
    } else {
        echo '<p>El carrito está vacío.</p>';
    }
    ?>

    <form action="inicio.php" method="post">
        <input type="submit" name="seguir_comprando" value="Seguir comprando">
    </form>

    <form action="pedidos.php" method="post">
        <input type="submit" name="borrar_historial" value="Borrar historial">
    </form>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <input type="submit" name="reducir_pedidos" value="Reducir número de pedidos">
    </form>
</body>
</html>



