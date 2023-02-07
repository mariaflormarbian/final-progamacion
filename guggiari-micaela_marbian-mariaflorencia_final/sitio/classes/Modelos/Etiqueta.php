<?php

namespace DaVinci\Modelos;
use DaVinci\Database\Conexion;
use PDO;

class  Etiqueta extends Modelo
{

    protected int $etiquetas_id;
    protected string $nombre;
    protected $propiedades = ['etiquetas_id', 'nombre'];

    public  function  todo():array
    {
        $db = Conexion::getConexion();
        $query = "SELECT * FROM etiquetas";
        $stmt = $db->prepare($query);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, self::class);

        return  $stmt->fetchAll();
    }
    
    /**
     * @return int
     */
    public function getEtiquetasId(): int
    {
        return $this->etiquetas_id;
    }

    /**
     * @param int $etiquetas_id
     */
    public function setEtiquetasId(int $etiquetas_id): void
    {
        $this->etiquetas_id = $etiquetas_id;
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