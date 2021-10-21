let flag = false;
$(document).ready(function () {
    let url = $('base').attr('href');

    //Năm tự động điền vào select
    var seYear = $('#year');
    var date = new Date();
    var cur = date.getFullYear();

    for (i = cur; i >= 1921; i--) {
        seYear.append('<option value="'+i+'">'+i+'</option>');
    };
    
    //Tháng tự động điền vào select
    var seMonth = $('#month');
    
    var month=new Array();
    month[1]="01";
    month[2]="02";
    month[3]="03";
    month[4]="04";
    month[5]="05";
    month[6]="06";
    month[7]="07";
    month[8]="08";
    month[9]="09";
    month[10]="10";
    month[11]="11";
    month[12]="12";

    // seMonth.append('<option value="">-- Month --</option>');
    for (i = 1; i <= 12; i++) {
        seMonth.append('<option value="'+i+'">'+month[i]+'</option>');
    };
    
    $('#month').on('change',function () {
        setDate();
    });

    $('#year').on('change',function () { 
        setDate();
    });

    $('#update-profile').on('submit',function(e) {
        e.preventDefault();
        if(flag == false) {
            flag = true;
            var birthday = $('#year').val() +'-'+ $('#month').val() +'-'+ $('#day').val();
            if($('input[name="fullname"]').val() == '') {
                Swal.fire('Vui lòng nhập họ tên');
            } else if($('input[name="address"]').val() == '') {
                Swal.fire('Vui lòng nhập địa chỉ');
            } else if($('input[name="address"]').val() != '' && $('input[name="fullname"]').val() != '') {
                $.ajax({
                    url: url+"/customer/update",
                    method: "POST",
                    data: {
                        fullname:$('input[name="fullname"]').val(),
                        gender:$('#gender').val(),
                        address:$('input[name="address"]').val(),
                        birthday:birthday
                    },
                    dataType: 'json',
                    success: function(data) {
                        if(data) {
                            showToast(data.icon,data.title);
                            setTimeout(() => {
                                flag =false;
                            },2000);
                        }
                    }
                });
            }
        }
    });

    $('input[name="fileAvatar"]').on('change',function() {
        if($('input[name="fileAvatar"]').val() != '' && $('input[name="fileAvatar"]').val().lastIndexOf('.jpg') != -1 || $('input[name="fileAvatar"]').val().lastIndexOf('.jpeg') != -1 || $('input[name="fileAvatar"]').val().lastIndexOf('.gif') != -1 || $('input[name="fileAvatar"]').val().lastIndexOf('.png') != -1) {
            var fd = new FormData();
            var file_data = $('input[name="fileAvatar"]').prop('files')[0];
            fd.append("avatarCustomer",file_data);
            $.ajax({
                method: "POST",
                url: url+"/customer/updateAvatar",
                contentType: false,
                processData: false,
                data: fd,
                beforeSend :function () {
                    $('.img-account-change__img img').attr('src','https://ckbox.net/static/media/loading.50cd3412.gif')
                },
                success:function (data) {
                    if(data) {
                        $('#error_img').html(data);
                    } else {
                        setTimeout(() => {
                            window.location.href = url+'/tai-khoan';
                        },1500)
                    }
                }
            });
        } else if($('input[name="fileAvatar"]').val() != '' && $('input[name="fileAvatar"]').val().lastIndexOf('.jpg') == -1 && $('input[name="fileAvatar"]').val().lastIndexOf('.jpeg') == -1 && $('input[name="fileAvatar"]').val().lastIndexOf('.gif') == -1 && $('input[name="fileAvatar"]').val().lastIndexOf('.png') == -1) {
            Swal.fire('Vui lòng chọn đúng định dạng');
        } else if($('input[name="fileAvatar"]').val() == '') {
            return false;
        }
    });

    $('button.delMyorder').on('click',function (e) {
        e.preventDefault();
        Swal.fire({
            title: 'Hủy đơn hàng',
            text: "Bạn có chắc chắn muốn hủy?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: 'grey',
            confirmButtonText: 'Xác nhận'
          }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: url+'/customer/delOrder',
                    data:{id:parseInt($(this).data('id'))},
                    dataType: "json",
                    cache: false,
                    beforeSend: function() {
                        showToast('info','Vui lòng chờ');
                    },
                    success: function (data) {
                        if(data) {
                            showToast(data.icon,data.title);
                            setTimeout(() => {
                                window.location.href = url;
                            },3000);
                        }
                    }
                });
            }
        })
    });

    $('#changePassword').on('submit',function (e) {
        e.preventDefault();
        if($('input[name="oldPassword"]').val() == '') {
            Swal.fire('Vui lòng nhập mật khẩu cũ');
        } else if($('input[name="newPassword"]').val() == '') {
            Swal.fire('Vui lòng nhập mật khẩu mới');
        } else if ($('input[name="newPassword"]').val().length < 8) {
            Swal.fire('Mật khẩu tối thiểu 8 ký tự');
        } else if(!validatePassword($('input[name="newPassword"]').val())) {
            Swal.fire('Vui lòng nhập lại mật khẩu mới bao gồm chữ hoa, chữ thường, số và ký tự đặc biệt');
        } else if($('input[name="confirmPassword"]').val() != $('input[name="newPassword"]').val()) {
            Swal.fire('Vui lòng nhập lại mật khẩu mới');
        } else {
            if($('input[name="newPassword"]').val() !== $('input[name="confirmPassword"]').val()) {
                Swal.fire('Mật khẩu không trùng khớp');
            } else {
                Swal.fire({
                    title: 'Bạn có muốn lưu thay đổi?',
                    showDenyButton: true,
                    showCancelButton: true,
                    confirmButtonText: `Lưu`,
                    denyButtonText: `Không lưu`,
                  }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "POST",
                            url: url+"/customer/changePassword",
                            data: {
                                oldPass:$('input[name="oldPassword"]').val(),
                                newPass:$('input[name="newPassword"]').val()
                            },
                            dataType: "json",
                            success: function (data) {
                                if(data) {
                                    showToast(data.icon,data.title);
                                }
                            }
                        });
                    } else if (result.isDenied) {
                      Swal.fire('Thay đổi đã không được lưu', '', 'info')
                    }
                })
            }
        }
    });
});

