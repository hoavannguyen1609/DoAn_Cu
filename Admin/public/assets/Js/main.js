$(document).ready(function () {
    let url = $('base').attr('href');
    if ($('#show.content-box').length > 0) {
        var urlAll = new URL(window.location);
        var pageUrl = urlAll.searchParams.get('page');
        if(pageUrl == null || typeof pageUrl == 'undefine' || pageUrl == '') {
            loadinfo();
        } else if(pageUrl.indexOf('order') != -1) {
            loadOrder(pageUrl.slice(-1));
        } else if(pageUrl) {
            switch (pageUrl) {
                case 'info':
                    loadinfo();
                    break;
                case 'staff':
                    loadStaff();
                    break;
                case 'position':
                    loadPosition();
                    break;
                case 'salary':
                    loadSalary();
                    break;
                case 'formaddstaff':
                    loadFormaddStaff();
                    break;
                case 'formaddposition':
                    loadFormaddPosition();
                    break;
                case 'category':
                    loadCategory();
                    break;
                case 'manufacturer':
                    loadmanufacturer();
                    break;
                case 'promotion':
                    loadPromotion();
                    break;
                default:
                    loadinfo();
                    break;
            }
        }
    }

    $('#loginForm').on('submit',function(e) {
        e.preventDefault();
        var userName = $(this).children('input.user').val();
        var password = $(this).children('input.pass').val();
        if(userName == '' && password == '') {
            showToast('error','Tài khoản và mật khẩu trống');
        } else if(userName == '') {
            showToast('error','Tài khoản trống');
        } else if(password == '') {
            showToast('error','Mật khẩu trống');
        }
        if(userName != '' && password != '') {
            $.ajax({
                type: "POST",
                url: $('base').attr('href')+'/login/index',
                data: {
                    account: userName,
                    password: password
                },
                cache: false,
                dataType: 'json',
                success: function (data) {
                    if (data) {
                        showToast(data.icon, data.title);
                        if (data.icon == 'success') {
                            window.location.href = $('base').attr('href');
                        }
                    }
                }
            });
        }
    });
});

function loadinfo() {
    if($('.content-box .info-box').length <= 0) {
        loadAjax('home','getInfo','Thông tin',function(data) {
            if($('.content-box .info-box').length > 0) {
                $('.content-box.info').empty();
            }
            appendData(data.data, data.html, $('.content-box'),'info');
        },'info');
    }
}

function loadFormaddStaff() {
    loadAjax('.formAdd-staff','staff','formaddStaff','Thêm nhân viên',function(data) {
        $('.content-box').append(data.html);
        $('select[name="gender"]').append(data.gender);
        $('select[name="position"]').append(data.position);
    },'formaddstaff');
}

function loadStaff() {
    loadAjax('.staff-box','staff','index','Nhân viên',function(data) {
        appendBegin($('.content-box'),data.top,function() {
            appendData(data.data,data.html,$('.list-staff'),'staff',data.gender,data.position);
        });
    },'staff');
}

function loadFormaddPosition() {
    loadAjax('.formAdd-staff','staff','formAddPosition','Thêm chức vụ',function(data) {
        $('.content-box').append(data);
    },'formaddposition');
}

function loadPosition() {
    loadAjax('.position-box','staff','loadPosition','Chức vụ',function(data) {
        setContent('.position-box', 'position', data.top, data.data, data.html, '.list-position');
    });
}

function loadSalary() {
    loadAjax('.salary-box','staff','loadSalary','Lương và phụ cấp',function(data) {
        setContent('.salary-box','salary',data.top,data.dataAl,data.slAl,'.salary-box__allowance-list');
        $('.salary-box__salary').append(data.slBs);
    });
}

function loadProduct() {

    let url = $('base').attr('href');
    setPage('product');
    if($('.content-box .product-box').length <= 0) {
        $.ajax({
            type: "POST",
            url: url+'/product/index',
            dataType: "json",
            success: function (data) {
                if(data) {
                    
                }
            }
        });
    } else {
        return false;
    }
}

