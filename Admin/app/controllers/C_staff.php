<?php
class C_staff extends baseModels {
    public function __construct() {
        $this->modelStaff = $this->baseModel('M_staff');
    }

    public function index() {
        if(!empty(Session::dataSS('admin_cps'))) {
            $topHtml = $this->getView('V_staffTop');
            $xhtml = $this->getView('V_staff');
            $data = $this->all->select()->table('adminstrator')->join('salary','id_admin = admin_id')->join('allowance_position','allowance_position_id = id_allowance')->orderBy('id_admin','ASC')->get();
            $gender = $this->all->getAll('gender',array());
            $position = $this->all->getAll('tbl_position',array());
            echo json_encode(['data' => $data,'top' => $topHtml,'html' => $xhtml,'gender' => $gender,'position' => $position]);
        }
    }

    public function formaddStaff() {
        $dataGender = $this->all->getAll('gender',array());
        $gender = '';
        $position = '';
        foreach($dataGender as $value) {
            $gender .= '<option value="'.$value['id_gender'].'">'.$value['gender_name'].'</option>';
        }
        $dataPosition = $this->all->select()->table('tbl_position')->where('id_position','!=',3)->get();
        foreach($dataPosition as $value) {
            $position .= '<option value="'.$value['id_position'].'">'.$value['position_name'].'</option>';
        }
        $html = $this->getView('V_formAddstaff');
        echo json_encode(['html' => $html,'gender' => $gender,'position' => $position]);
    }

    public function addStaff() {
        if(!empty(Session::dataSS('admin_cps'))) {
            if(isset($_POST['type']) && $_POST['type'] == 'addStaff') {
                $checkAccount = $this->all->getAll('adminstrator',array('account' => md5(trim($_POST['account']))));
                if(!empty($checkAccount)) {
                    echo json_encode('Tài khoản đã được đăng ký');
                } else {
                    $checkPhone = $this->all->getAll('adminstrator',array('phone' => trim($_POST['phone'])));
                    if(!empty($checkPhone)) {
                        echo json_encode('Số điện thoại đã được đăng ký');
                    } else {
                        $checkEmail = $this->all->getAll('adminstrator',array('email' => trim($_POST['email'])));
                        if(!empty($checkEmail)) {
                            echo json_encode('Email đã được đăng ký');
                        } else {
                            $avatar = 'avatarDefault/';
                            if($_POST['gender'] == 1) {
                                $avatar .= 'avatarDefaultMail.jpg';
                            }
                            if($_POST['gender'] == 2) {
                                $avatar .= 'avatarDefaultFermail.jpg';
                            }
                            if($_POST['gender'] == 3) {
                                $avatar .= 'avatarDefault.png';
                            }
                            $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
                            $randPass = substr(str_shuffle($chars), 0, 6);
                            $randCode = rand(100000,999999);
                            $allowanceId = $this->all->getAll('allowance_position',array('position_allowance' => $_POST['position']));
                            $this->all->insertData('adminstrator',array(
                                'avatar_admin' => $avatar,
                                'account' => md5(trim($_POST['account'])),
                                'password' => md5($randPass),
                                'name' => trim($_POST['name']),
                                'gender' => $_POST['gender'],
                                'birthday' => $_POST['birthday'],
                                'phone' => trim($_POST['phone']),
                                'email' => trim($_POST['email']),
                                'address' => trim($_POST['address']),
                                'position' => $_POST['position'],
                                'working_day' => $_POST['workDay'],
                                'bank_account' => trim($_POST['bankAccount']),
                                'allowance_position_id' => $allowanceId[0]['id_allowance'],
                                'codeOTP' => $randCode
                            ));
                            $lastId = $this->all->getLastId('id_admin','adminstrator');
                            $salaryBasic = $this->all->getAll('salary',array());
                            $this->all->insertData('salary',array(
                                'salary_basic' => $salaryBasic[0]['salary_basic'],
                                'salary_allowance_work_date' => 0,
                                'admin_id' => $lastId[0]['MAX(id_admin)']
                            ));
                            $position = $this->all->getAll('tbl_position',array('id_position' => $_POST['position']));
                            $title = 'Tạo tài khoản thành công';
                            $body = 'CellphoneS thông báo bạn đã được tạo thành công tài khoản Quản trị. Thông tin tài khoản bao gồm: ' .$_POST['account'] .', mật khẩu: ' .$randPass .', số điện thoại: ' .$_POST['phone'] .', chức vụ: ' .$position[0]['position_name'] .' và số tài khoản ngân hàng: ' . $_POST['bankAccount'] .'.';
                            $nTo = $_POST['name'];
                            $mTo = $_POST['email'];
                            $this->modelStaff->sendMailer($title,$body,$nTo,$mTo);
                            echo json_encode(['icon' => 'success','title' => 'Thêm nhân viên thành công']);
                        }
                    }
                }
            }
        }
    }

