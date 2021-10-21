<?php
class M_pay extends core_Model {
    public $idTotalorder_new;
    public function insertOrderdetail($productId,$amout,$totalId,$customerId) {
        $this->all->insertData("order_details",array(
            'product_id' => $productId,
            'amount_product_order' => $amout,
            'total_order_id' => $totalId,
            'customer_id' => $customerId
        ));
    }

    public function insertTotalOrder($idTotal,$fullname,$phone,$address,$codeOrder,$totalPrice,$payments,$message,$idCustomer) {
        $this->all->insertData('total_order',array(
            'id_total_order' => $idTotal,
            'customer_name' => $fullname,
            'customer_phone' => $phone,
            'customer_address' => $address,
            'code_order' => $codeOrder,
            'total_order_price' => $totalPrice,
            'payments' => $payments,
            'message' => $message,
            'customer_id' => $idCustomer,
            'status_id' => 1
        ));
    }

    function sendMailer($title2,$body2,$nTo2,$mTo2) {
        $nForm = "CellphoneS";
        $mFrom = 'hoavannguyen1609@gmail.com';
        $mPass = 'nguyenhoa16290102';
        $nTo = $nTo2;
        $mTo =  $mTo2;
        $mail             = new PHPMailer();
        $body             = $body2;
        $title = $title2;
        $mail->IsSMTP();             
        $mail->CharSet  = "utf-8";
        $mail->SMTPDebug  = 0;
        $mail->SMTPAuth   = true;
        $mail->SMTPSecure = "ssl";
        $mail->Host       = "smtp.gmail.com";
        $mail->Port       = 465;
        // xong phan cau hinh bat dau phan gui mail
        $mail->Username   = $mFrom;
        $mail->Password   = $mPass;
        $mail->SetFrom($mFrom, $nForm);
        $mail->AddReplyTo('hoavannguyen1609@gmail.com', 'Admin CellphoneS');
        $mail->Subject    = $title;
        $mail->MsgHTML($body);
        $mail->AddAddress($mTo, $nTo);
        // thuc thi lenh gui mail 
        if(!$mail->Send()) {
            return 0;  
        } else {
            return 1;
        }
    }
}