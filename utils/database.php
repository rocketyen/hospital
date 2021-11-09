<?php
require_once(dirname(__FILE__) . '/../config/config.php');
class Database
{
    private static $pdo;

    public static function connect()
    {

        try {
            if (is_null(self::$pdo)) {

                self::$pdo = new PDO(DSN, LOGIN, PASSWORD);
                self::$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            }
            return self::$pdo;
            
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
    
}

