<?php
/**
 * Transforma un string a una versión slugificada amigable para URLs.
 *
 * @param string $string
 * @return string
 */
function slugify(string $string): string
{
    $search = [' ', '%', '+', '\'', '"', '`', '´'];
    $replace = ['-', '', '-', '', '', '', ''];
    return str_replace($search, $replace, $string);
}

/**
 * Wrapper de htmlspecialchars.
 *
 * @param null|string $string
 * @return string
 */
function e(?string $string): string
{
    return htmlspecialchars($string);
}

/**
 * Retorna un string con el query string omitiendo los valores indicados en excepciones.
 */
function queryStringExcepto(array $excepciones = []): string
{
	$queryStringPartes = explode('&', $_SERVER['QUERY_STRING']);
	$filtrados = [];
	foreach($queryStringPartes as $valor) {
		// Si la clave no está en el array de $excepciones, la agregamos.
		[$clave, $dato] = explode('=', $valor);
		if(!in_array($clave, $excepciones)) {
			$filtrados[$clave] = $valor;
		}
	}
	return implode('&', $filtrados);
}