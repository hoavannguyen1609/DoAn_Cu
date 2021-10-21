<?php
class C_registration extends baseModels {
    public function __construct() {
        $this->modelregistration = $this->baseModel('M_sendMailer');
    }

    public function index() {
        $this->data['contentregistration']['filecss'] = 'main';
        $this->data['contentregistration']['filejs'] = 'registration';
        $this->data['contentregistration']['title'] = 'Đăng ký tài khoản';
        $this->render('layouts/L_registration',$this->data);
    }

    public function selectAddress() {
        if(isset($_POST['provinceName'])) {
            $idProvince = $this->all->getAll('province',array('province_name' => $_POST['provinceName']));
            if(!empty($idProvince)) {
                $result = $this->all->getAll('district',array('province_id' => $idProvince[0]['id_province']));
                echo json_encode($result);
            }
        } else {
            $result = $this->all->getAll('province');
            echo json_encode($result);
        }
    }

    public function createAccount() {
        if(!empty($_FILES['avatarCustomer']) && isset($_POST['account']) && isset($_POST['password']) && isset($_POST['phone']) && isset($_POST['email'])  && isset($_POST['fullname']) && isset($_POST['gender']) && isset($_POST['birthday']) && isset($_POST['province']) && isset($_POST['district']) && isset($_POST['commune'])) {
            $checkAccount = $this->all->getAll('customer',array('account' => trim($_POST['account'])));
            $checkPhone = $this->all->getAll('customer',array('phone' => trim($_POST['phone'])));
            $checkMail = $this->all->getAll('customer',array('email' => trim($_POST['email'])));
            if(!empty($checkAccount) || !empty($checkPhone) || !empty($checkMail)) {
                if (!empty($checkAccount) && !empty($checkPhone) && !empty($checkMail)) {
                    $output = 'Tài khoản, số điện thoại và email đã được đăng ký';
                } elseif (!empty($checkAccount) && !empty($checkPhone)) {
                    $output = "Tài khoản và số điện thoại đã được đăng ký";
                } elseif (!empty($checkAccount) && !empty($checkMail)) {
                    $output = "Tài khoản và email đã được đăng ký";
                } elseif (!empty($checkPhone) && !empty($checkMail)) {
                    $output = "Số điện thoại và email đã được đăng ký";
                } elseif (!empty($checkPhone)){
                    $output = 'Số điện thoại đã được đăng ký';
                } elseif (!empty($checkMail)) {
                    $output = 'Email đã được đăng ký';
                }
                echo json_encode(['error' => 'error','title' => $output]);
            } else {
                if($_FILES['avatarCustomer']['size'] > 5242880) {
                    echo json_encode(['error' => 'error','title' => 'Chỉ chọn được ảnh dưới 5md']);
                } else {
                    $address = trim($_POST['commune']) .", " .trim($_POST['district']) .", " .trim($_POST['province']);
                    $birthdayArr = explode('/',trim($_POST['birthday']));
                    $birthday = $birthdayArr[2] ."/" .$birthdayArr[1] ."/" .$birthdayArr[0];
                    $this->uploadImg($_FILES['avatarCustomer']);
                    $imgAccount = 'avatarUpload/' .$this->fileName;
                    $codeOTP = rand(100000,999999);
                    $this->all->insertData('customer',array(
                        'image_customer' => $imgAccount,
                        'account' => trim($_POST['account']),
                        'password' => md5(trim($_POST['password'])),
                        'name' => trim($_POST['fullname']),
                        'gender' => $_POST['gender'],
                        'birthday' => $birthday,
                        'phone' => trim($_POST['phone']),
                        'email' => trim($_POST['email']),
                        'address' => $address,
                        'codeOTP' => $codeOTP
                    ));
                    move_uploaded_file($_FILES['avatarCustomer']['tmp_name'],'public/plugin/avatarUpload/'.$this->fileName);
                    $this->sendMail();
                    echo json_encode(['icon' => 'success','title' => 'Đăng ký thành công']);
                }
            }
        } elseif (!isset($_FILES['avatarCustomer']) && isset($_POST['account']) && isset($_POST['password']) && isset($_POST['phone']) && isset($_POST['email'])  && isset($_POST['fullname']) && isset($_POST['gender']) && isset($_POST['birthday']) && isset($_POST['address']))  {
            $checkAccount = $this->all->getAll('customer',array('account' => trim($_POST['account'])));
            $checkPhone = $this->all->getAll('customer',array('phone' => trim($_POST['phone'])));
            $checkMail = $this->all->getAll('customer',array('email' => trim($_POST['email'])));
            if(!empty($checkAccount) || !empty($checkPhone) || !empty($checkMail)) {
                if (!empty($checkAccount) && !empty($checkPhone) && !empty($checkMail)) {
                    $output = 'Tài khoản, số điện thoại và email đã được đăng ký';
                } elseif (!empty($checkAccount) && !empty($checkPhone)) {
                    $output = "Tài khoản và số điện thoại đã được đăng ký";
                } elseif (!empty($checkAccount) && !empty($checkMail)) {
                    $output = "Tài khoản và email đã được đăng ký";
                } elseif (!empty($checkPhone) && !empty($checkMail)) {
                    $output = "Số điện thoại và email đã được đăng ký";
                } elseif (!empty($checkPhone)){
                    $output = 'Số điện thoại đã được đăng ký';
                } elseif (!empty($checkMail)) {
                    $output = 'Email đã được đăng ký';
                }
                echo json_encode(['error' => 'error','title' => $output]);
            } else {
                $birthdayArr = explode('/',trim($_POST['birthday']));
                $birthday = $birthdayArr[2] ."/" .$birthdayArr[1] ."/" .$birthdayArr[0];
                $codeOTP = rand(100000,999999);
                if($_POST['gender'] == 1) {
                    $fileAvatar = 'avatarDefaultMail.jpg';
                } elseif ($_POST['gender'] == 2) {
                    $fileAvatar = 'avatarDefaultFermail.jpg';
                } elseif ($_POST['gender'] == 3) {
                    $fileAvatar = 'avatarDefault.png';
                }
                $imgAccount = 'avatarDefault/' .$fileAvatar;
                $this->all->insertData('customer',array(
                    'image_customer' => $imgAccount,
                    'account' => trim($_POST['account']),
                    'password' => md5(trim($_POST['password'])),
                    'name' => trim($_POST['fullname']),
                    'gender' => $_POST['gender'],
                    'birthday' => $birthday,
                    'phone' => trim($_POST['phone']),
                    'email' => trim($_POST['email']),
                    'address' => trim($_POST['address']),
                    'codeOTP' => $codeOTP
                ));
                $this->sendMail();
                echo json_encode(['icon' => 'success','title' => 'Đăng ký thành công']);
            }
        }
        
    }

    public function sendMail() {
        $date = date('d/m/Y H:i:s');
        $title = "Đăng ký tài khoản thành công";
        $body = 'Bạn đã đăng ký thành công tài khoản tại CellphoneS. Với tài khoản: '.trim($_POST['account']) .' và mật khẩu: ' .trim($_POST['password']) .' vào lúc: ' .$date .'. Bây giờ, bạn có thể đăng nhập và mua sắm tại Website của chúng tôi, để đăng nhập ngay hãy ấn <a href="'._WEB_ROOT.'/login">vào đây</a>';
        $nTo = trim($_POST['fullname']);
        $mTo = trim($_POST['email']);
        $this->modelregistration->sendMailer($title,$body,$nTo,$mTo);
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
                }
            }
             else {
                $this->fileName = $file['name'];
            }
        }
    }
}