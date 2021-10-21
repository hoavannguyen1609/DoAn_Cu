<?php
abstract class core_Model extends Database {
    
    protected $all;

    public function __construct() {
        $this->all = new Database();
    }
}