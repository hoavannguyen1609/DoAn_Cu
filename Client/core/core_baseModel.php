<?php
class baseModels {

    public $all;

    public function baseModel($model) {
        if (file_exists(_DIR_ROOT.'/app/models/'.$model.'.php')) {
            require_once _DIR_ROOT.'/app/models/'.$model.'.php';
            if (class_exists($model)) {
                $model = new $model();
                return $model;
            }
        }
        return false;
    }

    public function render($view, $data = []) {
        
        if(!empty(Views::$dataShare)) {
            $data = array_merge($data,Views::$dataShare);
        }
        
        extract($data);

        $contentView = null;

        if (preg_match('~^layouts~', $view)){

            if (file_exists(_DIR_ROOT.'/app/views/'.$view.'.php')){
                require_once _DIR_ROOT.'/app/views/'.$view.'.php';
            }

        }else{
            if (file_exists(_DIR_ROOT.'/app/views/'.$view.'.php')){
                $contentView = file_get_contents(_DIR_ROOT.'/app/views/'.$view.'.php');
            }

            $template =  new Template();
            $template->run($contentView, $data);
        }
    }

    public function removeSc($string) {
        if(!empty($string)) {
            $string = str_replace('+',' ',$string);
            // $string = str_replace('')
            return $string;
        }
    }
}