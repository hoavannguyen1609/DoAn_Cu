<?php
class Session {
    /* 
    - data($key, $value) => set
    - data($key) => getsession
    */
    static function dataSS($key = '', $value = '') {
       $sessionKey = self::isInvalidSS();
        if(!empty($value)) {
            if(!empty($key)) {
                $_SESSION[$sessionKey][$key] = $value; //set session
                return true;
            } else {
                return false;
            }
        } else {
            if(!empty($key)) {
                if(isset($_SESSION[$sessionKey][$key])) {
                    return $_SESSION[$sessionKey][$key]; // get session
                }
            } else {
                return $_SESSION[$sessionKey];
            }
        }
    }

    /* 
    - delete($key) => xóa session với $key
    - delete() => xóa hết session
    */

    static function deleteSS($key = '') {
       $sessionKey = self::isInvalidSS();
        if(!empty($key)) {
            if(isset($_SESSION[$sessionKey][$key])) {
                unset($_SESSION[$sessionKey][$key]);
                return true;
            } else {
                return false;
            }
        } else {
            unset($_SESSION[$sessionKey]);
            return true;
        }
        return false;
    }

    /**
     * flash data
     * - set flash data => giống set session
     * - get flash data => giống get session, xóa luôn sau khi get session
     */

    static function flashSS($key = '', $value = '') {
        // $dataFlash = Session::dataSS($key,$value);
        if(!empty($value)) {
            if(!empty($key)) {
                self::dataSS($key,$value);
                return true;
            } else {
                return false;
            }
        } else {
            if(!empty($key)) {
                self::deleteSS($key);
                return true;
            } else {
                self::deleteSS();
                return true;
            }
        }
    }

    static function showErrors($message) {
        $data = ['message' => $message];
        App::$app->loadErrorData('Exception',$data);
        die();
    }

    static function isInvalidSS() {

        global $config;
        
        if (!empty($config['session'])) {
            $sessionConfig = $config['session'];
            if(!empty($sessionConfig['session_key'])) {
                $sessionKey = $sessionConfig['session_key'];
                return $sessionKey;
            } else {
                self::showErrors('Thiếu cấu hình Session. Vui lòng kiểm tra file onfig/config_session.php!');
            }
        } else {
            self::showErrors('Thiếu cấu hình session_key. Vui lòng kiểm tra file config/config_session.php!');
        }
    }
}