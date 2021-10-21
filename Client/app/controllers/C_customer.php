<?php
class C_customer extends baseModels {

    public function __construct() {
        $this->modelCustomer = $this->baseModel('M_sendMailer');
    }

    public function index() {
        if(!empty(Session::dataSS('customer_cps'))) {
            $this->data['contentCustomer']['filejs'] = 'customer';
            $this->data['contentCustomer']['title'] = 'Tài khoản của tôi';
            $this->data['contentCustomer']['customer_cps'] = $this->all->select('*')->table('customer')->where('account','=',Session::dataSS('customer_cps'))->get();
            $this->data['contentCustomer']['gender'] = $this->all->select()->table('gender')->where('id_gender','=',$this->data['contentCustomer']['customer_cps'][0]['gender'])->get();
            $birthdayArr = explode('-',$this->data['contentCustomer']['customer_cps'][0]['birthday']);
            $this->data['contentCustomer']['date'] = $birthdayArr[2];
            $this->data['contentCustomer']['month'] = $birthdayArr[1];
            $this->data['contentCustomer']['year'] = $birthdayArr[0];
            $this->render('layouts/L_customer', $this->data);
        }
    }

    public function update() {
        if (isset($_POST['fullname']) && isset($_POST['gender']) && isset($_POST['birthday']) && isset($_POST['address'])) {
            if(!empty(Session::dataSS('customer_cps'))) {
                $get = $this->all->getAll('customer',array('account' => Session::dataSS('customer_cps')));
                if($get[0]['image_customer'] == 'avatarDefault/avatarDefaultMail.jpg' || $get[0]['image_customer'] == 'avatarDefault/avatarDefaultFermail.jpg' || $get[0]['image_customer'] == 'avatarDefault/avatarDefault.png') {
                    if($_POST['gender'] == $get[0]['gender']) {
                        $this->all->update('customer',array(
                            'name' => trim($_POST['fullname']),
                            'birthday' => $_POST['birthday'],
                            'address' => $_POST['address']
                        ),array('account' => Session::dataSS('customer_cps')));
                    } else {
                        if(!empty(Session::dataSS('avatarCustomer'))) {
                            Session::deleteSS('avatarCustomer');
                            if($_POST['gender'] == 1) {
                                $fileAvatar = 'avatarDefault/avatarDefaultMail.jpg';
                            }
                            if($_POST['gender'] == 2) {
                                $fileAvatar = 'avatarDefault/avatarDefaultFermail.jpg';
                            }
                            if($_POST['gender'] == 3) {
                                $fileAvatar = 'avatarDefault/avatarDefault.png';
                            }
                            $this->all->update('customer',array(
                                'image_customer' => $fileAvatar,
                                'name' => trim($_POST['fullname']),
                                'gender' => $_POST['gender'],
                                'birthday' => $_POST['birthday'],
                                'address' => $_POST['address']
                            ),array('account' => Session::dataSS('customer_cps')));
                            $avatarCustomer = '<img src="'._AVATAR_CUSTOMER. $fileAvatar.'">';
                            Session::dataSS('avatarCustomer',$avatarCustomer);
                        }
                    }
                } else {
                    $this->all->update('customer',array(
                        'name' => trim($_POST['fullname']),
                        'gender' => $_POST['gender'],
                        'birthday' => $_POST['birthday'],
                        'address' => $_POST['address']
                    ),array('account' => Session::dataSS('customer_cps')));
                }
                
                echo json_encode(['icon' => 'success','title' => 'Lưu thành công']);
            }
        }
    }

    public function updateAvatar() {
        if(!empty(Session::dataSS('customer_cps'))) {
            if(!empty($_FILES['avatarCustomer'])) {
                if($_FILES['avatarCustomer']['size'] > 5242880) {
                    echo 'Chỉ chọn được ảnh dưới 5md';
                } else {
                    $getAvatar = $this->all->getAll('customer',array('account' => Session::dataSS('customer_cps')));
                    if($getAvatar[0]['image_customer'] != 'avatarDefault/avatarDefaultFermail.jpg' && $getAvatar[0]['image_customer'] != 'avatarDefault/avartaDefaultMail.jpg' && $getAvatar[0]['image_customer'] != 'avatarDefault/avatarDefault.png') {
                        if(is_array(getimagesize(_WEB_ROOT.'/public/plugin/'.$getAvatar[0]['image_customer']))) {
                            unlink('public/plugin/'.$getAvatar[0]['image_customer']);
                            $this->uploadImg($_FILES['avatarCustomer']);
                        } else {
                            $this->uploadImg($_FILES['avatarCustomer']);
                        }
                    } else {
                        $this->uploadImg($_FILES['avatarCustomer']);
                    }
                }
            }
        }
    }

