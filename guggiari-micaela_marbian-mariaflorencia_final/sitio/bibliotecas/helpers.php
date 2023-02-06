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
