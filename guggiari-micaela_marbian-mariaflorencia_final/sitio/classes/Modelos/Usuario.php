<?php

namespace DaVinci\Modelos;
use DaVinci\Database\Conexion;
use PDO;

class Usuario extends Modelo
{

    protected $usuarios_id;
    protected $roles_fk;
    protected $email;
    protected $password;
    protected ?string $nombre;
    protected ?string $apellido;

    protected string $table = "usuarios";
    protected string $primaryKey = "usuarios_id";
    
    protected array $propiedades = ['usuarios_id', 'email', 'password', 'nombre', 'apellido'];
    
    public function getUsuariosId(): int
    {
        return $this->usuarios_id;
    }

    /**
     * @param int $usuarios_id
     */
    public function setUsuariosId(int $usuarios_id): void
    {
        $this->$usuarios_id;
    }

    /**
     * @return int
     */
    public function getRolesFk(): int
    {
        return $this->roles_fk;
    }

    /**
     * @param int $roles_fk
     */
    public function setRolFk(int $roles_fk): void
    {
        $this->$roles_fk;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return array|string[]
     */
    public function getPropiedades(): array
    {
        return $this->propiedades;
    }

    /**
     * @param array|string[] $propiedades
     */
    public function setPropiedades(array $propiedades): void
    {
        $this->propiedades = $propiedades;
    }
    
    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return string|null
     */

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    /**
     * @param string|null $nombre
     */
    public function setNombre(?string $nombre): void
    {
        $this->nombre = $nombre;
    }

    /**
     * @return string|null
     */
    public function getApellido(): ?string
    {
        return $this->apellido;
    }

    /**
     * @param string|null $apellido
     */
    public function setApellido(?string $apellido): void
    {
        $this->apellido = $apellido;
    }
    public function getNombreCompleto(): string
    {
        return $this->getNombre() . " " . $this->getApellido();
    }
    
    public function traerPorEmail(string $email): ?Usuario
    {
        $db = Conexion::getConexion();
        $query = "SELECT * FROM usuarios
        WHERE email = ?";
        $stmt = $db->prepare($query);
        $stmt->execute([$email]);

        $stmt->setFetchMode(PDO::FETCH_CLASS, self::class);
        $usuario = $stmt->fetch();


        if (!$usuario) {
            return null;
        }
        return $usuario;
    }
}