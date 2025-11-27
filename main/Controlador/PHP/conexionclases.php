<?php


//creamos una clase
class Conexion{
    //Creamos las variables atributos de la clase
    private $servidor = "localhost";
    private $bd = "Mindshare";
    private $usuario = "root";
    private $pass = "rosquin987";
    private $charset = "utf8mb4";


    protected $pdo;

    //Creamos una funcion publica para establecer las conexiones 

    public function __construct(){
       try{
            $dsn="mysql:host={$this->servidor}; dbname={$this->bd}; charset={$this->charset}";
            $this->pdo = new PDO($dsn, $this->usuario, $this->pass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        
       }
       catch(PDOException $ex){
        die("Error al conectar ". $ex->getMessage());
       }
    }

    public function getConexion() {
        return $this->pdo;
    }
    
        
    
}
?>