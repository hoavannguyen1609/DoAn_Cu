<div class="manufacturer-box">
    <div class="manufacturer-box__title">
        <span>Hãng sản xuất của sản phẩm</span>
    </div>
    <div class="manufacturer-box__btn">
        <a href="javascript:showFormAdd()" class="btn">+Thêm hãng sản xuất</a>
    </div>
    <form class="formAdd">
        <a href="javascript:closeFormAdd()" class="btn btn-outline-danger">
            <i class="fas fa-times"></i>
        </a>
        <div class="form-group">
            <label>Tên hãng sản xuất:</label>
            <input type="text" id="manufacturer" placeholder="Nhập tên hãng sản xuất">
        </div>
        <div class="form-group">
            <button onclick="javascript:addmanufacturer()" type="button" class="btn">Thêm</button>
        </div>
    </form>
    <div class="manufacturer-box__child">
        <div class="manufacturer-box__child-title">
            <div class="manufacturer-box__number">
                <span>Mã hãng sản xuất</span>
            </div>
            <div class="manufacturer-box__name">
                <span>Tên hãng sản xuất</span>
            </div>
            <div class="manufacturer-box__opera">
                <span>Thao tác</span>
            </div>
        </div>
        <div class="manufacturer-box__list"></div>
    </div>
</div>