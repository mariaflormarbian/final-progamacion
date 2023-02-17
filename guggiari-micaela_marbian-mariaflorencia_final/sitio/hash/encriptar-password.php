<?php

echo "<br>";

$password2 = "pacho";

$hash2 = password_hash($password2, PASSWORD_DEFAULT);

echo "La encriptación del password '" . $password2 . "' generó el hash: " . $hash2;

echo "<br>";

$password3= "mica";

$hash3 = password_hash($password3, PASSWORD_DEFAULT);

echo "La encriptación del password '" . $password3 . "' generó el hash: " . $hash3;

echo "<br>";

$password4= "flor2";

$hash4 = password_hash($password4, PASSWORD_DEFAULT);

echo "La encriptación del password '" . $password4 . "' generó el hash: " . $hash4;
