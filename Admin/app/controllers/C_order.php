<?php
class C_order extends baseModels {
    public function __construct() {
        
    }
    
    public function index($type) {
        if(!empty($type)) {
            $data = $this->all->select()->table('total_order')->join('status','status_id = id_status')->where('status_id','=',$type)->get();
            $htmlTop = '<div class="order-box"><div class="order-box__title"><span>Danh sách đơn hàng</span></div><div class="order-box__child"><div class="order-box__list"></div></div></div>';
            if(!empty($data)) {
                $html = $this->getView('V_order'.$type);
                echo json_encode(['data' => $data,'htmlTop' => $htmlTop,'html' => $html]);
            } else {
                if($type == 1) {
                    $html = '<b>Không có đơn hàng chưa duyệt</b>';
                } elseif($type == 2) {
                    $html = '<b>Không có đơn hàng đã duyệt</b>';
                } elseif($type == 3) {
                    $html = '<b>Không có đơn hàng đã thanh toán</b>';
                }
                echo json_encode(['data' => $data,'htmlTop' => $htmlTop,'empty' => $html]);
            }
        }
    }

    public function confirmOrder($id) {
        if($id) {
            $this->all->update('total_order',array('status_id' => 2),array('id_total_order' => $id));
            $btn = '<button disabled class="btn btn-success"><i class="fas fa-check"></i></button>';
            echo json_encode(['icon' => 'success','title' => 'Duyệt thành công','id' => $id,'button' => $btn]);
        }
    }

    public function delOrder($id) {
        if(!empty($id)) {
            $this->all->delete('order_details',array('total_order_id' => $id));
            $this->all->delete('total_order',array('id_total_order' => $id));
            echo json_encode(['icon' => 'success','title' => 'Xóa đơn hàng thành công','id' => $id]);
        }
    }

    public function getOrderdetail($id) {
        $data = $this->all->select()->table('order_details')->join('product','product_id = id_product')->join('total_order','total_order_id = id_total_order')->where('total_order_id','=',$id)->get();
        $htmlTop = $this->getView('V_orderDetailTop');
        $html = $this->getView('V_orderDetail');
        echo json_encode(['data' => $data,'htmltop' => $htmlTop,'html' => $html]);
    }
}