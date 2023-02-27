<?php

namespace DaVinci\Modelos;


use DaVinci\Database\Conexion;
use PDO;

class Compra extends Modelo{
    protected int $compra_id;
    protected int $carrito_fk;
    protected int $usuarios_fk;
    protected string $fecha;
    protected int $cantidad;
    protected float $total;
    protected string $productos;


    protected string $table = "compra";
    protected string $primaryKey = "compra_id";

    protected array $properties = ['compra_id', 'carrito_fk', 'usuarios_fk', 'fecha', 'cantidad', 'total', 'productos'];

    public function data(): array{
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

    public function addPurchases(array $data): void{
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

    public function getByUser(int $id): array
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

    public function getCartFk()
    {
        return $this->carrito_fk;
    }

    public function setCartFk($carrito_fk)
    {
        $this->carrito_fk = $carrito_fk;

        return $this;
    }

    public function getUserFk()
    {
        return $this->usuarios_fk;
    }

    public function setUserFk($usuarios_fk)
    {
        $this->usuarios_fk = $usuarios_fk;

        return $this;
    }

    public function getDate()
    {
        return $this->fecha;
    }

    public function setDate($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    public function getQuantity()
    {
        return $this->cantidad;
    }

    public function setQuantity($cantidad)
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

    public function getProducts()
    {
        $items = explode (" | ", $this->productos);
        return $items;
    }

    public function setProducto($productos)
    {
        $this->productos = $productos;

        return $this;
    }

    public function getUser()
    {
        return $this->usuarios;
    }

    public function setUser($usuarios)
    {
        $this->usuarios = $usuarios;

        return $this;
    }
}