    public function uploadImg($file) {
        if(!empty($file)) {
            if(is_array(getimagesize(_WEB_ROOT.'/public/plugin/avatarUpload/'.$file['name']))) {
                $extension = explode('.',$file['name']);
                $fileExtension = end($extension);
                $agreeType = ['jpeg','jpg','png','gif'];
                $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
                if(in_array($fileExtension,$agreeType)) {
                    $fileNameRandom = substr(str_shuffle($chars), 0, 24) .rand(1000000,999999999999);
                    $fileNamertrim = rtrim($file['name'],strstr($file['name'],'.'));
                    $this->fileName = str_replace($fileNamertrim,$fileNameRandom,$file['name']);
                    $this->fileName = 'avatarUpload/' .$this->fileName;
                    $this->all->update('customer',array(
                        'image_customer' => $this->fileName
                    ),array('account' => Session::dataSS('customer_cps')));
                    move_uploaded_file($file['tmp_name'],'public/plugin/'.$this->fileName);
                    if(!empty(Session::dataSS('avatarCustomer'))) {
                        Session::deleteSS('avatarCustomer');
                        $img = '<img src="'._AVATAR_CUSTOMER.$this->fileName.'">';
                        Session::dataSS('avatarCustomer',$img);
                    }
                } else {
                    echo json_encode(['error' => 'error','title' => 'Định dạng không hợp lệ']);
                }
            } else {
                $this->fileName = $file['name'];
                $this->fileName = 'avatarUpload/' .$this->fileName;
                $this->all->update('customer',array(
                    'image_customer' => $this->fileName
                ),array('account' => Session::dataSS('customer_cps')));
                move_uploaded_file($file['tmp_name'],'public/plugin/'.$this->fileName);
                if(!empty(Session::dataSS('avatarCustomer'))) {
                    Session::deleteSS('avatarCustomer');
                    $img = '<img src="'._AVATAR_CUSTOMER.$this->fileName.'">';
                    Session::dataSS('avatarCustomer',$img);
                }
            }
        }
    }

    public function signout() {
        if(!empty(Session::dataSS('customer_cps'))) {
            Session::deleteSS('customer_cps');
            $response = new Response();
            $response->redirect(_WEB_ROOT.'/login');
        }
    }

    public function orderPaynow() {
        if(!empty(Session::dataSS('customer_cps'))) {
            if(isset($_GET['id'])) {
                $this->data['contentOrder']['productOrder'] = $this->all->select()->table('order_details')->join('product','product_id = id_product')->join('total_order','total_order_id = id_total_order')->where('total_order_id','=',$_GET['id'])->get();
                $this->data['contentOrder']['total'] = $this->all->select()->table('total_order')->join('status','status_id = id_status')->where('id_total_order','=',$_GET['id'])->get();
                $this->data['contentOrder']['filejs'] = 'customer';
                $this->data['contentOrder']['title'] = 'Đặt hàng thành công';
                $this->render('layouts/L_orderPaynow',$this->data);
            }
        }
    }

    public function forgetPass() {
        if(isset($_POST['account'])) {
            $checkAccount = $this->all->select()->table('customer')->where('account','=',trim($_POST['account']))->get();
            if (!empty($checkAccount)) {
                $randCode = rand(100000,999999);
                $title = 'Đặt lại mật khẩu';
                $body = 'CellphoneS thông báo: Để đặt lại mật khẩu vui lòng nhập mã OTP ' .$randCode .'. Không chia sẻ mã này cho bất kì ai.';
                $nTo = $checkAccount[0]['name'];
                $mTo = $checkAccount[0]['email'];
                $this->modelCustomer->sendMailer($title,$body,$nTo,$mTo);
                $this->all->update('customer',array('codeOTP' => $randCode),array('account' => $checkAccount[0]['account']));
                echo json_encode(['icon' => 'success', 'title' => 'Thành công','id' => $checkAccount[0]['id_customer']]);
            } else {
                echo json_encode(['error' => 'error','title' => 'Tài khoản không tồn tại']);
            }
        } else {
            $this->data['contentForgetpass']['filejs'] = 'forgetPass';
            $this->data['contentForgetpass']['title'] = 'Đặt lại mật khẩu';
            $this->render('layouts/L_forgetpass',$this->data);
        }
    }

    public function confirmOTP() {
        if(isset($_POST['codeOTP']) && isset($_POST['id'])) {
            $checkOTP = $this->all->select()->table('customer')->where('id_customer','=',$_POST['id'])->get();
            if($_POST['codeOTP'] == $checkOTP[0]['codeOTP']) {
                echo json_encode(['icon' => 'success','title' => 'Thành công','id' => $checkOTP[0]['id_customer']]);
            } else {
                echo json_encode(['error' => 'error','title' => 'Mã xác nhận không đúng']);
            }
        } else {
            $this->data['contentForgetpass']['filejs'] = 'forgetPass';
            $this->data['contentForgetpass']['title'] = 'Xác minh tài khoản';
            $this->data['contentForgetpass']['idCustomer'] = $this->all->select('id_customer')->table('customer')->where('id_customer','=',$_GET['id'])->get();
            $this->render('layouts/L_confirmOTPpass',$this->data);
        }
    }

