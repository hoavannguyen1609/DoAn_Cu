<section>
    <div class="grid wide">
        <div class="row">
            <div class="col l-12 m-12 c-12 login-box">
                <div class="login-box__group l-4 l-o-4 m-8 m-o-2 c-8 c-o-2 bg-white py-3 my-5">
                    <div class="text-center">
                        <h3>Đăng nhập</h3>
                        <p class="font-italic text-danger notices text-center"><?php echo (!empty($noticeLogin)) ? $noticeLogin : "" ?></p>
                    </div>
                    <form id="login-form" method="post" class="l-10 l-o-1 m-10 m-o-1 c-10 c-o-1">
                        <div class="login-box__items">
                            <label for="">Tài khoản:</label>
                            <div class="login-box__items--child d-flex  align-items-center form-control">
                                <input type="text" class="w-100" name="account" placeholder="Nhập tài khoản" autofocus  value="">
                            </div>
                            <p class="text-danger mt-3 bg-warning account text-center l-12 m-12 c-12 mt-16"></p>
                        </div>
                        <div class="login-box__items mt-12">
                            <label for="">Mật khẩu:</label>
                            <div class="login-box__items--child d-flex align-items-center form-control">
                                <input type="password" class="w-100" name="password" placeholder="Nhập mật khẩu" value="" autocomplete="off">
                                <button type="button">
                                    <i class="far fa-eye-slash"></i>
                                </button>
                            </div>
                            <p class="text-danger mt-3 bg-warning password text-center l-12 m-12 c-12 mt-16"></p>
                        </div>
                        <div class="login-box__items mt-12">
                            <div class="l-12 m-12 c-12 login-box__btn d-flex w-100">
                                <div class="l-12 m-12 c-12 login-box__btn--success d-flex justify-content-end w-100 flex-grow-1">
                                    <input type="submit" name="login" value="Đăng nhập" class="btn bg-doctrine w-100 text-white">
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="mt-4 d-flex l-10 l-o-1 m-10 m-o-1 c-10 c-o-1">
                        <div class="registration l-6 m-6 c-4 d-flex justify-content-center">
                            <div class="text-left text-success">
                                <a href="<?php echo _WEB_ROOT .'/dang-ky' ?>" class="text-success text-decoration-none">
                                    <span>Đăng ký</span>
                                </a>
                            </div>
                        </div>
                        <div class="forget-password registration l-6 m-6 c-8 d-flex justify-content-center align-items-center  text-decoration-none">
                            <div class="text-right">
                                <a href="<?php echo _WEB_ROOT .'/forget-pass' ?>" class="text-primary text-decoration-none">
                                    <span>Quên mật khẩu</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>