<div class="position-box">
    <div class="position-box__title">
        <span>Danh sách chức vụ trong cửa hàng</span>
    </div>
    <div class="position-box__btn-show btn">
        <a href="javascript:showFormAdd()">+Thêm chức vụ</a>
    </div>
    <div class="position-box__formAdd">
        <form method="post" class="formAdd" id="formAdd-position">
            <a href="javascript:closeFormAdd()" class="close-form btn btn-outline-danger">
                <i class="fas fa-times"></i>
            </a>
            <div class="form-group">
                <label>Tên chức vụ:</label>
                <input type="text" name="positionName" placeholder="Nhập chức vụ">
            </div>
            <div class="form-group">
                <label>Phụ cấp:</label>
                <input type="text" name="allowancePosition" placeholder="Nhập phụ cấp">
            </div>
            <a class="btn addPosition" href="javascript:addPosition('position-box__formAdd')">Thêm</a>
        </form>
    </div>
    <div class="list-position">
        <div class="list-position__head">
            <div class="list-position__number-head">
                <span>Mã CV</span>
            </div>
            <div class="list-position__name-head">
                <span>Tên CV</span>
            </div>
            <div class="list-position__operation">
                <span>Thao tác</span>
            </div>
        </div>
    </div>
</div>