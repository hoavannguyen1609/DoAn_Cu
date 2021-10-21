<?php
class M_product extends core_Model {
    public function changeStatus($param,$type) {
        if($type == 'category') {
            $status = ($param['status'] == 6) ? 7 : 6;
            $icon = ($param['status'] == 6) ? 'minus' : 'check';
            $classStatus = ($param['status'] == 6) ? 'danger' : 'success';
            $xhtml = '<a href="javascript:changeStatus('.$param['id'].','.'\''.$param['controller'].'\''.','.$status.','.'\''.$type.'\''.','.'\''.$param['typeHistory'].'\'' .')" class="btn btn-'.$classStatus.' status-'.$param['id'].'"><i class="far fa-'.$icon.'-circle"></i></a>';
            $this->all->update('category',array('status_category_id' => $status),array('id_category' => $param['id']));
            $this->all->update('product',array('status_id' => $status),array('category_id' => $param['id']));
            $statusBefore = $this->all->getAll('status',array('id_status' => $param['status']));
            $statusEnd = $this->all->getAll('status',array('id_status' => $status));
            $content = 'Đã thay đổi status từ ' .$statusBefore[0]['status_name'] .' thành ' .$statusEnd[0]['status_name'];
            $this->insertHistoryChange($content,$param['typeHistory'],Session::dataSS('admin_cps'));
            return ['html' => $xhtml,'id' => $param['id'],'icon' => 'success','title' => 'Thay đổi thành công'];
        }
    }

    public function insertHistoryChange($content,$type) {
        if(!empty(Session::dataSS('admin_cps'))) {
            $idAdmin = $this->all->getAll('adminstrator',array('account' => md5(Session::dataSS('admin_cps'))));
        }
        $this->all->insertData('history_change',array(
            'history_change_name' => $content,
            'history_change_type' => $type,
            'date_change' => date('Y/m/d H:i:s'),
            'admin_id_history' => $idAdmin[0]['id_admin']
        ));
    }
}