<?php
session_start();

require __DIR__ . '/../vendor/autoload.php';

use App\Usuario;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class DaoLogin
{
    private $conexion;

    public function __construct()
    {
        $this->getConexion();
    }

    //Metodo que me permite iniciar SESSION
    public function login($obj): array
    {

        $usuario = new Usuario();
        $usuario->setEmail($obj->email);
        $usuario->setPassword($obj->pass);

        try {
            $conexion = $this->conexion;
            $stmt = $conexion->prepare(OBTENER_USUARIOS);
            $stmt->execute();
            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $users = $this->desencriptarEmail($resultados);
            if ($this->verificarInformacion($users, $usuario)) {
                return ['resultado' => 1];
            }
        } catch (PDOException $e) {
            die("Error en la consulta: " . $e->getMessage());
        }

        return ['resultado' => 0];
    }

    //metodo que me permite desencriptar el correo de cada usuario
    private function desencriptarEmail($usuarios)
    {
        $encriptacion = new Encriptacion();

        foreach ($usuarios as &$usuario) {
            $usuario['email'] = $encriptacion->desencriptar($usuario['email']);
        }

        return $usuarios;
    }

    //verifica si las credenciales ingresadas coinciden con los registros de la db
    private function verificarInformacion($usuarios, $usuario)
    {
        foreach ($usuarios as $row) {
            if ($row['email'] == $usuario->getEmail() &&  password_verify($usuario->getPassword(), $row['password'])) {
                $_SESSION['user'] = $row['vendedor'];
                $_SESSION['rol'] = $row['rol'];
                $_SESSION['email'] = $row['email'];
                return true;
            }
        }

        return false;
    }

    private function verificarEmail($usuarios, $usuario)
    {
        foreach ($usuarios as $row) {
            if ($row['email'] == $usuario->getEmail()) {
                return $row['id'];
            }
        }

        return null;
    }

    //metodo que me permite recuperar el acceso a la cuenta
    public function recuperar($obj): array
    {

        $usuario = new Usuario();
        $usuario->setEmail($obj->email);

        if($usuario->getEmail() == null || $usuario->getEmail() == "") {
            return ['resultado' => 6];
        }

        try {
            $conexion = $this->conexion;
            $stmt = $conexion->prepare(OBTENER_USUARIOS);
            $stmt->execute();
            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $users = $this->desencriptarEmail($resultados);
            $idUsuario = $this->verificarEmail($users, $usuario);
            $_SESSION['idUsuarioUpdate'] = $idUsuario;

            if (is_null($idUsuario)) {
                return ['resultado' => 3];
            }
            $this->enviarToken($usuario->getEmail());
        } catch (PDOException $e) {
            die("Error en la consulta: " . $e->getMessage());
        }

        return ['resultado' => 4];
    }

    public function enviarToken($correo)
    {
        $mail = new PHPMailer(true);
        $token = bin2hex(random_bytes(32 / 2));
        $_SESSION['token'] = $token;
        $_SESSION['tiempo'] = time();

        try {
            //Server settings
            $mail->SMTPDebug = 0;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'zapateriajadezsv@gmail.com';                     //SMTP username
            $mail->Password   = 'klfesiwpfbkefuyu';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            $mail->CharSet = 'UTF-8';

            //Recipients
            $mail->setFrom('zapateriajadezsv@gmail.com', 'Zapateria JADEZ');
            $mail->addAddress($correo);     //Add a recipient

            //Content
            $mail->isHTML(true);   
            $mail->Subject = 'Restablecer contraseña';                               //Set email format to HTML

            $ruta = '../utils/token.html';

            $file = fopen($ruta, "r");
            $str = fread($file, filesize($ruta));
            $str = trim($str);
            fclose($file);

            $str = str_replace('%token%', $token, $str);

            $mail->Body = $str;

            $mail->send();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

        return;
    }

     //metodo que me permite cambiar la contraseña
     public function cambiar($obj, $id): array
     {
 
         $usuario = new Usuario();

         $pass = $obj->password;
         $passwordHash = password_hash($pass, PASSWORD_DEFAULT);

         $usuario->setPassword($passwordHash);
 
         try {
             $conexion = $this->conexion;
             $stmt = $conexion->prepare(CAMBIAR_PASSWORD);
             $stmt->bindValue(":password", $usuario->getPassword());
             $stmt->bindValue(":id", $id, PDO::PARAM_INT);
             
             if($stmt->execute()) {
                unset($_SESSION['token']);
                unset($_SESSION['tiempo']);
                return ["resultado" => 5];
             }
             
         } catch (PDOException $e) {
             die("Error en la consulta: " . $e->getMessage());
         }
 
         return ['resultado' => 9];
     }

    //Metodo que permite obtener la conexion
    public function getConexion()
    {
        require_once ROOT_PATH .'/config/Conexion.php';
        $conexion = new Conexion();
        $this->conexion = $conexion->getConexion();
    }
}
