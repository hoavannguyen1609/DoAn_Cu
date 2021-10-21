$(document).ready(function () {
    let url = $('base').attr('href');
    function fetchProvince() {
        $.ajax({
            type: "GET",
            url: url+'/registration/selectAddress',
            dataType: "json",
            cache:false,
            success: function (data) {
                if(data) {
                    $(data).each(function (index,value) { 
                        $('#province').append('<option value="'+value['province_name']+'">'+value['province_name']+'</option>');
                    });
                }
            }
        });
    }
    fetchProvince();

    $('input[name="province"]').on('change',function (e) {
        $('input[name="district"]').empty();
        $('#district').empty();
        e.preventDefault();
        if($(this).val() != '') {
            $.ajax({
                type: "POST",
                url: url+"/registration/selectAddress",
                data: {
                    provinceName:$(this).val()
                },
                dataType: "json",
                cache: false,
                success: function (data) {
                    if(data) {
                        $('.district_list').css('display','block');
                        $(data).each(function(index,value){
                            $('#district').append('<option value="'+value['district_name']+'">'+value['district_name']+'</option>');
                        })
                    }
                }
            });
        } else {
            $('.district_list').css('display','none');
            $('input[name="district"]').val('');
        }
    });

    $('input[name="district"]').change(function (e) {
        $('input[name="commune"]').empty();
        e.preventDefault();
        if($(this).val() != '') {
            $('.commune_list').css('display','block');
        } else {
            $('.commune_list').css('display','none');
            $('input[name="commune"]').val('');
        }
    });

    $('.registration-form').on('submit',function(e) {
        e.preventDefault();
        if($('input[name="fullname"]').val() == '') {
            $('input[name="fullname"]').css('border','1px solid #e0052b');
            $('p.fullname').text('Vui lòng nhập họ tên');
        } else {
            $('input[name="fullname"]').css('border','1px solid #ced4da');
            $('p.fullname').text('');
        }

        if($('input[name="account"]').val() == '') {
            $('input[name="account"]').css('border','1px solid #e0052b');
            $('p.account').text('Vui lòng nhập tài khoản');
        } else if($('input[name="account"]').val().length < 8) {
            $('input[name="account"]').css('border','1px solid #e0052b');
            $('p.account').text('Tài khoản tối thiểu 8 ký tự');
        }  else if(!validateAccount($('input[name="account"]').val())) {
            $('input[name="account"]').css('border','1px solid #e0052b');
            $('p.account').text('Tài khoản không được chứa ký tự đặc biệt');
        } else {
            $('input[name="account"]').css('border','1px solid #ced4da');
            $('p.account').text('');
        }

        if($('input[name="password"]').val() == '') {
            $('input[name="password"]').css('border','1px solid #e0052b');
            $('p.password').text('Vui lòng nhập mật khẩu');
        } else if($('input[name="password"]').val().length < 8 || $('input[name="password"]').val().length > 12) {
            $('input[name="password"]').css('border','1px solid #e0052b');
            $('p.password').text('Mật khẩu tối thiểu 8 ký tự và tối đa 12 ký tự');
        }  else if(!validatePassword($('input[name="password"]').val())) {
            $('input[name="password"]').css('border','1px solid #e0052b');
            $('p.password').html('Mật khẩu phải bao gồm chữ hoa, chữ thường, số,<br>ký tự đặc biệt');
        } else {
            $('input[name="password"]').css('border','1px solid #ced4da');
            $('p.password').html('');
        }

        if($('input[name="confirmPassword"]').val() == '') {
            $('input[name="confirmPassword"]').css('border','1px solid #e0052b');
            $('p.confirmPassword').text('Vui lòng nhập lại mật khẩu');
        } else if($('input[name="confirmPassword"]').val() != $('input[name="password"]').val()) {
            $('input[name="confirmPassword"]').css('border','1px solid #e0052b');
            $('input[name="password"]').css('border','1px solid #e0052b');
            $('p.confirmPassword').text('Mật khẩu không trùng khớp');
        } else {
            $('input[name="confirmPassword"]').css('border','1px solid #ced4da');
            $('p.confirmPassword').html('');
        }

        if(typeof $('input[name="gender"]:checked').val() == "undefined") {
            $('.gender').text('Vui lòng chọn giới tính!');
        } else {
            $('.gender').text('');
        }

        if($('input[name="birthday"]').val() == '') {
            $('input[name="birthday"]').css('border','1px solid #e0052b');
            $('p.birthday').text('Vui lòng nhập ngày sinh');
        }  else if(!validateDate_of_birth($('input[name="birthday"]').val())) {
            $('input[name="birthday"]').css('border','1px solid #e0052b');
            $('p.birthday').text('Vui lòng nhập đúng định dạng ngày/tháng/năm');
        } else {
            $('input[name="birthday"]').css('border','1px solid #ced4da');
            $('p.birthday').text('');
        }

        if($('input[name="phone"]').val() == '') {
            $('input[name="phone"]').css('border','1px solid #e0052b');
            $('p.phone').text('Vui lòng nhập số điện thoại');
        }  else if(!validateNumberPhone($('input[name="phone"]').val())) {
            $('input[name="phone"]').css('border','1px solid #e0052b');
            $('p.phone').text('Vui lòng nhập đúng só điện thoại Việt Nam');
        } else {
            $('input[name="phone"]').css('border','1px solid #ced4da');
            $('p.phone').text('');
        }

        if($('input[name="email"]').val() == '') {
            $('input[name="email"]').css('border','1px solid #e0052b');
            $('p.email').text('Vui lòng nhập email');
        }  else if(!validateEmail($('input[name="email"]').val())) {
            $('input[name="email"]').css('border','1px solid #e0052b');
            $('p.email').text('Vui lòng nhập đúng định dạng email');
        } else {
            $('input[name="email"]').css('border','1px solid #ced4da');
            $('p.email').text('');
        }

        if($('input[name="province"]').val() == '') {
            $('p.address').text('Vui lòng chọn Tỉnh/Thành phố');
            $('input[name="province"]').css('border','1px solid #e0052b');
        } else {
            $('input[name="province"]').css('border','1px solid #ced4da');
            if($('input[name="district"]').val() == '') {
                $('input[name="district"]').css('border','1px solid #e0052b');
                $('p.address').text('Vui lòng chọn Quận/Huyện');
            } else {
                $('input[name="district"]').css('border','1px solid #ced4da');
                if($('input[name="commune"]').val() == '') {
                    $('p.address').text('Vui lòng nhập Xã/Phường');
                    $('input[name="commune"]').css('border','1px solid #e0052b');
                } else {
                    $('input[name="commune"]').css('border','1px solid #ced4da');
                    $('p.address').text('');
                }
            }
        }
 
        if ($('input[name="file"]').val() != '') {
            if ($('input[name="file"]').val().lastIndexOf('.jpg') == -1 && $('input[name="file"]').val().lastIndexOf('.jpeg') == -1 && $('input[name="file"]').val().lastIndexOf('.gif') == -1 && $('input[name="file"]').val().lastIndexOf('.png') == -1) {
                $('p.file').text('Vui lòng chọn đúng định dạng ảnh cho phép!');
            } else {
                $('p.file').text('');
            }
        }

        if($('input[name="fullname"]').val() != '' && $('input[name="account"]').val() != '' && validateAccount($('input[name="account"]').val()) && $('input[name="password"]').val() != '' && validatePassword($('input[name="password"]').val()) && $('input[name="password"]').val() == $('input[name="confirmPassword"]').val() && typeof $('input[name="gender"]:checked').val() != "undefined" && $('input[name="birthday"]').val() != '' && validateDate_of_birth($('input[name="birthday"]').val()) && $('input[name="phone"]').val() != '' && validateNumberPhone($('input[name="phone"]').val()) && $('input[name="email"]').val() != '' && validateEmail($('input[name="email"]').val()) && $('input[name="province"]').val() != '' && $('input[name="district"]').val() != '' && $('input[name="commune"]').val() != '' && $('input[name="password"]').val().length <= 12) {
            var address = $('input[name="commune"]').val() +', '+$('input[name="district"]').val() +', '+$('input[name="province"]').val();
            if($('input[name="file"]').val() != '') {
                if($('input[name="file"]').val().lastIndexOf('.jpg') != -1 || $('input[name="file"]').val().lastIndexOf('.jpeg') != -1 || $('input[name="file"]').val().lastIndexOf('.gif') != -1 || $('input[name="file"]').val().lastIndexOf('.png') != -1) {
                    var fd = new FormData($('.registration-form')[0]);
                    var file_data = $('input[name="file"]').prop('files')[0];
                    fd.append("avatarCustomer",file_data);
                    if(file_data) {
                        $.ajax({
                            url: url+"/createAccount",
                            dataType: 'json',
                            contentType: false,
                            processData: false,
                            data: fd,
                            method: 'POST',
                            beforeSend: function() {
                                $('input[name="registration"]').val('Checking ...');
                                $('input[name="registration"]').attr('disabled','disabled');
                                showToast('info','Vui lòng chở');
                            },
                            success: function(data){
                                $('input[name="registration"]').removeAttr('disabled');
                                $('input[name="registration"]').val('Đăng ký');
                                if(data) {
                                    if(data.error) {
                                        showToast(data.error,data.title);
                                    }
                                    if(data.icon) {
                                        showToast(data.icon,data.title);
                                        setTimeout(() => {
                                            window.location.href = url+'/login';
                                        },2000)
                                    }
                                }
                            }
                        });
                    }
                } else {
                    $('.file').text('Vui lòng chọn đúng định dạng ảnh cho phép');
                    return false;
                }
            } else {
                $.ajax({
                    url: url+"/createAccount",
                    data:{account:$('input[name="account"]').val(),
                        password:$('input[name="password"]').val(),
                        fullname:$('input[name="fullname"]').val(),
                        gender:$('input[name="gender"]:checked').val(),
                        birthday:$('input[name="birthday"]').val(),
                        phone:$('input[name="phone"]').val(),
                        email:$('input[name="email"]').val(),
                        address:address
                    },
                    method: 'POST',
                    dataType: 'json',
                    beforeSend: function() {
                        $('input[name="registration"]').val('Checking ...');
                        $('input[name="registration"]').attr('disabled','disabled');
                        showToast('info','Vui lòng chở');
                    },
                    success: function(data){
                        $('input[name="registration"]').removeAttr('disabled');
                        $('input[name="registration"]').val('Đăng ký');
                        if(data) {
                            if(data.error) {
                                showToast(data.error,data.title);
                            }
                            if(data.icon) {
                                showToast(data.icon,data.title);
                                setTimeout(() => {
                                    window.location.href = url+'/login';
                                },2000)
                            }
                        }
                    }
                });
            }
        }
    })
});

const Toast = Swal.mixin({
    toast: true,
    position: 'top-center',
    showConfirmButton: false,
    timer: 2000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
})