<?php
// Conexión a la base de datos
$conexion = mysqli_connect("127.0.0.1", "root", "", "dw3_guggiari_marbian");

// Recuperar el término de búsqueda
$termino_busqueda = $_GET['termino_busqueda'];

// Realizar la consulta
$query = "SELECT * FROM productos WHERE titulo LIKE '%$termino_busqueda%'";
$resultado = mysqli_query($conexion, $query);

// Mostrar los resultados en una tabla
echo "<table>";
while ($fila = mysqli_fetch_array($resultado)) {
    echo "<tr><td>" . $fila['titulo'] . "</td><td>" . $fila['imagen'] . "</td></tr>";

}
echo "</table>";

// Cerrar la conexión a la base de datos
mysqli_close($conexion);
?>