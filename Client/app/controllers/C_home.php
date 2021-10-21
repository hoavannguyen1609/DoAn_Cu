<?php
class C_home extends baseModels {

    public function index() {
        $this->data['contentHome']['filecss'] = 'home';
        $this->data['contentHome']['filejs'] = 'home';
        $this->data['contentHome']['slide'] = $this->all->select()->table('slide')->where('status_id','=',6)->get();
        $this->data['contentHome']['box_sliding'] = $this->all->select()->table('box_sliding')->where('status_id','=',6)->get();
        $this->data['contentHome']['productSale'] = $this->all->select()->table('product')->where('status_id','=',6)->where('sale','=',1)->get();
        $this->data['contentHome']['productMobile'] = $this->all->select()->table('product')->join('promotion','promotion_id = id_promotion')->where('status_id','=',6)->where('category_id','=',1)->where('sale','!=',1)->limit(10)->get();
        $this->data['contentHome']['productLaptop'] = $this->all->select()->table('product')->join('promotion','promotion_id = id_promotion')->where('status_id','=',6)->where('category_id','=',3)->where('sale','!=',1)->limit(10)->get();
        $this->data['contentHome']['productWatch'] = $this->all->select()->table('product')->join('promotion','promotion_id = id_promotion')->where('status_id','=',6)->where('category_id','=',9)->where('sale','!=',1)->limit(10)->get();
        $this->data['contentHome']['productaccessory'] = $this->all->select()->table('product')->join('promotion','promotion_id = id_promotion')->where('status_id','=',6)->where('category_id','=',13)->where('sale','!=',1)->limit(10)->get();
        $this->data['contentHome']['productspeak'] = $this->all->select()->table('product')->join('promotion','promotion_id = id_promotion')->where('status_id','=',6)->where('category_id','=',11)->where('sale','!=',1)->limit(10)->get();
        $this->data['contentHome']['productTablet'] = $this->all->select()->table('product')->join('promotion','promotion_id = id_promotion')->where('status_id','=',6)->where('category_id','=',7)->where('sale','!=',1)->limit(10)->get();
        if(!empty(Session::dataSS('customer_cps'))) {
            if(empty(Session::dataSS('avatarCustomer'))) {
                $avatacustomer = $this->all->getAll('customer',array('account' => Session::dataSS('customer_cps')));
                if(!empty($avatacustomer)) { 
                    $avatar = '<img src="'._AVATAR_CUSTOMER.$avatacustomer[0]['image_customer'].'">';
                    Session::dataSS('avatarCustomer',$avatar);
                }
            }
        }
        $this->data['content'] = 'V_home';
        $this->render('layouts/L_home',$this->data);
    }

    public function selectMobile() {
        $this->setData('Điện thoại',1);
    }

    public function selectLaptop() {
        $this->setData('Laptop',3);
    }

    public function selectTablet() {
        $this->setData('Tablet',7);
    }

    public function selectAmthanh() {
        $this->setData('Loa, Tai nghe',11);
    }

    public function selectWatch() {
        $this->setData('Đồng hồ',9);
    }

    public function selectHeadphone() {
        $this->setData('Tai nghe',13);
    }

    public function setData($title,$categoryID,$categoryTwo = '') {
        $this->data['contentHome']['filecss'] = 'home';
        $this->data['contentHome']['filejs'] = 'home';
        $this->data['contentHome']['title'] = $title;
        $this->data['contentHome']['product'] = $this->all->select()->table('product')->join('promotion','promotion_id = id_promotion')->join('manufacturer','manufacturer_id = id_manufacturer')->where('status_id','=',6)->where('category_id','=',$categoryID)->get();
        if(!empty($categoryTwo)) {
            $this->data['contentHome']['productaccessory'] = $this->all->select()->table('product')->join('promotion','promotion_id = id_promotion')->where('status_id','=',6)->where('category_id','=',$categoryTwo)->limit(10)->get();
        }
        $this->render('layouts/L_product',$this->data);
    }

    public function loadProduct() {
        if(isset($_POST['limit']) && isset($_POST['offset']) && isset($_POST['categoryID'])) {
            $result = $this->all->select()->table('product')->join('promotion','promotion_id = id_promotion')->where('category_id','=',$_POST['categoryID'])->limit($_POST['limit'],$_POST['offset'])->get();
            echo json_encode(array('product' => $result));
        }
    }

    public function getDetail($name) {
        if(!empty($name)) {
            $this->data['contentDetail']['title'] = $this->removeSc($name);
            $this->data['contentDetail']['product'] = $this->all->select()->table('product')->join('promotion','promotion_id = id_promotion')->join('category','category_id = id_category')->join('manufacturer','manufacturer_id = id_manufacturer')->whereLike('product_name',$this->removeSc($name))->get();
            $this->render('layouts/L_productDetail',$this->data);
        }
    }
}