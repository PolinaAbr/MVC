<?php

final class DB {
    private $tables = array();
    private  static $instance = null;

    private function __construct() {

    }

    protected function __clone() {

    }

    function getTable($name) {
        if ($this->tables[$name]) {
            return $this->tables[$name];
        } else {
            $this->tables[$name] = new $name."Table"();
            return new $this->tables[$name];
        }
    }

    static public function getInstance() {
        if(is_null(self::$instance))
        {
            self::$instance = new static();
        }
        return self::$instance;
    }
}

abstract class Table {
    abstract function add();
    abstract function update();
    abstract function  delete();
    abstract function getList();
}

$user = DB::getTable("user");