function loadCategory() {
    loadAjax('.caegory-box','product','loadCategory','Danh mục',function(data) {
        setContent('.category-box','category',data.top,data.data,data.html,'.category-box__list');
    });
}

function loadmanufacturer() {
    loadAjax('.manufacturer-box','product','loadmanufacturer','Hãng sản xuất',function(data) {
        setContent('.manufacturer-box','manufacturer',data.top,data.data,data.html,'.manufacturer-box__list');
    });
}

function loadPromotion() {
    loadAjax('.promotion-box','product','loadPromotion','Khuyến mãi',function(data) {
        setContent('.promotion-box','promotion',data.htmltop,data.data,data.html,'.promotion-box__list');
    });
}

function loadAjax(tag,controler,action,title,callback,type) {
    if($('.content-box '+tag).length <= 0) {
        $.ajax({
            type: "POST",
            url: $('base').attr('href')+'/'+controler+'/'+action,
            dataType: "json",
            cache: false,
            success: function (data) {
                if(data) {
                    if(title) {
                        setTitle(title);
                    }
                    if(type) {
                        setPage(type);
                    }
                    callback(data);
                }
            }
        });
    }
}

function loadOrder(type) {
    setTitle('Đơn hàng');
    $.ajax({
        type: "GET",
        url: $('base').attr('href')+"/order/index/"+type,
        dataType: "json",
        success: function (data) {
            if(data) {
                setPage('order'+type);
                if(data.html) {
                    setContent('.order-box','order'+type,data.htmlTop,data.data,data.html,'.order-box__list');
                } else {
                    $('.content-box').append(data.htmlTop);
                    $('.order-box__list').append(data.empty);
                }
            }
        }
    });
}

function getDetails(id) {
    if(id) {
        $.ajax({
            type: "GET",
            url: $('base').attr('href')+"/order/getOrderdetail/"+id,
            dataType: "json",
            success: function (data) {
                if(data) {
                    setContent('.orderDetail-box','orderDetail'+id,data.htmltop,data.data,data.html,$('.orderDetail-box__list'));
                }
            }
        });
    }
}

function setContent(box, type, dataTop, data, html, show) {
    if ($('.content-box ' + box).length <= 0) {
        setPage(type);
        appendBegin($('.content-box'), dataTop, function () {
            appendData(data, html, $(show), type);
        });
    } else {
        $(show).empty();
        appendData(data, html, $(show), type);
    }
}

function appendBegin(element,dataBegin,callback) {
    if(element.length > 0) {
        element.append(dataBegin);
        callback();
    } else {
        return false;
    }
}