    public function editStaff() {
        if(!empty(Session::dataSS('admin_cps'))) {
            if(isset($_POST['id'])) {
                $checkPhone = $this->all->select()->table('adminstrator')->where('phone','=',trim($_POST['phone']))->where('id_admin','!=',$_POST['id'])->get();
                if (!empty($checkPhone)) {
                    echo json_encode('Số điện thoại đã được đăng ký');
                } else {
                    $checkEmail = $this->all->select()->table('adminstrator')->where('email','=',trim($_POST['email']))->where('id_admin','!=',$_POST['id'])->get();
                    if (!empty($checkEmail)) {
                        echo json_encode('Email đã được đăng ký');
                    } else {
                        $param['id'] = $_POST['id'];
                        $param['name'] = trim($_POST['name']);
                        $param['gender'] = $_POST['gender'];
                        $param['birthday'] = trim($_POST['birthday']);
                        $param['phone'] = trim($_POST['phone']);
                        $param['email'] = trim($_POST['email']);
                        $param['address'] = trim($_POST['address']);
                        $param['position'] = $_POST['position'];
                        $param['workDay'] = trim($_POST['workDay']);
                        $param['bank'] = trim(($_POST['bank']));
                        $param['allowance'] = $_POST['allowance'];
                        $result = $this->modelStaff->edit($param);
                        echo json_encode($result);
                    }
                }
            }
        }
    }

    public function deleteStaff() {
        $position = $this->all->getAll('adminstrator',array('id_admin' => $_POST['id']));
        if($position[0]['position'] == 3) {
            echo json_encode(['icon' => 'warning','title' => 'Không thể xóa chủ shop']);
        } 
        else {
            $this->all->delete('salary',array('admin_id' =>$_POST['id']));
            $this->all->delete('adminstrator',array('id_admin' => $_POST['id']));
            echo json_encode(['icon' => 'success','title' => 'Xóa thành công','id' => $_POST['id']]);
        }
    }

    public function addPosition() {
        if(!empty(Session::dataSS('admin_cps'))) {
            if(isset($_POST['position']) && isset($_POST['allowance'])) {
                $this->all->insertData('tbl_position',array('position_name' => $_POST['position']));
                $lastId = $this->all->getLastId('id_position','tbl_position');
                $this->all->insertData('allowance_position',array(
                    'allowance_level' => $_POST['allowance'],
                    'position_allowance' => $lastId[0]['MAX(id_position)']
                ));
                echo json_encode(['icon' => 'success','title' => 'Thêm chức vụ thành công']);
            }
        }
    }

    public function loadPosition() {
        if(!empty(Session::dataSS('admin_cps'))) {
            $data = $this->all->select('*')->table('tbl_position')->get();
            $topView = $this->getView('V_positionTop');
            $xhtml = $this->getView('V_position');
            echo json_encode(['data' => $data,'top' => $topView,'html' => $xhtml]);
        }
    }

    public function editPosition() {
        if(isset($_POST['id']) && isset($_POST['value'])) {
            $this->all->update('tbl_position',array('position_name' => $_POST['value']),array('id_position' => $_POST['id']));
            echo json_encode(['icon' => 'success','title' => 'Thay đổi thành công']);
        }
    }

    public function deletePosition($id) {
        if(!empty($id)) {
            if($id == 3) {
                echo json_encode(['icon' => 'error','title' => 'Không thể xóa, bạn là chủ']);
            } else {
                $get = $this->all->getAll('adminstrator',array('position' => $id));
                if(!empty($get)) {
                    if(count($get) <= 3) {
                        $name = '';
                        foreach($get as $value) {
                            $name .= $value['name'] .', ';
                        }
                        $name = rtrim($name,', ');
                        echo json_encode(['icon' => 'warning','title' => 'Không thể xóa','title2' => 'Phải thay đổi chức vụ nhân viên '.$name]);
                    } else {
                        echo json_encode(['icon' => 'warning','title' => 'Không thể xóa','title2' => 'Phải thay đổi chức vụ '.count($get).' nhân viên']);
                    }
                } else {
                    $this->all->delete('allowance_position',array('position_allowance' => $id));
                    $this->all->delete('tbl_position',array('id_position' => $id));
                    echo json_encode(['icon' => 'success','title' => 'Xóa thành công','id' => $id]);
                }
            }
        }
    }

    public function loadSalary() {
        $dataSalary = $this->all->getAll('salary',array());
        $dataAllowance = $this->all->select()->table('allowance_position')->join('tbl_position','position_allowance = id_position')->get();
        $topHtml = $this->getView('V_salaryTop');
        $salaryBasic = '<div class="salary-box__salary-basic"><span>Lương cơ bản:&nbsp;</span><input type="text" id="salaryBasic" value="'.str_replace(',','.',number_format($dataSalary[0]['salary_basic'])).' ₫"><a href="javascript:changeSalaryBasic()" class="btn btn-outline-success"><i class="fas fa-check"></i></a></div>';
        $salaryAllowance = $this->getView('V_salaryAllowance');
        echo json_encode(['dataAl' => $dataAllowance,'top' => $topHtml,'slBs' => $salaryBasic,'slAl' => $salaryAllowance]);
    }

    public function changeSalarybasic() {
        if(isset($_POST['value'])) {
            $this->all->update('salary',array('salary_basic' => $_POST['value']),array());
            echo json_encode(['icon' => 'success','title' => 'Thay đổi thành công']);
        }
    }

    public function changeAllowance() {
        $this->all->update('allowance_position',array('allowance_level' => $_POST['value']),array('id_allowance' => $_POST['id']));
        echo json_encode(['icon' => 'success','title' => 'Thay đổi thành công']);
    }
}
?>