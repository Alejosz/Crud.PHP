<?php

class Conexion extends PDO
{
    private $hostBd = "localhost";
    private $userBd = "root";
    private $passwordBd = "";
    private $nameBd="Datos_Alejo";


    public function __construct()
    {
        try {
            parent::__construct('mysql:host=' . $this->hostBd . ';dbname=' . $this->nameBd . ';charset=utf8', $this->userBd, $this->passwordBd, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        } catch (PDOException $e) {
            echo 'error:' . $e->getMessage();
            exit;
        }
    }
}

?>