function appendData(data,html,show,type,dataTwo,dataThree) {
    if(data.length > 0) {
        $(data).each(function(index,value) {
            let htmlMore = html;
            if(type.indexOf('order') != -1) {
                htmlMore = htmlMore.replace(/{{codeOrder}}/g,value.id_total_order);
                htmlMore = htmlMore.replace(/{{customerName}}/g,value.customer_name);
                htmlMore = htmlMore.replace(/{{customerPhone}}/g,'0'+value.customer_phone);
                htmlMore = htmlMore.replace(/{{customerAddress}}/g,value.customer_address);
                htmlMore = htmlMore.replace(/{{payment}}/g,value.payments);
                htmlMore = htmlMore.replace(/{{datePut}}/g,setDateTime(value.date_put));
                htmlMore = htmlMore.replace(/{{idTotalOrder}}/g,value.id_total_order);
                htmlMore = htmlMore.replace(/{{orderCode}}/g,value.code_order);
                htmlMore = htmlMore.replace(/{{customerMessage}}/g,value.message);
                htmlMore = htmlMore.replace(/{{totalOrder}}/g,setMoney(value.total_order_price));
                htmlMore = htmlMore.replace(/{{statusOrder}}/g,value.status_name);
            } else {
                switch (type) {
                    case 'info':
                        htmlMore = htmlMore.replace(/{{name}}/g,value.name);
                        htmlMore = htmlMore.replace(/{{position}}/g,value.position_name);
                        htmlMore = htmlMore.replace(/{{avatar}}/g,$('base').attr('href')+ '/public/plugin/' +value.avatar_admin);
                        break;
                    case 'staff':
                        if(dataTwo != '') {
                            var gender = '';
                            $(dataTwo).each(function(index,item) {
                                if(item.id_gender == value.gender) {
                                    gender += '<option selected value="'+item.id_gender+'">'+item.gender_name+'</option>';
                                } else if(item.id_gender != value.gender) {
                                    gender += '<option value="'+item.id_gender+'">'+item.gender_name+'</option>';
                                }
                            });
                        }
        
                        if(dataThree != '') {
                            var position = '';
                            $(dataThree).each(function(index,item) {
                                if(item.id_position == value.position ) {
                                    position += '<option selected value="'+item.id_position+'">'+item.position_name+'</option>';
                                } else if(item.id_position != value.position && item.id_position != 3) {
                                    position += '<option value="'+item.id_position+'">'+item.position_name+'</option>';
                                }
                            });
                        }
            
                        htmlMore = htmlMore.replace(/{{avatar}}/g,$('base').attr('href')+'/public/plugin/'+value.avatar_admin);
                        htmlMore = htmlMore.replace(/{{idAdmin}}/g,value.id_admin);
                        htmlMore = htmlMore.replace(/{{name}}/g,value.name);
                        htmlMore = htmlMore.replace(/{{gender}}/g,gender);
                        htmlMore = htmlMore.replace(/{{birthday}}/g,setDate(value.birthday));
                        htmlMore = htmlMore.replace(/{{phone}}/g,'0'+value.phone);
                        htmlMore = htmlMore.replace(/{{email}}/g,value.email);
                        htmlMore = htmlMore.replace(/{{address}}/g,value.address);
                        htmlMore = htmlMore.replace(/{{position}}/g,position);
                        htmlMore = htmlMore.replace(/{{workday}}/g,setDate(value.working_day));
                        htmlMore = htmlMore.replace(/{{salaryBasic}}/g,setMoney(value.salary_basic));
                        htmlMore = htmlMore.replace(/{{salaryPosition}}/g,setMoney(value.allowance_level));
                        htmlMore = htmlMore.replace(/{{salaryWork}}/g,setMoney(value.salary_allowance_work_date));
                        htmlMore = htmlMore.replace(/{{bankAccount}}/g,value.bank_account);
                        break;
                    case 'position':
                        htmlMore = htmlMore.replace(/{{number}}/g,value.id_position);
                        htmlMore = htmlMore.replace(/{{positionName}}/g,value.position_name);
                        break;
                    case 'salary':
                        htmlMore = htmlMore.replace(/{{allowanceMoney}}/g,setMoney(value.allowance_level));
                        htmlMore = htmlMore.replace(/{{positionNamesalary}}/g,value.position_name);
                        htmlMore = htmlMore.replace(/{{idAllowance}}/g,value.id_allowance);
                        break;
                    case 'category':
                        var classStatus,classIcon;
                        if(value.status_category_id == 6) {
                            classStatus = 'success';
                            classIcon = 'check';
                        } else {
                            classStatus = 'danger';
                            classIcon = 'minus';
                        }
                        htmlMore = htmlMore.replace(/{{classStatus}}/g,classStatus);
                        htmlMore = htmlMore.replace(/{{classIcon}}/g,classIcon);
                        htmlMore = htmlMore.replace(/{{status}}/g,value.status_category_id);
                        htmlMore = htmlMore.replace(/{{idCategory}}/g,value.id_category);
                        htmlMore = htmlMore.replace(/{{categoryName}}/g,value.category_name);
                        break;
                    case 'manufacturer':
                        htmlMore = htmlMore.replace(/{{idmanufacturer}}/g,value.id_manufacturer);
                        htmlMore = htmlMore.replace(/{{manufacturerName}}/g,value.manufacturer_name);
                        break;
                    case 'promotion':
                        htmlMore = htmlMore.replace(/{{idPromotion}}/g,value.id_promotion);
                        htmlMore = htmlMore.replace(/{{promotionName}}/g,value.promotion_name);
                        break;
                    // case '':
    
                        // break;
                    default:
                        break;
                }
            }
            show.append(htmlMore);
        });
    } else {
        return false;
    }
}

