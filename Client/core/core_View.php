<?php
class Views {
    static public $dataShare = [];
    static public function viewShare($data) {
        if(!empty($data)) {
            self::$dataShare = $data;
        }
    }
}