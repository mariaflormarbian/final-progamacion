<?php
$nombre = $_GET['nombre'];
$apellido = $_GET['apellido'];

echo  '<div class="form-enviado"><p>'. $nombre  .' '.$apellido . ' <strong>hemos recibido su  mensaje</strong>. A la brevedad tendrá una respuesta.<br>¡Muchas gracias por contactarnos!</p></div>';

?>