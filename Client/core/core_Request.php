<?php
class Request {

    // 1. Method
    // 2. Body
    private $__rules = [], $__message = [], $__errors = [];

    public $all;

    public function __construct() {
        $this->all = new Database('localhost','root','','thegioididong');
    }

    public function getMethod() {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    public function isPost() {
        if ($this->getMethod() == 'post') {
            return true;
        } else {
            return false;
        }
    }

    public function isGet() {
        if ($this->getMethod() == 'get') {
            return true;
        } else {
            return false;
        }
    }

    public function getField() {

        $dataFields = [];

        if($this->isGet()) {
            if(!empty($_GET)) {
                foreach($_GET as $key => $value) {
                    if(is_array($value)) {
                        $dataFields[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
                    } else {
                        $dataFields[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS/*, FILTER_REQUIRE_ARRAY*/);      
                    }
                }
            }
        }

        if($this->isPost()) {
            if(!empty($_POST)) {
                foreach($_POST as $key => $value) {
                    if(is_array($value)) {
                        $dataFields[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
                    } else {
                        $dataFields[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS/*, FILTER_REQUIRE_ARRAY*/);      
                    }
                }
            }
        }
        return $dataFields;
    }

    // set rules
    public function rules($rules = []) {
        $this->__rules = $rules;
    }

    // set message
    public function message($message = []) {
        $this->__message = $message;
    }

    // run validate
    public function validate() {

        $this->__rules = array_filter($this->__rules);

        $checkValidate = true;

        if(!empty($this->__rules)) {

            $dataFields = $this->getField();

            foreach($this->__rules as $fieldName => $rulesItem) {

                $rulesItemArr = explode('|',$rulesItem);

                foreach($rulesItemArr as $rules) {

                    $rulesName = '';
                    $rulesValue = '';

                    $rulesArr = explode(':',$rules);

                    $rulesName = reset($rulesArr);

                    if (count($rulesArr) > 1) {
                        $rulesValue = end($rulesArr);
                    }

                    if ($rulesName == 'required') {
                        if (empty(trim($dataFields[$fieldName]))) {
                            $this->setError($fieldName, $rulesName);
                            $checkValidate = false;
                        } 
                    } elseif ($rulesName == 'min') {
                        if (strlen(trim($dataFields[$fieldName])) < $rulesValue) {
                            $this->setError($fieldName, $rulesName);
                            $checkValidate = false;
                        } 
                    } elseif ($rulesName == 'max') {
                        if (strlen(trim($dataFields[$fieldName])) > $rulesValue) {
                            $this->setError($fieldName, $rulesName);
                            $checkValidate = false;
                        } 
                    } elseif ($rulesName == 'email') {
                        if (!filter_var(trim($dataFields[$fieldName]), FILTER_VALIDATE_EMAIL)) {
                            $this->setError($fieldName, $rulesName);
                            $checkValidate = false;
                        } 
                    } elseif ($rulesName == 'match') {
                        if (trim($dataFields[$fieldName]) != trim($dataFields[$rulesValue])) {
                            $this->setError($fieldName, $rulesName);
                            $checkValidate = false;
                        } 
                    } elseif ($rulesName == 'unique') {
                        if(!empty($rulesArr)) {

                            $tableName = null;
                            $fieldCheck = null;

                            if(!empty($rulesArr[1])) {
                                $tableName = $rulesArr[1];
                            }
                            if(!empty($rulesArr[2])) {
                                $fieldCheck = $rulesArr[2];
                            }
                            if(!empty($tableName) && !empty($fieldCheck)) {
                                if(count($rulesArr) == 3) {
                                    $checkExists = $this->all->select("")->table($tableName)->where($fieldCheck, "=" ,trim($dataFields[$fieldName]))->get();
                                } elseif (count($rulesArr) == 4) {

                                    if(!empty($rulesArr[3]) && preg_match('~.+?\=.+?~is', $rulesArr[3])) {

                                        $conditionwhere = $rulesArr[3];
                                        $conditionwhere = str_replace('=','<>',$conditionwhere);
                                    
                                        $checkExists = $this->all->select("")->table($tableName)->where($fieldCheck, "=" ,trim($dataFields[$fieldName]))->where($fieldCheck,"=",trim($dataFields[$fieldName]))->get();
                                    }
                                }
                                if (empty($checkExists)) {
                                    $this->setError($fieldName, $rulesName);
                                    $checkValidate = false;
                                } else {
                                    return true;
                                }
                                
                            } else {
                                return false;
                            }
                        }
                    }

                    // callback check 
                    if (preg_match('~^callback_(.+)~is', $rulesName, $callbackArr)) {
                        if(!empty($callbackArr[1])) {
                            $callbackName = $callbackArr[1];
                            if (method_exists(App::$app->getCurrentController(), $callbackName)) {
                                $checkCallback = call_user_func_array([App::$app->getCurrentController(), $callbackName],[trim($dataFields[$fieldName])]);
                            }
                            if($checkCallback == false) {
                                $this->setError($fieldName, $rulesName);
                                $checkValidate = false;
                            }
                        }
                    }
                }
            }
        }

        // $sessionKey = Session::isInvalidSS();
        // Session::dataSS($sessionKey .'__errors',$this->errors());
        // Session::dataSS($sessionKey .'__old',$this->getField());
        else {
            return $checkValidate;
        }
    }

    // get error
    public function errors($fieldName = '') {
        if(!empty($this->__errors)) {
            if (empty($fieldName)) {
                $errorsArr = [];
                foreach($this->__errors as $key => $error) {
                    $errorsArr[$key] = reset($error);
                }
                return $errorsArr;
            } else { 
                return reset($this->__errors[$fieldName]);
            } 
        } else {
            return false;
        }
    }

    public function setError($fieldName, $rulesName) {
        $this->__errors[$fieldName][$rulesName] = $this->__message[$fieldName .'.' .$rulesName];
    }
}