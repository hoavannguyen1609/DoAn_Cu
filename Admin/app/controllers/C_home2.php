<?php
class C_home extends baseModels {

    public $idProduct = '', $fileName = '';

    public function __construct() {
        $this->modelHome = $this->baseModel('M_home');
    }

    public function index() {
        if(!empty(Session::dataSS('admin_cps'))) {
            $this->data['contentHome']['admin'] = $this->all->getAll('adminstrator',array('account' => md5(Session::dataSS('admin_cps'))));
            $this->render('layouts/L_home',$this->data);
        } else {
            $this->data['contentLogin']['title'] = 'Đăng nhập';
            $this->render('layouts/L_login',$this->data);
        }
    }

    public function getInfo() {
        if(isset($_POST['id'])) {
            $result = $this->all->getAll('adminstrator',array('id_admin' => $_POST['id']));
            echo json_encode($result);
        }
    }

    // public function getListAdmin() {
    //     if(!empty(Session::dataSS('admin_cps'))) {
    //         $result = $this->all->select()->table('adminstrator')->join('gender','gender = id_gender')->join('tbl_position','position = id_position')->get();
    //         echo json_encode($result);
    //     }
    // }

    public function editStaff() {
        if(isset($_POST['type']) && $_POST['type'] == 'editStaff') {
            $birthdayArr = explode('/',trim($_POST['birthday']));
            $workingdayArr = explode('/',trim($_POST['working_day']));
            $birthday = $birthdayArr[2] .'-' .$birthdayArr[1] .'-' .$birthdayArr[0];
            $workingDay = $workingdayArr[2] .'/' .$workingdayArr[1] .'/' .$workingdayArr[0];
            $this->all->update('adminstrator',array(
                'name' => trim($_POST['fullname']),
                'gender' => $_POST['gender'],
                'birthday' => $birthday,
                'phone' => trim($_POST['phone']),
                'email' => trim($_POST['email']),
                'address' => trim($_POST['address']),
                'position' => $_POST['position'],
                'working_day' => $workingDay
            ),array('id_admin' => $_POST['id']));
            echo json_encode(['icon' => 'success', 'title' => 'Cập nhật thành công']);
        }
    }

    public function editAjax() {
        if(isset($_POST['value']) && isset($_POST['id']) && isset($_POST['type'])) {
            $param['value'] = $_POST['value'];
            $param['id'] = $_POST['id'];
            $result = $this->modelHome->updateAjax($param,$_POST['type']);
            echo json_encode($result);
        }
    }

    public function deleteAjax() {
        if(isset($_POST['type']) && isset($_POST['id'])) {
            $param['id'] = $_POST['id'];
            $result = $this->modelHome->delAjax($param,$_POST['type']);
            echo json_encode($result);
        }
    }

    public function addStaff() {
        if(isset($_POST['type'])) {
            $checkAccount = $this->all->select('account')->table('adminstrator')->where('account','=',md5(trim($_POST['account'])))->get();
            $checkPhone = $this->all->select('phone')->table('adminstrator')->where('phone','=',trim($_POST['phone']))->get();
            $checkEmail = $this->all->select('email')->table('adminstrator')->where('email','=',trim($_POST['email']))->get();
            if(!empty($checkAccount) || !empty($checkEmail) || !empty($checkPhone)) {
                echo json_encode(['error'=>'error','title' => 'Thông tin đã được đăng ký']);
            } else {
                $param['account'] = trim($_POST['account']);
                $param['fullname'] = trim($_POST['fullname']);
                $param['gender'] = $_POST['gender'];
                $param['birthday'] = $_POST['birthday'];
                $param['phone'] = trim($_POST['phone']);
                $param['email'] = trim($_POST['email']);
                $param['address'] = trim($_POST['address']);
                $param['position'] = $_POST['position'];
                $result = $this->modelHome->addNvAjax($param);
                echo json_encode($result);
            }
        }
    }

    public function searchAjax() {
        if(isset($_POST['type']) && isset($_POST['value'])) {
            $param['value'] = $_POST['value'];
            $result = $this->modelHome->searchData($param,$_POST['type']);
            echo json_encode($result);
        }  
    }

