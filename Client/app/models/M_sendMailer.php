<?php
class M_sendMailer {
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