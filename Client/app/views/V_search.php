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
                <?php if(!empty($productSearch)) {
                    if(!empty($_GET['key'])) {
                        echo '<h4 class="text-doctrine font-weight-bold font-italic pt-3">Kết quả tìm kiếm: "' .$_GET['key'] .'"</h4><br>';
                    }
                ?>
                    <div class="list-product-watch l-12 c-12 m-12 d-flex flex-wrap bg-white mb-5">
                            <?php foreach($productSearch as $value) { ?>
                            <div id="{{$value['id_product']}}" class="l-2-4 m-4 c-6 -3 list-product">
                                <div class="card py-4 h-100">
                                <a href="{{_WEB_ROOT .'/san-pham/' .str_replace(' ','+',$value['product_name'])}}" class="text-decoration-none d-block">
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
                                            <p class="h6 mb-0 font-weight-bold list-product__name">{{$value['product_name']}}</p>
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
                            <?php } ?>
                        </div>
                <?php } else { 
                    if(!empty($_GET['key'])) {
                        echo '<h4 class="text-doctrine font-weight-bold font-italic pt-3">Kết quả tìm kiếm: "' .$_GET['key'] .'"</h4><br>';
                    }?>
                        <div class="l-12 m-12 c-12 my-4 py-3 border bg-doctrine text-white">
                            <span class="font-weight-bold ml-2 py-3">Không tìm thấy kết quả trả về cho {{(!empty($_GET['key'])) ? $_GET['key'] : ''}}</span>
                        </div>
                <?php  }?>
            </div>
        </div>
    </div>
</section>