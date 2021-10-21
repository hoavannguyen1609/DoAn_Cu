<?php
class C_product extends baseModels {
    
    public function __construct() {
        $this->modelProduct = $this->baseModel('M_product');
    }

    public function index() {
        if(!empty(Session::dataSS('admin_cps'))) {
            $dataProduct = $this->all->getAll('product',array());
            $dataCategory = $this->all->getAll('category',array());
            $dataPromotion = $this->all->getAll('promotion',array());
            $dataManufacturer = $this->all->getAll('manufacturer',array());
            // $html = $this->getView('');
            echo json_encode($dataProduct);
        }
    }

    public function loadCategory() {
        if(!empty(Session::dataSS('admin_cps'))) {
            $dataCategory = $this->all->getAll('category',array());
            $htmlTop = $this->getView('V_categoryTop');
            $html = $this->getView('V_category');
            echo json_encode(['data' => $dataCategory,'top' => $htmlTop,'html' => $html]);
        }
    }

    public function editCategory() {
        if(!empty(Session::dataSS('admin_cps'))) {
            if(isset($_POST['id']) && isset($_POST['value'])) {
                $before = $this->all->getAll('category',array('id_category' => $_POST['id']));
                if($_POST['value'] == $before[0]['category_name']) {
                    echo json_encode(['icon' => 'success','title' => 'Không có gì thay đổi']);
                } else {
                    $this->all->update('category',array(
                        'category_name' => $_POST['value']
                    ),array('id_category' => $_POST['id']));
                    $content = 'Đã thay đổi từ '.$before[0]['category_name'] .' thành '.$_POST['value'];
                    $this->modelProduct->insertHistoryChange($content,2);
                    echo json_encode(['icon' => 'success','title' => 'Thay đổi thành công']);
                }
            }
        }
    }

    public function changeStatus() {
        if(!empty(Session::dataSS('admin_cps'))) {
            if(isset($_POST['id']) && isset($_POST['type'])) {
                $param['id'] = $_POST['id'];
                $param['status'] = $_POST['status'];
                $param['controller'] = $_POST['controller'];
                $param['typeHistory'] = $_POST['typeHistory'];
                $idAdmin = $this->all->getAll('adminstrator',array('account' => md5(Session::dataSS('admin_cps'))));
                $param['id_admin'] = $idAdmin[0]['id_admin'];
                $result = $this->modelProduct->changeStatus($param,$_POST['type']);
                echo json_encode($result);
            }
        }
    }

    public function delCategory($id) {
        if(!empty(Session::dataSS('admin_cps'))) {
            if(!empty($id)) {
                $check = $this->all->getAll('product',array('category_id' => $id));
                if(!empty($check)) {
                    if(count($check) <= 3) {
                        $content = '';
                        foreach($check as $value) {
                            $content .= $value['product_name'] .', ';
                        }
                        $content = rtrim($content,', ');
                        echo json_encode(['icon' => 'error','title' => 'Vui lòng thay đổi danh mục của sản phẩm '.$content]);
                    } else {
                        echo json_encode(['icon' => 'error','title' => 'Vui lòng thay đổi '.count($check).' sản phẩm thuộc danh mục này']);
                    }
                } else {
                    $categorySpec = $this->all->getAll('category_specs',array('category_id' => $id));
                    $categoryName = $this->all->getAll('category',array('id_category' => $id));
                    $content = 'Đã xóa danh mục: ' .$categoryName[0]['category_name'];
                    if(!empty($categorySpec)) {
                        $this->all->delete('category_specs',array('category_id' => $id));
                    }
                    $this->all->delete('category',array('id_category' => $id));
                    $this->modelProduct->insertHistoryChange($content,2);
                    echo json_encode(['icon' => 'success','title' => 'Xóa danh mục thành công']);
                }
            }
        }
    }
    
    public function loadmanufacturer() {
        $data = $this->all->getAll('manufacturer',array());
        $htmlTop = $this->getView('V_manufacturerTop');
        $html = $this->getView('V_manufacturer');
        echo json_encode(['top' => $htmlTop,'data' => $data,'html' => $html]);
    }

    public function addmanufacturer($name) {
        if(!empty($name)) {
            $this->all->insertData('manufacturer',array('manufacturer_name' => $name));
            $content = 'Đã thêm hãng sản xuất: ' .$name;
            $this->modelProduct->insertHistoryChange($content,3);
            echo json_encode(['icon' => 'success','title' => 'Thêm hãng sản xuất thành công']);
        }
    }

