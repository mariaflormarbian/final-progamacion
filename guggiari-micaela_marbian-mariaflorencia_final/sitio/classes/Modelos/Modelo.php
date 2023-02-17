<?php
namespace DaVinci\Modelos;

use DaVinci\Database\Conexion;
use PDO;

class Modelo 
{
    /**@var string la tabla a la que el modelo representa */
    protected string $table = "";
    /**@var string el campo de la PK */
    protected string $primaryKey = "";
    /**@var array las propiedades quese cargan en cargarPropiedades */
    protected array $propiedades = [];
    
    /**
     * Carga las propiedades del objeto con los datos del array.
     * 
     * @param array $data
     */
    public function cargarPropiedades(array $data)
    {
        foreach($data as $key => $value) {
            if(in_array($key, $this->propiedades)) {
                $this->{$key} = $value;
            }
        }
    }

    /**
     * @return array | static
     */
    public  function  todo():array
    {
        $db = Conexion::getConexion();
        $query = "SELECT * FROM {$this->table}";
        $stmt = $db->prepare($query);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, static::class);
        return $stmt->fetchAll();
    }
    
    /**
     * Retorna el objeto correspondiente al $id provisto.
     * 
     * @return static | null
     */
    public function traerPorId(int $id): ?static
    {
        $db = Conexion::getConexion();
        $query = "SELECT * FROM {$this->table}
                WHERE {$this->primaryKey} = ?";
        $stmt = $db->prepare($query);
        $stmt->execute([$id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, static::class);
        $obj = $stmt->fetch();

        return $obj ? $obj : null;
    }
}