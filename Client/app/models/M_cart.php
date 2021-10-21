<?php
class M_cart extends core_Model {
    public function updateCart($param) {
        $value = $param['value'];
        $id = $param['id'];
        $this->all->update('cart',array('amount_product_cart' => $value),array('id_cart' => $id));
        return ['id' => $id, 'value' => $value];
    }
}