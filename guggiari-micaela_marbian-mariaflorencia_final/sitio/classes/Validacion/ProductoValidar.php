<?php
namespace DaVinci\Validacion;

class ProductoValidar
{
    /** @var array La data a validar */
    protected $data = [];

    /** @var array Los errores de validación, en caso de existir */
    protected $errores = [];

    public function __construct(array $data)
    {
        $this->data = $data;
        $this->validar();
    }

    public function hayErrores(): bool
    {
        return !empty($this->errores);
    }

    public function getErrores(): array
    {
        return $this->errores;
    }

    protected function validar()
    {
        // Título
        if (empty($this->data['titulo'])) {
            $this->errores['titulo'] = "*Tenés que escribir el título del producto";
        } else if (strlen($this->data['titulo']) < 5) {
            $this->errores['titulo'] = "*Tenés que escribir al menos 5 caracteres para el título del producto";
        }

        // Precio
        if (empty($this->data['precio'])) {
            $this->errores['precio'] = "*Tenés que escribir el precio del producto";
        } else if (strlen($this->data['precio']) < 1) {
            $this->errores['precio'] = "*Tenés que escribir al menos 1 caracter para el precio del producto";
        }

        // Texto
        if (empty($this->data['texto'])) {
            $this->errores['texto'] = "*Tenés que escribir el texto del producto";
        }else if (strlen($this->data['texto']) < 10) {
            $this->errores['texto'] = "*Tenés que escribir al menos 10 caracteres para el texto del producto";
        }
        
      
    }
}