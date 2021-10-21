<?php
class C_login extends baseModels {
    
    public function index() {
        if(Session::dataSS('customer_cps') == null) {
            $this->data['contentLogin']['filecss'] = 'main';
            $this->data['contentLogin']['filejs'] = 'login';
            $this->data['contentLogin']['title'] = 'Đăng nhập tài khoản';
            $this->render('layouts/L_login',$this->data);
        } else {
            $response = new Response();
            $response->redirect(_WEB_ROOT);
        }
    }

    public function login() {
        if(isset($_POST['account']) && isset($_POST['password'])) {
            $check = $this->all->select()->table('customer')->where('account','=',trim($_POST['account']))->where('password','=',md5(trim($_POST['password'])))->get();
            if(!empty($check)) {
                Session::dataSS('customer_cps',$check[0]['account']);
                Session::dataSS('avatarCustomer','<img src="'._AVATAR_CUSTOMER.$check[0]['image_customer'].'">');
                echo json_encode(['icon' => 'success','title' => 'Đăng nhập thành công']);
            } else {
                echo json_encode(['error' => 'Thông tin tài khoản hoặc mật khẩu không chính xác']);
            }
        }
    }
}