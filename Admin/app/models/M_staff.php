<?php
class M_staff extends core_Model {
    public function edit($param) {
        $allowance = $this->all->getAll('allowance_position',array('position_allowance' => $param['position']));
        $position = $this->all->getAll('adminstrator',array('id_admin' => $param['id']));
        $getAvatar = $this->all->getAll('adminstrator',array('id_admin' => $param['id']));
        if(!empty($getAvatar)) {
            if(strlen(strstr($getAvatar[0]['avatar_admin'],'avatarDefault/')) > 0) {
                $avatar = 'avatarDefault/';
                if ($param['gender'] == 1) {
                    $avatar .= 'avatarDefaultMail.jpg';
                }
                if ($param['gender'] == 2) {
                    $avatar .= 'avatarDefaultFermail.jpg';
                }
                if ($param['gender'] == 3) {
                    $avatar .= 'avatarDefault.png';
                }
            } else {
                $avatar = $getAvatar[0]['avatar_admin'];
            }
        }
        $avatarR = _AVATAR_ADMIN .$avatar;
        if($position[0]['position'] == 3) {
            $this->all->update('adminstrator',array(
                'avatar_admin' => $avatar,
                'name' => $param['name'],
                'gender' => $param['gender'],
                'birthday' => $param['birthday'],
                'phone' => trim($param['phone']),
                'email' => trim($param['email']),
                'address' => trim($param['address']),
                'working_day' => trim($param['workDay']),
                'bank_account' => trim($param['bank']),
                'allowance_position_id' => $allowance[0]['id_allowance']
            ),array('id_admin' => $param['id']));
            $this->all->update('salary',array(
                'salary_allowance_work_date' => $param['allowance']
            ),array('admin_id' => $param['id']));
            if($param['position'] != $position[0]['position']) {
                return ['icon' => 'success','title' => 'Thay đổi thành công, không thể thay đổi chức vụ','allowance' => $allowance[0]['allowance_level'],'id' => $param['id'],'avatar' => $avatarR];
            } else {
                return ['icon' => 'success','title' => 'Thay đổi thành công','allowance' => $allowance[0]['allowance_level'],'id' => $param['id'],'avatar' => $avatarR];
            }
        } else {
            $this->all->update('adminstrator',array(
                'avatar_admin' => $avatar,
                'name' => $param['name'],
                'gender' => $param['gender'],
                'birthday' => $param['birthday'],
                'phone' => trim($param['phone']),
                'email' => trim($param['email']),
                'address' => trim($param['address']),
                'position' => $param['position'],
                'working_day' => trim($param['workDay']),
                'bank_account' => trim($param['bank']),
                'allowance_position_id' => $allowance[0]['id_allowance']
            ),array('id_admin' => $param['id']));
            $this->all->update('salary',array(
                'salary_allowance_work_date' => $param['allowance']
            ),array('admin_id' => $param['id']));
            return ['icon' => 'success','title' => 'Thay đổi thành công','allowance' => $allowance[0]['allowance_level'],'id' => $param['id'],'avatar' => $avatarR];
        }
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