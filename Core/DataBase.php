<?php

/**
 * Created by PhpStorm.
 * User: vlad
 * Date: 10.05.17
 * Time: 18:45
 */
namespace MVS\MyEduProject\Core;
use \Exception;
use \PDO;
class DataBase
{
    const DEFAULT_CONNECTION = '';
    public static $instance;
    protected $connectionName;
    protected $connection;

    /**
     * @param string $nameDb
     * @return DataBase
     */
    public static function getInstance($nameDb = self::DEFAULT_CONNECTION) {

        if (self::$instance === null || self::$instance->connection != $nameDb) {
            self::$instance = new self($nameDb);
        }

        return self::$instance;
    }

    private function  __clone(){}
    private function __wakeup(){}

    /**
     * DataBase constructor.
     * @param string $nameDb
     */
    private function __construct($nameDb){
        $config  = Config::getInstance();

        if (!array_key_exists($nameDb, $config->get('db'))) {
            throw new Exception('DB connection doesn\'t exist');
        }

        $this->connectionName = $nameDb;
        $db = $config->get('db')[$nameDb];

        $this->connection = new PDO(
            'mysql:host='
                . $db['host']
                . ';dbname='
                . $db['dbname']
                . ';charset='
                . $db['charset'],
            $db['login'],
            $db['pass']
        );

    }

    public function getConnection(){
        return $this->connection;
    }

}