function editStaff(id) {
    let url = $('base').attr('href');
    if($('#name-'+id).val() == '') {
        showToast('error','Vui lòng nhập họ tên');
    } else if($('#birthday-'+id).val() == '') {
        showToast('error','Vui lòng nhập ngày sinh');
    } else if(!validateDate($('#birthday-'+id).val())) {
        showToast('error','Vui lòng nhập ngày sinh đúng định dạng ngày/tháng/năm');
    } else if($('#phone-'+id).val() == '') {
        showToast('error','Vui lòng nhập số điện thoại');
    } else if(!validatePhone($('#phone-'+id).val())) {
        showToast('error','Vui lòng nhập đúng số điện thoại Việt Nam');
    } else if ($('#email-'+id).val() == '') {
        showToast('error','Vui lòng nhập email');
    } else if(!validateEmail($('#email-'+id).val())) {
        showToast('error','Vui lòng nhập đúng email');
    } else if($('#address-'+id).val() == '') {
        showToast('error','Vui lòng nhập địa chỉ');
    } else if($('#address-'+id).val().length < 12) {
        showToast('error','Vui lòng kiểm tra lại địa chỉ');
    } else if($('#workday-'+id).val() == '') {
        showToast('error','Vui lòng nhập ngày vào làm');
    } else if(!validateDate($('#workday-'+id).val())) {
        showToast('error','Vui lòng nhập ngày vào làm đúng định dạng ngày/tháng/năm');
    } else if($('#bank-'+id).val() == '') {
        showToast('error','Vui lòng nhập STK');
    } else if($('#bank-'+id).val() < 0 || $('#bank-'+id).val() % 1 !== 0) {
        showToast('error','Vui lòng kiểm tra lại STK');
    } else if($('#bank-'+id).val().length != 12) {
        showToast('error','STK chỉ bao gồm 12 số');
    } else {
        $.ajax({
            type: "POST",
            url: url+'/staff/editStaff',
            data: {
                id : id,
                name : $('#name-'+id).val(),
                gender : $('#gender-'+id).val(),
                birthday : removeDate($('#birthday-'+id).val()),
                phone : $('#phone-'+id).val(),
                email : $('#email-'+id).val(),
                address : $('#address-'+id).val(),
                position : $('#position-'+id).val(),
                workDay : removeDate($('#workday-'+id).val()),
                bank : $('#bank-'+id).val(),
                allowance : removeMoney($('#salaryWork-'+id).val())
            },
            dataType: "json",
            success: function (data) {
                if(data) {
                    if(data.icon) {
                        showToast(data.icon,data.title);
                        $('.allowance_level-'+data.id).text(setMoney(data.allowance));
                        $('#tr-'+data.id+' img').attr('src',data.avatar);
                    } else {
                        showToasterror(data);
                    }
                }
            }
        });
    }
}

function editPosition(id) {
    if(id) {
        $.ajax({
            type: "POST",
            url: $('base').attr('href')+'/staff/editPosition',
            data: {
                id : id,
                value : $('#position_name-'+id).val()
            },
            dataType: "json",
            success: function (data) {
                if(data) {
                    showToast(data.icon,data.title);
                }
            }
        });
    }
}

function editCategory(id) {
    if(id) {
        if($('#categoryName-'+id).val() == '') {
            showToasterror('Vui lòng nhập danh mục');
        } else {
            let url = $('base').attr('href');
            $.ajax({
                type: "POST",
                url: url+'/product/editCategory',
                data: {
                    id : id,
                    value : $('input#categoryName-'+id).val()
                },
                dataType: "json",
                success: function (data) {
                    if(data) {
                        showToast(data.icon,data.title);
                    }
                },
                error : function(data) {
                    console.log(data)
                }
            });
        }
    }
}

function editmanufacturer(id) {
    if(id) {
        if($('#manufacturerName-'+id).val() == '') {
            showToasterror('Vui lòng nhập danh mục');
        } else {
            let url = $('base').attr('href');
            $.ajax({
                type: "POST",
                url: url+'/product/editmanufacturerName',
                data: {
                    id : id,
                    value : $('input#manufacturerName-'+id).val()
                },
                cache : false,
                dataType: "json",
                success: function (data) {
                    if(data) {
                        showToast(data.icon,data.title);
                    }
                }
            });
        }
    }
}

