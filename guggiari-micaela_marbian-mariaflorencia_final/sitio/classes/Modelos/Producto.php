<?php
namespace DaVinci\Modelos;
use DaVinci\Database\Conexion;
use DaVinci\Paginacion\Paginador;
use EmptyIterator;
use PDO;
use PDOException;

class Producto extends Modelo
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
    protected ?string $texto;

    protected ProductoEstado $estado;
    protected Usuario $autor;
    
    protected array $etiquetas_fk = [];
    protected array $etiquetas = [];

    protected string $tabla = "productos";
    protected string $primaryKey = "productos_id";

    protected Paginador $paginador;

    protected array $propiedades = ['productos_id', 'usuarios_fk', 'productos_estados_fk', 'titulo', 'texto', 'precio', 'imagen', 'imagen_descripcion', 'video', 'audio'];

    /**
     * Obtiene todos los productos.
     */
    public function todo(array $where = [], int $registrosPorPagina =  10): array
    {
        $this->paginador = new Paginador($registrosPorPagina);

        $whereQuery = "";
        $whereValues = [];
        if(count($where) > 0) {
            $whereCondiciones = [];
            foreach($where as $valor) {
                $columna = $valor[0];
                $operador = $valor[1];
                $dato = $valor[2];
                $whereValues[$columna] = $dato;
                $whereCondiciones[] = "{$columna} {$operador} :{$columna}";
            }
            $whereQuery = " WHERE " . implode(" AND ", $whereCondiciones);
        }

        $db = Conexion::getConexion();
        $query = "SELECT p.*,
                u.*, 
                pe.productos_estados_id, 
                pe.nombre AS 'estado' 
                FROM productos p
                INNER JOIN productos_estados pe 
                ON p.productos_estados_fk = pe.productos_estados_id
                INNER JOIN usuarios u 
                    ON  p.usuarios_fk = u.usuarios_id
                LEFT JOIN productos_has_etiquetas nte
                    ON nte.productos_fk = p.productos_id
                LEFT JOIN etiquetas e
                    ON nte.etiquetas_fk = e.etiquetas_id
                {$whereQuery}
                GROUP BY p.productos_id
                LIMIT {$this->paginador->getRegistrosPorPagina()} 
                OFFSET {$this->paginador->getRegistroInicial()}";
                $stmt = $db->prepare($query);
                $stmt->execute($whereValues); 

        $stmt = $db->prepare($query);
        $stmt->execute($whereValues);

        $salida = [];

        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)){
            $salida[] = $this->generarProductoFila($fila);
        }

        $queryPaginacion = "SELECT COUNT(*) AS 'total' FROM productos
        {$whereQuery}";
        $stmtPag = $db->prepare($queryPaginacion);
        $stmtPag->execute($whereValues);
        $filaPag = $stmtPag->fetch();
        $this->paginador->setRegistrosTotales($filaPag['total']);

        return $salida;
    }

    protected function generarProductoFila(array $fila): self
    {
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

        if(!empty($fila['etiquetas'])) {
            $etiquetas = [];
            $etiquetasFila = explode(' | ', $fila['etiquetas']);
            foreach($etiquetasFila as $unaEtiqueta) {
                $etiquetaDatos = explode(' :: ', $unaEtiqueta);
                $etiqueta = new Etiqueta();
                $etiqueta->cargarPropiedades([
                    'etiquetas_id' => $etiquetaDatos[0],
                    'nombre' => $etiquetaDatos[1],
            ]);
                $etiquetas[] = $etiqueta;
            }
            $obj->setEtiquetas($etiquetas);
        }
        return $obj;
    }

    /**
     * Retorna los productos publicados.
     */
    public function publicadas(?array $where = null, int $registrosPorPagina = 10): array 
    {
        // $whereDefault = ['productos_estados_fk' => 2];
        $whereDefault = [['productos_estados_fk', '=', 2]];

        if($where !== null){
            $whereDefault = array_merge($whereDefault, $where);
        }

        return $this->todo($whereDefault, $registrosPorPagina);
    }

    /**
     * Carga las etiquetas asociadas al producto.
     */
    public function cargarEtiquetas()
    {
        $db = Conexion::getConexion();
        $query = "SELECT e.* FROM productos_has_etiquetas nte
                INNER JOIN etiquetas e ON e.etiquetas_id = nte.etiquetas_fk
                WHERE productos_fk = ?";
        $stmt = $db->prepare($query);
        $stmt->execute([$this->getCatalogoId()]);
        $etiquetasFk = [];
        $etiquetas = [];
        while($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $etiquetasFk[] = $fila['etiquetas_id'];
            $etiqueta = new Etiqueta();
            $etiqueta->cargarPropiedades($fila);
            $etiquetas[] = $etiqueta;
        }
        $this->etiquetas_fk = $etiquetasFk;
        $this->etiquetas = $etiquetas;
    }

    /**
     * Crea un producto en la base de datos.
     * 
     * @param array $data
     * @throws PDOException
     */
    public function crear(array $data): void
    {
        $db = Conexion::getConexion();
        $query = "INSERT INTO productos (usuarios_fk, productos_estados_fk, precio, titulo, texto, imagen, imagen_descripcion, video, audio) 
                VALUES (:usuarios_fk, :productos_estados_fk, :precio,  :titulo,  :texto, :imagen, :imagen_descripcion, :video, :audio)";
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
            'audio' => $data['audio'],

        ]);

        $id = $db->lastInsertId();
        if (!empty($data['etiquetas'])) {
            $this->grabarEtiquetas($id, $data['etiquetas']);
        }   
    }
    
    /**
     * Graba las etiquetas al producto.
     */
    protected function grabarEtiquetas(int $productoId, array $etiquetas)
    {
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
     */
    public function editar(int $id, array $data): void
    {
        $db = Conexion::getConexion();
        $query = "UPDATE productos
                SET usuarios_fk          = :usuarios_fk,
                    productos_estados_fk = :productos_estados_fk,
                    titulo               = :titulo,
                    precio               = :precio,
                    texto                = :texto,
                    imagen               = :imagen,
                    video                = :video,
                    imagen_descripcion   = :imagen_descripcion,
                    audio = :audio
                    
                WHERE productos_id = :productos_id";
        $stmt = $db->prepare($query);
        $stmt->execute([
            'productos_id' => $id,
            'usuarios_fk' => $data['usuarios_fk'],
            'productos_estados_fk' => $data ['productos_estados_fk'],
            'titulo' => $data['titulo'],
            'precio' => $data['precio'],
            'texto' => $data['texto'],
            'imagen' => $data['imagen'],
            'video' => $data['video'],
            'imagen_descripcion' => $data['imagen_descripcion'],
            'audio' => $data['audio'],
        ]);
        $this->actualizarEtiquetas($data['etiquetas']);
    }

    protected function actualizarEtiquetas(array $etiquetas)
    {
        $this->eliminarEtiquetas();
        if(!empty($etiquetas)){
            $this->grabarEtiquetas($this->getCatalogoId(), $etiquetas);
        }
    }
    
    /**
     * Elimina el producto.
     */
    public function eliminar(): void
    {
        $this->eliminarEtiquetas();
        $db = Conexion::getConexion();
        $query = "DELETE FROM productos
                WHERE productos_id = ?";
        $db->prepare($query)->execute([$this->getCatalogoId()]);
    }

    protected function eliminarEtiquetas()
    {
        $db = Conexion::getConexion();
        $query = "DELETE FROM productos_has_etiquetas
                WHERE productos_fk = ?";
        $db->prepare($query)->execute([$this->getCatalogoId()]);
    }

    /**
     * Setters y Getters.
     * 
     */

    public function getPrecio(): int
    {
        return $this->precio;
    }

    public function setPrecio(int $precio): void
    {
        $this->precio = $precio;
    }
    public function setCatalogoId(int $productos_id): void
    {
        $this->$productos_id;
    }

    public function getCatalogoId(): int
    {
        return $this->productos_id;
    }

    public function setTitulo($titulo): void
    {
        $this->titulo = $titulo;
    }

    public function getTitulo()
    {
        return $this->titulo;
    }

    public function setImagen($imagen): void
    {
        $this->imagen = $imagen;
    }

    public function getImagen()
    {
        return $this->imagen;
    }

    public function setImagenDescripcion($imagen_descipcion): void
    {
        $this->imagen_descripcion = $imagen_descipcion;
    }

    public function getImagenDescripcion()
    {
        return $this->imagen_descripcion;
    }

    public function setAudio($audio): void
    {
        $this->audio = $audio;
    }

    public function getAudio()
    {
        return $this->audio;
    }

    public function setVideo($video): void
    {
        $this->video = $video;
    }

    public function getVideo()
    {
        return $this->video;
    }

    public function setTexto($texto): void
    {
        $this->texto = $texto;
    }

    public function getTexto()
    {
        return $this->texto;
    }

    public function getUsuarioFk(): int
    {
        return $this->usuarios_fk;
    }

    public function setUsuarioFk(int $usuarios_fk): void
    {
        $this->$usuarios_fk;
    }

    public function getProductosEstadoFk(): int
    {
        return $this->productos_estados_fk;
    }

    public function getProductosId(): int
    {
        return $this->productos_id;
    }

    public function setProductosId(int $productos_id): void
    {
        $this->productos_id = $productos_id;
    }

    public function setProductosEstadoFk(int $productos_estados_fk): void
    {
        $this->productos_estados_fk = $productos_estados_fk;
    }

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

    public function setAutor(Usuario $autor): void
    {
        $this->autor = $autor;
    }

    public function getEtiquetaFk(): array
    {
        return $this->etiquetas_fk;
    }

    public function setEtiquetaFk(array $etiquetas_fk): void
    {
        $this->etiquetas_fk = $etiquetas_fk;
    }

    public function getEtiquetas(): array
    {
        return $this->etiquetas;
    }

    public function setEtiquetas(array $etiquetas): void
    {
        $this->etiquetas = $etiquetas;
    }

   

    public function getPaginador(): Paginador
    {
        return $this->paginador;
    }
}