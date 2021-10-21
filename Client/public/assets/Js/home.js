let ITEM_PER_PAGE = 5;
let page = 0;
let flag = false;
$(document).ready(function() {

    let url = $('base').attr('href');
    let elementShow = $('#elementShow');
    let categoryID = $('input[name="categoryID"]').val();

    handeleActive();

    var swiperSale = new Swiper(".list-product-sale", {
        slidesPerView: 5,
        spaceBetween: 8,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
    });

    var swiperLaptop = new Swiper(".list-product-laptop", {
        slidesPerView: 5,
        spaceBetween: 8,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
    });

    function countdown(end,elements,callback) {
        var seconds = 1000;
        var minutes = seconds * 60;
        var hours = minutes * 60;
        var days = hours * 24;

        end = new Date(end);
        var timer;

        function calculate() {
            var nowDate = new Date();
            var remaining = end.getTime() - nowDate.getTime();
            var data;

            if(isNaN(end)) {
                console.log('Invalid date/time');
                return;
            }

            if(remaining <= 0) {
                clearInterval(timer);
                if(typeof callback !== 'function') {
                    callback();
                }
            } else {
                if(!timer) {
                    timer = setInterval(calculate,seconds);
                }
            }
            data = {
                'days':Math.floor(remaining/days),
                'hours':Math.floor((remaining % days) / hours),
                'minutes':Math.floor((remaining % hours) / minutes),
                'seconds':Math.floor((remaining %minutes) / seconds)
            }

            if(elements.length) {
                for(x in elements) {
                    var x = elements[x];
                    data[x] = ('00' + data[x]).slice(-2);
                    $('#'+x).html(data[x]);
                }
            }
        }

        calculate();
    }

    countdown('10/30/2021',['days','hours','minutes','seconds'],function() {
        console.log('done');
    });

    $('button.add-cart').click(function (e) { 
        e.preventDefault();
        if(flag == false) {
            flag = true;
            $.ajax({
                type: "POST",
                url: url+"/cart/addCart",
                cache: false,
                data: {
                    id:$(this).data('id')
                },
                dataType: "json",
                success: function (data) {
                    if(data) {
                        showToast(data.icon,data.title);
                        setTimeout(() => {
                            flag = false;
                        },1500);
                    }
                }
            });
        }
    });

    let showProducts = $('#showProduct');
    if(showProducts.length > 0) {
        loadData();
    }

    function loadData() {
        if(flag == false) {
            flag = true;
            // $('body').loading();
            $.ajax({
                type: "POST",
                url: url+'/home/loadProduct',
                data: {
                    limit : ITEM_PER_PAGE + 1,
                    offset : page * ITEM_PER_PAGE,
                    categoryID : categoryID
                },
                dataType: "json",
                success: function (data) {
                    flag = false;
                    // setTimeout(() => {
                        // $('body').loading('stop');
                        if (data.product.length > ITEM_PER_PAGE) {
                            page++;
                            let showData = data.product.slice(0, ITEM_PER_PAGE);
                            let showProducts = $('#showProduct');
                            appendData(showData,elementShow,showProducts);
                        } else {
                            $('#btn-show').hide();
                            appendData(data.product, elementShow, showProducts);
                        }
                    // },1000);
                }
            });
        }
    }

    $('button#btn-show').on('click',function() {
        loadData();
        // $("body, html").animate({scrollTop: $(document).height()}, 10);
    });
})

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

function handeleActive() {
    $('#carouselExampleIndicators').find('.carousel-indicators__child.active').removeClass('avitve');
    let addActiveli = $('#carouselExampleIndicators').find('.carousel-indicators__child:first-child');
    $('#carouselExampleIndicators .carousel-inner').find('.carousel-item.active').removeClass('avitve');
    let addActive = $('#carouselExampleIndicators .carousel-inner').find('.carousel-item:first-child');
    if(addActive.length > 0) {
        addActive.addClass('active');
    }
    if(addActiveli) {
        addActiveli.addClass('active');
    }
}

function appendData(data,elementShow,showElement) {
    if(data.length > 0) {
        $.each(data, function(index,value) {
            var priceProductDis = new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'VND' }).format(value.price_product - (value.price_product * value.discount_product / 100));
            var priceProduct = new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'VND' }).format(value.price_product);
            var discountProduct = '<p class="sticker-percent">'+value.discount_product+'%</p>';
            let htmlMore = elementShow.html();
            htmlMore = htmlMore.replace(/{imgProduct}/g, value.img_product);
            if(value.discount_product != 0) {
                htmlMore = htmlMore.replace(/{productDiscount}/g, discountProduct);
            } else {
                htmlMore = htmlMore.replace(/{productDiscount}/g, '');
            }
            htmlMore = htmlMore.replace(/{productName}/g, value.product_name);
            htmlMore = htmlMore.replace(/{productPriceDis}/g, priceProductDis);
            if(value.discount_product != 0) {
                htmlMore = htmlMore.replace(/{productPrice}/g, priceProduct);
            } else {
                htmlMore = htmlMore.replace(/{productPrice}/g, '');
            }
            if(value.product_name != '') {
                htmlMore = htmlMore.replace(/{promotion}/g, value.promotion_name);
            } else {
                htmlMore = htmlMore.replace(/{promotion}/g, '');
            }
            htmlMore = htmlMore.replace(/{dataID}/g, value.id_product);
            showElement.append(htmlMore);
        });
    }
}

function addCart(id) {
    let url = $('base').attr('href');
    if(flag == false) {
        flag = true;
        $.ajax({
            type: "POST",
            url: url+"/cart/addCart",
            cache: false,
            data: {
                id:id
            },
            dataType: "json",
            success: function (data) {
                if(data) {
                    showToast(data.icon,data.title);
                    setTimeout(() => {
                        flag = false;
                    },1500);
                }
            }
        });
    }
}