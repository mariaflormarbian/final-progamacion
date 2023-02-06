<?php

namespace DaVinci\Modelos;
use DaVinci\Database\Conexion;
use PDO;

class Usuario
{

    /**
     * @var int
     */
    protected $usuarios_id;
    /**
     * @var int
     */
    protected $roles_fk;
    /**
     * @var string
     */
    protected $email;
    /**
     * @var string
     */
    protected $password;
    protected ?string $nombre;
    protected ?string $apellido;
    /**
     * @return int
     */

    protected array $propiedades = ['usuarios_id', 'email', 'password', 'nombre', 'apellido'];

    public function cargarPropiedades(array $data)
    {
        foreach($data as $key => $value) {
            if(in_array($key, $this->propiedades)) {
                $this->{$key} = $value;
            }
        }
    }

    public function getUsuariosId(): int
    {
        return $this->usuarios_id;
    }

    /**
     * @param int $usuarios_id
     */
    public function setUsuariosId(int $usuarios_id): void
    {
        $this->usuarios_id = $usuarios_id;
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
        $this->rol_fk = $roles_fk;
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


    /**
     *
     * @param string $email
     * @return Usuario|null
     */

    public function traerPorId(int $id): ?self
    {
        $db = Conexion::getConexion();
        $query = "SELECT * FROM usuarios
                WHERE usuarios_id = ?";
        $stmt = $db->prepare($query);
        $stmt->execute([$id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, self::class);
        $usuario = $stmt->fetch();

        return $usuario ? $usuario : null;
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