<div class="promotion-box">
    <div class="prmotion-box__title">
        <span>Danh sách khuyến mãi</span>
    </div>
    <div class="promotion-box__btn">
        <button class="btn" onclick="javascript:showFormAdd()">+Thêm khuyến mãi</button>
    </div>
    <form class="formAdd">
        <a href="javascript:closeFormAdd()" class="btn btn-outline-danger">
            <i class="fas fa-times"></i>
        </a>
        <div class="form-group">
            <label>Khuyến mãi:</label>
            <input type="text" id="promotionAdd" placeholder="Nhập khuyến mãi">
        </div>
        <div class="form-group">
            <button type="button" class="btn" onclick="javascript:addPromotion()">Thêm</button>
        </div>
    </form>
    <div class="promotion-box__child">
        <div class="promotion-box__child-title">
            <div class="promotion-box__code">
                <span>Mã khuyến mãi</span>
            </div>
            <div class="promotion-box__name">
                <span>Khuyến mãi</span>
            </div>
            <div class="promotion-box__opera">
                <span>Thao tác</span>
            </div>
        </div>
        <div class="promotion-box__list"></div>
    </div>
</div>