function editPromotion(id) {
    // if($('input#promotion-'+id).val() == '') {
    //     showToasterror('Vui lòng nhập khuyến mãi');
    // } else {
        $.ajax({
            type: "POST",
            url: $('base').attr('href')+"/product/editPromotion",
            data: {
                id : id,
                value : $('input#promotion-'+id).val()
            },
            dataType: "json",
            success: function (data) {
                if(data) {
                    showToast(data.icon, data.title);
                }
            },
            error:function(data) {
                console.log(data)
            }
        });
    // }
}

function delStaff(id) {
    if(id) {
        let url = $('base').attr('href');
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
                    url: url+'/staff/deleteStaff',
                    data: {id:id},
                    dataType: "json",
                    success: function (data) {
                        if(data) {
                            showToast(data.icon,data.title);
                            if(data.icon == 'success') {
                                let current = 'tr-' +data.id;
                                $('#'+ current).hide(1500);
                            }
                        }
                    }
                });
            }
        });
    }
}

function delPosition(id) {
    if(id) {
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
                let url = $('base').attr('href');
                $.ajax({
                    type: "GET",
                    url: url+'/staff/deletePosition/'+id,
                    dataType: "json",
                    success: function (data) {
                        if(data) {
                            showToast(data.icon,data.title);
                            if(data.title2) {
                                setTimeout(() => {
                                    showToast(data.icon,data.title2);
                                },3000);
                            }
                            if(data.icon == 'success') {
                                let current = 'tr-' +data.id;
                                $('#'+ current).hide(1500);
                            }
                        }
                    }
                });
            }
        });
    }
}

function delCategory(id) {
    if(id) {
        Swal.fire({
            title: 'Bạn có chắc chắn?',
            text: "Bạn có chắc chắn muốn xóa danh mục "+$('input#categoryName-'+id).val()+"? Điều này ảnh hưởng đến tính toàn vẹn dữ liệu",
            icon: 'error',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Xóa!'
        }).then((result) => {
            if (result.isConfirmed) {
                let url = $('base').attr('href');
                $.ajax({
                    type: "GET",
                    url: url+"/product/delCategory/" + id,
                    dataType: "json",
                    success: function (data) {
                        if (data) {
                            showToast(data.icon,data.title);
                            if(data.id) {
                                $('#tr'+data.id).hide(1500);
                            }
                        }
                    }
                });
            }
        }); 
    }
}

function delmanufacturer(id) {
    Swal.fire({
        title: 'Bạn có chắc chắn?',
        text: "Bạn có chắc chắn muốn xóa hãng sản xuất "+$('input#manufacturerName-'+id).val()+"? Điều này ảnh hưởng đến tính toàn vẹn dữ liệu",
        icon: 'error',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Xóa!'
    }).then((result) => {
        if (result.isConfirmed) {
            let url = $('base').attr('href');
            $.ajax({
                type: "GET",
                url: url+"/product/delManufacturer/" + id,
                dataType: "json",
                success: function (data) {
                    if (data) {
                        showToast(data.icon,data.title);
                        if(data.id) {
                            $('#tr-'+data.id).hide(1500);
                        }
                    }
                }
            });
        }
    });
}

function delPromotion(id) {
    Swal.fire({
        title: 'Bạn có chắc chắn?',
        text: "Bạn có chắc chắn muốn xóa khuyến mãi "+$('input#promotion-'+id).val()+"? Điều này ảnh hưởng đến tính toàn vẹn dữ liệu",
        icon: 'error',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Xóa!'
    }).then((result) => {
        if (result.isConfirmed) {
            let url = $('base').attr('href');
            $.ajax({
                type: "GET",
                url: url+"/product/delPromotion/"+id,
                dataType: "json",
                success: function (data) {
                    if (data) {
                        showToast(data.icon,data.title);
                        if(data.id) {
                            $('#tr-'+data.id).hide(1500);
                        }
                    }
                }
            });
        }
    });
}

