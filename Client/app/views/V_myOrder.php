<section>
    <div class="grid wide">
        <div class="row no-gutters">
            <div class="l-12 m-12 c-12 d-flex flex-wrap py-5">
                <div class="c-12 m-2 l-2 px-3">
                    <div class="img-account d-flex align-items-center">
                        <div class="img-account__img">
                            <?php echo (!empty(Session::dataSS('avatarCustomer'))) ? Session::dataSS('avatarCustomer') : "" ?>
                        </div>
                        <div class="img-account__account text-truncate ml-3">
                            <strong class=""><?php echo (!(empty(Session::dataSS('customer_cps')))) ? Session::dataSS('customer_cps') : "Tài khoản của tôi" ?></strong>
                        </div>
                    </div>
                    <div class="update-change flex-column py-3">
                        <div class="my-account py-2">
                            <a href="<?php echo _WEB_ROOT .'/tai-khoan' ?>" class="text-decoration-none text-dark">
                                <span>
                                    <i class="far fa-user text-info"></i>
                                    <span class="ml-3 h6 mb-0">Tài khoản của tôi</span>
                                </span>
                            </a>
                        </div>
                        <div class="order-buy py-2 d-flex">
                            <a href="<?php echo _WEB_ROOT .'/don-mua-cua-toi' ?>" class="text-decoration-none text-dark">
                                <span>
                                    <i class="far fa-list-alt text-info"></i>
                                    <span class="ml-3 h6 mb-0">Đơn mua</span>
                                </span>
                            </a>
                        </div>
                        <div class="order-buy pt-2 d-flex">
                            <a href="<?php echo _WEB_ROOT .'/sign-out' ?>" class="text-decoration-none text-dark">
                                <span>
                                    <i class="fas fa-sign-out-alt text-danger"></i>
                                    <span class="ml-3 h6 mb-0">Đăng xuất</span>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="c-12 l-10 m-10 shadow-sm bg-white">
                    <div class="c-12 m-12 l-12 px-4">
                        <div class="profile">
                            <p class="my-profile mb-1">
                                Đơn hàng của tôi
                            </p>
                            <p class="text-dark">
                                <i>Quản lý đơn hàng đã mua</i>
                            </p>
                        </div>
                        <div class="l-12 m-12 c-12 py-4">
                            <div class="content-myOrder__body w-100">
                                @foreach($productHistory as $value)
                                <div class="content-myOrder__box">
                                    <div class="content-myOrder__items">
                                        <div class="content-myOrder__code-date">
                                            <div class="code-order">
                                                <span>Mã đơn hàng:</span><span class="code-order__item">{{$value['code_order']}}</span>
                                            </div>
                                            <div class="date-add">
                                                <span>{{date_format(date_create($value['date_add_historybuy']),'d/m/Y')}}</span>
                                            </div>
                                        </div>
                                        <div class="content-myOrder__product">
                                            <div class="product__img">
                                                <img src="{{_IMG_PRODUCT .$value['img_product']}}" alt="">
                                            </div>
                                            <div class="product__name">
                                                <span>{{$value['product_name']}}</span>
                                            </div>
                                        </div>
                                        <div class="content-myOrder__product info">
                                            <div class="amount">
                                                <span>
                                                    <!-- {{$value['']}} -->
                                                </span>
                                            </div>
                                            <div class="price">
                                                <span>
                                                    <span class="new-price">
                                                        {{str_replace(',','.',number_format($value['price_product'] - ($value['price_product'] * $value['discount_product'] / 100))) .' ₫'}}
                                                    </span>
                                                    <span class="old-price">
                                                        <del>
                                                            {{str_replace(',','.',number_format($value['price_product'])) .' ₫'}}
                                                        </del>
                                                    </span>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="content-myOrder__btn">
                                            <button data-id="{{$value['id_total_order']}}" class="btn delMyorder">Hủy đơn hàng</button>
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
    </div>
</section>