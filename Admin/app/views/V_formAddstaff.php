<div class="formAdd-staff">
    <div class="formAdd-staff__title">
        <span>Thêm nhân viên của hàng</span>
    </div>
    <div class="formAdd-saff__child">
        <form>
            <div class="form-group">
                <label>Họ tên:</label>
                <input type="text" autocomplete="off" placeholder="Nhập họ tên" id="fullname">
            </div>
            <div class="form-group">
                <label>Tài khoản:</label>
                <input type="text" autocomplete="off" placeholder="Nhập tài khoản" id="account">
            </div>
            <div class="form-group">
                <label>Giới tính:</label>
                <select name="gender" class="custom-select"></select>
            </div>
            <div class="form-group">
                <label>Ngày sinh:</label>
                <input type="text" autocomplete="off" placeholder="Nhập ngày sinh" id="birthday">
            </div>
            <div class="form-group">
                <label>Số điện thoại:</label>
                <input type="text" autocomplete="off" placeholder="Nhập số điện thoại" id="phone">
            </div>
            <div class="form-group">
                <label>Email:</label>
                <input type="text" autocomplete="off" placeholder="Nhập email" id="email">
            </div>
            <div class="form-group">
                <label>Địa chỉ:</label>
                <input type="text" autocomplete="off" placeholder="Nhập địa chỉ" id="address">
            </div>
            <div class="form-group">
                <label>Chức vụ:</label>
                <select name="position" class="custom-select"></select>
            </div>
            <div class="form-group">
                <label>Ngày vào làm:</label>
                <input type="text" autocomplete="off" placeholder="Nhập ngày vào làm" id="workday">
            </div>
            <div class="form-group">
                <label>Số tài khoản:</label>
                <input type="text" autocomplete="off" placeholder="Nhập số tài khoản" id="bankAccount">
            </div>
            <div class="form-group">
                <button type="button" class="btn" onclick="javascript:addStaff('formAdd-saff__child')">Thêm nhân viên</button>
            </div>
        </form>
    </div>
</div>