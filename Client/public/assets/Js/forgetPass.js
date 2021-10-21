let flag = false;
$(document).ready(function () {
    let url = $('base').attr('href');
    $('#forget-pass').on('submit',function (e) {
        e.preventDefault();
        if($('input[name="account"]').val() == '') {
            showToast('error','Vui lòng nhập tài khoản');
        } else if (flag == false) {
            flag = true;
            // showToast('info','Vui lòng chờ');
            $.ajax({
                method: "POST",
                url: url+"/customer/forgetPass",
                data: {account:$('input[name="account"]').val()},
                dataType: "json",
                beforeSend: function () {
                    $('input.btn').val('Vui lòng chờ');
                },
                success: function (data) {
                    if(data) {
                        flag = false;
                        $('input.btn').val('Lấy mã xác nhận');
                        if(data.error) {
                            showToast(data.error,data.title);
                        }
                        if(data.icon) {
                            showToast(data.icon,data.title);
                            setTimeout(() => {
                                window.location.href = url+'/xac-minh-tai-khoan?id='+data.id;
                            },2000)
                        }
                    }
                }
            });
        }
    });

    $('#confirm-otp').on('submit',function (e) {
        e.preventDefault();
        if($('input[name="confirm-otp"]').val() == '') {
            showToast('error','Vui lòng nhập mã xác nhận');
        } else if(!Number.isInteger(parseInt($('input[name="confirm-otp"]').val()))) {
            showToast('warning','Vui lòng kiểm tra lại mã xác nhận');
            setTimeout(() => {
                showToast('info','Mã xác nhận gồm 6 chữ số');
            },2000)
        }else if($('input[name="confirm-otp"]').val().length != 6) {
            showToast('info','Mã xác nhận gồm 6 chữ số');
        } else if (flag == false) {
            $.ajax({
                type: "POST",
                url: url+'/customer/confirmOTP',
                data: {codeOTP:$('input[name="confirm-otp"]').val(),id:$('input[name="idCustomer"]').val()},
                dataType: "json",
                success: function (data) {
                    if(data) {
                        if(data.error) {
                            showToast(data.error,data.title);
                        }
                        if(data.icon) {
                            showToast(data.icon,data.title);
                            setTimeout(() => {
                                window.location.href = url+'/dat-lai-mat-khau?id='+data.id;
                            },2000)
                        }
                    }
                }
            });
        }
    });

    $('#resetPass').on('submit',function (e) {
        e.preventDefault();
        if($('input[name="newPass"]').val() == '') {
            $('input[name="newPass"]').css('border','1px solid #e0052b');
            $('p.newPass').text('Vui lòng nhập mật khẩu mới');
        } else {
            $('input[name="newPass"]').css('border','1px solid #ced4da');
            $('p.newPass').text('');
        }

        if ($('input[name="confirmNewpass"]').val() == '') {
            $('input[name="confirmNewpass"]').css('border','1px solid #e0052b');
            $('p.confirmNewpass').text('Vui lòng nhập lại mật khẩu mới');
        } else {
            $('input[name="confirmNewpass"]').css('border','1px solid #ced4da');
            $('p.confirmNewpass').text('');
        }
        
        if($('input[name="confirmNewpass"]').val() != '' && $('input[name="newPass"]').val() != '') {
            if(!validatePassword($('input[name="newPass"]').val())) {
                $('p.newPass').html('- Mật khẩu phải bao gồm chữ hoa, chữ thường, số, ký tự đặc biệt <br> - Mật khẩu tối thiều 8 ký tự');
            } else if($('input[name="newPass"]').val().length > 12) {
                $('p.newPass').text('Mật khẩu tối đa 12 ký tự');
            } else if ($('input[name="confirmNewpass"]').val() != $('input[name="newPass"]').val()) {
                showToast('error','Mật khẩu không trùng khớp');
            } else if(flag == false) {
                $.ajax({
                    type: "POST",
                    url: url+'/customer/resetPass',
                    data: {
                        id:$('input[name="idCustomer"]').val(),
                        value:$('input[name="newPass"]').val()
                    },
                    dataType: "json",
                    beforeSend: function () {
                        $('resetPass__btn button.btn').text('Vui lòng chờ');
                    },
                    success: function (data) {
                        $('resetPass__btn button.btn').text('Xác nhận');
                        if(data) {
                            showToast(data.icon,data.title);
                            setTimeout(() => {
                                window.location.href = url+'/login';
                            })
                        }
                    }
                });
            }
        }
    });
});

const Toast = Swal.mixin({
    toast: true,
    position: 'center-center',
    showConfirmButton: false,
    timer: 2000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
})