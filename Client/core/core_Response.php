<?php
class Response {
    public function redirect($uri = '') {
        if (preg_match('~^(http|htpps)~is',$uri)) {
            $url = $uri;
        } else {
            $url = _WEB_ROOT .'/' .$uri;
        }
        header('location: '.$url);
        exit;
    }
}