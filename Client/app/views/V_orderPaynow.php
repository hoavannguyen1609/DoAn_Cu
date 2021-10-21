<section>
    <div class="grid wide">
        <div class="row no-gutters">
            <div class="l-12 m-12 c-12 back-to-shop mt-4">
                <a href="{{_WEB_ROOT}}" class="text-doctrine text-decoration-none">
                    <span>< </span>
                    <span>Tiếp tục mua sắm</span>
                </a>
            </div>
            <div class="l-12 m-12 c-12 content-orderPaynow">
                <div class="title-orderPaynow text-center">
                    Thông tin đơn hàng
                </div>
                <div class="l-6 m-10 c-10 content-orderDetail">
                    <div class="content-orderDetail__body">
                        @foreach($productOrder as $value)
                        <div class="content-orderDetail__box">
                            <div class="content-orderDetail__items">
                                <div class="content-orderDetail__item">
                                    <div class="content-orderDetail__text">-Mã đơn hàng</div>
                                    <div class="content-orderDetail__infoProduct">
                                        <span class="">{{$value['code_order']}}</span>
                                    </div>
                                </div>
                                <div class="content-orderDetail__item--product">
                                    <div class="content-orderDetail__text">-Sản phẩm</div>
                                    <div class="content-orderDetail__infoProduct">
                                        <div class="content-orderDetail__infoProduct--img">
                                            <img src="{{_IMG_PRODUCT .$value['img_product']}}" alt="">
                                        </div>
                                        <div class="content-orderDetail__infoProduct--name">
                                            <span class="">{{$value['product_name']}}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="content-orderDetail__item">
                                    <div class="content-orderDetail__text">-Đơn giá</div>
                                    <div class="content-orderDetail__infoProduct">
                                        <span class="">{{str_replace(',','.',number_format($value['price_product'] - ($value['price_product'] * $value['discount_product'] / 100))) .' ₫'}}</span>
                                    </div>
                                </div>
                                <div class="content-orderDetail__item">
                                    <div class="content-orderDetail__text">-Số lượng</div>
                                    <div class="content-orderDetail__infoProduct">
                                        <span class="">{{$value['amount_product_order']}}</span>
                                    </div>
                                </div>
                                <div class="content-orderDetail__item">
                                    <div class="content-orderDetail__text">-Thành tiền</div>
                                    <div class="content-orderDetail__infoProduct">
                                        <span class="">{{str_replace(',','.',number_format(($value['price_product'] - ($value['price_product'] * $value['discount_product'] / 100)) * $value['amount_product_order'])) .' ₫'}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @if(!empty($total))
                            <div class="total-price">
                                <div class="total-price__text">Tổng giá trị đơn hàng: </div>
                                <div class="total-price__value">{{str_replace(',','.',number_format($total[0]['total_order_price'])) .' ₫'}}</div>
                            </div>
                        @endif
                        <div class="content-orderDetail__title">Thông tin nhận hàng</div>
                        <div class="content-orderDetail__box info">
                            <div class="content-orderDetail__items">
                                <div class="content-orderDetail__text">-Họ tên:</div>
                                <div class="content-orderDetail__infoPut">{{$productOrder[0]['customer_name']}}</div>
                            </div>
                            <div class="content-orderDetail__items">
                                <div class="content-orderDetail__text">-Số điện thoại</div>
                                <div class="content-orderDetail__infoPut">{{'0'.$productOrder[0]['customer_phone']}}</div>
                            </div>
                            <div class="content-orderDetail__items">
                                <div class="content-orderDetail__text">-Địa chỉ:</div>
                                <div class="content-orderDetail__infoPut">{{$productOrder[0]['customer_address']}}</div>
                            </div>
                        </div>
                        <div class="content-orderDetail__box payment">
                            <div class="content-orderDetail__item">
                                <div class="content-orderDetail__text">-Phương thức thanh toán:</div>
                                <div class="content-orderDetail__payment">{{$productOrder[0]['payments']}}</div>
                            </div>
                            <div class="content-orderDetail__item">
                                <div class="content-orderDetail__text">-Trạng thái đơn hàng:</div>
                                <div class="content-orderDetail__status">{{$total[0]['status_name']}}</div>
                            </div>
                        </div>
                        <div class="content-orderDetail__btn">
                            <?php if($productOrder[0]['status_id'] == 1) {
                                echo '<button data-id="'.$productOrder[0]['id_total_order'].'" class="btn delMyorder">Hủy đơn hàng</button>';
                            } else {
                                echo '<button data-id="'.$productOrder[0]['id_total_order'].'" class="btn disabled" disabled>Hủy đơn hàng</button>';
                            }?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>