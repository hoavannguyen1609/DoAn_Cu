<?php
class C_home extends baseModels {
    public function index() {
        if (!empty(Session::dataSS('admin_cps'))) {
            $this->data['contentHome']['title'] = 'Trang chủ';
            $this->data['contentHome']['infoAdmin'] = $this->all->getAll('adminstrator', array('account' => md5(Session::dataSS('admin_cps'))));
            $this->data['contentHome']['date'] = date('d/m/Y');
            $this->render('layouts/L_home', $this->data);
        } else {
            $this->data['contentLogin']['title'] = 'Đăng nhập';
            $this->data['contentLogin']['filecss'] = 'login';
            $this->render('layouts/L_login', $this->data);
        }
    }

    public function getInfo() {
        if (!empty(Session::dataSS('admin_cps'))) {
            $data = $this->all->select()->table('adminstrator')->join('gender','gender = id_gender')->join('tbl_position','position = id_position')->where('account', '=', md5(Session::dataSS('admin_cps')))->get();
            if (!empty($data)) {
                $result = $this->getView('layouts/L_infoAdmin');
                echo json_encode(['html' => $result, 'data' => $data]);
            }
        }
    }
}
