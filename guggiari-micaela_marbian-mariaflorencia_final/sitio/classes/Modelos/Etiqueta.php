<?php

namespace DaVinci\Modelos;
use DaVinci\Database\Conexion;
use PDO;

class  Etiqueta extends Modelo
{
    protected int $etiquetas_id;
    protected string $nombre;
    protected array $propiedades = ['etiquetas_id', 'nombre'];

    public  function  todo():array
    {
        $db = Conexion::getConexion();
        $query = "SELECT * FROM etiquetas";
        $stmt = $db->prepare($query);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, self::class);

        return  $stmt->fetchAll();
    }
    
    public function getEtiquetasId(): int
    {
        return $this->etiquetas_id;
    }

    public function setEtiquetasId(int $etiquetas_id): void
    {
        $this->etiquetas_id = $etiquetas_id;
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