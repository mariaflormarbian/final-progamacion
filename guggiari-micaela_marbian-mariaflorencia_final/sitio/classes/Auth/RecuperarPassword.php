<?php

require_once RUTA_RAIZ . '/classes/Usuario.php';
require_once RUTA_RAIZ . '/classes/Conexion.php';


    class RecuperarPassword
    {
    protected  ?Usuario $usuario;
    protected  string  $token;
    protected DateTime $expiracion;


    public function enviarEmailDeRecuperacion(Usuario  $usuario)
    {
        $this->usuario =$usuario;
        $this->token = $this->generarToken();

        $this->almacenarToken();

        $this->enviarEmail();
    }

        public function setUsuarioPorId(int $id)
        {
            $this->usuario = (new Usuario())->traerPorId($id);
        }

        public function setToken(string $token)
        {
            $this->token = $token;
        }

        /**
         * Verifica si este token corresponde a este usuario.
         *
         * @return bool
         * @todo Implementar
         */
        public function esValido()
        {
            return true;
        }

        /**
         * Verifica si este token está expirado.
         *
         * @return bool
         * @todo Implementar
         */
        public function expirado()
        {
            return false;
        }

        public function actualizarPassword(string $password)
        {
            // Noten que llamamos al editar password sobre el usuario que ya obtuvimos y tiene todos los
            // datos de la base. Por eso no necesito pasar el id, ya lo tiene.
            $this->usuario->editarPassword($password);

            $this->eliminarToken();
        }

        protected function eliminarToken()
        {
            $db = Conexion::getConexion();
            $query = "DELETE FROM recuperar_passwords
                WHERE usuarios_id = ?";
            $db->prepare($query)->execute([$this->usuario->getUsuarioId()]);
        }

        /**
         * Genera un token criptográficamente seguro.
         *
         * @return string
         */
        protected function generarToken(): string
        {
            $token = openssl_random_pseudo_bytes(32);

            return bin2hex($token);
        }

        protected function almacenarToken()
        {
            $db = Conexion::getConexion();
            $query = "INSERT INTO recuperar_passwords (usuarios_id, token, expiracion) 
                VALUES (:usuarios_id, :token, :expiracion)";
            $stmt = $db->prepare($query);

            $this->expiracion = new DateTime();
            $this->expiracion->modify('+1 hour');

            $stmt->execute([
                'usuarios_id' => $this->usuario->getUsuariosId(),
                'token' => $this->token,
                'expiracion' => $this->expiracion->format('Y-m-d H:i:s'),
            ]);
        }

        protected function enviarEmail()
        {

            $destinatario = $this->usuario->getEmail();
            $asunto = "Restablecer Password :: Saraza Basket";
            $cuerpo = "Estimado/a xxx
        
        Recibimos una solicitud para restablecer tu password en Saraza Basket.
        Si no fuiste vos, podés ignorar este email.
        
        Para restablecer tu password, ingresá al link:
        
        http://localhost/Programacion%20final/marbian-mariaflorencia/sitio/admin/index.php?v=actualizar-password&token=" . $this->token . "&usuario=" . $this->usuario->getUsuarioId() . "
        
        Saludos cordiales,
        Simpsoneras";

            $headers = "From: no-responder@simpsoneras.com" . "\r\n";

            if(!mail($destinatario, $asunto, $cuerpo, $headers)) {
                $filename = date('YmdHis_') . "recuperar-password_" . $this->usuario->getEmail() . ".txt";
                file_put_contents(__DIR__ . '/../emails fallidos/' . $filename, $cuerpo);
//            throw new \Exception();
            }
        }
    }