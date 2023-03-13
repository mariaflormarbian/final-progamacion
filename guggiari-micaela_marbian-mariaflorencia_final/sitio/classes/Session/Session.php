<?php
namespace DaVinci\Session;

class Session
{
    /**
     * Retorna la variable de sesión con el $nombre, si existe, y la elimina.
     * Si no existe, retorna el $default.
     *
     * @param string $nombre
     * @param $default
     * @return mixed|null
     */
    public function flash(string $nombre, $default = null)
    {
        $valor = $_SESSION[$nombre] ?? $default;
        unset($_SESSION[$nombre]);
        return $valor;
    }
}
