<?php
namespace DaVinci\Auth;
use DaVinci\Modelos\Usuario;

class Autenticacion
{
    public function iniciarSesion(string $email, string $password, ?int $roles = null): bool
    {
        $usuario = (new Usuario())->traerPorEmail($email);
        if(!$usuario) {
            return false;
        }

        if(!password_verify($password, $usuario->getPassword())) {
            return false;
        }

        // Si se pide verificar el rol, lo hacemos.
        if($roles !== null && $usuario->getRolesFk() !== $roles) {
            return false;
        }

        $this->autenticar($usuario);
        return true;
    }

    public function autenticar(Usuario $usuario)
    {
        $_SESSION['usuarios_id'] = $usuario->getUsuariosId();
        $_SESSION['roles_fk']     = $usuario->getRolesFk();
    }

    public function cerrarSesion()
    {
        unset($_SESSION['usuarios_id'], $_SESSION['roles_fk']);
    }

    public function estaAutenticado(): bool
    {
        return isset($_SESSION['usuarios_id']);
    }

    public function esAdmin(): bool
    {
        return $_SESSION['roles_fk'] === 1;
    }

    public function getId(): ?int
    {
        return $this->estaAutenticado() ?
            $_SESSION['usuarios_id'] :
            null;
    }

    public function getUsuario(): ?Usuario
    {
        return $this->estaAutenticado() ?
        (new Usuario())->traerPorId($_SESSION['usuarios_id']) :
        null;
    }
}
