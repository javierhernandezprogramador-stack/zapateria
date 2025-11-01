<?php 

class Conexion {
    private $host = 'localhost';
    private $dbName = 'zapateria';
    private $userName = 'root';
    private $password = 'root';
    private $charset = 'utf8mb4';   
    private $pdo;

    public function __construct() {
        $this->conectar();
    }

    public function conectar() {
        try {
            $dsn = "mysql:host={$this->host};dbname={$this->dbName};charset={$this->charset}";
            $this->pdo = new PDO($dsn, $this->userName, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        }catch(PDOException $e) {
            die("Error en la conexion: " . $e->getMessage());
        }
    }

    public function getConexion() {
        return $this->pdo;
    }

    public function desconectar() {
        $this->pdo = null;
    }
}