<?php
class C_search extends baseModels {
    public function index() {
        $key = str_replace('/\s+/',' ', trim($_GET['key']));
        $this->data['contentSearch']['filecss'] = 'home';
        $this->data['contentSearch']['filejs'] = 'home';
        $this->data['contentSearch']['slide'] = $this->all->select()->table('slide')->where('status_id','=',6)->get();
        $this->data['contentSearch']['box_sliding'] = $this->all->select()->table('box_sliding')->where('status_id','=',6)->get();
        if($key == '') {
            $response = new Response();
            $response->redirect(_WEB_ROOT);
        } else {
            $category = $this->all->select()->table('category')->whereLike('category_name',$key)->get();
            if(!empty($category)) {
                $this->data['contentSearch']['productSearch'] = $this->all->select()->table('product')->join('promotion','promotion_id = id_promotion')->where('status_id','=',6)->where('category_id','=',$category[0]['id_category'])->get();
            } else {
                $this->data['contentSearch']['productSearch'] = $this->all->select()->table('product')->join('promotion','promotion_id = id_promotion')->whereLike('product_name',$key)->whereLike('price_product',$key)->get();
            }
            $this->render('layouts/L_search',$this->data);
        }
    }
}