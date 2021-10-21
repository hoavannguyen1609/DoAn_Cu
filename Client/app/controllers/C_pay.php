<?php
class C_pay extends baseModels {
    private $date, $code_order,$idTotalorder_new;
    public function __construct() {
        $this->modelPay = $this->baseModel('M_pay');
        $this->date = date('H:i:s d/m/Y');
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $this->code_order = substr(str_shuffle($chars), 0, 12) .rand(1000000,999999999999);
    }

    public function index() {
        if(!empty(Session::dataSS('customer_cps'))) {
            $idCustomer = $this->all->select('id_customer')->table('customer')->where('account','=',Session::dataSS('customer_cps'))->get();
            if(!empty($idCustomer)) {
                $this->data['contentPay']['filecss'] = 'cart';
                $this->data['contentPay']['filejs'] = 'cart';
                $this->data['contentPay']['title'] = 'Thanh toán';
                $this->data['contentPay']['totalPay'] = $this->all->select()->table('cart')->where('customer_id','=',$idCustomer[0]['id_customer'])->join('product','product_id = id_product')->get();
                $this->render('layouts/L_pay',$this->data);
            }
        }
    }

    public function payNow($id) {
        if(!empty(Session::dataSS('customer_cps'))) {
            if(!empty($id)) {
                $this->data['contenPaynow']['filejs'] = 'pay';
                $this->data['contenPaynow']['filecss'] = 'pay';
                $this->data['contenPaynow']['title'] = 'Đặt hàng';
                $this->data['contenPaynow']['product'] = $this->all->select()->table('product')->where('id_product','=',$id)->get();
                $this->data['contenPaynow']['customer'] = $this->all->select()->table('customer')->where('account','=',Session::dataSS('customer_cps'))->get();
                $this->data['contenPaynow']['amountProduct'] = 1;
                $this->render('layouts/L_payNow',$this->data);
            }
        } else {
            $this->data['contentLogin']['filejs'] = 'login';
            $this->data['contentLogin']['title'] = 'Đăng nhập ';
            $this->data['contentLogin']['noticeLogin'] = 'Vui lòng đăng nhập trước khi mua sắm';
            $this->render('layouts/L_login',$this->data);
        }
    }

    public function confirmPay() {
        if(!empty(Session::dataSS('customer_cps'))) {
            $customer = $this->all->getAll('customer',array('account'=>Session::dataSS('customer_cps')));
            if(!empty($customer)) {
                if(isset($_POST['type']) && $_POST['type'] == 'confirmPut') {
                    if(isset($_POST['message']) &&!empty($_POST['message'])) {
                        $message = $_POST['message'];
                    } else {
                        $message = '';
                    }
                    $this->getIdtotalOrder();
                    // if($_POST['fullname'] == $customer[0]['name'] && $_POST['phone'] == $customer[0]['phone'] && $_POST['address'] == $customer[0]['address']) {                        
                    //     $this->insertTotalOrder($idTotalorder_new,$customer[0]['name'],$customer[0]['phone'],$customer[0]['address'],$code_order,$_POST['total'],$_POST['payments'],$message,$customer[0]['id_customer']);
                    // } else {
                        $this->modelPay->insertTotalOrder($this->idTotalorder_new,$_POST['fullname'],$_POST['phone'],$_POST['address'],$this->code_order,$_POST['total'],$_POST['payments'],$message,$customer[0]['id_customer']);
                    // }
                    $this->modelPay->insertOrderdetail($_POST['id'],$_POST['amount'],$this->idTotalorder_new,$customer[0]['id_customer']);
                    $product = $this->all->select()->table('product')->join('category','category_id = id_category')->where('id_product','=',$_POST['id'])->get();
                    $body = 'CellphoneS thông báo: Bạn đã đặt thành công đơn hàng với mã đơn: ' .$this->code_order .' vào lúc: '.$this->date.'. Thông tin đơn hàng bao gồm: sản phẩm ' .$product[0]['category_name'] .': ' .$product[0]['product_name'] .' với đơn giá: ' .str_replace(',','.',number_format($product[0]['price_product'] - ($product[0]['price_product'] * $product[0]['discount_product'] / 100))) .' ₫, số lượng: ' .$_POST['amount'] .' và tổng giá trị đơn hàng: ' .str_replace(',','.',number_format($_POST['total'])) .' ₫. Số điện thoại nhận hàng: ' .$_POST['phone'] .'. Vui lòng chú ý điện thoại để thuận tiện cho việc giao hàng. Xin chân thành cảm ơn.';
                    $this->modelPay->sendMailer('Đặt hàng thành công',$body,$_POST['fullname'],$_POST['email']);
                    echo json_encode(['icon' => 'success','title' => 'Đặt hàng thành công', 'id' => $this->idTotalorder_new]);
                }
            }
        }
    }

    public function confirmPutCart() {
        if(!empty(Session::dataSS('customer_cps'))) {
            if(isset($_POST['type']) && $_POST['type'] == 'confirmPut') {
                $customer = $this->all->getAll('customer',array('account' => Session::dataSS('customer_cps')));
                $productCart = $this->all->select('*')->table('cart')->join('product','product_id = id_product')->where('customer_id','=',$customer[0]['id_customer'])->get();
                if(!empty($productCart)) {
                    if(isset($_POST['message']) &&!empty($_POST['message'])) {
                        $message = $_POST['message'];
                    } else {
                        $message = '';
                    }
                    $this->getIdtotalOrder();
                    $this->modelPay->insertTotalOrder($this->idTotalorder_new,$_POST['fullname'],$_POST['phone'],$_POST['address'],$this->code_order,$_POST['total'],$_POST['payments'],$message,$customer[0]['id_customer']);
                    $body = 'CellphoneS thông báo: Bạn đã đặt thành công đơn hàng với mã đơn: ' .$this->code_order .' vào lúc: '.$this->date.'. Thông tin đơn hàng bao gồm: ';
                    foreach($productCart as $value) {
                        $this->modelPay->insertOrderdetail($value['product_id'],$value['amount_product_cart'],$this->idTotalorder_new,$customer[0]['id_customer']);
                        $body .=  $value['product_name'] .' với đơn giá: ' .str_replace(',','.',number_format($value['price_product'] - ($value['price_product'] * $value['discount_product'] / 100))) .' ₫, số lượng: ' .$value['amount_product_cart'].'. ';
                        $this->all->delete('cart',array('id_cart' => $value['id_cart']));
                    }
                    $body .= 'Tổng giá trị đơn hàng: ' .str_replace(',','.',number_format($_POST['total'])) .' ₫. Số điện thoại nhận hàng: ' .$_POST['phone'] .'. Vui lòng chú ý điện thoại để thuận tiện cho việc giao hàng. Xin chân thành cảm ơn.';
                    $this->modelPay->sendMailer('Đặt hàng thành công',$body,$_POST['fullname'],$_POST['email']);
                    echo json_encode(['icon' => 'success','title' => 'Đặt hàng thành công', 'id' => $this->idTotalorder_new]);
                }
            }
        }
    }

    public function getIdtotalOrder() {
        $idTotalorder = $this->all->select('id_total_order')->table('total_order')->get();
        if(!empty($idTotalorder)) {
            foreach($idTotalorder as $value) {
                $this->idTotalorder_new = $value['id_total_order'] + 1;
            }
        } else {
            $this->idTotalorder_new = 1;
        }
        return $this;
    }
}