function changeSalaryBasic() {
    if(parseInt(removeMoney($('input#salaryBasic').val())) < 0) {
        showToast('error','Lương cơ bản phải lớn hơn 0₫')
    } else {
        let url = $('base').attr('href');
        $.ajax({
            type: "POST",
            url: url+'/staff/changeSalarybasic',
            data: {
                value : removeMoney($('input#salaryBasic').val())
            },
            dataType: "json",
            success: function (data) {
                if(data) {
                    showToast(data.icon,data.title);
                }
            }
        });
    }
}

function changeAllowance(id) {
    if(id) {
        if(parseInt(removeMoney($('#allowanceMoney-'+id).val())) < 0) {
            showToast('error','Lương phụ cấp '+$('#position-allowance-'+id).text()+' phải lớn hơn 0₫');
        } else {
            let url = $('base').attr('href');
            $.ajax({
                type: "POST",
                url: url + '/staff/changeAllowance',
                data: {
                    id: id,
                    value: removeMoney($('#allowanceMoney-' + id).val())
                },
                dataType: "json",
                success: function (data) {
                    if (data) {
                        showToast(data.icon, data.title);
                    }
                }
            });
        }
    }
}

function changeStatus(id,controller,status,type,typeHistory) {
    if(id && controller && status && type) {
        let url = $('base').attr('href');
        $.ajax({
            type: "POST",
            url: url+'/'+controller+"/changeStatus",
            data: {
                id : id,
                controller : controller,
                status : status,
                type : type,
                typeHistory : typeHistory
            },
            dataType: "json",
            success: function (data) {
                if(data) {
                    $('a.status-'+data.id).replaceWith(data.html);
                    showToast(data.icon,data.title);
                }
            }
        });
    }
}

function addStaff(classlist) {
    if(classlist && $('.'+classlist).length > 0) {
        if($('.'+classlist+' form').length > 0) {
            if($('#fullname').val() == '') {
                showToasterror('Vui lòng nhập họ tên');
            } else if($('#account').val() == '') {
                showToasterror('Vui lòng nhập tài khoản');
            } else if (!validateAccount($('#account').val())) {
                showToasterror('Tài khoản không được chứa ký tự đặc biệt');
            } else if($('select[name="gender"]').val() == '') {
                showToasterror('Vui lòng chọn giới tính');
            } else if($('#birthday').val() == '') {
                showToasterror('Vui lòng nhập ngày sinh');
            } else if(!validateDate($('#birthday').val())) {
                showToasterror('Vui lòng nhập ngày sinh đúng định dạng dd/mm/yyyy');
            } else if($('#phone').val() == '') {
                showToasterror('Vui lòng nhập số điện thoại');
            } else if(!validatePhone($('#phone').val())) {
                showToasterror('Vui lòng nhập đúng định dạng số điện thoại Việt Nam');
            } else if($('#email').val() == '') {
                showToasterror('Vui lòng nhập email');
            } else if(!validateEmail($('#email').val())) {
                showToasterror('Vui lòng nhập đúng định dạng email');
            } else if($('#address').val() == '') {
                showToasterror('Vui lòng nhập địa chỉ');
            } else if($('#address').val().length < 12) {
                showToasterror('Vui lòng kiểm tra lại địa chỉ');
            } else if($('select[name="position"]').val() == '') {
                showToasterror('Vui lòng chọn chức vụ');
            } else if($('#workday').val() == '') {
                showToasterror('Vui lòng nhập ngày vào làm');
            } else if(!validateDate($('#workday').val())) {
                showToasterror('Vui lòng nhập ngày vào làm đúng định dạng dd/mm/yyyy');
            } else if($('#bankAccount').val() == '') {
                showToasterror('Vui lòng nhập số tài khoản ngân hàng');
            } else if($('#bankAccount').val().length != 12) {
                showToasterror('Số tài khoản ngân hàng chỉ bao gồm 12 chữ số');
            } else if(parseInt($('#bankAccount').val()) <= 0 ||$('#bankAccount').val() % 1 !== 0) {
                showToasterror('Số tài khoản ngân hàng phải là số nguyên lớn hơn 0');
            } else {
                let url = $('base').attr('href');
                $.ajax({
                    type: "POST",
                    url: url+'/staff/addStaff',
                    data: {
                        name : $('#fullname').val(),
                        account : $('#account').val(),
                        gender : $('select[name="gender"]').val(),
                        birthday : removeDate($('#birthday').val()),
                        phone : $('#phone').val(),
                        email : $('#email').val(),
                        address : $('#address').val(),
                        position : $('select[name="position"]').val(),
                        workDay : removeDate($('#workday').val()),
                        bankAccount : $('#bankAccount').val(),
                        type : 'addStaff'
                    },
                    dataType: "json",
                    beforeSend: function() {
                        showToast('info','Vui lòng chờ');
                    },
                    success: function (data) {
                        if(data) {
                            if(data.icon && data.title) {
                                showToast(data.icon,data.title);
                            } else {
                                showToasterror(data);
                            }
                        }
                    }
                });
            }
        }
    } else {
        return false;
    }
}

