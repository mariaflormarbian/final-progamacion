<?php

$password = "morella87";

$hash = password_hash($password, PASSWORD_DEFAULT);

echo "La encriptación del password '" . $password . "' generó el hash: " . $hash;


echo "<br>";

$password = "pacho";

$hash = password_hash($password, PASSWORD_DEFAULT);

echo "La encriptación del password '" . $password . "' generó el hash: " . $hash;

