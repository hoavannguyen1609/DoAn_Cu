<?php
class C_login extends baseModels {
    public function index() {
        if(isset($_POST['account']) && isset($_POST['password'])) {
            $getAdmin = $this->all->select()->table('adminstrator')->where('account','=',md5(trim($_POST['account'])))->where('password','=',md5(trim($_POST['password'])))->get();
            if(!empty($getAdmin)) {
                if(Session::dataSS('admin_cps') == null) {
                    Session::dataSS('admin_cps',trim($_POST['account']));
                    // Session::dataSS('name_admin',$getAdmin[0]['name']);
                    // Session::dataSS('admin_position',$getAdmin[0]['position']);
                }
                echo json_encode(['icon' => 'success','title' => 'Đăng nhập thành công']);
            } else {
                echo json_encode(['icon' => 'error','title' => 'Thông tin tài khoản hoặc mật khẩu không chính xác']);
            }
        } else {
            $responsve = new Response();
            $responsve->redirect(_WEB_ROOT);
        }
    }
}