$(document).ready(function () {
    var newTotal = 0;
    $('input[name="totalunitPrice"]').each(function() {
        newTotal += parseInt($(this).val());
    });
    $('input[name="totalPrice"]').val(newTotal);
    var totalmoney = new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'VND' }).format(newTotal);
    $('.total-price__child').text(totalmoney);

    $('#formPut').on('submit',function(e) {
        e.preventDefault();
        if($('input[name="fullname"]').val() == '') {
            $('input[name="fullname"]').css('border','1px solid #e0052b');
            $('p.fullname').text('Vui lòng nhập họ tên');
        } else {
            $('input[name="fullname"]').css('border','1px solid #ced4da');
            $('p.fullname').text('');
        }

        if($('input[name="phone"]').val() == '') {
            $('input[name="phone"]').css('border','1px solid #e0052b');
            $('p.phone').text('Vui lòng nhập số điện thoại');
        }else if(!validateNumberPhone($('input[name="phone"]').val())) {
            $('input[name="phone"]').css('border','1px solid #e0052b');
            $('p.phone').text('Vui lòng kiểm tra lại số điện thoại');
        } else {
            $('input[name="phone"]').css('border','1px solid #ced4da');
            $('p.phone').text('');
        }

        if($('input[name="address"]').val() == '') {
            $('input[name="address"]').css('border','1px solid #e0052b');
            $('p.address').text('Vui lòng nhập địa chỉ');
        }else if($('input[name="address"]').val().length < 18) {
            $('input[name="address"]').css('border','1px solid #e0052b');
            $('p.address').text('Vui lòng kiểm tra lại địa chỉ');
        } else {
            $('input[name="address"]').css('border','1px solid #ced4da');
            $('p.address').text('');
        }

        if($('input[name="fullname"]').val() != '' && $('input[name="phone"]').val() != '' && $('input[name="address"]').val() != '' && $('input[name="message"]').val().length <= 120 && validateNumberPhone($('input[name="phone"]').val()) && $('input[name="address"]').val().length >= 18) {
            let url = $('base').attr('href');
            $.ajax({
                type: "POST",
                url: url+'/pay/confirmPutCart',
                data: {
                    total:$('input[name="totalPrice"]').val(),
                    fullname:$('input[name="fullname"]').val(),
                    phone:$('input[name="phone"]').val(),
                    email:$('input[name="email"]').val(),
                    address:$('input[name="address"]').val(),
                    payments:$('select[name="paymentMethods"]').val(),
                    message:$('input[name="message"]').val(),
                    type:'confirmPut'
                },
                dataType: "json",
                beforeSend: function () {
                    showToast('info','Vui lòng chờ');
                },
                success: function (data) {
                    if(data) {
                        showToast(data.icon,data.title);
                        if(data.id) {
                            setTimeout(() => {
                                window.location.href = url+'/dat-hang-thanh-cong?id='+data.id;
                            },1500);
                        }
                    }
                }
            });
        }
    })
});

const Toast = Swal.mixin({
    toast: true,
    position: 'top-center',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
});