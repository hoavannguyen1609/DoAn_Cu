<?php
class C_signOut extends baseModels {
    public function index() {
        if(!empty(Session::dataSS('admin_cps'))) {
            Session::deleteSS('admin_cps');
            $response = new Response();
            $response->redirect(_WEB_ROOT);
        }
    }
}