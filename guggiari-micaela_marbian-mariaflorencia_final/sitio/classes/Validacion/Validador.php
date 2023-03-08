<?php
namespace DaVinci\Validacion;
use Exception;

class Validador
{
    private array $data = [];

    /**
     * Array asociativo con las reglas de validación. Las claves deben coincidir con las claves de la $data que tiene que validar, 
     * y los valores deben ser un array con la lista de reglas a aplicar.
     */
    private array $reglas = [];

    /** @var array Los errores de validación. Las claves van a coincidir con los nombres de los campos a los que los errores pertenecen. */
    private array $errores = [];

    public function __construct(array $data, array $reglas)
    {
        $this->data = $data;
        $this->reglas = $reglas;

        $this->validar();
    }

    /**
     * Aplica las validaciones.
     *
     * @return void
     */
    private function validar()
    {
        foreach($this->reglas as $clave => $listaReglas) {

            foreach($listaReglas as $regla) {
                $this->aplicarRegla($clave, $regla);
            }
        }
    }

    /**
     * Aplica la regla de validación al campo de la $clave.
     *
     * @param string $clave
     * @param string $regla
     * @return void
     * @throws Exception
     */
    private function aplicarRegla(string $clave, string $regla)
    {

        if(strpos($regla, ":") !== false) {
            $reglaPartes = explode(":", $regla);
            $metodo = $this->obtenerNombreMetodo($reglaPartes[0]);
            $this->{$metodo}($clave, $reglaPartes[1]);
        } else {
            $metodo = $this->obtenerNombreMetodo($regla);
            $this->{$metodo}($clave);
        }
    }

    /**
     * Prepara el nombre del método para la regla y verifica que exista.
     *
     * @param string $regla
     * @return string
     * @throws Exception
     */
    private function obtenerNombreMetodo(string $regla): string
    {
        $metodo = "_" . $regla;
        if(!method_exists($this, $metodo)) {
            throw new ReglaNoExistenteException($regla, "No existe la regla de validación '" . $regla . "'.");
        }
        return $metodo;
    }

    /**
     * Retorna true si hay errores.
     * false de lo contrario.
     *
     * @return bool
     */
    public function hayErrores(): bool
    {
        return count($this->errores) > 0;
    }

    public function getErrores(): array
    {
        return $this->errores;
    }

    /**
     * Agrega un error para el campo $clave.
     *
     * @param string $clave
     * @param string $mensaje
     * @return void
     */
    private function addError(string $clave, string $mensaje)
    {
        if(!isset($this->errores[$clave])) {
            $this->errores[$clave] = [];
        }
        $this->errores[$clave][] = $mensaje;
    }

    /**
     * Valida que el campo no esté vacío.
     *
     * @param string $clave
     * @return void
     */
    private function _required(string $clave)
    {
        $dato = $this->data[$clave] ?? null;
        if(empty($dato)) {
            $this->addError($clave, 'El campo ' . $clave . ' no puede quedar vacío.');
        }
    }

    /**
     * Valida que el campo sea un valor numérico.
     *
     * @param string $clave
     * @return void
     */
    private function _numeric(string $clave)
    {
        $dato = $this->data[$clave] ?? null;
        if(!is_numeric($dato)) {
            $this->addError($clave, 'El campo ' . $clave . ' debe ser un valor numérico.');
        }
    }

    /**
     * Valida que el campo tenga formato de email.
     *
     * @param string $clave
     * @return void
     */
    private function _email(string $clave)
    {
        $dato = $this->data[$clave] ?? null;
        if(!filter_var($dato, FILTER_VALIDATE_EMAIL)) {
            $this->addError($clave, 'El campo ' . $clave . ' debe tener formato de email.');
        }
    }

    /**
     * Valida que el campo tenga al menos $longitud caracteres.
     *
     * @param string $clave
     * @param int $longitud
     * @return void
     */
    private function _min(string $clave, int $longitud)
    {
        $dato = $this->data[$clave] ?? null;
        if(strlen($dato) < $longitud) {
            $this->addError($clave, 'El campo ' . $clave . ' debe tener al menos ' . $longitud . ' caracteres.');
        }
    }

    /**
     * Verifica que el valor de la $clave coincida el de $claveCheck.
     *
     * @param string $clave
     * @param string $claveCheck
     * @return void
     */
    private function _equal(string $clave, string $claveCheck)
    {
        $dato1 = $this->data[$clave];
        $dato2 = $this->data[$claveCheck];
        if($dato1 != $dato2) {
            $this->addError('password_confirmar', 'El password no coincide con su confirmación.');
        }
    }
}
