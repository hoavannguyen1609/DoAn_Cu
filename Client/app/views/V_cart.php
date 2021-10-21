<section>
    <div class="grid wide">
        <div class="row no-gutters">
            <div class="l-12 m-12 c-12" id="cart">
                <div class="text-333 text-center title">
                    <h4>Giỏ hàng của bạn</h4>
                </div>
                <div class="l-12 m-12 c-12">
                    <div class="cart-title">
                        <div class="cart-title__product">Sản phẩm</div>
                        <div class="cart-title__group">
                            <div class="cart-title__unit-price">Đơn giá</div>
                            <div class="cart-title__amount">Số lượng</div>
                            <div class="cart-title__total-price">Thành tiền</div>
                            <div class="cart-title__edit">Thao tác</div>
                        </div>
                    </div>
                    <div class="l-12 m-12 c-12">
                        <div class="cart-list">
                            <div class="cart-list__group">
                            <?php foreach($listCart as $value) {?>
                                <div id="tr-<?php echo $value['id_cart'] ?>" class="cart-list__items">
                                    <div class="cart-list__box">
                                        <div class="cart-list__img">
                                            <a href="{{_URL_PRODUCT .str_replace(' ','+',$value['product_name'])}}">
                                                <img src="{{_IMG_PRODUCT.$value['img_product']}}" alt="">
                                            </a>
                                        </div>
                                        <div class="cart-list__name">
                                            <a href="{{_URL_PRODUCT .str_replace(' ','+',$value['product_name'])}}">
                                                <span>
                                                    {{$value['product_name']}}
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="cart-list__box">
                                        <div class="cart-list__price">
                                            <span>
                                                <span class="new-price font-weight-bold">
                                                    <input id="new-price<?php echo $value['id_cart'] ?>" type="hidden" value="{{$value['price_product'] - ($value['price_product'] * $value['discount_product'] / 100)}}">
                                                    {{str_replace(',','.',number_format($value['price_product'] - ($value['price_product'] * $value['discount_product'] / 100))) .' ₫'}}
                                                </span>
                                            </span>
                                        </div>
                                        <div class="cart-list__amount">
                                            <div class="cart-list__minus-button">
                                                <button id="btn-minus-<?php echo $value['id_cart'] ?>" data-id="{{$value['id_cart']}}" class="btn minus" onclick="minusProduct($(this).data('id'))">-</button>
                                            </div>
                                            <div class="cart-list__input">
                                                <input id="input-<?php echo $value['id_cart'] ?>" type="text" value="{{$value['amount_product_cart']}}" readonly data-id="{{$value['id_cart']}}">
                                            </div>
                                            <div class="cart-list__plus-button">
                                                <button id="btn-plus-<?php echo $value['id_cart'] ?>" data-id="{{$value['id_cart']}}" class="btn plus"  onclick="plusProduct($(this).data('id'))">+</button>
                                            </div>
                                        </div>
                                        <div class="cart-list__total-price font-weight-bold">
                                            <input id="newTotal-<?php echo $value['id_cart'] ?>" type="hidden" value="{{($value['price_product'] - ($value['price_product'] * $value['discount_product'] / 100)) * $value['amount_product_cart']}}" class="newTotal">
                                            <span id="total-price-<?php echo $value['id_cart'] ?>">{{str_replace(',','.',number_format(($value['price_product'] - ($value['price_product'] * $value['discount_product'] / 100)) * $value['amount_product_cart'])) .' ₫'}}</span>
                                        </div>
                                        <div class="cart-list__del">
                                            <a href="javascript:delProduct('<?php echo _WEB_ROOT .'/cart/delProduct/' .$value['id_cart'] ?>')" class="text-doctrine text-decoration-none">Xóa</a>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="pay">
                        <div id="totalMoney" class="text-doctrine"></div>
                        <a href="{{_WEB_ROOT .'/dat-don'}}" class="bg-doctrine text-white btn">Đặt hàng</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>