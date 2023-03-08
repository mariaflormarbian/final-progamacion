<?php
namespace DaVinci\Auth;
use DateTime;
use DaVinci\Modelos\Usuario;
use DaVinci\Database\Conexion;

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
        $this->editarPassword($password);
        $this->eliminarToken();
    }

    protected function eliminarToken()
    {
        $db = Conexion::getConexion();
        $query = "DELETE FROM recuperar_passwords
            WHERE usuarios_id = ?";
        $db->prepare($query)->execute([$this->getUsuarioId()]);
    }

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
        $asunto = "Restablecer Password :: Simpsoneras";
        $cuerpo = "Estimado/a xxx
    
        Recibimos una solicitud para restablecer tu password en Simpsoneras.
        Si no fuiste vos, podés ignorar este email.
        
        Para restablecer tu password, ingresá al link:
        
        http://localhost/Github/Parcial%20Brian%20tp%203/final-progamacion/guggiari-micaela_marbian-mariaflorencia_final/sitio/admin/index.php?v=actualizar-password&token=" . $this->token . "&usuario=" . $this->usuario->getUsuariosId() . "
        
        Saludos cordiales,
        Simpsoneras";

        $headers = "From: no-responder@simpsoneras" . "\r\n";

        if(!mail($destinatario, $asunto, $cuerpo, $headers)) {
            // Si no se puede mandar, vamos a guardarlo en un archivo de texto para poder ver cómo queda.
            $filename = date('YmdHis_') . "recuperar-password_" . $this->usuario->getEmail() . ".txt";
            file_put_contents(__DIR__ . '/../../emails-fallidos/' . $filename, $cuerpo);
            // throw new \Exception();
        }
    }
}