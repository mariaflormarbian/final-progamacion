<?php

namespace DaVinci\Modelos;

use DaVinci\Database\Conexion;
use PDO;


class  ProductoEstado
{
    protected  int $productos_estados_id;
    protected  string $nombre;


    protected array $propiedades = ['productos_estados_id', 'nombre'];
    public function cargarPropiedades(array $data)
    {
        foreach($data as $key => $value) {
            if(in_array($key, $this->propiedades)) {
                $this->{$key} = $value;
            }
        }
    }

    public  function  todo():array
    {
        $db = Conexion::getConexion();
        $query = "SELECT * FROM productos_estados";
        $stmt = $db->prepare($query);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, self::class);

        return  $stmt->fetchAll();
    }
    /**
     * @return int
     */
    public function getProductosEstadosId(): int
    {
        return $this->productos_estados_id;
    }

    /**
     * @param int $productos_estados_id
     */
    public function setProductosEstadosId(int $productos_estados_id): void
    {
        $this->productos_estados_id = $productos_estados_id;
    }

    /**
     * @return string
     */
    public function getNombre(): string
    {
        return $this->nombre;
    }

    /**
     * @param string $nombre
     */
    public function setNombre(string $nombre): void
    {
        $this->nombre = $nombre;
    }


}