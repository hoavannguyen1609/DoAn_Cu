<body>
<base href="<?php echo _WEB_ROOT ?>">
    <div class="load">
        <i class="fas fa-spinner loading"></i>
    </div>
    <div class="overlay-body"></div>
    <div class="fb-customerchat" page_id="100631512347225"></div>
    <script type="text/javascript"></script>
    <header>
        <div id="header-top" class="w-100">
            <div class="grid wide h-100">
                <div class="row no-gutters h-100">
                    <div class="l-12 m-12 c-12 h-100">
                        <div class="row no-gutters justify-content-between align-items-center h-100">
                            <div class="side-bar d-lg-none d-xl-none px-3">
                                <i class="fa fa-bars text-white h3 mb-0"></i>
                            </div>
                            <div class="logo-cps h-100 d-flex align-items-center px-3">
                                <a href="<?php echo _WEB_ROOT ?>" class="d-flex align-items-center h-100">
                                    <i class="logo-cps__img"></i>
                                </a>
                            </div>
                            <form action="<?php echo _WEB_ROOT .'/search'?>" method="get" class="form-search flex-grow-1 h-100 d-flex align-items-center justift-content-center px-3 ml-4">
                                <div class="forem-search__group d-flex w-100 h-70 bg-white rounded">
                                    <input type="text" name="key" placeholder="Bạn cần tìm gì ...?" autocomplete="off" value="<?php echo (!empty($_GET['key'])) ? $_GET['key'] : '' ?>" class="flex-grow-1 pl-12 text-muted h4 mb-0 border-0  rounded">
                                    <button type="submit" class="btn form-search__group--btn d-flex align-items-center justify-content-center bg-white h-100">
                                        <i class="fas fa-search h4 mb-0"></i>
                                    </button>
                                </div>
                            </form>
                            <div id="box-func-group" class="box-func-group d-flex align-items-center flex-grow-1 justify-content-around px-3 h-100">
                                <div class="call-buy">
                                    <a href="tel:18002097" class="d-flex align-items-center text-white">
                                        <div class="call-buy__icon d-flex align-items-center">
                                            <i class="fas fa-phone h3 mb-0"></i>
                                        </div>
                                        <div class="call-buy__text text-center px-3 d-sm-none d-lg-block d-xl-block">
                                            <p class="mb-0">Gọi mua hàng </p>
                                            <p class="d-md-none d-lg-block d-xl-block mb-0">
                                                <strong> 1800.2097</strong>
                                            </p>
                                        </div>
                                    </a>
                                </div>
                                <div class="cart-group">
                                    <a href="<?php echo _WEB_ROOT .'/cart' ?>" class="d-flex aligin-items-center text-white">
                                        <div class="cart-group__icon d-flex align-items-center">
                                            <i class="fas fa-shopping-cart h3 mb-0"></i>
                                        </div>
                                        <div class="d-lg-flex d-xl-flex d-md-none d-sm-none align-items-center px-3">
                                            <p class="mb-0">Giỏ hàng</p>
                                        </div>
                                    </a>
                                </div>
                                <div class="customer-login d-flex align-items-center">
                                    <div class="d-flex align-items-center">
                                        <a href="<?php echo (!empty(Session::dataSS('customer_cps'))) ? _WEB_ROOT .'/tai-khoan' : _WEB_ROOT .'/login' ?>">
                                            <?php if(!empty(Session::dataSS('customer_cps'))) { echo (!empty(Session::dataSS('avatarCustomer'))) ? Session::dataSS('avatarCustomer') : '<i class="far fa-user-circle text-white h3 mb-0"></i>';}
                                            else {echo '<i class="far fa-user-circle text-white h3 mb-0"></i>';} ?>
                                        </a>
                                    </div>
                                    <div class="d-lg-flex d-xl-flex d-md-none d-sm-none d-xs-none align-items-center px-3">
                                        <p class="mb-0 d-flex align-items-center">
                                            <a href="<?php echo (!empty(Session::dataSS('customer_cps'))) ? _WEB_ROOT .'/tai-khoan' : _WEB_ROOT .'/login' ?>"  class="text-white">
                                                <span><?php echo (!empty(Session::dataSS('customer_cps'))) ? Session::dataSS('customer_cps') : 'Đăng nhập'  ?> </span>
                                            </a>
                                            <span  class="text-white"> <?php echo (!empty(Session::dataSS('customer_cps'))) ? "" : '&nbsp; | &nbsp;' ?></span>
                                            <a href="<?php echo _WEB_ROOT .'/dang-ky' ?>" class="text-white">
                                                <span> <?php echo (!empty(Session::dataSS('customer_cps'))) ? "" : 'Đăng ký'  ?></span>
                                            </a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>