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
                                Hồ sơ của tôi
                            </p>
                            <p class="management-security text-dark">
                                <i>Quản lý thông tin hồ sơ để bảo mật an toàn</i>
                            </p>
                        </div>
                        <div class="my-profile__list l-12 m-12 c-12 py-4 pr-3">
                            <form id="update-profile" method="post">
                                <div class="my-profile__items pt-3">
                                    <label for="">Tài khoản:</label>
                                    <span><i><?php echo $customer_cps[0]['account'] ?></i></span>
                                </div>
                                <div class="my-profile__items pt-3">
                                    <label for="">Mật khẩu:</label>
                                    <span><a href="<?php echo _WEB_ROOT .'/doi-mat-khau' ?>">Thay đổi</a></span>
                                </div>
                                <div class="my-profile__items pt-3">
                                    <label for="">Họ tên:</label>
                                    <input type="text" name="fullname" class="form-control w-75" value="<?php echo $customer_cps[0]['name'] ?>">
                                </div>
                                <div class="my-profile__items pt-3">
                                    <label for="">Email:</label>
                                    <!-- <input type="text" class="form-control w-75" value=""> -->
                                    <span><?php echo $customer_cps[0]['email'] ?></span>
                                </div>
                                <div class="my-profile__items pt-3">
                                    <label for="">Số điện thoại:</label>
                                    <span><?php echo '0' .$customer_cps[0]['phone'] ?></span>
                                </div>
                                <div class="my-profile__items pt-3">
                                    <label for="">Giới tính</label>
                                    <select name="" id="gender" class="form-control w-25">
                                            <?php if($gender[0]['id_gender'] == 1) {
                                                echo '<option value="1">'.$gender[0]['gender_name'].'</option><option value="2">Nữ</option><option value="3">Khác</option>';
                                            } elseif ($gender[0]['id_gender'] == 2) {
                                                echo '<option value="2">'.$gender[0]['gender_name'].'</option><option value="1">Nam</option><option value="3">Khác</option>';
                                            } elseif ($gender[0]['id_gender'] == 3) {
                                                echo '<option value="3">'.$gender[0]['gender_name'].'</option><option value="1">Nam</option><option value="2">Nữ</option>';
                                            } ?>
                                    </select>
                                </div>
                                <div class="my-profile__items pt-3">
                                    <label for="">Địa chỉ:</label>
                                    <input type="text" class="form-control w-75" value="<?php echo $customer_cps[0]['address'] ?>" name="address">
                                </div>
                                <div class="my-profile__items pt-3">
                                    <label for="">Ngày sinh:</label>
                                    <div class="d-flex">
                                        <select name="" class="form-control w-25" id="year">
                                            <option value="<?php echo $year ?>"><?php echo $year ?></option>
                                        </select>
                                        <select name="" class="form-control w-25" id="month">
                                            <option value="<?php echo $month ?>"><?php echo $month ?></option>
                                        </select>
                                        <select name="" class="form-control w-25" id="day">
                                            <option value="<?php echo $date ?>"><?php echo $date ?></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="my-profile__items pt-3">
                                    <input type="submit" name="update" value="Lưu" class="btn update">
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="img-account-change c-12 m-4 l-4 d-flex align-items-center justify-content-center">
                        <form class="img-account-change__child py-3" id="fileAvatar">
                            <div class="img-account-change__img d-flex align-items-center justify-content-center">
                                <!-- <a href="javascript:zoomAvatar()"> -->
                                    <img src="<?php echo _AVATAR_CUSTOMER .$customer_cps[0]['image_customer'] ?>" id="" onclick="openInNewTab($(this).attr('src'))">
                                <!-- </a> -->
                            </div>
                            <div class="img-account-change__input-file py-3">
                                <input type="file" name="fileAvatar">
                            </div>
                            <div class="text-muted">Định dạng cho phép: .jpg, .jpeg, .png, .gif</div>
                            <div id="error_img" class="bg-warning text-danger font-italic"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>