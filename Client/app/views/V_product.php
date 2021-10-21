<section>
    <div class="grid wide">
        <div class="row no-gutters">
            <div class="l-12 m-12 c-12">
                <input type="hidden" name="categoryID" value="{{$product[0]['category_id']}}">
                <div class="block-filter">
                    <div class="filter__block-list-filter">
                        <div class="box-title">
                            <div class="box-title__title">Chọn theo tiêu chí</div>
                        </div>

                    </div>
                    <div class="filter__block-list-sort">
                        <div class="box-title">
                            <div class="box-title__title">Sắp xếp theo</div>
                        </div>
                        <div class="box-list-filter">
                            <a id="sortDesc" class="btn-filter item-filter" onclick="customSetOrder('price', '0', 'desc')"><i class="fas fa-sort-amount-up"></i>&ensp;Giá cao</a>
                            <a id="sortAsc" class="btn-filter item-filter" onclick="customSetOrder('price', '0', 'asc')"><i class="fas fa-sort-amount-up-alt"></i>&ensp;Giá thấp</a>
                        </div>
                    </div>
                </div>
                <div class="list-product-mobile l-12 c-12 m-12 d-flex flex-wrap bg-white my-5" id="showProduct"></div>
                <?php if(!empty($productaccessory)) { ?>
                    <div class="list-product-mobile l-12 c-12 m-12 d-flex flex-wrap bg-white my-5">
                    @foreach($productaccessory as $value)
                    <div id="{{$value['id_product']}}" class="l-2-4 m-4 c-6 -3 list-product">
                        <div class="card py-4 h-100">
                            <a href="{{_WEB_ROOT .'/san-pham/' .str_replace(' ','+',$value['product_name'])}}" class="text-decoration-none d-block text-333">
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
                                <a href="{{_WEB_ROOT .'/mua-ngay/'.$value['id_product']}}" class="btn bg-doctrine text-white w-50 flex-end">Mua ngay</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <?php } ?>
                <div class="text-center l-12 c-12 m-12 mb-4">
                    <button id="btn-show" class="btn">Xem thêm</button>
                </div>
            </div>
        </div>
    </div>
    <div class="list-product-mobile l-12 c-12 m-12 flex-wrap bg-white my-5" id="elementShow">
        <div class="l-2-4 m-4 c-6 -3 list-product">
            <div class="card py-4 h-100">
                <a href="{{_URL_PRODUCT}}{productName}" class="text-decoration-none d-block text-333">
                    <div class="list-product__img mx-auto w-75">
                        <img src="{{_IMG_PRODUCT}}{imgProduct}" alt="" class="w-100">
                        <div class="product__box-sticker">
                                {productDiscount}
                        </div>
                    </div>
                    <div class="list-product__info">
                        <div class="list-product__name text-center mt-3">
                            <p class="h6 mb-0 font-weight-bold list-product__name--child">{productName}</p>
                        </div>
                        <div class="list-product__price text-center py-2">
                            <span>
                                <span class="text-doctrine font-weight-bold">{productPriceDis}</span>
                                <span class="text-muted ml-2 old-price"><del>{productPrice}</del></span>
                            </span>
                        </div>
                        <div class="list-product__promotion px-2 text-muted pb-3">{promotion}</div>
                    </div>
                </a>
                <div class="btn-add__group d-flex justify-content-between">
                    <button data-id="{dataID}" class="add-cart btn bg-doctrine text-white w-50" onclick="javascript:addCart($(this).data('id'))">Thêm giỏ hàng</button>
                    <a href="{{_WEB_ROOT .'/mua-ngay/'}}{dataID}" class="btn bg-doctrine text-white w-50 flex-end">Mua ngay</a>
                </div>
            </div>
        </div>
    </div>
</section>