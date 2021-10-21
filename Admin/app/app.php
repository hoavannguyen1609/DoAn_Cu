<?php 
class App {

    private $__controller, $__action, $__params, $__routes, $__all, $__request;

    static public $app;

    public function __construct() {

        global $routes;

        self::$app = $this;

        $this->__routes = new Routes();
        if (!empty($routes['default_controller'])) {
            $this->__controller = $routes['default_controller'];
        }
        $this->__action = 'index';
        $this->__params = [];

        if(class_exists('DB')) {
            
            $dbObject = new DB();

            $this->__all = $dbObject->all;
        }
        
        $this->handleUrl();
    }

    // $_SERVER[] URL
    function getUrl() {
        if (!empty($_SERVER['PATH_INFO'])) {
            $url = $_SERVER['PATH_INFO'];
        } else {
            $url = "/";
        }
        return $url;
    }

    function handleUrl() {
        $url = $this->getUrl();
        $url = $this->__routes->handleRoute($url);

        $this->handleGlobalMiddleware($this->__all);
        $this->handleRouteMiddleware($this->__routes->getUri(),$this->__all );

        $this->handleAppServiceProvider($this->__all);

        $urlArray = array_filter(explode('/',$url));
        $urlArray = array_values($urlArray);

        $urlCheck = '';
        if (!empty($urlArray)) {
            foreach ($urlArray as $key => $value) {
                $urlCheck .= $value.'/';
                $fileCheck = rtrim($urlCheck,'/');
                $fileArr = explode('/',$fileCheck);
                $fileArr[count($fileArr)-1] = ucfirst('C_' .$fileArr[count($fileArr)-1]);
                $fileCheck = implode('/',$fileArr);
                if (!empty($urlArray[$key - 1])) {
                    unset($urlArray[$key - 1]);
                }
                if (file_exists('app/controllers/'.($fileCheck).'.php')) {
                    $urlCheck = $fileCheck;
                    break;
                }
            }
            $urlArray = array_values($urlArray);
        }


        // Xử lý controller
        if (!empty($urlArray[0])) {
            $this->__controller = 'C_' .$urlArray[0];
        } else {
            $this->__controller = $this->__controller;
        }

        if ($urlCheck == '') {
            $urlCheck = $this->__controller;
        }

        if (file_exists("app/controllers/".$urlCheck.".php")) {
            require_once "app/controllers/".$urlCheck.".php";

            if (class_exists($this->__controller)) {
                $this->__controller = new $this->__controller();
                unset($urlArray[0]);
                if (!empty($this->__all)) {
                    $this->__controller->all = $this->__all;
                }
            }
            else {
                $this->loadError("404");
            }
        }
        else {
            $this->loadError("404");
        }
        // Xử lý action
        if (!empty($urlArray[1])) {
            $this->__action = $urlArray[1];
            unset($urlArray[1]);
        }

        // Xử lý __params
        $this->__params = array_values($urlArray);

        if (method_exists($this->__controller, $this->__action)) {
            call_user_func_array([$this->__controller, $this->__action], $this->__params);
        }
        else {
            $this->loadError("404");
        }
    }

    public function handleRouteMiddleware($keyRoute, $all) {
        global $config;
        $keyRoute = trim($keyRoute);
        if(!empty($config['app']['routeMiddleware'])) {
            $allRouteMiddleware = $config['app']['routeMiddleware'];
            if(!empty($allRouteMiddleware)) {
                foreach($allRouteMiddleware as $key => $routeMiddlewareFile) {
                    if($keyRoute == trim($key) && file_exists("app/middlewares/" .$routeMiddlewareFile .".php")) {
                        require_once('app/middlewares/' .$routeMiddlewareFile .'.php');
                        if(class_exists($routeMiddlewareFile)) {
                            $routeMiddlewareObject = new $routeMiddlewareFile();
                            if(!empty($all)) {
                                $routeMiddlewareObject->all = $all;
                            }
                            $routeMiddlewareObject->handle();
                        }
                    }
                }
            }
        }
    }

    public function handleGlobalMiddleware($all) {
        global $config;
        if(!empty($config['app']['globalMiddleware'])) {
            $globalMiddleware = $config['app']['globalMiddleware'];
            if(!empty($globalMiddleware)) {
                foreach($globalMiddleware as $globalMiddlewareFile) {
                    if(file_exists('app/middlewares/' .$globalMiddlewareFile .'.php')) {
                        require_once('app/middlewares/' .$globalMiddlewareFile .'.php');
                        if(class_exists($globalMiddlewareFile)) {
                            $globalMiddlewareObject = new $globalMiddlewareFile();
                            if(!empty($all)) {
                                $globalMiddlewareObject->all = $all;
                            }
                            $globalMiddlewareObject->handle();
                        }
                    }
                }
            }
        }
    }

    public function handleAppServiceProvider($all) {
        global $config;
        if(!empty($config['app']['boot'])) {
            $bootArr = $config['app']['boot'];
            if(!empty($bootArr)) {
                foreach($bootArr as $bootName) {
                    if(file_exists('app/coreHelper/' .$bootName .'.php')) {
                        require_once('app/coreHelper/' .$bootName .'.php');
                        if(class_exists($bootName)) {
                            $bootObject = new $bootName();
                            if(!empty($all)) {
                                $bootObject->all = $all;
                            }
                            $bootObject->boot();
                        }
                    }
                }
            }
        }
    }

    public function getCurrentController() {
        return $this->__controller;
    }

    function loadError($name) {
        require_once "errors/error".$name.".php";
    }

    function loadErrorData($name,$data = []) {
        extract($data);
        require_once "errors/error".$name.".php";
    }
}