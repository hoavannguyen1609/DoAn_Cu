$(document).ready(function() {
    $('i.fa-eye-slash').on('click',function() {
        if ($(this).hasClass("fa-eye-slash")) {
            $(this).addClass("fa-eye").removeClass("fa-eye-slash");
            $('input[name="password"]').attr('type','text');
        } else {
            $(this).addClass("fa-eye-slash").removeClass("fa-eye");
            $('input[name="password"]').attr('type','password');
        }
    });
    $('#login-form').on('submit',function(e) {
        e.preventDefault();
        let url = $('base').attr('href');
        var account = $('input[name="account"]').val();
        var password = $('input[name="password"]').val();

        if(account == '') {
            $('.account').html('Tài khoản trống!');
        } else {
            $('.account').html('');
        }

        if (password == '') {
            $('.password').html('Mật khẩu trống!');
        } else {
            $('.password').html('');
        }

        if(account != '' && password != '') {
            $.ajax({
                url: url+'/login/login',
                method: 'POST',
                cache: false,
                data:{account:account,password:password},
                dataType:'json', 
                beforeSend:function() {
                    $('input[name="login"]').val("Connecting ...");
                },
                success: function(data) {
                    $('input[name="login"]').val('Đăng nhập');
                    if(data.error) {
                        Swal.fire(data.error);
                    }
                    if(data.title && data.icon) {
                        let urlNow = location.href;
                        showToast(data.icon,data.title);
                        setTimeout(() => {
                            window.location.href = urlNow;
                        },3000)
                    }
                }
            });
        } else {
            return false;
        }
    });
});

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
  
function showToast(icon,text) {
    Toast.fire({
        icon: icon,
        title: '' +text
    })
}