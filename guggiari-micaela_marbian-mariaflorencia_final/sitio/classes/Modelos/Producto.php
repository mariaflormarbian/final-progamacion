<?php


namespace DaVinci\Modelos;

use DaVinci\Database\Conexion;
use PDO;
use PDOException;

class Producto
{
    protected int $productos_id;
    protected int $usuarios_fk;
    protected int $productos_estados_fk;
    protected string $titulo;
    protected int $precio;
    protected ?string $imagen;
    protected ?string $imagen_descripcion;
    protected ?string $video;
    protected ?string $audio;
    protected string $texto;
    protected ProductoEstado $estado;
    protected Usuario $autor;
    protected array $etiquetas_fk = [];
    protected array $etiquetas = [];


    /**
     * Obtiene todos los productos disponibles.
     * @return Producto[]  La lista de productos.
     */

    protected array $propiedades = ['productos_id', 'usuarios_fk', 'productos_estados_fk', 'titulo', 'texto', 'precio', 'imagen', 'imagen_descripcion', 'video', 'audio'];
    public function cargarPropiedades(array $data)
    {
        foreach($data as $key => $value) {
            if(in_array($key, $this->propiedades)) {
                $this->{$key} = $value;
            }
        }
    }

    public function todo(?array $where = null): array
    {
        $whereQuery = "";
        if($where !== null) {
            $whereConditions = [];
            foreach($where as $column => $value) {

                $whereConditions[] = "$column = :$column";
            }
            $whereQuery = " WHERE " . implode(" AND ", $whereConditions);
        }

        $db = Conexion::getConexion();
        $query = "SELECT p.*, u.*, pe.productos_estados_id, pe.nombre AS 'estado' FROM productos p
                INNER JOIN productos_estados pe ON p.productos_estados_fk = pe.productos_estados_id
                INNER JOIN usuarios u ON p.usuarios_fk = u.usuarios_id". $whereQuery;

        $stmt = $db->prepare($query);
        $stmt->execute($where);

        $salida = [];
    while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)){
        $obj = new Producto();
        $obj->cargarPropiedades($fila);

        $estado = new ProductoEstado();
        $estado->cargarPropiedades([
            'productos_estados_id' => $fila['productos_estados_id'],
            'nombre'            => $fila['estado'],
        ]);
        $obj->setEstado($estado);


        $autor = new Usuario();
        $autor->cargarPropiedades($fila);
        $obj->setAutor($autor);

        $salida[] = $obj;
    }
        return $salida;
    }


    public function traerPorId(int $id): ?self
    {
        $db = Conexion::getConexion();
        $query = "SELECT * FROM productos
                WHERE productos_id = ?";

        $stmt = $db->prepare($query);

        $stmt->execute([$id]);

        $stmt->setFetchMode(PDO::FETCH_CLASS, self::class);

        $productos = $stmt->fetch();

        if (!$productos) {
            return null;
        }

        return $productos;
    }

    public function cargarEtiquetas()
    {

        $db = Conexion::getConexion();
        $query = "SELECT e.* FROM productos_has_etiquetas phe
                INNER JOIN etiquetas e ON phe.etiquetas_fk = e.etiquetas_id
                WHERE productos_fk = ?";
        $stmt = $db->prepare($query);
        $stmt->execute([$this->getListadoId()]);

        while($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $this->etiquetas_fk[] = $fila['etiquetas_id'];

            $etiqueta = new Etiqueta();
            $etiqueta->cargarPropiedades($fila);
            $this->etiquetas[] = $etiqueta;
        }
    }

    public function crear(array $data)
    {
        $db = Conexion::getConexion();
        $query = "INSERT INTO productos (usuarios_fk, productos_estados_fk, precio, titulo, texto, imagen, imagen_descripcion, video) 
                VALUES (:usuarios_fk, :productos_estados_fk, :precio,  :titulo,  :texto, :imagen, :imagen_descripcion, :video)";

        $stmt = $db->prepare($query);

        $stmt->execute([
            'usuarios_fk' => $data['usuarios_fk'],
            'productos_estados_fk' => $data['productos_estados_fk'],
            'titulo' => $data['titulo'],
            'precio' => $data['precio'],
            'texto' => $data['texto'],
            'imagen' => $data['imagen'],
            'imagen_descripcion' => $data['imagen_descripcion'],
            'video' => $data['video'],


        ]);

        $id = $db->lastInsertId();
        $this->grabarEtiquetas($id, $data['etiquetas']);

    }


    protected function grabarEtiquetas(int $productoId, array $etiquetas)
    {
        if(count($etiquetas) === 0) return;

        $insertPares = [];
        $valores = [];

        foreach($etiquetas as $etiquetaId) {
            $insertPares[] = "(?, ?)";
            $valores[] = $productoId;
            $valores[] = $etiquetaId;
        }

        $db = Conexion::getConexion();
        $listaPares = implode(', ', $insertPares);
        $query = "INSERT INTO productos_has_etiquetas (productos_fk, etiquetas_fk) VALUES {$listaPares}";
        $db->prepare($query)->execute($valores);
    }


    /**
     * Editar el producto.
     *
     * @return void
     * @throws PDOException
     */



    public function editar(int $pk, array $data): void
    {
        $db = Conexion::getConexion();
        $query = "UPDATE productos
                SET usuarios_fk          = :usuarios_fk,
                    productos_estados_fk          = :productos_estados_fk,
                    titulo              = :titulo,
                    precio            = :precio,
                    texto               = :texto,
                    imagen              = :imagen,
                    video              = :video,
                    audio              = :audio,
                    imagen_descripcion  = :imagen_descripcion
                WHERE productos_id = :productos_id";

        $db->prepare($query)->execute([
            'productos_id' => $this->getListadoId(),
            'usuarios_fk' => $data['usuarios_fk'],
            'productos_estados_fk' => $data ['productos_estados_fk'],
            'titulo' => $data['titulo'],
            'precio' => $data['precio'],
            'texto' => $data['texto'],
            'imagen' => $data['imagen'],
            'video' => $data['video'],
            'audio' => $data['audio'],
            'imagen_descripcion' => $data['imagen_descripcion'],
        ]);
        $this->actualizarEtiquetas($data['etiquetas']);


    }
    protected function actualizarEtiquetas(array $etiquetas)
    {
        $this->eliminarEtiquetas();
        $this->grabarEtiquetas($this->getListadoId(), $etiquetas);
    }




    /**
     * Elimina el producto.
     *
     * @return void
     * @throws PDOException
     */
    public function eliminar(): void
    {
        $this->eliminarEtiquetas();

        $db = Conexion::getConexion();
        $query = "DELETE FROM productos
                WHERE productos_id = ?";
        $db->prepare($query)->execute([$this->getListadoId()]);

    }

    protected function eliminarEtiquetas()
    {
        $db = Conexion::getConexion();
        $query = "DELETE FROM productos_has_etiquetas
                WHERE productos_fk = ?";
        $db->prepare($query)->execute([$this->getListadoId()]);
    }

    /**
     * @return array
     */
    public function getEtiquetasFk(): array
    {
        return $this->etiquetas_fk;
    }

    /**
     * @param array $etiquetas_fk
     */
    public function setEtiquetasFk(array $etiquetas_fk): void
    {
        $this->etiquetas_fk = $etiquetas_fk;
    }






    /**
     * Setters y Getters.
     * @return  self.
     */

    public function getPrecio(): int
    {
        return $this->precio;
    }

    /**
     * @param int $precio
     */
    public function setPrecio(int $precio): void
    {
        $this->precio = $precio;
    }
    public function setListadoId(int $productos_id): void
    {
        $this->id = $productos_id;

    }

    public function getListadoId(): int
    {
        return $this->productos_id;


    }

    /**
     * @return int
     */


    public function setTitulo($titulo): void
    {
        $this->titulo = $titulo;
    }

    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * @return int
     */





    public function setImagen($imagen): void
    {
        $this->imagen = $imagen;
    }

    public function getImagen()
    {
        return $this->imagen;
    }

    /**
     * @param self $imagen .
     */

    public function setImagenDescripcion($imagen_descipcion): void
    {
        $this->imagen_descripcion = $imagen_descipcion;
    }

    public function getImagenDescripcion()
    {
        return $this->imagen_descripcion;
    }

    /**
     * @param self $imagen_descripcion .
     */
    public function setAudio($audio): void
    {
        $this->audio = $audio;
    }

    public function getAudio()
    {
        return $this->audio;
    }

    /**
     * @param self $audio .
     */
    public function setVideo($video): void
    {
        $this->video = $video;
    }

    public function getVideo()
    {
        return $this->video;
    }

    /**
     * @param self $video .roles
     */
    public function setTexto($texto): void
    {
        $this->texto = $texto;
    }

    public function getTexto()
    {
        return $this->texto;
    }

    /**
     * @param self $texto .
     */


    public function getUsuarioFk(): int
    {
        return $this->usuarios_fk;
    }

    /**
     * @param int $usuarios_fk
     */
    public function setUsuarioFk(int $usuarios_fk): void
    {
        $this->usuario_fk = $usuarios_fk;
    }

    /**
     * @return int
     */
    public function getProductosEstadoFk(): int
    {
        return $this->productos_estados_fk;
    }

    /**
     * @param int $productos_estados_fk
     */
    public function setProductosEstadoFk(int $productos_estados_fk): void
    {
        $this->productos_estados_fk = $productos_estados_fk;
    }

    /**
     * @return int
     */
    public function getEstado(): ProductoEstado
    {
        return $this->estado;
    }

    public function setEstado (ProductoEstado  $estado) : void
    {
        $this->estado = $estado;
    }

    public function getAutor(): Usuario
    {
        return $this->autor;
    }

    /**
     * @param Usuario $autor
     */
    public function setAutor(Usuario $autor): void
    {
        $this->autor = $autor;
    }

    /**
     * @return array
     */
    public function getEtiquetaFk(): array
    {
        return $this->etiquetas_fk;
    }

    /**
     * @param array $etiquetas_fk
     */
    public function setEtiquetaFk(array $etiquetas_fk): void
    {
        $this->etiquetas_fk = $etiquetas_fk;
    }

    /**
     * @return array
     */
    public function getEtiquetas(): array
    {
        return $this->etiquetas;
    }

    /**
     * @param array $etiquetas
     */
    public function setEtiquetas(array $etiquetas): void
    {
        $this->etiquetas = $etiquetas;
    }

}