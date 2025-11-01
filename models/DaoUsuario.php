<?php

require __DIR__ . '/../vendor/autoload.php';

use App\Proveedor;
use App\Usuario;
use App\Vendedor;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class DaoUsuario
{
    private $conexion;

    public function __construct()
    {
        $this->getConexion();
    }

    //Metodo que me permite obtener todos los proveedores
    public function read(): array
    {
        require_once __DIR__ . '/../route.php';
        include ROOT_PATH . '/utils/proveedor/consultasProveedor.php';

        $arrayProveedores = array();

        try {
            $conexion = $this->conexion;
            $stmt = $conexion->prepare(LISTADO_PROVEEDORES);
            $stmt->execute();
            $array = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($array as $row) {
                $proveedor = new Proveedor(
                    $row['id'],
                    $row['nombre'],
                    $row['telefono'],
                    $row['email'],
                    $row['direccion']
                );

                array_push($arrayProveedores, $proveedor);
            }

            return $arrayProveedores;
        } catch (PDOException $e) {
            die("Error en la consulta: " . $e->getMessage());
        }

        return null;
    }

    //metodo que permite almacenar un usuario
    public function save($email): array
    {
        $dao = new DaoVendedor();
        $vendedor = new Vendedor();
        $usuario = new Usuario();
        $encriptacion = new Encriptacion();

        $vendedor = $dao->lastRecord();

        $password = $this->generarContrasena();
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $emailEnviar = $email;
        $email = $encriptacion->encriptar($email);

        $usuario->setEmail($email);
        $usuario->setPassword($passwordHash);
        $usuario->setVendedor($vendedor->getId());
        $usuario->setRol('2');

        try {
            $conexion = $this->conexion;
            $stmt = $conexion->prepare(NUEVO_USUARIO);
            $stmt->bindValue(":email", $usuario->getEmail(), PDO::PARAM_STR);
            $stmt->bindValue(":password", $usuario->getPassword(), PDO::PARAM_STR);
            $stmt->bindValue(":vendedor", $usuario->getVendedor(), PDO::PARAM_STR);
            $stmt->bindValue(":rol", $usuario->getRol(), PDO::PARAM_INT);

            if ($stmt->execute()) {
                $this->enviarCorreo($password, $emailEnviar);
                return ['resultado' => 1];
            }
        } catch (PDOException $e) {
            die("Error al insertar usuario: " . $e->getMessage());
        }


        return ['resultado' => 0];
    }

    private function enviarCorreo($password, $email)
    {
        $mail = new PHPMailer(true);

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
            $mail->addAddress($email);     //Add a recipient

            //Content
            $mail->isHTML(true);
            $mail->Subject = 'Información importante';                               //Set email format to HTML

            $ruta = '../utils/credenciales.html';

            $file = fopen($ruta, "r");
            $str = fread($file, filesize($ruta));
            $str = trim($str);
            fclose($file);

            $str = str_replace('%pass|%', $password, $str);

            $mail->Body = $str;

            $mail->send();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

        return;
    }

    //genera la contraseña del usuario
    function generarContrasena($longitud = 12)
    {
        $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()';
        $caracteresLongitud = strlen($caracteres);
        $contrasena = '';

        for ($i = 0; $i < $longitud; $i++) {
            $contrasena .= $caracteres[random_int(0, $caracteresLongitud - 1)];
        }

        return $contrasena;
    }

    //metodo que me permite modifiar un proveedor
    public function update($obj, $id): array
    {
        require_once __DIR__ . '/../route.php';
        include ROOT_PATH . '/utils/proveedor/consultasProveedor.php';
        include ROOT_PATH . '/utils/validar.php';

        $proveedor = new Proveedor();
        $proveedor->setNombre($obj->nombre);
        $proveedor->setTelefono($obj->telefono);
        $proveedor->setEmail($obj->email);
        $proveedor->setDireccion($obj->direccion);

        try {
            $conexion = $this->conexion;
            $bandera = validarProveedorModificar($proveedor, $conexion, $id);

            if (isset($bandera)) {
                return $bandera;
            }

            $stmt = $conexion->prepare(MODIFICAR_PROVEEDOR);
            $stmt->bindValue(":nombre", $proveedor->getNombre(), PDO::PARAM_STR);
            $stmt->bindValue(":telefono", $proveedor->getTelefono(), PDO::PARAM_STR);
            $stmt->bindValue(":email", $proveedor->getEmail(), PDO::PARAM_STR);
            $stmt->bindValue(":direccion", $proveedor->getDireccion(), PDO::PARAM_STR);
            $stmt->bindValue(":id", $id, PDO::PARAM_INT);

            if ($stmt->execute()) {
                return ['resultado' => 1];
            }

            return false;
        } catch (PDOException $e) {
            die("Error al modificar: " . $e->getMessage());
        }

        return ['resultado' => 0];
    }

    //metodo que me permite eliminar un proveedor
    public function delete($id): array
    {
        require_once __DIR__ . '/../route.php';
        include ROOT_PATH . '/utils/proveedor/consultasProveedor.php';

        try {
            $conexion = $this->conexion;
            $stmt = $conexion->prepare(ELIMINAR_PROVEEDOR);
            $stmt->bindParam(":id", $id);

            if ($stmt->execute()) {
                return ['resultado' => 1];
            }

            return false;
        } catch (PDOException $e) {
            die("Error al eliminar proveedor: " . $e->getMessage());
        }

        return ['resultado' => 0];
    }

    //metodo que me permite obtener un proveedor en especifico
    public function findById($id): Proveedor
    {
        require_once __DIR__ . '/../route.php';
        include ROOT_PATH . '/utils/proveedor/consultasProveedor.php';

        try {
            $conexion = $this->conexion;
            $stmt = $conexion->prepare(SELECCIONAR_PROVEEDOR);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            $array = $stmt->fetch(PDO::FETCH_ASSOC);

            $proveedor = new Proveedor($array['id'], $array['nombre'], $array['telefono'], $array['email'], $array['direccion']);

            return $proveedor;
        } catch (PDOException $e) {
            die("Error al obtener un registro: " . $e->getMessage());
        }

        return null;
    }

    //Metodo que permite obtener la conexion
    public function getConexion()
    {
        $conexion = new Conexion();
        $this->conexion = $conexion->getConexion();
    }
}
