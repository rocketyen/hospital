<?php
require_once (dirname(__FILE__).'/../config/config.php');
class Database
{
    public static function connect()
    {

        try {
            $pdo = new PDO(DSN, LOGIN, PASSWORD);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }
}