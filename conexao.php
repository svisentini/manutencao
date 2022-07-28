<?php

class Banco {

    // -----------------------------------------------
    // LOCAL
    //private static $dbNome = 'manutencao-db-php';
    //private static $dbHost = '127.0.0.1';
    //private static $dbUsuario = 'root';
    //private static $dbSenha = '';
    // -----------------------------------------------
    // PROD
    private static $dbNome = '380267';
    private static $dbHost = '127.0.0.1';
    private static $dbUsuario = '380267';
    private static $dbSenha = 'SVfreeweb1!';
    // -----------------------------------------------
    
    private static $cont = null;
    private static $conexao = null;
    
    public function __construct() 
    {
        die('A função Init nao é permitido!');
    }

    public static function conectar() {
        self::$conexao = mysqli_connect(self::$dbHost, self::$dbUsuario, self::$dbSenha, self::$dbNome) or die ('Não foi possível conectar');
        return self::$conexao; 
    }


    public static function conectar_consulta(){
        if(null == self::$cont){
            try{
                self::$cont =  new PDO( "mysql:host=".self::$dbHost.";"."dbname=".self::$dbNome, self::$dbUsuario, self::$dbSenha); 
            }
            catch(PDOException $exception){
                die($exception->getMessage());
            }
        }
        return self::$cont;
    }

    public static function desconectar(){
        self::$cont = null;
    }

}
?>