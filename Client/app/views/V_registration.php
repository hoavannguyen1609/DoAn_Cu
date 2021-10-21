<section>
    <div class="grid wide">
        <div class="row no-gutters">
            <div class="l-12 m-12 c-12 registration-content">
                <div class="registration-title text-center">
                    <div>Đăng ký</div>
                </div>
                <div class="l-12 m-12 c-12">
                    <form method="post" class="l-8 m-10 c-10 registration-form">
                        <div class="registration__items">
                            <div class="registration__item">
                                <label>Họ tên:</label>
                                <div class="registration__input">
                                    <input type="text" autocomplete="off" placeholder="Nhập tài khoản" class="form-control" name="fullname">
                                </div>
                                <p class="text-doctrine font-italic mb-0 mt-1 fullname"></p>
                            </div>
                            <div class="registration__item">
                                <label>Tài khoản:</label>
                                <div class="registration__input">
                                    <input type="text" autocomplete="off" placeholder="Nhập họ tên" class="form-control" name="account">
                                </div>
                                <p class="text-doctrine font-italic mb-0 mt-1 account"></p>
                            </div>
                        </div>
                        <div class="registration__items">
                            <div class="registration__item">
                                <label>Mật khẩu:</label>
                                <div class="registration__input">
                                    <input type="text" autocomplete="off" placeholder="Nhập mật khẩu" class="form-control" name="password">
                                </div>
                                <p class="text-doctrine font-italic mb-0 mt-1 password"></p>
                            </div>
                            <div class="registration__item">
                                <label>Nhập lại mật:</label>
                                <div class="registration__input">
                                    <input type="text" autocomplete="off" placeholder="Nhập lại mật khẩu" class="form-control" name="confirmPassword">
                                </div>
                                <p class="text-doctrine font-italic mb-0 mt-1 confirmPassword"></p>
                            </div>
                        </div>
                        <div class="registration__items--gender">
                            <!-- <div class="registration__item"> -->
                                <label>Giới tính:</label>
                                <div class="registration__box">
                                    <div class="registration__item">
                                        <input type="radio" name="gender" id="male" class="bg-doctrine text-doctrine" value="1"><label for="male">Nam</label>
                                    </div>
                                    <div class="registration__item">
                                        <input type="radio" name="gender" id="female" class="bg-doctrine text-doctrine" value="2"><label for="female">Nữ</label>
                                    </div>
                                    <div class="registration__item">
                                        <input type="radio" name="gender" id="others" class="bg-doctrine text-doctrine" value="3"><label for="others">Khác</label>
                                    </div>
                                </div>
                                <p class="text-doctrine font-italic mb-0 mt-1 gender"></p>
                            <!-- </div> -->
                        </div>
                        <div class="registration__items">
                            <div class="registration__item">
                                <label>Ngày sinh:</label>
                                <div class="registration__input">
                                    <input type="text" autocomplete="off" placeholder="Nhập ngày sinh" class="form-control" name="birthday">
                                </div>
                                <p class="text-doctrine font-italic mb-0 mt-1 birthday"></p>
                            </div>
                            <div class="registration__item">
                                <label>Số điện thoại:</label>
                                <div class="registration__input">
                                    <input type="text" autocomplete="off" placeholder="Nhập số điện thoại" class="form-control" name="phone">
                                </div>
                                <p class="text-doctrine font-italic mb-0 mt-1 phone"></p>
                            </div>
                        </div>
                        <div class="registration__items">
                            <div class="registration__item">
                                <label>Email:</label>
                                <div class="registration__input">
                                    <input type="text" autocomplete="off" placeholder="Nhập email" class="form-control" name="email">
                                </div>
                                <p class="text-doctrine font-italic mb-0 mt-1 email"></p>
                            </div>
                        </div>
                        <div class="registration__items">
                            <div class="registration__item">
                                <label>Địa chỉ:</label>
                                <!-- <div class="registration__input">
                                    <input type="text" autocomplete="off" placeholder="Nhập địa chỉ" class="form-control">
                                </div> -->
                                <div class="province__list">
                                    <input type="text" list="province" placeholder="Chọn Tỉnh/Thành phố" name="province"  autocomplete="off" class="form-control">
                                    <datalist id="province"></datalist>
                                    <p class="text-doctrine font-italic mb-0 mt-1"></p>
                                </div>
                                <div class="district_list">
                                    <input type="text" list="district" placeholder="Chọn Huyện/Quận" name="district"  autocomplete="off" class="form-control">
                                    <datalist id="district"></datalist>
                                    <p class="text-doctrine font-italic mb-0 mt-1"></p>
                                </div>
                                <div class="commune_list">
                                    <input type="text" placeholder="Nhập Xã/Phường" name="commune" autocomplete="off" class="form-control">
                                </div>
                                <p class="text-doctrine font-italic mb-0 mt-1 address"></p>
                            </div>
                        </div>
                        <div class="registration__items--avatar">
                            <label>Ảnh đại diện: <span class="text-muted">* Có thể không chọn</span></label>
                            <div class="registration__input">
                                <input type="file" name="file">
                            </div>
                            <p class="text-muted">Định dạng cho phép: .jpg, .png, .jpeg, .gif</p>
                            <p class="text-doctrine font-italic mb-2 file"></p>
                        </div>
                        <div class="registration__items--btn">
                            <button type="submit" class="btn">Đăng ký</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>