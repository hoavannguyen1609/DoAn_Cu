$(window).on('load',function(event) {
    $('.load').delay(1000).fadeOut('fast');
});

$(document).ready(function() {
    $('i.fa-bars').on('click',function() {
        if ($(this).hasClass("fa-bars")) {
            $(this).addClass("fa-times").removeClass("fa-bars");
            $("#header-menu").fadeIn('fast');
            $('.overlay-body').fadeIn('fast');
        } else {
            $(this).addClass("fa-bars").removeClass("fa-times");
            $("#header-menu").fadeOut('fast');
            $('.overlay-body').fadeOut('fast');
        }
    });

    if($("#back-to-top").length > 0){
		$(window).scroll(function () {
			var e = $(window).scrollTop();
			if (e > 300) {
				$("#back-to-top").show();
                $("#back-to-top").css("display",'flex');
			} else {
				$("#back-to-top").hide();
			}
		});
		$("#back-to-top").click(function () {
			$('body,html').animate({
				scrollTop: 0
			});
		});
    }

    $('.form-search input').focus(function() { 
        $('.overlay-body').css('display','block');
    });

    $('.overlay-body').on('click',function () {
        $('.overlay-body').css('display','none');
    });

    window.fbAsyncInit = function() {
        FB.init({
            appId: "1784956665094089",
            xfbml: true,
            version: "v2.6"
        });
    };
    (function(d, s, id){
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) { return; }
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));

    $("body").hotline({phone:"0941470529",p_bottom:true,bottom:60,p_left:true,left:0,bg_color:"#e60808",abg_color:"rgba(230, 8, 8, 0.7)",show_bar:true,position:"fixed",});

    // window.fbMessengerPlugins = window.fbMessengerPlugins || { init : function() { FB.init({ appId: "1784956665094089", xfbml: true, version: "v3.0" }); }, callable : [] }; window.fbAsyncInit = window.fbAsyncInit || function() { window.fbMessengerPlugins.callable.forEach( function( item ) { item(); } ); window.fbMessengerPlugins.init(); }; setTimeout( function() { (function(d, s, id){ var js, fjs = d.getElementsByTagName(s)[0]; if (d.getElementById(id)) { return; } js = d.createElement(s); js.id = id; js.src = "//connect.facebook.net/vi_VN/sdk.js"; fjs.parentNode.insertBefore(js, fjs); }(document, 'script', 'facebook-jssdk')); }, 0);
});

function validateAccount(Account) {
    const RegexName = /^[a-zA-Z0-9]+$/;
    return RegexName.test(Account);
}

// function validateName(Name) {
//     const RegexName = /^[a-zA-Z!@#\$%\^\&*\)\(+=._-]{2,}$/g;
//     return RegexName.test(Name);
// }

function removeAscent (str) {
    if (str === null || str === undefined) return str;
    str = str.toLowerCase();
    str = str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g, "a");
    str = str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g, "e");
    str = str.replace(/ì|í|ị|ỉ|ĩ/g, "i");
    str = str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g, "o");
    str = str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g, "u");
    str = str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g, "y");
    str = str.replace(/đ/g, "d");
    return str;
}

function validatePassword(Password) {
    const RegexPassword = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*]).{8,}$/;
    return RegexPassword.test(Password);
}

function validateNumberPhone(NumberPhone) {
    const RegexNumberPhone = /((09|03|07|08|05)+([0-9]{8})\b)/g;
    return RegexNumberPhone.test(NumberPhone);
}

function validateEmail(Email) {
    const RegexEmail = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return RegexEmail.test(Email);
}

function validateDate_of_birth(Date_of_birth) {
    var RegexDate_of_birth = /^\d{1,2}\/\d{1,2}\/\d{4}$/;
    return RegexDate_of_birth.test(Date_of_birth);
}

function showToast(icon,message) {
    Toast.fire({
        icon: icon,
        title:' '+ message
    })
}

function setLocalstorage(name,amount) {
    localStorage.setItem(name, amount);
}