<?php
namespace DaVinci\Modelos;
use DaVinci\Database\Conexion;
use PDO;

class Carrito extends Modelo{
    protected int $carrito_id;
    protected int $usuarios_fk;

    protected int $cantidad;
    protected float $total;

    protected string $tabla = "carrito";
    protected string $primaryKey = "carrito_id";

    public function data(): array
    {
        $db = Conexion::getConexion();
        $query = "SELECT carrito.*, 
        SUM(cantidad) AS 'cantidad', 
        SUM(subtotal) AS 'total' 
        FROM carrito 
        INNER JOIN agregar_producto addp ON addp.carrito_fk = carrito.carrito_id
        INNER JOIN productos p ON addp.productos_fk = p.productos_id
        GROUP BY carrito.carrito_id";
        $stmt = $db->prepare($query);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, self::class);
        return $stmt->fetchAll();
    }

    public function createCarrito(array $data): void
    {
        $db = Conexion::getConexion();
        $db->beginTransaction();

        try{
            $query = "INSERT INTO carrito (carrito_id, usuarios_fk)
                VALUES(:carrito_id, :usuarios_fk)";
            $stmt = $db->prepare($query);
            $stmt->execute([
                "carrito_id" => $data["carrito_id"],
                "usuarios_fk" => $data["usuarios_fk"]
            ]);
            $db->commit();
        } catch (Exeption $e){
            $db->rollBack();
            throw $e;
        }
    }

    public function getCarritoID()
    {
        return $this->carrito_id;
    }

    public function setCarritoID($carrito_id)
    {
        $this->carrito_id = $carrito_id;
        return $this;
    }

    public function getUsuarioFk()
    {
        return $this->usuarios_fk;
    }

    public function setUsuarioFk($usuarios_fk)
    {
        $this->usuarios_fk = $usuarios_fk;
        return $this;
    }

    public function getCantidad()
    {
        return $this->cantidad;
    }

    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;
        return $this;
    }

    public function getTotal()
    {
        return $this->total;
    }

    public function setTotal($total)
    {
        $this->total = $total;
        return $this;
    }
}