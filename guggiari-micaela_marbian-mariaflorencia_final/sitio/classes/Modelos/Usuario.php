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
    
    protected array $propiedades = ['usuarios_id','roles_fk', 'email', 'password', 'nombre', 'apellido'];
    
    public function getUsuariosId(): int
    {
        return $this->usuarios_id;
    }

    public function crear(array $data)
    {
        $db = Conexion::getConexion();
        $query = "INSERT INTO usuarios (email, password, roles_fk) 
        VALUES (:email, :password, :roles_fk)";
        $db->prepare($query)->execute([
            'email' => $data['email'],
            'password' => $data['password'],
            'roles_fk' => $data['roles_fk'],
        ]);
    
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
    public function setRolesFk(int $roles_fk): void
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
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
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
    
    public function traerPorEmail(string $email): ?self
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

    public function editarPassword(string $password)
    {
        $db = Conexion::getConexion();
        $query = "UPDATE usuarios
                SET password = :password
                WHERE usuarios_id = :id";
        $db->prepare($query)->execute([
            'id' => $this->getUsuariosId(),
            'password' => $password,
        ]);
    }

}