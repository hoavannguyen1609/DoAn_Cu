<section>
    <div class="grid wide">
        <div class="row no-gutters">
            <div class="l-12 m-12 c-12">
                <div class="box-sliding d-flex l-12 m-12 m-12 pt-4">
                    <div class="l-2 navigator flex-column">
                        <ul class="nav__list mb-0 px-3 mr-3 shadow-sm h-100">
                            <li class="nav__items py-2">
                                <a href="{{ _WEB_ROOT .'/dienthoai'}}" class="d-flex text-333 align-items-center h-100">
                                    <i class="icon-cps-3"></i>
                                    <span>Điện thoại</span>
                                </a>
                            </li>
                            <li class="nav__items py-2">
                                <a href="{{ _WEB_ROOT .'/laptop'}}" class="d-flex text-333 align-items-center h-100">
                                    <i class="icon-cps-380"></i>
                                    <span>Laptop</span>
                                </a>
                            </li>
                            <li class="nav__items py-2">
                                <a href="{{ _WEB_ROOT .'/tablet' }}" class="d-flex text-333 align-items-center h-100">
                                    <i class="icon-cps-4"></i>
                                    <span>Tablet</span>
                                </a>
                            </li>
                            <li class="nav__items py-2">
                                <a href="{{ _WEB_ROOT .'/amthanh' }}" class="d-flex text-333 align-items-center h-100">
                                    <i class="icon-cps-220"></i>
                                    <span>Loa</span>
                                </a>
                            </li>
                            <li class="nav__items py-2">
                                <a href="{{ _WEB_ROOT .'/dongho' }}" class="d-flex text-333 align-items-center h-100">
                                    <i class="icon-cps-610"></i>
                                    <span>Đồng hồ</span>
                                </a>
                            </li>
                            <!-- <li class="nav__items py-2">
                                <a href="{{ _WEB_ROOT .'/nha-thong-minh' }}" class="d-flex text-333 align-items-center h-100">
                                    <i class="icon-cps-845"></i>
                                    <span>Nhà thông minh</span>
                                </a>
                            </li> -->
                            <li class="nav__items py-2">
                                <a href="{{ _WEB_ROOT .'/tainghe' }}" class="d-flex text-333 align-items-center h-100">
                                    <i class="icon-cps-30"></i>
                                    <span>Tai nghe</span>
                                </a>
                            </li>
                            <!-- <li class="nav__items py-2">
                                <a href="{{ _WEB_ROOT .'/thu-cu-doi-moi'}}" class="d-flex text-333 align-items-center h-100">
                                    <i class="icon-cps-tcdm"></i>
                                    <span>Thu cũ</span>
                                </a>
                            </li> -->
                            <!-- <li class="nav__items py-2">
                                <a href="{{ _WEB_ROOT .'/hang-cu' }}" class="d-flex text-333 align-items-center h-100">
                                    <i class="icon-cps-29"></i>
                                    <span>Hàng cũ</span>
                                </a>
                            </li> -->
                            <!-- <li class="nav__items py-2">
                                <a href="{{ _WEB_ROOT .'/khuyen-mai' }}" class="d-flex text-333 align-items-center h-100">
                                    <i class="icon-cps-promotion"></i>
                                    <span>Khuyến mãi</span>
                                </a>
                            </li> -->
                        </ul>
                    </div>
                    <div class="l-7 m-12 c-12 sliding">
                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                @foreach($slide as $value)
                                <li data-target="#carouselExampleIndicators" data-slide-to="{{ $value['id_slide'] - 1 }}" class="carousel-indicators__child"></li>
                                @endforeach
                            </ol>
                            <div class="carousel-inner">
                                @foreach($slide as $value)
                                <div class="carousel-item">
                                    <img class="d-block w-100" src="{{ _IMG_SLIDE .$value['img_slide'] }}" alt="First slide">
                                </div>
                                @endforeach
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                <img src="{{_URL_IMG .'icon/icon-next.png' }}" alt="">
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                <img src="{{ _URL_IMG .'icon/icon-next.png' }}" alt="">
                            </a>
                        </div>
                        <div class="carouselText shadow-sm d-flex">
                            @foreach($slide as $value) 
                            <div class="caroselText__bodercol"></div>
                            <div class="caroselText__items h-100 d-flex justify-content-between align-items-center">
                                <a href="{{ _WEB_ROOT .$value['path_slide'] }}" class="flex-grow-1 d-block">
                                    <span>{{ $value['title_program'] }} <br> {{ $value['special_program'] }}</span>
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="l-3 box-sliding-right">
                        <div class="d-flex flex-column ml-3 bg-white shadow-sm h-100">
                            @foreach($box_sliding as $value)
                            <div class="w-100 box-sliding-right__items">
                                <a href="{{ _WEB_ROOT .'/dien-thoai/' .$value['path_box_sliding'] }}" class="d-block">
                                    <img src="{{ _IMG_FRONT .$value['img_box_sliding']  }}" alt="" class="w-100 h-100">
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="l-12 m-12 m-12 floating-enabled py-4">
                    <a href="{{ _WEB_ROOT .'/com-bo' }}" class="d-block w-100">
                        <img src="{{_IMG_FRONT .'hp-z-2021-1200x75.webp'}}" alt="" class="w-100">
                    </a>
                </div>
                <div class="l-12 m-12 c-12 bg-white rounded shadow-sm box-flash-sale">
                    <div class="box-title d-flex rounded align-items-center px-2">
                        <div class="l-6 m-6 c-6 box-title__title">
                            <div class="d-flex justify-content-start">
                                <p class="mb-0">
                                    <strong>
                                        HOT
                                        <img src="{{ _URL_IMG .'icon/flash-sale.gif' }}" alt="">
                                        SALE
                                    </strong>
                                </p>
                            </div>
                        </div>
                        <div class="box-title__date l-6 m-6 c-6">
                            <div class="d-flex justify-content-end align-items-center">
                                <p class="mb-0 title">
                                    Bắt đầu sau   
                                </p> &nbsp;
                                <ul class="mb-0">
                                    <li><span id="days"></span>:</li>
                                    <li><span id="hours"></span>:</li>
                                    <li><span id="minutes"></span>:</li>
                                    <li><span id="seconds"></span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="box-content list-product-sale d-block flex-wrap swiper-container">
                        <ul id="autoWidth" class="swiper-wrapper">
                            @foreach($productSale as $value)
                            <li class="swiper-slide h-100 item-d">
                                <div class="card pt-2 pb-4 h-100">
                                    <div class="card-img d-flex align-items-center py-4">
                                        <a href="{{ _URL_PRODUCT .str_replace(' ','+',$value['product_name']) }}" class="text-decoration-none text-333 text-center w-100">
                                            <img src="{{ _IMG_PRODUCT .$value['img_product'] }}" alt="" class="card-img-top m-auto">
                                            <div class="product__box-sticker">
                                                <?php if($value['discount_product'] != 0) {
                                                    echo '<p class="sticker-percent">'.$value['discount_product'] .'%</p>';
                                                } ?>
                                                <p class="sticker-flashsale">
                                                    <i class="icon-cps-sale"></i>
                                                </p>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="card-body pt-1">
                                        <a href="{{ _URL_PRODUCT .str_replace(' ','-',$value['product_name']) }}" class="text-decoration-none text-333 text-center w-100">
                                            <div class="card-title text-center h6 mb-0 font-weight-bold">{{ $value['product_name'] }}</div>
                                            <div class="card-text pt-1">
                                                <span>
                                                    <span class="text-doctrine font-weight-bold">
                                                        {{str_replace(',','.',number_format($value['price_product'] - ($value['price_product'] * $value['discount_product'] / 100))) .' ₫'}}
                                                    </span>
                                                    <span class="text-muted ml-3 old-price">
                                                        <del>{{str_replace(',','.',number_format($value['price_product'])) .' ₫'}}</del>
                                                    </span>
                                                </span>
                                            </div>
                                            <div class="card-text mt-2 product-box-rating">
                                                <i class="fa fa-star checked"></i>
                                                <i class="fa fa-star checked"></i>
                                                <i class="fa fa-star checked"></i>
                                                <i class="fa fa-star checked"></i>
                                                <i class="fa fa-star checked"></i>
                                                @if(!empty($value['comment']))
                                                <span class="text-muted">{{$value['comment']}}</span>
                                                @endif
                                            </div>
                                        </a>
                                    </div>
                                    <div class="btn-add__group d-flex justify-content-between">
                                        <button data-id="{{$value['id_product']}}" class="add-cart btn bg-doctrine text-white w-50">Thêm giỏ hàng</button>
                                        <a href="<?php echo _WEB_ROOT .'/mua-ngay/'.$value['id_product'] ?>" class="btn bg-doctrine text-white w-50 flex-end">Mua ngay</a>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>
                </div>
                <div class="l-12 m-12 c-12 py-3 list-product-box">
                    <div class="box-title d-flex flex-column rounded align-iems-center">
                        <div class="box-title__tile l-12 m-12 m-12 px-3 py-2">
                            <p class="h3 mb-0 font-wieght-bold"><strong><i>Điện thoại nổi bật</i></strong></p>
                        </div>
                        <div class="list-product-mobile l-12 c-12 m-12 d-flex flex-wrap bg-white">
                            @foreach($productMobile as $value)
                            <div id="{{$value['id_product']}}" class="l-2-4 m-4 c-6 -3 list-product">
                                <div class="card py-4 h-100">
                                    <a href="{{_URL_PRODUCT .str_replace(' ','+',$value['product_name'])}}" class="text-decoration-none d-block text-333">
                                        <div class="list-product__img mx-auto w-75">
                                            <img src="{{_IMG_PRODUCT .$value['img_product']}}" alt="" class="w-100">
                                            <div class="product__box-sticker">
                                                <?php if($value['discount_product'] != 0) {
                                                    echo '<p class="sticker-percent">'.$value['discount_product'] .'%</p>';
                                                } ?>
                                            </div>
                                        </div>
                                        <div class="list-product__info">
                                            <div class="list-product__name text-center mt-3">
                                                <p class="h6 mb-0 font-weight-bold list-product__name--child">{{$value['product_name']}}</p>
                                            </div>
                                            <div class="list-product__price text-center py-2">
                                                <span>
                                                    <span class="text-doctrine font-weight-bold">
                                                        {{str_replace(',','.',number_format($value['price_product'] - ($value['price_product'] * $value['discount_product'] / 100))) .' ₫'}}
                                                    </span>
                                                    <?php 
                                                        if($value['discount_product'] != 0) {
                                                            echo '<span class="text-muted ml-2 old-price"><del>'.str_replace(',','.',number_format($value['price_product'])) .' ₫</del></span>';
                                                        }
                                                    ?>
                                                </span>
                                            </div>
                                            <div class="list-product__promotion px-2 text-muted">
                                                <p>{{(!empty($value['promotion_name'])) ? $value['promotion_name'] : ''}}</p>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="btn-add__group d-flex justify-content-between">
                                        <button data-id="{{$value['id_product']}}" class="add-cart btn bg-doctrine text-white w-50">Thêm giỏ hàng</button>
                                        <a href="<?php echo _WEB_ROOT .'/mua-ngay/'.$value['id_product'] ?>" class="btn bg-doctrine text-white w-50 flex-end">Mua ngay</a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="l-12 m-12 c-12 py-3 list-product-box">
                    <div class="box-title d-flex flex-column rounded align-iems-center">
                        <div class="box-title__tile l-12 m-12 m-12 px-3 py-2">
                            <p class="h3 mb-0 font-wieght-bold"><strong><i>Tablet nổi bật</i></strong></p>
                        </div>
                        <div class="list-product-mobile l-12 c-12 m-12 d-flex flex-wrap bg-white">
                            @foreach($productTablet as $value)
                            <div id="{{$value['id_product']}}" class="l-2-4 m-4 c-6 -3 list-product">
                                <div class="card py-4 h-100">
                                    <a href="{{_URL_PRODUCT .str_replace(' ','+',$value['product_name'])}}" class="text-decoration-none d-block text-333">
                                        <div class="list-product__img mx-auto w-75">
                                            <img src="{{_IMG_PRODUCT .$value['img_product']}}" alt="" class="w-100">
                                            <div class="product__box-sticker">
                                                <?php if($value['discount_product'] != 0) {
                                                    echo '<p class="sticker-percent">'.$value['discount_product'] .'%</p>';
                                                } ?>
                                            </div>
                                        </div>
                                        <div class="list-product__info">
                                            <div class="list-product__name text-center mt-3">
                                                <p class="h6 mb-0 font-weight-bold list-product__name--child">{{$value['product_name']}}</p>
                                            </div>
                                            <div class="list-product__price text-center py-2">
                                                <span>
                                                    <span class="text-doctrine font-weight-bold">
                                                        {{str_replace(',','.',number_format($value['price_product'] - ($value['price_product'] * $value['discount_product'] / 100))) .' ₫'}}
                                                    </span>
                                                    <?php 
                                                        if($value['discount_product'] != 0) {
                                                            echo '<span class="text-muted ml-2 old-price"><del>'.str_replace(',','.',number_format($value['price_product'])) .' ₫</del></span>';
                                                        }
                                                    ?>
                                                </span>
                                            </div>
                                            <div class="list-product__promotion px-2 text-muted">
                                                <p>{{(!empty($value['promotion_name'])) ? $value['promotion_name'] : ''}}</p>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="btn-add__group d-flex justify-content-between">
                                        <button data-id="{{$value['id_product']}}" class="add-cart btn bg-doctrine text-white w-50">Thêm giỏ hàng</button>
                                        <a href="<?php echo _WEB_ROOT .'/mua-ngay/'.$value['id_product'] ?>" class="btn bg-doctrine text-white w-50 flex-end">Mua ngay</a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="l-12 m-12 c-12 py-3 list-product-box">
                    <div class="box-title d-flex flex-column rounded align-iems-center">
                        <div class="box-title__tile l-12 m-12 m-12 px-3 py-2">
                            <p class="h3 mb-0 font-wieght-bold"><strong><i>Laptop nổi bật</i></strong></p>
                        </div>
                        <div class="list-product-laptop l-12 c-12 m-12 d-flex flex-wrap bg-white swiper-container">
                            <ul id="listLaptop" class="swiper-wrapper">
                                @foreach($productLaptop as $value)
                                <li class="item-d h-100 swiper-slide">
                                    <div class="card pt-2 pb-4 h-100">
                                        <div class="card-img d-flex align-items-center py-3">
                                            <a href="{{ _URL_PRODUCT .str_replace(' ','+',$value['product_name']) }}" class="text-decoration-none text-333 text-center w-100">
                                                <img src="{{ _IMG_PRODUCT .$value['img_product'] }}" alt="" class="card-img-top m-auto">
                                                <div class="product__box-sticker">
                                                    <?php if($value['discount_product'] != 0) {
                                                        echo '<p class="sticker-percent">'.$value['discount_product'] .'%</p>';
                                                    } ?>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="card-body pt-1">
                                            <a href="{{ _URL_PRODUCT .str_replace(' ','-',$value['product_name']) }}" class="text-decoration-none text-333 text-center w-100">
                                                <div class="card-title text-center h6 mb-0 font-weight-bold">{{ $value['product_name'] }}</div>
                                                <div class="card-text pt-1">
                                                    <span>
                                                        <span class="text-doctrine font-weight-bold">
                                                            {{str_replace(',','.',number_format($value['price_product'] - ($value['price_product'] * $value['discount_product'] / 100))) .' ₫'}}
                                                        </span>
                                                        <?php 
                                                            if($value['discount_product'] != 0) {
                                                                echo '<span class="text-muted ml-3 old-price"><del>'.str_replace(',','.',number_format($value['price_product'])) .' ₫</del></span>';
                                                            }
                                                        ?>
                                                    </span>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="btn-add__group d-flex justify-content-between">
                                            <button data-id="{{$value['id_product']}}" class="add-cart btn bg-doctrine text-white w-50">Thêm giỏ hàng</button>
                                            <a href="<?php echo _WEB_ROOT .'/mua-ngay/'.$value['id_product'] ?>" class="btn bg-doctrine text-white w-50 flex-end">Mua ngay</a>
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="l-12 m-12 c-12 py-3 list-product-box">
                    <div class="box-title d-flex flex-column rounded align-iems-center">
                        <div class="box-title__tile l-12 m-12 m-12 px-3 py-2">
                            <p class="h3 mb-0 font-wieght-bold"><strong><i>Đồng hồ thông minh</i></strong></p>
                        </div>
                        <div class="list-product-watch l-12 c-12 m-12 d-flex flex-wrap bg-white">
                            @foreach($productWatch as $value)
                            <div id="{{$value['id_product']}}" class="l-2-4 m-4 c-6 -3 list-product">
                                <div class="card py-4 h-100">
                                <a href="{{_URL_PRODUCT .str_replace(' ','+',$value['product_name'])}}" class="text-decoration-none d-block text-333">
                                    <div class="list-product__img mx-auto w-75">
                                        <img src="{{_IMG_PRODUCT .$value['img_product']}}" alt="" class="w-100">
                                        <div class="product__box-sticker">
                                            <?php if($value['discount_product'] != 0) {
                                                    echo '<p class="sticker-percent">'.$value['discount_product'] .'%</p>';
                                            } ?>
                                        </div>
                                    </div>
                                    <div class="list-product__info">
                                        <div class="list-product__name text-center mt-3">
                                            <p class="h6 mb-0 font-weight-bold list-product__name--child">{{$value['product_name']}}</p>
                                        </div>
                                        <div class="list-product__price text-center py-2">
                                            <span>
                                                <span class="text-doctrine font-weight-bold">
                                                    {{str_replace(',','.',number_format($value['price_product'] - ($value['price_product'] * $value['discount_product'] / 100))) .' ₫'}}
                                                </span>
                                                <?php 
                                                    if($value['discount_product'] != 0) {
                                                        echo '<span class="text-muted ml-3 old-price"><del>'.str_replace(',','.',number_format($value['price_product'])) .' ₫</del></span>';
                                                    }
                                                ?>
                                            </span>
                                        </div>
                                        <div class="text-muted px-2 list-product__promotion">
                                            <p>{{(!empty($value['promotion_name'])) ? $value['promotion_name'] : ''}}</p>
                                        </div>
                                    </div>
                                </a>
                                <div class="btn-add__group d-flex justify-content-between">
                                    <button data-id="{{$value['id_product']}}" class="add-cart btn bg-doctrine text-white w-50">Thêm giỏ hàng</button>
                                    <a href="<?php echo _WEB_ROOT .'/mua-ngay/'.$value['id_product'] ?>" class="btn bg-doctrine text-white w-50 flex-end">Mua ngay</a>
                                </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="l-12 m-12 c-12 py-3 list-product-box">
                    <div class="box-title d-flex flex-column rounded align-iems-center">
                        <div class="box-title__tile l-12 m-12 m-12 px-3 py-2">
                            <p class="h3 mb-0 font-wieght-bold"><strong><i>Tai nghe nổi bật</i></strong></p>
                        </div>
                        <div class="list-product-watch l-12 c-12 m-12 d-flex flex-wrap bg-white">
                            @foreach($productaccessory as $value)
                            <div id="{{$value['id_product']}}" class="l-2-4 m-4 c-6 -3 list-product">
                                <div class="card py-4 h-100">
                                <a href="{{_URL_PRODUCT .str_replace(' ','+',$value['product_name'])}}" class="text-decoration-none d-block text-333">
                                    <div class="list-product__img mx-auto w-75">
                                        <img src="{{_IMG_PRODUCT .$value['img_product']}}" alt="" class="w-100">
                                        <div class="product__box-sticker">
                                            <p class="sticker-percent">{{$value['discount_product'] .'%'}}</p>
                                        </div>
                                    </div>
                                    <div class="list-product__info">
                                        <div class="list-product__name text-center mt-1">
                                            <p class="h6 mb-0 font-weight-bold list-product__name--child">{{$value['product_name']}}</p>
                                        </div>
                                        <div class="list-product__price text-center py-2">
                                            <span>
                                                <span class="text-doctrine font-weight-bold">
                                                    {{str_replace(',','.',number_format($value['price_product'] - ($value['price_product'] * $value['discount_product'] / 100))) .' ₫'}}
                                                </span>
                                                <?php 
                                                    if($value['discount_product'] != 0) {
                                                        echo '<span class="text-muted ml-3 old-price"><del>'.str_replace(',','.',number_format($value['price_product'])) .' ₫</del></span>';
                                                    }
                                                ?>
                                            </span>
                                        </div>
                                        <div class="tex-muted px-2 list-product__promotion">
                                            <p>{{(!empty($value['promotion_name'])) ? $value['promotion_name'] : ''}}</p>
                                        </div>
                                    </div>
                                </a>
                                <div class="btn-add__group d-flex justify-content-between">
                                    <button data-id="{{$value['id_product']}}" class="add-cart btn bg-doctrine text-white w-50">Thêm giỏ hàng</button>
                                    <a href="<?php echo _WEB_ROOT .'/mua-ngay/'.$value['id_product'] ?>" class="btn bg-doctrine text-white w-50 flex-end">Mua ngay</a>
                                </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="l-12 m-12 c-12 py-3 list-product-box">
                    <div class="box-title d-flex flex-column rounded align-iems-center">
                        <div class="box-title__tile l-12 m-12 m-12 px-3 py-2">
                            <p class="h3 mb-0 font-wieght-bold"><strong><i>Loa bluetooth</i></strong></p>
                        </div>
                        <div class="list-product-watch l-12 c-12 m-12 d-flex flex-wrap bg-white">
                            @foreach($productspeak as $value)
                            <div id="{{$value['id_product']}}" class="l-2-4 m-4 c-6 -3 list-product">
                                <div class="card py-4 h-100">
                                <a href="{{_URL_PRODUCT .str_replace(' ','+',$value['product_name'])}}" class="text-decoration-none d-block text-333">
                                    <div class="list-product__img mx-auto w-75">
                                        <img src="{{_IMG_PRODUCT .$value['img_product']}}" alt="" class="w-100">
                                        <div class="product__box-sticker">
                                            <?php if($value['discount_product'] != 0) {
                                                echo '<p class="sticker-percent">'.$value['discount_product'] .'%</p>';
                                            } ?>
                                        </div>
                                    </div>
                                    <div class="list-product__info">
                                        <div class="list-product__name text-center mt-3">
                                            <p class="h6 mb-0 font-weight-bold list-product__name--child">{{$value['product_name']}}</p>
                                        </div>
                                        <div class="list-product__price text-center py-2">
                                            <span>
                                                <span class="text-doctrine font-weight-bold">
                                                    {{str_replace(',','.',number_format($value['price_product'] - ($value['price_product'] * $value['discount_product'] / 100))) .' ₫'}}
                                                </span>
                                                <?php 
                                                    if($value['discount_product'] != 0) {
                                                        echo '<span class="text-muted ml-3 old-price"><del>'.str_replace(',','.',number_format($value['price_product'])) .' ₫</del></span>';
                                                    }
                                                ?>
                                            </span>
                                        </div>
                                        <!-- <div class="list-product__rating product-box-rating">
                                            <i class="fa fa-star checked"></i>
                                            <i class="fa fa-star checked"></i>
                                            <i class="fa fa-star checked"></i>
                                            <i class="fa fa-star checked"></i>
                                            <i class="fa fa-star checked"></i>
                                            @if(!empty($value['comment']))
                                                <span class="text-muted">{{$value['comment']}}</span>
                                            @endif
                                        </div> -->
                                        <div class="px-2 text-muted list-product__promotion">
                                            <p>{{(!empty($value['promotion_name'])) ? $value['promotion_name'] : ''}}</p>
                                        </div>
                                    </div>
                                </a>
                                <div class="btn-add__group d-flex justify-content-between">
                                    <button data-id="{{$value['id_product']}}" class="add-cart btn bg-doctrine text-white w-50">Thêm giỏ hàng</button>
                                    <a href="<?php echo _WEB_ROOT .'/mua-ngay/'.$value['id_product'] ?>" class="btn bg-doctrine text-white w-50 flex-end">Mua ngay</a>
                                </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>