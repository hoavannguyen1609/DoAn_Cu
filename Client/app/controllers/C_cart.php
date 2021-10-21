<?php
class C_cart extends baseModels {
    public function __construct() {
        $this->modelCart = $this->baseModel('M_cart');
    }

    public function index() {
        if(!empty(Session::dataSS('customer_cps'))) {
            $idCustomer = $this->all->select('id_customer')->table('customer')->where('account','=',Session::dataSS('customer_cps'))->get();
            if(!empty($idCustomer)) {
                $this->data['contentCart']['filecss'] = 'cart';
                $this->data['contentCart']['filejs'] = 'cart';
                $this->data['contentCart']['title'] = 'Giỏ hàng';
                $this->data['contentCart']['cart'] = $this->all->select()->table('cart')->where('customer_id','=',$idCustomer[0]['id_customer'])->get();
                if(!empty($this->data['contentCart']['cart'])) {
                    $this->data['contentCart']['listCart'] = $this->all->select()->table('cart')->join('product','product_id = id_product')->where('customer_id','=',$idCustomer[0]['id_customer'])->get();
                    $this->render('layouts/L_cart',$this->data);
                } else {
                    $this->render('layouts/L_emptycart',$this->data);
                }
            }
        } else {
            $this->data['contentLogin']['filejs'] = 'login';
            $this->data['contentLogin']['title'] = 'Đăng nhập ';
            $this->data['contentLogin']['noticeLogin'] = 'Vui lòng đăng nhập trước khi xem giỏ hàng';
            $this->render('layouts/L_login',$this->data);
        }
    }

    public function addCart() {
        if(!empty(Session::dataSS('customer_cps'))) {
            if(isset($_POST['id'])) {
                $idCustomer = $this->all->select()->table('customer')->where('account','=',Session::dataSS('customer_cps'))->get();
                if(!empty($idCustomer)) {
                    $amountCart = $this->all->select()->table('cart')->where('customer_id','=',$idCustomer[0]['id_customer'])->where('product_id','=',$_POST['id'])->get();
                    if(!empty($amountCart)) {
                        if($amountCart[0]['amount_product_cart'] == 5) {
                            echo json_encode(['icon' => 'warning','title' => 'Đã có 5 sản phẩm trong giỏ hàng']);
                        } else {
                            $newAmountcart = $amountCart[0]['amount_product_cart'] + 1;
                            $this->all->update('cart',array(
                                'amount_product_cart' => $newAmountcart
                            ),array('product_id' => $_POST['id'], 'customer_id' => $idCustomer[0]['id_customer']));
                            echo json_encode(['title' => 'Thêm sản phẩm vào giỏ hàng thành công','icon' => 'success']);
                        }
                    } else {
                        $newAmountcart = 1;
                        $date = date('Y/m/d H:i:s');
                        $this->all->insertData('cart',array(
                            'amount_product_cart' => $newAmountcart,
                            'date_add_cart' => $date,
                            'product_id' => $_POST['id'],
                            'customer_id' => $idCustomer[0]['id_customer']
                        ));
                        echo json_encode(['title' => 'Thêm sản phẩm vào giỏ hàng thành công','icon' => 'success']);
                    }
                }
            }
        } else {
            echo json_encode(['title' => 'Vui lòng đăng nhập trước khi mua sắm','icon' => 'warning']);
        }
    }

    public function changeProduct() {
        if(isset($_POST['value']) && isset($_POST['id'])) {
            $param['id'] = $_POST['id'];
            $param['value'] = $_POST['value'];
            $result = $this->modelCart->updateCart($param);
            echo json_encode($result);
        }
    }

    public function delProduct($id) {
        if(!empty($id)) {
            $this->all->delete('cart',array('id_cart' => $id));
            echo json_encode(['icon' => 'success','title' => 'Xóa thành công','id' => $id]);
        }
    }

    public function putOrder() {
        if(!empty(Session::dataSS('customer_cps'))) {
            $this->data['contentPutorder']['customer'] = $this->all->getAll('customer',array('account' => Session::dataSS('customer_cps')));
            if(!empty($this->data['contentPutorder']['customer'])) {
                $this->data['contentPutorder']['product'] = $this->all->select()->table('cart')->join('product','product_id = id_product')->where('customer_id','=',$this->data['contentPutorder']['customer'][0]['id_customer'])->get();
                if(!empty($this->data['contentPutorder']['product'])) {
                    $this->data['contentPutorder']['title'] = 'Đặt hàng';
                    $this->data['contentPutorder']['filejs'] = 'putOrder';
                    $this->data['contentPutorder']['filecss'] = 'pay';
                    $this->render('layouts/L_putOrder',$this->data);
                }
            }
        }
    }
}