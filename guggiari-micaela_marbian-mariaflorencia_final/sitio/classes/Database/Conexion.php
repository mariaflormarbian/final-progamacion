<?php

namespace DaVinci\Database;

use PDO;
use Exception;

class  Conexion
{

    public const DB_HOST = '127.0.0.1';
    public const DB_USER = 'root';
    public const DB_PASS = '';
    public const DB_BASE = 'dw3_guggiari_marbian';
    public const DB_DSN = 'mysql:host=' . self::DB_HOST . ';dbname=' . self::DB_BASE . ';charset=utf8mb4';

    protected static ?PDO $db = null;

    private static function conectar()
    {
        try {
            self::$db = new PDO(self::DB_DSN, self::DB_USER, self::DB_PASS);
            self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
            die ('Error al conectar con MySQL');
        }
    }

    public static function getConexion(): PDO
    {
        if(self::$db === null) {
            self::conectar();
        }

        return self::$db;
    }
}