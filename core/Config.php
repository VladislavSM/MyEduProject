<?php

/**
 * Created by PhpStorm.
 * User: vlad
 * Date: 12.05.17
 * Time: 13:14
 */

namespace core;

use DirectoryIterator;

class Config
{
    protected $configs;
    private static $instance;

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self;
        }
        return self::$instance;
    }
    private function __clone() {
    }
    private function __wakeup() {
    }

    private function __construct() {
        $path = APP_PATH  . 'config';
        $iterator = new DirectoryIterator($path);

        foreach ($iterator as $file) {
            if ($file->isFile()) {
                $this->configs[$file->getBasename('.php')] = require_once $file->getPathname();
            }
        }

    }

    /**
     * @param string $name
     * @return bool
     */
    public function get($name = '') {
        $result = [];
        if ('' === $name) {
           $result = $this->configs;
        } elseif (array_key_exists($name, $this->configs)) {
           $result = $this->configs[$name];
        }
        return $result;
    }






}


