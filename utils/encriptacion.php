<?php 

class Encriptacion {
    private $key;
    private $iv;

    public function __construct() {
        //$this->key = openssl_random_pseudo_bytes(32); // Clave secreta de 256 bits
        $this->key = 'your-secure-key-32-bytes';
        $this->iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
    }

    function encriptar( $data ) {
        $encriptado =  openssl_encrypt($data, 'aes-256-cbc', $this->key, 0, $this->iv);
        return base64_encode($encriptado . '::' . $this->iv);
    }

    /*function desencriptar( $data ) {
        list($dato, $this->iv) = explode('::', base64_decode($data), 2);
        return openssl_decrypt($dato, 'aes-256-cbc', $this->key, 0, $this->iv);
    }*/

    function desencriptar($data) {
        $decodedData = base64_decode($data);
        $parts = explode('::', $decodedData, 2);

        // Verificar que explode retorne dos partes, si no, retornar null o manejar el error
        if (count($parts) === 2) {
            list($dato, $iv) = $parts;
            return openssl_decrypt($dato, 'aes-256-cbc', $this->key, 0, $iv);
        } else {
            // Manejar el caso donde el formato es incorrecto
            return null; // o lanza una excepción o mensaje de error
        }
    }
}
?>