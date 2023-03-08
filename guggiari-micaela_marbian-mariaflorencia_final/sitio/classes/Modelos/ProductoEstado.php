<?php
namespace DaVinci\Modelos;
use DaVinci\Database\Conexion;
use PDO;

class  ProductoEstado extends Modelo
{
    protected  int $productos_estados_id;
    protected  string $nombre;
    protected string $tabla = "productos_estados";
    protected string $primaryKey = "productos_estados_id";
    protected array $propiedades = ['productos_estados_id', 'nombre'];

    public function getProductosEstadosId(): int
    {
        return $this->productos_estados_id;
    }

    public function setProductosEstadosId(int $productos_estados_id): void
    {
        $this->productos_estados_id = $productos_estados_id;
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): void
    {
        $this->nombre = $nombre;
    }
}