function setDate() {
    var month = $('#month').val();
    if(month == 1 || month == 3 || month == 5 || month == 7 || month == 8 || month == 10 || month == 12) {
        for(var i = 1; i <= 31; i++) {
            if(i <= 9) {
                $('#day').append('<option value="'+i+'">0'+i+'</option>');
            } else {
                $('#day').append('<option value="'+i+'">'+i+'</option>');
            }
        }
    } else if(month == 4 || month == 6 || month == 9 || month == 11) {
        for(var i = 1; i <= 30; i++) {
            if(i <= 9) {
                $('#day').append('<option value="'+i+'">0'+i+'</option>');
            } else {
                $('#day').append('<option value="'+i+'">'+i+'</option>');
            }
        }
    } else if(month == 2 && ($('#year').val() % 4 == 0) && (($('#year').val() % 100 != 0)||($('#year').val() % 400 == 0))) {
        for(var i = 1; i <= 29; i++) {
            if(i <= 9) {
                $('#day').append('<option value="'+i+'">0'+i+'</option>');
            } else {
                $('#day').append('<option value="'+i+'">'+i+'</option>');
            }
        }
    } else if (month == 2 && ($('#year').val() % 4 != 0) && (($('#year').val() % 100 == 0)||($('#year').val() % 400 != 0))) {
        for(var i = 1; i <= 28; i++) {
            if(i <= 9) {
                $('#day').append('<option value="'+i+'">0'+i+'</option>');
            } else {
                $('#day').append('<option value="'+i+'">'+i+'</option>');
            }
        }
    }
}

function openInNewTab(href) {
    Object.assign(document.createElement('a'), {
      target: '_blank',
      href,
    }).click();
}

const Toast = Swal.mixin({
    toast: true,
    position: 'center-center',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
})