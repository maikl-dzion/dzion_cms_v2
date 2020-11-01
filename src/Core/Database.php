<?php

namespace Dzion\Core;

use PDO;
use PDOException;
use Dzion\Interfaces\DatabaseInterface;

class Database implements DatabaseInterface
{

    protected $pdo;
    public    $query;
    protected $config;

    public function __construct($config = [])
    {
        $this->config = $config;
        $this->connect();
    }

    public function connect()
    {
        $port    = 3306;
        $charset = 'utf8';

        $config = $this->config;

        $driver = $config['driver'];
        $host   = $config['host'];
        $dbName = $config['dbname'];
        if(!empty($config['port']))
           $port   = $config['port'];
        if(!empty($config['charset']))
            $charset   = $config['charset'];

        $user = $config['user'];
        $password = $config['password'];

        //$dsn = "{$driver}:host={$host};port={$port};dbname={$dbName};charset={$charset}";
        $dsn = "{$driver}:host={$host};port={$port};dbname={$dbName};";

        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            // PDO::ATTR_EMULATE_PREPARES => FALSE
        ];

        try {

            $this->pdo = new PDO($dsn, $user, $password, $options);

        } catch (PDOException $e) {

            exit('Error connecting to database: ' . $e->getMessage());

        }

    }

//    /**
//     * Добавление в таблицу, в случаи успеха вернет вставленный ID, иначе 0.
//     */
//    public static function add($query, $param = array())
//    {
//        self::$sth = self::getDbh()->prepare($query);
//        return (self::$sth->execute((array) $param)) ? self::getDbh()->lastInsertId() : 0;
//    }
//
//    /**
//     * Выполнение запроса.
//     */
//    public static function set($query, $param = array())
//    {
//        self::$sth = self::getDbh()->prepare($query);
//        return self::$sth->execute((array) $param);
//    }
//
//    /**
//     * Получение строки из таблицы.
//     */
//    public static function getRow($query, $param = array())
//    {
//        self::$sth = self::getDbh()->prepare($query);
//        self::$sth->execute((array) $param);
//        return self::$sth->fetch(PDO::FETCH_ASSOC);
//    }
//
//    /**
//     * Получение всех строк из таблицы.
//     */
//    public static function getAll($query, $param = array())
//    {
//        self::$sth = self::getDbh()->prepare($query);
//        self::$sth->execute((array) $param);
//        return self::$sth->fetchAll(PDO::FETCH_ASSOC);
//    }
//
//    /**
//     * Получение значения.
//     */
//    public static function getValue($query, $param = array(), $default = null)
//    {
//        $result = self::getRow($query, $param);
//        if (!empty($result)) {
//            $result = array_shift($result);
//        }
//
//        return (empty($result)) ? $default : $result;
//    }
//
//    /**
//     * Получение столбца таблицы.
//     */
//    public static function getColumn($query, $param = array())
//    {
//        self::$sth = self::getDbh()->prepare($query);
//        self::$sth->execute((array) $param);
//        return self::$sth->fetchAll(PDO::FETCH_COLUMN);
//    }


}