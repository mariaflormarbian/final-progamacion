<?php

namespace DaVinci\Modelos;

use DaVinci\Database\Conexion;
use DaVinci\Modelos\Modelo;
use PDO;

class AddProduct extends Modelo
{
    protected int $agregar_producto_id;
    protected int $carrito_fk;
    protected int $productos_fk;
    protected string $titulo;
    protected int $cantidad;
    protected float $subtotal;

    protected string $table = 'agregar_producto';
    protected string $primaryKey = "agregar_producto_id";

    protected array $properties = ['agregar_producto_id', 'carrito_fk', 'productos_fk', 'titulo', 'cantidad', 'subtotal'];


    public function data(): array
    {
        $db = Conexion::getConexion();
        $query = "SELECT agregar_producto.*
        FROM agregar_producto 
        INNER JOIN productos 
        ON agregar_producto.productos_fk = productos.productos_id";
        $stmt = $db->prepare($query);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, self::class);
        return $stmt->fetchAll();
    }

    public function addList(array $data): void
    {
        $db = Conexion::getConexion();
        $db->beginTransaction();
        try{
            $query = "INSERT INTO agregar_producto (carrito_fk, productos_fk, titulo, cantidad, subtotal)
                    VALUES (:carrito_fk, :productos_fk, :titulo, :cantidad, :subtotal)";
            $stmt = $db->prepare($query);
            $stmt->execute([
                'carrito_fk' => $data['carrito_fk'],
                'productos_fk' => $data['productos_fk'],
                'titulo' => $data['titulo'],
                'cantidad' => $data['cantidad'],
                'subtotal' => $data['subtotal'],
            ]);

            $db->commit();
        } catch (Exception $e) {
            $db->rollBack();
            throw $e;
        }
    }

    public function addProduct(int $id, array $data): void
    {
        $db = Conexion::getConexion();
        $db->beginTransaction();

        try{
            $query = "UPDATE agregar_producto
                            SET cantidad = :cantidad,
                            subtotal = :subtotal
                            WHERE agregar_producto_id = :agregar_producto_id";

            $stmt = $db->prepare($query);
            $stmt->execute([
                'agregar_producto_id' => $id,
                'cantidad' => $data['cantidad'],
                'subtotal' => $data['subtotal'],
            ]);

            $db->commit();
        } catch (Exception $e) {
            $db->rollBack();
            throw $e;
        }
    }

    public function delete(): void
    {
        $db = Conexion::getConexion();
        $db->beginTransaction();

        try{
            $query = "DELETE FROM agregar_producto
            WHERE agregar_producto_id = ?";
            $stmt = $db->prepare($query);
            $stmt->execute([$this->getAddProductID()]);

            $db->commit();
        } catch (Exception $e) {
            $db->rollBack();
            throw $e;
        }
    }

    public function removeAddProduct($id): void
    {
        $db = Conexion::getConexion();
        $query = "DELETE FROM agregar_producto
        WHERE carrito_fk = :carrito_fk";
        $stmt = $db->prepare($query);
        $stmt->execute([
            'carrito_fk' => $id,
        ]);
    }

    public function productList($products, $authentication): string
    {
        $array = [];
        foreach($products as $product){
            if($product->getCartFk() == $authentication){
                $productQuantity = $product->getQuantity() . "x " . $product->getTitle();
                array_push($array, $productQuantity);
            }
        }
        $stringArray = implode(' | ', $array);

        return  $stringArray;
    }

    public function getAddProductID()
    {
        return $this->agregar_producto_id;
    }

    public function setAddProductID($agregar_producto_id)
    {
        $this->agregar_producto_id = $agregar_producto_id;

        return $this;
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

    public function getProductsFk()
    {
        return $this->productos_fk;
    }

    public function setProductsFk($productos_fk)
    {
        $this->productos_fk = $productos_fk;

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



    public function getSubtotal()
    {
        return $this->subtotal;
    }

    public function setSubtotal($subtotal)
    {
        $this->subtotal = $subtotal;

        return $this;
    }

    public function getTitle()
    {
        return $this->titulo;
    }



}