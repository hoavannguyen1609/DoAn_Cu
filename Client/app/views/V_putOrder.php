<section>
    <div class="grid wide">
        <div class="row no-gutters">
            <div class="l-12 m-12 c-12 content">
                <div class="l-12 m-12 c-12 text-center title">
                    <span>Đặt ngay rinh ngay ưu đãi</span>
                </div>
                <div class="l-10 m-12 c-12 pay-list">
                    <form method="post" id="formPut" class="list-product l-12">
                        @foreach($product as $value)
                            <div class="list-product__list">
                                <input name="id-product" type="hidden" value="{{$value['id_product']}}">
                                <div class="list-product__items">
                                    <div class="list-product__box">
                                        <div class="list-product__img">
                                            <a href="{{_URL_PRODUCT .str_replace(' ','+',$value['product_name'])}}">
                                                <img src="{{_IMG_PRODUCT .$value['img_product']}}" alt="">
                                            </a>
                                        </div>
                                        <div class="list-product__name">
                                            <a href="{{_URL_PRODUCT .str_replace(' ','+',$value['product_name'])}}" class="text-decoration-none text-333">
                                                <span>{{$value['product_name']}}</span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="list-product__box">
                                        <div class="list-product__unit-price">
                                            <input type="hidden" name="unitPrice" value="{{$value['price_product'] - ($value['price_product'] * $value['discount_product'] / 100)}}">
                                            <span class="list-product__unit-price--text">Đơn giá: <span class="">{{str_replace(',','.',number_format($value['price_product'] - ($value['price_product'] * $value['discount_product'] / 100))) .' ₫'}}</span></span>
                                        </div>
                                        <div class="list-product__amount">
                                            <!-- <div class="list-product__btn">
                                                <button id="btn-minus" data-id="<?php echo $value['id_product'] ?>" onclick="minus($(this).data('id'))" type="button" class="btn">-</button>
                                            </div> -->
                                            <span>Số lượng:&nbsp;</span>
                                            <div class="list-product__input">
                                                <!-- <input id="input-<?php echo $value['id_product'] ?>" type="text" name="amountProduct" class="text-center" readonly value="{{$value['amount_product_cart']}}"> -->
                                                <span> {{$value['amount_product_cart']}}</span>
                                            </div>
                                            <!-- <div class="list-product__btn">
                                                <button id="btn-plus" data-id="<?php echo $value['id_product'] ?>" onclick="plus($(this).data('id'))" type="button" class="btn">+</button>
                                            </div> -->
                                        </div>
                                        <div class="list-product__totalUnitprice">
                                            <input type="hidden" name="totalunitPrice" value="{{($value['price_product'] - ($value['price_product'] * $value['discount_product'] / 100)) * $value['amount_product_cart']}}">
                                            <span class="list-product__totalunitprice--text">Thành tiền: <span class="">{{str_replace(',','.',number_format(($value['price_product'] - ($value['price_product'] * $value['discount_product'] / 100)) * $value['amount_product_cart'])) .' ₫'}}</span></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="total-price">
                            <input type="hidden" name="totalPrice">
                            <div class="total-price__text">Tổng giá trị đơn hàng:</div>
                            <div class="total-price__child"></div>
                        </div>
                        <div class="form-info">
                            <div class="info-title">
                                <div class="info-title__title">Thông tin nhận hàng</div>
                                <span><i>(Vui lòng nhập đầy đủ thông tin nhận hàng)</i></span>
                            </div>
                            <div class="info-form">
                                <div class="info-form__box">
                                    <div class="info-form__fullname">
                                        <label>Họ và tên: (Bắt buộc)</label>
                                        <input type="text" placeholder="Nhập họ tên" name="fullname" class="form-control" autocomplete="off" value="{{$customer[0]['name']}}">
                                        <p class="mt-1 font-italic text-doctrine mb-0 fullname"></p>
                                    </div>
                                    <div class="imfo-form__phone">
                                    <label>Số điện thoại: (Bắt buộc)</label>
                                        <input type="text" placeholder="Nhập số điện thoại" name="phone" class="form-control" autocomplete="off" value="{{'0'.$customer[0]['phone']}}">
                                        <p class="mt-1 font-italic text-doctrine mb-0 phone"></p>
                                    </div>
                                </div>
                                <div class="info-form__box">
                                    <div class="info-form__email">
                                    <label>Email:</label>
                                        <input type="text" name="email" class="form-control" value="{{$customer[0]['email']}}" readonly>
                                    </div>
                                    <div class="info-form__address">
                                    <label>Địa chỉ: (Bắt buộc)</label>
                                        <input type="text" placeholder="Nhập địa chỉ" name="address" class="form-control" autocomplete="off" value="{{$customer[0]['address']}}">
                                        <p class="mt-1 font-italic text-doctrine mb-0 address"></p>
                                    </div>
                                </div>
                                <div class="info-form__box">
                                    <label>Phương thức thanh toán</label>
                                    <select name="paymentMethods" class="form-control">
                                        <option value="Thanh toán khi nhận hàng">Thanh toán khi nhận hàng</option>
                                        <option value="Thanh toán online">Thanh toán online</option>
                                    </select>
                                </div>
                                <div class="info-form__box">
                                    <div>
                                        <label>Lưu ý của khách hàng:</label>
                                        <input type="text" name="message" class="form-control" autocomplete="off">
                                        <p class="text-doctrine font-italic mt-1 mb-0 message"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="confirm-btn">
                            <input type="submit" value="Đặt hàng " class="btn">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>