function addPosition(classlist) {
    if($('.'+classlist).length > 0 && $('.'+classlist+' form').length > 0) {
        if($('input[name="positionName"]').val() == '') {
            showToasterror('Vui lòng nhập chức vụ');
        } else if($('input[name="allowancePosition"]').val() == '') {
            showToasterror('Vui lòng nhập phụ cấp');
        } else if(parseInt($('input[name="allowancePosition"]').val()) < 0 || $('input[name="allowancePosition"]').val() % 1 !== 0) {
            showToasterror('Phụ cấp phải là số nguyên lớn hơn 0₫')
        } else {
            $.ajax({
                type: "POST",
                url: $('base').attr('href')+'/staff/addPosition',
                data: {
                    position : $('input[name="positionName"]').val(),
                    allowance : removeMoney($('input[name="allowancePosition"]').val())
                },
                dataType: "json",
                success: function (data) {
                    if(data) {
                        showToast(data.icon,data.title);
                    }
                }
            });
        }
    } else {
        return false;
    }
}

function addmanufacturer() {
    if($('form input#manufacturer').val() == '') {
        showToasterror('Vui lòng nhập tên hãng sản xuất');
    } else {
        $.ajax({
            type: "GET",
            url: $('base').attr('href')+"/product/addmanufacturer/"+$('form input#manufacturer').val(),
            dataType: "json",
            success: function (data) {
                if(data) {
                    showToast(data.icon,data.title);
                    loadmanufacturer();
                }
            }
        });
    }
}

function addPromotion() {
    if($('#promotionAdd').val() == '') {
        showToasterror('Vui lòng nhập khuyến mãi');
    } else {
        $.ajax({
            type: "GET",
            url: $('base').attr('href')+"/product/addPromotion/"+$('#promotionAdd').val(),
            dataType: "json",
            success: function (data) {
                if(data) {
                    showToast(data.icon,data.title);
                    loadPromotion();
                }
            }
        });
    }
}

function confirmOrder(id) {
    $.ajax({
        type: "GET",
        url: $('base').attr('href')+"/order/confirmOrder/"+id,
        dataType: "json",
        success: function (data) {
            if(data) {
                showToast(data.icon,data.title);
                $('a.confirmOrder-'+data.id).replaceWith(data.button);
                $('a.delOrder-'+data.id).remove();
                $('span.status-'+data.id).text('Đã duyệt');
            }
        }
    });
}

function delOrder(id) {
    if(id) {
        Swal.fire({
            title: 'Bạn có chắc chắn?',
            text: "Bạn có chắc chắn muốn xóa đơn hàng",
            icon: 'error',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Xóa!'
        }).then((result) => {
            if (result.isConfirmed) {
                let url = $('base').attr('href');
                $.ajax({
                    type: "GET",
                    url: $('base').attr('href') + "/order/delOrder/" + id,
                    dataType: "json",
                    success: function (data) {
                        if (data) {
                            showToast(data.icon, data.title);
                            $('#tr-' + data.id).hide(1500);
                        }
                    }
                });
            }
        });
    }
}