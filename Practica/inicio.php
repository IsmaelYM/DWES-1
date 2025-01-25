<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
</head>

<body>
    <h1>Seleccione un artículo</h1>

    <form action="carrito.php" method="post">
        <label for="articulo">Artículo:</label>
        <select name="articulo" id="articulo">
            <option value="producto1">Lápiz - 10.00€</option>
            <option value="producto2">Rotulador - 15.00€</option>
            <option value="producto3">Compás - 20.00€</option>
            <option value="producto4">Regla - 5.00€</option>
        </select>

        <label for="cantidad">Cantidad:</label>
        <input type="number" name="cantidad" id="cantidad" value="1" min="1">

        <input type="submit" value="Añadir al carrito">
    </form>
</body>

</html>
