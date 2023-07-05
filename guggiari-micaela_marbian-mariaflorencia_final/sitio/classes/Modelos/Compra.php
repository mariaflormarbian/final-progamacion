<?php
namespace DaVinci\Modelos;
use DaVinci\Database\Conexion;
use PDO;
use Exception;

class Compra extends Modelo{

    protected int $compra_id;
    protected int $carrito_fk;
    protected int $usuarios_fk;
    protected string $fecha;
    protected int $cantidad;
    protected float $total;
    protected string $productos;
    protected string $tabla = "compra";
    protected string $primaryKey = "compra_id";
    protected array $properties = ['compra_id', 'carrito_fk', 'usuarios_fk', 'fecha', 'cantidad', 'total', 'productos'];

    public function data(): array
    {
        $db = Conexion::getConexion();
        $query = "SELECT compra.*,
        GROUP_CONCAT(usuarios.nombre, ' ' , usuarios.apellido) AS 'usuarios'
        FROM compra
        INNER JOIN usuarios
        ON compra.usuarios_fk = usuarios.usuarios_id
        GROUP BY compra.compra_id";

        $stmt = $db->prepare($query);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, self::class);
        return $stmt->fetchAll();
    }

    public function agregarCompras(array $data): void
    {
        $db = Conexion::getConexion();
        $db->beginTransaction();

        try{
            $query = "INSERT INTO compra (carrito_fk, usuarios_fk, fecha, cantidad, total, productos)
                VALUES (:carrito_fk, :usuarios_fk, :fecha, :cantidad, :total, :productos)";
            $stmt = $db->prepare($query);
            $stmt->execute([
                "carrito_fk" => $data["carrito_fk"],
                "usuarios_fk" => $data["usuarios_fk"],
                "fecha" => $data["fecha"],
                "cantidad" => $data["cantidad"],
                "total" => $data["total"],
                "productos" => $data["productos"],
            ]);
            $db->commit();
        } catch (Exception $e){
            $db->rollBack();
            throw $e;
        }
    }

    public function getByUsuario(int $id): array
    {
        $db = Conexion::getConexion();
        $query = "SELECT * FROM compra
					WHERE carrito_fk = ?";
        $stmt = $db->prepare($query);
        $stmt->execute([$id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, static::class);

        return $stmt->fetchAll();
    }

    public function getPurchaseID()
    {
        return $this->compra_id;
    }

    public function getCarritoFk()
    {
        return $this->carrito_fk;
    }

    public function setCarritoFk($carrito_fk)
    {
        $this->carrito_fk = $carrito_fk;

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

    public function getFecha()
    {
        return $this->fecha;
    }

    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
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

    public function getProductos()
    {
        $items = explode (" | ", $this->productos);
        return $items;
    }

    public function setProducto($productos)
    {
        $this->productos = $productos;
        return $this;
    }

    public function getUsuario()
    {
        return $this->usuarios_fk;
    }

    public function setUsuario($usuarios)
    {
        $this->usuarios_fk = $usuarios;
        return $this;
    }
}