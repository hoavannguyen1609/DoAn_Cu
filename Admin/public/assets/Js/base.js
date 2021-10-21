// new WOW().init();

$(document).ready(function () {

  $('a.notify').on('click', function () {
    if ($('.drop-down__notify.block').length > 0) {
      $('.drop-down__notify').removeClass('block');
    } else {
      $('.drop-down__notify').addClass('block');
    }
  });

  $('a.sidebar__link').on('click', function () {
    var p = $(this).children('p');
    var parent = $(this).parent('.sidebar__item');
    var childParent = parent.children('.sidebar__list-child');
    if ($(this).hasClass('active')) {
      if (childParent.length > 0) {
        var liChild = childParent.children('li.sidebar__item-child');
        if (liChild.length > 0) {
          var i = 0;
          while (i <= liChild.length) {
            var aActive = liChild.children('a.active');
            i++;
          }
          if (aActive.length > 0) {
            if (childParent.css('display') != 'none') {
              childParent.slideUp();
            } else {
              childParent.slideDown();
            }
          } else {
            if (childParent.css('display') != 'none') {
              childParent.slideUp();
            } else {
              childParent.slideDown();
            }
            // p.children('i.fa-angle-down').removeClass('active');
            // $(this).removeClass('active');
          }
        } else {
          return false;
        }
      } else {
        // $(this).removeClass('active');
      }
    } else {
      if ($('a.sidebar__link.active').length > 0) {
        $('a.sidebar__link.active').removeClass('active');
      }
      $('i.fa-angle-down').removeClass('active');
      p.children('i.fa-angle-down').addClass('active');
      $('.sidebar__list-child').slideUp();
      $(this).addClass('active');
      if (childParent.length > 0) {
        childParent.slideDown();
      }
      if ($(this).children('i.fa-history').length > 0) {
        $(this).children('i.fa-history').addClass('active');
      }
    }
  });

  $('.sidebar__item-child a').on('click', function () {
    if ($(this).hasClass('active')) {
      $(this).removeClass('active');

    } else {
      if ($('.sidebar__item-child a.active').length > 0) {
        $('.sidebar__item-child a.active').removeClass('active');
      }
      $(this).addClass('active');
    }
  });

  $('.overlay').on('click', function () {
    $(this).css('display', 'none');
    if ($('aside.sidebar__mini').length > 0) {
      $('aside').addClass('hideSidebar');
      $('aside').removeClass('sidebar__mini');
    }
    setTimeout(() => {
      $('aside').removeClass('hideSidebar');
    }, 1000);
  });
});

function setMargin() {
  if ($('#main.all.sidebar-collapse').length > 0) {
    $('#main.all.sidebar-collapse').removeClass('sidebar-collapse');
    $('.setMargin i').replaceWith('<i class="far fa-arrow-alt-circle-left"></i>');
  } else {
    $('#main.all').addClass('sidebar-collapse');
    $('.setMargin i').replaceWith('<i class="far fa-arrow-alt-circle-right"></i>');
  }
}

function showSidebar() {
  $('aside').addClass('sidebar__mini');
  $('.overlay').css('display', 'block');
}

function openFullscreen() {
  if (document.documentElement.requestFullscreen) {
    document.documentElement.requestFullscreen();
  } else if (document.documentElement.webkitRequestFullscreen) {
    document.documentElement.webkitRequestFullscreen();
  } else if (document.documentElement.msRequestFullscreen) {
    document.documentElement.msRequestFullscreen();
  }
  $('a.change-screen').replaceWith('<a href="javascript:closeFullscreen()" class="change-screen"><i class="fas fa-compress-arrows-alt"></i></a>');
}

function closeFullscreen() {
  if (document.exitFullscreen) {
    document.exitFullscreen();
  } else if (document.webkitExitFullscreen) {
    document.webkitExitFullscreen();
  } else if (document.msExitFullscreen) {
    document.msExitFullscreen();
  }
  $('a.change-screen').replaceWith('<a href="javascript:openFullscreen()" class="change-screen"><i class="fas fa-expand-arrows-alt"></i></a>');
}

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

function showToast(icon, message) {
  Toast.fire({
    icon: icon,
    title: ' ' + message
  });
}

function showToasterror(message) {
  Toast.fire({
    icon: 'error',
    title: ' ' + message
  });
}

function validateDate(Date_of_birth) {
  var RegexDate_of_birth = /^\d{1,2}\/\d{1,2}\/\d{4}$/;
  return RegexDate_of_birth.test(Date_of_birth);
}

function validatePhone(NumberPhone) {
  const RegexNumberPhone = /((09|03|07|08|05)+([0-9]{8})\b)/g;
  return RegexNumberPhone.test(NumberPhone);
}

function validateEmail(Email) {
  const RegexEmail = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return RegexEmail.test(Email);
}

function validateAccount(Account) {
  const RegexName = /^[a-zA-Z0-9]+$/;
  return RegexName.test(Account);
}

function removeAscent(str) {
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

function setLocalstorage(name, amount) {
  localStorage.setItem(name, amount);
}

function setDate(date) {
  var dateArr = date.split('-');
  return dateArr[2] + '/' + dateArr[1] + '/' + dateArr[0];
}

function setMoney(money) {
  return new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'VND' }).format(money);
}

function removeDate(date) {
  if (date) {
    var dateArr = date.split('/');
    return dateArr[2] + '-' + dateArr[1] + '-' + dateArr[0];
  }
}

function removeMoney(money) {
  if (money) {
    money = money.replace('₫', '');
    money = money.trim();
    money = money.replaceAll('.', '');
  }
  return money;
}

function setPage(name) {
  if ($('a.sidebar__link.active').length > 0) {
    $('a.sidebar__link.active').removeClass('active');
  }
  if ($('.content-box').length > 0) {
    $('.content-box').empty();
    history.pushState(null, null, '?page=' + name);
    if ($('.content-box.info').length > 0) {
      $('.content-box').removeClass('info');
    }
    if ($('.' + name).length > 0) {
      if ($('.sidebar__item-child a.active').length > 0) {
        $('.sidebar__item-child a.active').removeClass('active');
      }
      $('.' + name).addClass('active');
      sidebarItem = $('.' + name).parent();
      while (sidebarItem) {
        if (sidebarItem.hasClass('sidebar__item')) {
          var children = sidebarItem.children('a.sidebar__link');
          children.addClass('active');
          break;
        } else {
          sidebarItem = sidebarItem.parent();
        }
      }
    }
  }
}

function showFormAdd() {
  if ($('form.formAdd').length > 0) {
    $('form.formAdd').slideDown();
  } else {
    return false;
  }
}

function closeFormAdd() {
  if ($('form.formAdd').length > 0) {
    $('form.formAdd').slideUp();
  } else {
    return false;
  }
}

function setDateTime(value) {
  if (value) {
    var datetimeArr = value.split(' ');
    if (datetimeArr[0].indexOf('-') != -1) {
      var dateArr = datetimeArr[0].split('-');
      return dateArr[2] + '/' + dateArr[1] + '/' + dateArr[0] + ' ' + datetimeArr[1];
    }
  }
}

function setTitle(value) {
  if (value) {
    var title = value + ' | CellphoneS - Điện thoại, laptop, tablet, phụ kiện chính hãng';
    return $('head title').text(title);
  }
}