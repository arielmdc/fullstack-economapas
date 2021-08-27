<?php 

class Conexao{

    public static function Connect(){

        $opcoes = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
        $connect = new PDO("mysql:host=localhost;dbname=economapas", 'root', '123456', $opcoes); 
        return $connect;
    }
}