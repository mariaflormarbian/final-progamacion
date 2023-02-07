<?php

namespace DaVinci\Modelos;

use DaVinci\Database\Conexion;
use PDO;

class  ProductoEstado extends Modelo
{
    protected  int $productos_estados_id;
    protected  string $nombre;

    protected string $table = "productos_estados";
    protected string $primaryKey = "productos_estados_id";
    
    protected array $propiedades = ['productos_estados_id', 'nombre'];

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