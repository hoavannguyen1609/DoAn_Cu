<?php 
class Routes {
    private $keyRoute = null, $__url;
    function handleRoute($url) {
        global $routes;
        unset($routes['default_controller']);
        $url = trim($url,'/');
        $handleUrl = $url;
        if (!empty($routes)) {
            foreach ($routes as $key => $value) {
                if (preg_match('~'.$key.'~is',$url)) {
                    $handleUrl = preg_replace('~'.$key.'~is',$value,$url);
                    $this->keyRoute = $key;
                }
            }
        }
        return $handleUrl;
    }

    public function getUri() {
        return $this->keyRoute;
    }

    static function getFullUrl() {
        $url = _WEB_ROOT .App::$app->getUrl();
        return $url;
    }
}