    public function qlyNhanvien() {
        if(!empty(Session::dataSS('admin_cps'))) {
            $this->data['contentStaff']['title'] = "Quản lý nhân viên";
            $this->data['contentStaff']['gender'] = $this->all->getAll('gender',array());
            $this->data['contentStaff']['position'] = $this->all->getAll('tbl_position',array());
            $this->data['contentStaff']['staff'] = $this->all->getAll('adminstrator',array());
            $this->render('layouts/L_staff',$this->data);
        } 
    }

    public function qlyProduct() {
        if(!empty(Session::dataSS('admin_cps'))) {
            $this->data['contentProduct']['title'] = 'Quản lý sản phẩm';
            $this->data['contentProduct']['product'] = $this->all->select('*')->table('product')/*->join('category','category_id = id_category')->join('promotion','promotion_id = id_promotion')->join('manufacturer','manufacturer_id = id_manufacturer')*/->get();
            $this->data['contentProduct']['category'] = $this->all->select()->table('category')->get();
            $this->data['contentProduct']['promotion'] = $this->all->getAll('promotion',array());
            $this->data['contentProduct']['manufacturer'] = $this->all->getAll('manufacturer',array());
            $this->render('layouts/L_product',$this->data);
        }
    }

    public function signOut() {
        if(!empty(Session::dataSS('admin_cps'))) {
            Session::flashSS();
            $response = new Response();
            $response->redirect(_WEB_ROOT);
        }
    }

    public function uploadImgProduct() {
        if(!empty($_FILES['uploadImgProduct']) && $_POST['idProduct']) {
            $this->chekUpImg($_FILES['uploadImgProduct'],$_POST['idProduct']);
            if(empty($this->error)) {
                $xhtml = '<img src="'. _IMG_PRODUCT .$this->fileName .'" class="imgProduct-'.$_POST['idProduct'].' img-product">';
                echo json_encode(['icon'=>'success','title' => 'Thay đổi thành công','html' => $xhtml, 'id' => $_POST['idProduct']]);
            } else {
                echo json_encode($this->error);
            }
        }
    }

    public function chekUpImg($file,$idProduct='') {
        if(!empty($file)) {
            $extension = explode('.',$file['name']);
            $fileExtension = end($extension);
            $agreeType = ['jpeg','jpg','png','webp'];
            if(in_array($fileExtension,$agreeType)) {
                if($file['size'] > 5242880) {
                    return $this->error = ['icon' => 'error','title' => 'Chỉ được upload file dưới 5mb'];
                } else {
                    if(is_array(getimagesize(_IMG_PRODUCT.$file['name']))) {
                        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
                        $fileNameRandom = substr(str_shuffle($chars), 0, 24) .rand(1000000,999999999999);
                        $fileNamertrim = rtrim($file['name'],strstr($file['name'],'.'));
                        $this->fileName = str_replace($fileNamertrim,$fileNameRandom,$file['name']);
                        if(!empty($idProduct)) {
                            $this->all->update('product',array(
                                'img_product' => $this->fileName
                            ),array('id_product' => $idProduct));
                        }
                        move_uploaded_file($file['tmp_name'], '../imageAll/imgProduct/'.$this->fileName);
                    } else {
                        if(!empty($idProduct)) {
                            $this->all->update('product',array(
                                'img_product' => $this->fileName
                            ),array('id_product' => $idProduct));
                        }
                        move_uploaded_file($file['tmp_name'], '../imageAll/imgProduct/'.$this->fileName);
                    }
                }
            } else {
                return $this->error = ['icon' => 'error','title' => 'Định dạng không hợp lệ'];
            }
        }
    }

    public function addProduct() {
        if(!empty($_FILES['imgProduct'])) {
            if($_POST['discountProduct'] == '' || !isset($_POST['discountProduct'])) {
                $disCount = 0;
            } else {
                $disCount = $_POST['discountProduct'];
            }

            $this->chekUpImg($_FILES['imgProduct']);
            if(empty($this->error)) {
                $checkName = $this->all->getAll('product',array('product_name' => trim($_POST['productName'])));
                if(empty($checkName)) {
                    $this->all->insertData('product',array(
                        'img_product' => $this->fileName,
                        'product_name' => $_POST['productName'],
                        'amount_product' => $_POST['amountProduct'],
                        'price_product' => $_POST['unitPrice'],
                        'discount_product' => $disCount,
                        'category_id' => $_POST['category'],
                        'manufacturer_id' => $_POST['manufacturer'],
                        'promotion_id ' => $_POST['promotion'],
                        'sale' => $_POST['sale'],
                        'status_id' => $_POST['status']
                    ));
                    echo json_encode(['icon' => 'success','title' => 'Thêm sản phẩm thành công']);
                } else {
                    echo json_encode(['icon' => 'error','title' => 'Sản phẩm đã tồn tại']);
                }
            } else {
                echo json_encode($this->error);
            }
        }
    }

