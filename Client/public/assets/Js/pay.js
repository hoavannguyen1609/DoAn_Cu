let flag = false;
$(document).ready(function () {
    let id = $('input[name="id-product"]').val();
    if(localStorage.getItem("amountProductpaynow") && localStorage.getItem("idProductpaynow")) {
        var idPaynow = localStorage.getItem("idProductpaynow");
        var valueStorage = localStorage.getItem("amountProductpaynow");
        if(id == idPaynow) {
            $('#input-'+id).val(valueStorage);
        }
        if($('#input-'+id).val() == 1) {
            $('#btn-minus').attr('disabled','disabled');
            $('#btn-minus').css('opacity','0.5');
        }
        if($('#input-'+id).val() == 5) {
            $('#btn-plus').attr('disabled','disabled');
            $('#btn-plus').css('opacity','0.5');
        }
    } else {
        if($('#input-'+id).val() == 1) {
            $('#btn-minus').attr('disabled','disabled');
            $('#btn-minus').css('opacity','0.5');
        }
        if($('#input-'+id).val() == 5) {
            $('#btn-plus').attr('disabled','disabled');
            $('#btn-plus').css('opacity','0.5');
        }
    }
    setTotal($('#input-'+id).val(),$('input[name="unitPrice"]').val());

    $('input[name="message"]').keyup(function(e) {
        if($(this).val().length > 120) {
            $(this).css('border','1px solid #e0052b');
            $('p.message').text('Tối đa 120 ký tự');
            return false;
        } else {
            $(this).css('border','1px solid #ced4da');
            $('p.message').text('');
        }
    });

    $('#formPay').submit(function (e) { 
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
                url: url+'/pay/confirmPay',
                data: {
                    id: $('input[name="id-product"]').val(),
                    amount:$('input[name="amountProduct"]').val(),
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
                                // window.location.href = url+'/customer/orderPaynow?id='+data.id;
                                window.location.href = url+'/dat-hang-thanh-cong?id='+data.id;
                            },1500);
                        }
                    }
                }
            });
        }
    });
});

function minus(id) {
    $('#btn-plus').removeAttr('disabled');
    $('#btn-plus').css('opacity','1');
    if($('#input-'+id).val() > 1 && $('#input-'+id).val() <= 5) {
        var value = parseInt($('#input-'+id).val());
        value -= 1;
        $('#input-'+id).val(value);
        setTotal(value,$('input[name="unitPrice"]').val());
        if(value == 1) {
            $('#btn-minus').attr('disabled','disabled');
            $('#btn-minus').css('opacity','0.5');
        }
        setLocalstorage("idProductpaynow",id);
        setLocalstorage("amountProductpaynow",value);
    }
}

function plus(id) {
    $('#btn-minus').removeAttr('disabled');
    $('#btn-minus').css('opacity','1');
    if($('#input-'+id).val() >= 1 && $('#input-'+id).val() <= 4) {
        var value = parseInt($('#input-'+id).val());
        value += 1;
        $('#input-'+id).val(value);
        setTotal(value,$('input[name="unitPrice"]').val());
        if(value == 5) {
            $('#btn-plus').attr('disabled','disabled');
            $('#btn-plus').css('opacity','0.5');
        }
        setLocalstorage("idProductpaynow",id);
        setLocalstorage("amountProductpaynow",value);
    }
}

function setTotal(amount, unitPrice) {
    var price = unitPrice * amount;
    var totalPrice = new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'VND' }).format(price);
    $('.total-price__child').text(totalPrice);
    $('input[name="totalPrice"]').val(amount * unitPrice);
}

const Toast = Swal.mixin({
    toast: true,
    position: 'top-center',
    showConfirmButton: false,
    timer: 1500,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
})