let flag = false;
$(document).ready(function () {
    $('.cart-list__input input').each(function () {
        var id = $(this).data('id');
        if($(this).val() == 1) {
            $('button#btn-minus-'+id).attr('disabled','disabled');
            $('button#btn-minus-'+id).css('opacity','0.5');
        }
        if($(this).val() == 5) {
            $('button#btn-plus-'+id).attr('disabled','disabled');
            $('button#btn-plus-'+id).css('opacity','0.5');
        }
    });
    fetchTotalmoney();
});

function fetchTotalmoney() {
    let newTotal = 0;
    $('input.newTotal').each(function () {
        newTotal += parseInt($(this).val());
    });
    $('#totalMoneyip').val(newTotal);
    var totalmoney = new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'VND' }).format(newTotal);
    $('#totalMoney').text('Tổng thanh toán: '+totalmoney);
}

function minusProduct(id) {
    let url = $('base').attr('href');
    $('button#btn-plus-'+id).removeAttr('disabled');
    $('button#btn-plus-'+id).css('opacity','1');
    if(flag == false) {
        flag = true;
        if($('input#input-'+id).val() >= 2 && $('input#input-'+id).val() <= 5) {
            var value = $('input#input-'+id).val() - 1;
            $('input#input-'+id).val(value);
            $.ajax({
                type: "POST",
                url: url+'/cart/changeProduct',
                data: {
                    id: id,
                    value:$('input#input-'+id).val()
                },
                async:false,
                dataType: "json",
                success: function (data) {
                    if(data) {
                        if(data.value == 1) {
                            $('button#btn-minus-'+id).attr('disabled','disabled');
                            $('button#btn-minus-'+id).css('opacity','0.5');
                        }
                        let newPrice = parseInt($('#new-price'+id).val());
                        $('#newTotal-'+id).val(newPrice * parseInt(data.value));
                        var price = new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'VND' }).format(newPrice * parseInt(data.value));
                        $('#total-price-'+data.id).text(price);
                        setTimeout(() => {
                            flag = false;
                        },600);
                        fetchTotalmoney();
                    }
                }
            });
        }
    }
}

function plusProduct(id) {
    let url = $('base').attr('href');
    if(flag == false) {
        flag = true;
        $('button#btn-minus-'+id).removeAttr('disabled');
        $('button#btn-minus-'+id).css('opacity','1');
        if($('input#input-'+id).val() <= 4 && $('input#input-'+id).val() >= 1) {
            var value = parseInt($('input#input-'+id).val()) + 1;
            $('input#input-'+id).val(value);
            $.ajax({
                type: "POST",
                url: url+'/cart/changeProduct',
                data: {
                    id: id,
                    value:$('input#input-'+id).val()
                },
                async:false,
                dataType: "json",
                success: function (data) {
                    if(data) {
                        if(data.value == 5) {
                            $('button#btn-plus-'+id).attr('disabled','disabled');
                            $('button#btn-plus-'+id).css('opacity','0.5');
                        }
                        let newPrice = parseInt($('#new-price'+id).val());
                        $('#newTotal-'+id).val(newPrice * parseInt(data.value));
                        var price = new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'VND' }).format(newPrice * parseInt(data.value));
                        $('#total-price-'+data.id).text(price);
                        setTimeout(() => {
                            flag = false;
                        },600);
                        fetchTotalmoney();
                    }
                }
            });
        }
    }
}

function delProduct(url) {
    let href = $('base').attr('href');
    Swal.fire({
        title: 'Bạn có chắc?',
        text: "Bạn có chắc chắn muốn xóa!",
        icon: 'error',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Xóa!'
      }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "POST",
                url: url,
                dataType: "json",
                cache: false,
                success: function (data) {
                    if(data) {
                        let current = 'tr-' + data.id;
                        $('input#newTotal-'+data.id).removeClass('newTotal');
                        showToast(data.icon,data.title);
                        $('#'+current).hide(1500);
                        if($('input.newTotal').length >= 1) {
                            fetchTotalmoney();
                        } else if($('input.newTotal').length <= 0) {
                            $('#cart .title').css('display','none');
                            $('#cart .cart-title').css('display','none');
                            $('.pay').css('display','none');
                            $('#cart').append('<div class="back-to-shop l-10 l-o-1 m-10 m-o-1 c-10 c-o-1"><a href="'+href+'" class=" text-decoration-none"><span> < Tiếp tục mua sắm tại cửa hàng</span></a></div><div class="empty-cart py-5"><div class="empty-cart__group text-center"><div class="empty-cart__icon pb-3 text-center"><i class="fas fa-cart-plus"></i></div><div class="empty-cart__text text-center"><p class="mb-0">Giỏ hàng trống</p></div></div></div>');
                        }
                        
                    }
                }
            });
        }
    })
}

function showToast(icon,message) {
    Toast.fire({
        icon: icon,
        title:' '+ message
    })
}

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