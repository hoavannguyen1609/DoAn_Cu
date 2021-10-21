<?php
class load {
    static function basemodel($model) {
        if (file_exists(_DIR_ROOT.'/app/models/'.$model.'.php')) {
            require_once _DIR_ROOT.'/app/models/'.$model.'.php';
            if (class_exists($model)) {
                $model = new $model();
                return $model;
            }
        }
        return false;
    }

    static function render($view, $data = []) {

        if(!empty(Views::$dataShare)) {
            $data = array_merge($data,Views::$dataShare);
        }
        // extract chuyển $key thành biến
        extract($data);
        if (file_exists(_DIR_ROOT.'/app/views/'.$view.'.php')) {
            require_once _DIR_ROOT.'/app/views/'.$view.'.php';
        }
    }
}