    public function editmanufacturerName() {
        if(!empty(Session::dataSS('admin_cps'))) {
            if(isset($_POST['value']) && isset($_POST['id'])) {
                $before = $this->all->getAll('manufacturer',array('id_manufacturer' => $_POST['id']));
                if($_POST['value'] == $before[0]['manufacturer_name']) {
                    echo json_encode(['icon' => 'success','title' => 'Không có gì thay đổi']);
                } else {
                    $this->all->update('manufacturer',array('manufacturer_name' => $_POST['value']),array('id_manufacturer' => $_POST['id']));
                    $content = 'Đã thay đổi từ: ' .$before[0]['manufacturer_name'] .' thành: ' .$_POST['value'];
                    $this->modelProduct->insertHistoryChange($content,3);
                    echo json_encode(['icon' => 'success','title' => 'Thay đổi thành công']);
                }
            }
        }
    }

    public function delmanufacturer($id) {
        if(!empty(Session::dataSS('admin_cps'))) {
            $check = $this->all->getAll('product',array('manufacturer_id' => $id));
            if(!empty($check)) {
                $result = '';
                if(count($check) <= 3) {
                    foreach($check as $value) {
                        $result .= $value['product_name'] .', ';
                    }
                    $result = rtrim($result,', ');
                    echo json_encode(['icon' => 'warning','title' => 'Vui lòng thay đổi hãng sản xuất của sản phẩm ' .$result]);
                } else {
                    echo json_encode(['icon' => 'warning','title' => 'Vui lòng thay đổi '.count($check). ' sản phẩm thuộc hãng sản xuất này']);
                }
            } else {
                $before = $this->all->getAll('manufacturer',array('id_manufacturer' => $id));
                $content = 'Đã xóa: ' .$before[0]['manufacturer_name'];
                $this->modelProduct->insertHistoryChange($content,3);
                $this->all->delete('manufacturer',array('id_manufacturer' => $id));
                echo json_encode(['icon' => 'success','title' => 'Xóa thành công','id' => $id]);
            }
        }
    }

    public function loadPromotion() {
        $data = $this->all->getAll('promotion',array());
        $htmlTop = $this->getView('V_promotionTop');
        $html = $this->getView('V_promotion');
        echo json_encode(['data' => $data,'htmltop' => $htmlTop,'html' => $html]);
    }

    public function editPromotion() {
        if(isset($_POST['value']) && isset($_POST['id'])) {
            $before = $this->all->getAll('promotion',array('id_promotion' => $_POST['id']));
            if($_POST['value'] == $before[0]['promotion_name']) {
                echo json_encode(['icon' => 'success','title' => 'Không có gì thay đổi']);
            } else {
                $this->all->update('promotion',array('promotion_name' => $_POST['value']),array('id_promotion' => $_POST['id']));
                $content = 'Đã thay đổi từ: ' .$before[0]['promotion_name'] .' thành: ' .$_POST['value'];
                $this->modelProduct->insertHistoryChange($content,4);
                echo json_encode(['icon' => 'success','title' => 'Thay đổi thành công']);
            }
        }
    }

    public function delPromotion($id) {
        if(!empty($id)) {
            $check = $this->all->getAll('product',array('promotion_id' => $id));
            if(!empty($check)) {
                $result = '';
                if(count($check) <= 3) {
                    foreach($check as $value) {
                        $result .= $value['product_name'] .', ';
                    }
                    $result = rtrim($result,', ');
                    echo json_encode(['icon' => 'warning','title' => 'Vui lòng thay đổi khuyên mãi của sản phẩm: ' .$result]);
                } else {
                    echo json_encode(['icon' => 'warning','title' => 'Vui lòng thay đổi khuyên mãi của '.count($check).' sản phẩm']);
                }
            } else {
                $before = $this->all->getAll('promotion',array('id_promotion' => $id));
                $content = 'Đã xóa khuyến mãi ' .$before[0]['promotion_name'];
                $this->all->delete('promotion',array('id_promotion' => $id));
                $this->modelProduct->insertHistoryChange($content,4);
                echo json_encode(['icon' => 'success','title' => 'Xóa khuyến mãi thành công','id' => $id]);
            }
        }
    }

    public function addPromotion($name) {
        $this->all->insertData('promotion',array('promotion_name' => $name));
        $content = 'Đã thêm khuyến mãi' .$name;
        $this->modelProduct->insertHistoryChange($content,4);
        echo json_encode(['icon' => 'success','title' => 'Thêm khuyến mãi thành công']);
    }
}