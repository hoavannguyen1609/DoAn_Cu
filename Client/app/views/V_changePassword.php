<section>
    <div class="grid wide">
        <div class="row no-gutters">
            <div class="l-12 m-12 c-12 d-flex flex-wrap py-5">
                <div class="c-12 m-2 l-2 px-3">
                    <div class="img-account d-flex align-items-center">
                        <div class="img-account__img">
                            <?php echo (!empty(Session::dataSS('avatarCustomer'))) ? Session::dataSS('avatarCustomer') : "" ?>
                        </div>
                        <div class="img-account__account text-truncate ml-3">
                            <strong class=""><?php echo (!(empty(Session::dataSS('customer_cps')))) ? Session::dataSS('customer_cps') : "Tài khoản của tôi" ?></strong>
                        </div>
                    </div>
                    <div class="update-change flex-column py-3">
                        <div class="my-account py-2">
                            <a href="<?php echo _WEB_ROOT .'/tai-khoan' ?>" class="text-decoration-none text-dark">
                                <span>
                                    <i class="far fa-user text-info"></i>
                                    <span class="ml-3 h6 mb-0">Tài khoản của tôi</span>
                                </span>
                            </a>
                        </div>
                        <div class="order-buy py-2 d-flex">
                            <a href="<?php echo _WEB_ROOT .'/don-mua-cua-toi' ?>" class="text-decoration-none text-dark">
                                <span>
                                    <i class="far fa-list-alt text-info"></i>
                                    <span class="ml-3 h6 mb-0">Đơn mua</span>
                                </span>
                            </a>
                        </div>
                        <div class="order-buy pt-2 d-flex">
                            <a href="<?php echo _WEB_ROOT .'/sign-out' ?>" class="text-decoration-none text-dark">
                                <span>
                                    <i class="fas fa-sign-out-alt text-danger"></i>
                                    <span class="ml-3 h6 mb-0">Đăng xuất</span>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="c-12 l-10 m-10 shadow-sm bg-white d-flex rounded flex-wrap">
                    <div class="c-12 m-8 l-8 px-4 profile-list">
                        <div class="profile">
                            <p class="my-profile mb-1">
                                Đổi mật khẩu
                            </p>
                            <p class="management-security text-dark">
                                <i>Quản lý thông tin hồ sơ để bảo mật an toàn</i>
                            </p>
                        </div>
                        <div class="change-pass__list l-12 m-12 c-12 py-4 pr-3">
                            <form method="post" id="changePassword">
                                <div class="change-pass__items py-2">
                                    <label for="">Mật khẩu cũ:</label>
                                    <input type="text" class="form-control py-2" name="oldPassword" id="" autocomplete="off" placeholder="Nhập mật khẩu cũ">
                                </div>
                                <div class="change-pass__items py-2">
                                    <label for="">Mật khẩu mới:</label>
                                    <input maxlength="12" type="text" class="form-control py-2" name="newPassword" id="" autocomplete="off" placeholder="Nhập mật khẩu mới">
                                </div>
                                <div class="change-pass__items py-2">
                                    <label for="">Xác nhận lại mật khẩu:</label>
                                    <input maxlength="12" type="text" class="form-control py-2" name="confirmPassword" id="" autocomplete="off" placeholder="Nhập lại mật khẩu mới">
                                </div>
                                <div class="change-pass__items py-2 text-center">
                                    <input type="submit" value="Xác nhận" class="bg-doctrine btn p-3 text-white">
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="img-account-change c-12 m-4 l-4 d-flex align-items-center justify-content-center">
                        <i class="far fa-smile-beam text-doctrine"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>