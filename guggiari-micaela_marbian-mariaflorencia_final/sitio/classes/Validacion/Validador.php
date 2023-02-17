<?php

namespace DaVinci\Validacion;

use Exception;

class Validador
{
    /**
     * @var array Array asociativo con los datos a validar.
     *            Ej: [
     *                   'titulo' => 'Soy un título',
     *                   'descripcion' => '',
     *                   'precio' => 123.33,
     *                   'marca_id' => 1,
     *                   'email' => 'asd@asd.com',
     *                ]
     */
    private array $data = [];

    /**
     * @var array Array asociativo con las reglas de validación. Las claves deben coincidir con las claves
     *              de la $data que tiene que validar, y los valores deben ser un array con la lista de
     *              reglas a aplicar.
     *            Ej: [
     *               'titulo' => ['required', 'min:4'],
     *               'precio' => ['required', 'numeric'],
     *               'email' => ['required', 'email'],
     *               'descripcion' => ['required'],
     *             ]
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
        // Para aplicar las validaciones, vamos a necesitar recorrer las reglas de validación.
        // Ejemplo de una regla:
        // 'titulo' => ['required', 'min:4']
        foreach($this->reglas as $clave => $listaReglas) {
            // Como las reglas son potencialmente muchas para cada validación, vamos a recorrer la lista de
            // reglas para esta clave y aplicar la regla de validación en otro método.
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
        // Las reglas vienen en dos posibles formatos:
        // a. Una regla sin "parámetros". Ej: "numeric" o "required".
        // b. Una regla con "parámetros". Ej: "min:3".
        // Cada una de las reglas ('required', 'min', 'numeric', 'email', etc) van a ser un método
        // de esta clase. Este método va a llamarse igual que la regla, pero con un "_" de prefijo.

        // Antes de hacer nada, necesitamos identificar en qué caso estamos, si en a., o en b.
        // Como el caso b. requiere de que haya parámetros (indicados con un ":"), podemos usar eso
        // para identificarlo.
        if(strpos($regla, ":") !== false) {
            // Regla con parámetros.
            // Separamos la regla de sus parámetros.
            $reglaPartes = explode(":", $regla);

            $metodo = $this->obtenerNombreMetodo($reglaPartes[0]);

            $this->{$metodo}($clave, $reglaPartes[1]);
        } else {
            // Como los métodos se llaman igual que la regla pero con un "_" de prefijo, lo primero que vamos
            // a hacer es armar un string con el nombre del método formal y verificar que ese método exista.
            $metodo = $this->obtenerNombreMetodo($regla);

            // Ejecutamos el método.
            // Podemos usar como el nombre de métodos el contenido de una variable.
            // Por ejemplo, si:
            //  $metodo = "_required".
            // El código de abajo quedaría:
            //  $this->_required($clave)
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

    /*
     |--------------------------------------------------------------------------
     | Reglas de validación
     |--------------------------------------------------------------------------
     | Acá definimos las reglas de validación.
     | Cada regla va a representarse por un método que se llama igual que la regla, pero con el prefijo
     | "_" para diferenciarlo de otros métodos.
     | Cada método va a recibir al menos un argumento que es la clave del campo a validar.
     | Si la regla requiere de parámetros extras, recibirán argumentos extras.
     */

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
