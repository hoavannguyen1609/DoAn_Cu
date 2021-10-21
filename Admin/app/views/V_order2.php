<div class="order-box__item" id="tr-{{idTotalOrder}}">
    <div class="order-box__top">
        <div class="order-box__code">
            <span class="order-box__span">
                <span>Mã đơn:&nbsp;</span>
                <span>{{orderCode}}</span>
            </span>
        </div>
        <div class="order-box__date">
            <span class="order-box__span">
                <span>Ngày đặt:&nbsp;</span>
                <span>{{datePut}}</span>
            </span>
        </div>
    </div>
    <div class="order-box__under">
        <div class="order-box__left">
            <div class="order-box__customer-name">
                <span class="order-box__span">
                    <span>Họ tên:</span>
                    <span>{{customerName}}</span>
                </span>
            </div>
            <div class="order-box__customer-phone">
                <span class="order-box__span">
                    <span>Số điện thoại:</span>
                    <span>{{customerPhone}}</span>
                </span>
            </div>
            <div class="order-box__address">
                <span class="order-box__span">
                    <span>Địa chỉ:</span>
                    <span>{{customerAddress}}</span>
                </span>
            </div>
        </div>
        <div class="order-box__right">
            <div class="order-box__message">
                <span class="order-box__span">
                    <span>Lời nhắn:</span>
                    <span>{{customerMessage}}</span>
                </span>
            </div>
            <div class="order-box__paymet">
                <span class="order-box__span">
                    <span>Thanh toán:</span>
                    <span>{{payment}}</span>
                </span>
            </div>    
            <div class="order-box__status">
                <span class="order-box__span">
                    <span>Trạng thái:</span>
                    <span class="status status-{{idTotalOrder}}">{{statusOrder}}</span>
                </span>
            </div>                                                                                                                                                                                                                                                                                                                                                                                                               
        </div>
    </div>
    <div class="order-box__end">
        <div class="order-box__money">
            <span class="order-box__span">
                <span>Tổng tiền:</span>
                <span>{{totalOrder}}</span>
            </span>
        </div>
        <div class="order-box__btn">
            <!-- <div class="order-box__btn-brower">
                <a title="Duyệt đơn hàng" href="javascript:confirmOrder({{idTotalOrder}})" class="btn btn-success confirmOrder-{{idTotalOrder}}">
                    <i class="fas fa-check"></i>
                </a>
            </div>
            <div class="order-box__btn-del">
                <a title="Hủy đơn hàng" href="javascript:delOrder({{idTotalOrder}})" class="btn btn-danger delOrder-{{idTotalOrder}}">
                    <i class="far fa-trash-alt"></i>
                </a>
            </div> -->
            <div class="order-box__btn-detail">
                <a title="Chi tiết đơn hàng" href="javascript:getDetails({{idTotalOrder}})" class="btn btn-info">
                    <i class="fas fa-info-circle"></i>
                </a>
            </div>
        </div>
    </div>
</div>