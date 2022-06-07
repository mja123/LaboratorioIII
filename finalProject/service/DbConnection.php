<?php
class DbConnection {

    private $connection;
    private static $instance; 
    private $options;

    private function __construct() {
        
        $this->options = array(
            PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_EMULATE_PREPARES => FALSE, 
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
        ); 

        try{
            $this->connection = new PDO(getenv("URL"), getenv("USERNAME"), getenv("PASSWORD"), $this->options);         
        } catch(PDOException $e) {
            echo "Problemas al conectar la base de datos: $e"; 
        }
    }

    public static function getInstance() {
        if (!self::$instance instanceof self) {        
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->connection;
    }
}
?>