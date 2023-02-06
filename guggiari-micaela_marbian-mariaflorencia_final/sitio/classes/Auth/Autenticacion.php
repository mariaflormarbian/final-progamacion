<?php
namespace DaVinci\Auth;

use DaVinci\Modelos\Usuario;

class Autenticacion
{
    /**
     * @var Usuario
     */
    protected $usuario;

    /**
     *
     * @param string $email
     * @param string $password
     * @return bool
     */
    public function iniciarSesion(string $email, string $password): bool
    {
        $this->usuario = (new Usuario())->traerPorEmail($email);

        if ($this->usuario === null) {
            return false;
        }

        if (!password_verify($password, $this->usuario->getPassword())) {
            return false;
        }

        $_SESSION['usuarios_id'] = $this->usuario->getUsuariosId();
        return true;
    }

    /**
     * Cerramos sesion.
     */
    public function cerrarSesion()
    {
        unset($_SESSION['usuarios_id']);
    }


    public function estaAutenticado(): bool
    {
        return isset($_SESSION['usuarios_id']);
    }

    public function getId(): ?int
    {
        return $this->estaAutenticado() ?
            $_SESSION['usuarios_id'] :
            null;
    }
}