    public function resetPass() {
        if(isset($_POST['value']) && isset($_POST['id'])) {
            $customer = $this->all->getAll('customer',array('id_customer' => $_POST['id']));
            $this->all->update('customer',array('password' => md5(trim($_POST['value']))),array('id_customer' => $customer[0]['id_customer']));
            $date = date('d/m/Y H:i:s');
            $title = 'Đặt lại mật khẩu thành công';
            $body = 'CellphoneS thông báo: mật khẩu của bạn đã được thay đổi thành: ' .$_POST['value'] .' vào lúc: ' .$date .'. Bạn có thể sử dụng mật khẩu này để đăng nhập và mua sắm tại cửa hàng. Hoặc đăng nhập nhanh <a href="'._WEB_ROOT.'/login">tại đây</a>';
            $nTo = $customer[0]['name'];
            $mTo = $customer[0]['email'];
            $this->modelCustomer->sendMailer($title,$body,$nTo,$mTo);
            echo json_encode(['icon' => 'success','title' => 'Đặt lại mật khẩu thành công']);
        } else {
            $this->data['contentResetpass']['title'] = 'Đặt lại mật khẩu';
            $this->data['contentResetpass']['filejs'] = 'forgetpass';
            if(isset($_GET['id'])) {
                $this->data['contentResetpass']['idCustomer'] = $this->all->getAll('customer',array('id_customer' => $_GET['id']));
                if(!empty($this->data['contentResetpass']['idCustomer'])) {
                    $this->render('layouts/L_resetPass',$this->data);
                }
            }
        }
    }

    public function changePassword() {
        if(!empty(Session::dataSS('customer_cps'))) {
            if(isset($_POST['oldPass']) && isset($_POST['newPass'])) {
                $checkPass = $this->all->select()->table('customer')->where('account','=',Session::dataSS('customer_cps'))->where('password','=',md5(trim($_POST['oldPass'])))->get();
                if(!empty($checkPass)) {
                    $this->all->update('customer',array('password' => md5(trim($_POST['newPass']))),array('account' => Session::dataSS('customer_cps')));
                    $date = date('d/m/Y H:i:s');
                    $title = 'Đổi mật khẩu thành công';
                    $body = 'CellphoneS thông báo bạn đã thay đổi mật khẩu thành ' .trim($_POST['newPass']) .' vào lúc: ' .$date .'. Bạn có thể dùng mật khẩu này để đăng nhập lần sau.';
                    $nTo = $checkPass[0]['name'];
                    $mTo = $checkPass[0]['email'];
                    $this->modelCustomer->sendMailer($title,$body,$nTo,$mTo);
                    echo json_encode(['icon' => 'success','title' => 'Thay đổi mật khẩu thành công']);
                } else {
                    echo json_encode(['icon' => 'error','title' => 'Mật khẩu cũ không đúng']);
                }
            } else {
                $this->data['contentChangepass']['filejs'] = 'customer';
                $this->data['contentChangepass']['title'] = 'Đổi mật khẩu';
                $this->render('layouts/L_changePass',$this->data);
            }
        }
    }

    public function delOrder() {
        if(!empty(Session::dataSS('customer_cps'))) {
            if(isset($_POST['id'])) {
                $checkOrder = $this->all->getAll('total_order',array('id_total_order'=>$_POST['id']));
                if(!empty($checkOrder)) {
                    echo json_encode(['icon' => 'success','title' => 'Hủy đơn hàng thành công']);
                    $codeOrder = $this->all->getAll('total_order',array('id_total_order' => $_POST['id']));
                    $customer = $this->all->getAll('customer',array('id_customer' => $codeOrder[0]['customer_id']));
                    $title = 'Hủy đơn hàng';
                    $body = 'CellphoneS thông báo: Bạn đã hủy thành công đơn hàng với mã đơn: ' .$codeOrder[0]['code_order'] .'. Hãy tiếp tục mua sắm tại cửa hàng.';
                    $nTo = $customer[0]['name'];
                    $mTo = $customer[0]['email'];
                    $this->modelCustomer->sendMailer($title,$body,$nTo,$mTo);
                    $this->all->delete('order_details',array('total_order_id' => $_POST['id']));
                    $this->all->delete('total_order',array('id_total_order' => $_POST['id']));
                } else {
                    echo json_encode('Đơn hàng đã bị xóa');
                }
            }
        }
    }

    public function customerOrder() {
        if(!empty(Session::dataSS('customer_cps'))) {
            $customer = $this->all->getAll('customer',array('account' => Session::dataSS('customer_cps')));
            if(!empty($customer)) {
                $this->data['contentMyorder']['productHistory'] = $this->all->select()->table('historybuy')->join('product','product_id = id_product')->join('total_order','total_order_id_history = id_total_order')->where('customer_id_history','=',$customer[0]['id_customer'])->orderBy('id_historybuy','DESC')->get();
                // var_dump($this->data['contentMyorder']['productHistory']);
                $this->data['contentMyorder']['title'] = 'Đơn mua của tôi';
                $this->data['contentMyorder']['filejs'] = 'customer';
                if(!empty($this->data['contentMyorder']['productHistory'])) {
                    $this->render('layouts/L_myOrder',$this->data);
                } else {
                    $this->render('layouts/L_emptyMyorder',$this->data);
                }
            }
        }
    }
}