    public function qlyOrder() {
        $this->data['contentOrder']['listOrder'] = $this->all->select()->table('total_order')->join('status','status_id = id_status')->join('customer','customer_id = id_customer')->orderBy('status_id','ASC')->get();
        $this->data['contentOrder']['title'] = 'Quản lý đơn hàng';
        foreach($this->data['contentOrder']['listOrder'] as $value) {
            if($value['status_id'] == 1) {
                $this->data['contentOrder']['button'] = 'All'; 
            }
        }
        $this->render('layouts/L_order',$this->data);
    }

    public function confirmOrder() {
        if(isset($_POST['id'])) {
            if($_POST['id'] != 'ALL') {
                $getOrderdetail = $this->all->select()->table('order_details')->join('product','product_id = id_product')->where('total_order_id','=',$_POST['id'])->get();
                $this->setEndconfirmOrder($getOrderdetail,$_POST['id']);
            } else {
                $getOrderdetail = $this->all->select()->table('order_details')->join('product','product_id = id_product')->get();
                $this->setEndconfirmOrder($getOrderdetail);
            }
        }
    }

    public function setEndconfirmOrder($getOrderdetail,$id='') {
        if(!empty($getOrderdetail)) {
            $start = 0;
            $result = '';
            while($start <= count($getOrderdetail) - 1){
                if($getOrderdetail[$start]['amount_product'] == 0 || $getOrderdetail[$start]['amount_product'] < $getOrderdetail[$start]['amount_product_order']) {
                    $result .= $getOrderdetail[$start]['product_name'] .', ';
                }
                $start++;
            }
            $result = rtrim($result,', ');
            if(is_string($result) && $result != '') {
                $resultArr = explode(',',$result);
                if($resultArr) {
                    $resultArrKey = array_values(array_unique($resultArr));
                    $resultEnd = implode(',',$resultArrKey);
                } else {
                    $resultEnd = $result;
                }
                echo json_encode(['icon' => 'error','title' => 'Vui lòng kiểm tra lại số lượng sản phẩm '.$resultEnd]);
            } else {
                $xhtml = '<button disabled class="btn btn-success"><i class="fas fa-check-double"></i></button>';
                $begin = 0;
                while($begin <= count($getOrderdetail) - 1){
                    if($getOrderdetail[$begin]['amount_product_order'] < $getOrderdetail[$begin]['amount_product']) {
                        $this->all->update('product',array(
                            'amount_product' => ($getOrderdetail[$begin]['amount_product'] - $getOrderdetail[$begin]['amount_product_order'])
                        ),array('id_product' => $getOrderdetail[$begin]['product_id']));
                    }
                    $begin++;
                }
                if($id != '') {
                    $this->all->update('total_order',array('status_id' => 2),array('id_total_order' => $id));
                    echo json_encode(['icon' => 'success','title' => 'Thành công','text' => 'Đã xác nhận', 'id' => $id, 'html' => $xhtml]);
                } else {
                    $this->all->update('total_order',array('status_id' => 2),array());
                    echo json_encode(['icon' => 'success','title' => 'Thành công','text' => 'Đã xác nhận','html' => $xhtml]);
                }
            }
        }
    }

    public function orderDetails($id) {
        if(!empty($id)) {
            $this->data['contentOrderdetails']['title'] = 'Chi tiết đơn hàng';
            $this->data['contentOrderdetails']['listOrderDetails'] = $this->all->select()->table('order_details')->join('product','product_id = id_product')->join('total_order','total_order_id = id_total_order')->where('total_order_id','=',$id)->get();
            $this->render('layouts/L_orderDetails',$this->data);
        }
    }
}