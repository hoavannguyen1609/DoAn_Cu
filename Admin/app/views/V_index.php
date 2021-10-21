<body>
    <div class="overlay"></div>
    <base id="urlTag" href="{{_WEB_ROOT}}">
    <div id="main" class="all">
        <aside>
            <a href="{{_WEB_ROOT}}" class="logo" title="Trang chủ">
                <img src="{{_ICON_ .'logo-s.png'}}" alt="" width="40px">
                <span>CellphoneS</span>
            </a>
            <div class="sidebar">
                <div class="admin-panel">
                    <div class="admin-panel__img">
                        <img src="{{ _AVATAR_ADMIN . $infoAdmin[0]['avatar_admin'] }}" alt="avatar">
                    </div>
                    <div class="admin-panel__info">
                        <span>{{ $infoAdmin[0]['name'] }}</span>
                    </div>
                </div>
                <div class="sidebar__nav">
                    <ul class="sidebar__list">
                        <li class="sidebar__item">
                            <a href="javascript:loadinfo()" class="sidebar__link active info">
                                <i class="far fa-address-card"></i>
                                <p>Cá nhân</p>
                            </a>
                        </li>
                        @if($infoAdmin[0]['position'] == 3)
                        <li class="sidebar__item">
                            <a class="sidebar__link">
                                <i class="fas fa-user-shield"></i>
                                <p>
                                    Quản lý nhân viên
                                    <i class="fas fa-angle-down"></i>
                                </p>
                            </a>
                            <ul class="sidebar__list-child">
                                <li class="sidebar__item-child">
                                    <a href="javascript:loadFormaddStaff()" class="formaddstaff">
                                        <i class="far fa-circle"></i>
                                        <p>
                                            Thêm nhân viên
                                        </p>
                                    </a>
                                </li>
                                <li class="sidebar__item-child">
                                    <a href="javascript:loadStaff()" class="staff">
                                        <i class="far fa-circle"></i>
                                        <p>
                                            Danh sách nhân viên
                                        </p>
                                    </a>
                                </li>
                                <li class="sidebar__item-child">
                                    <a href="javascript:loadPosition()" class="position">
                                        <i class="far fa-circle"></i>
                                        <p>
                                            Quản lý chức vụ
                                        </p>
                                    </a>
                                </li>
                                <li class="sidebar__item-child">
                                    <a href="javascript:loadSalary()" class="salary">
                                        <i class="far fa-circle"></i>
                                        <p>
                                            Quản lý lương và phụ cấp
                                        </p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endif
                        @if($infoAdmin[0]['position'] == 3 || $infoAdmin[0]['position'] == 2)
                        <li class="sidebar__item">
                            <a class="sidebar__link">
                                <i class="fab fa-weebly"></i>
                                <p>
                                    Quản lý website
                                    <i class="fas fa-angle-down"></i>
                                </p>
                            </a>
                            <ul class="sidebar__list-child">
                                <li class="sidebar__item-child">
                                    <a href="#">
                                        <i class="far fa-circle"></i>
                                        <p>
                                            Banner
                                        </p>
                                    </a>
                                </li>
                                <li class="sidebar__item-child">
                                    <a href="#">
                                        <i class="far fa-circle"></i>
                                        <p>
                                            Slide
                                        </p>
                                    </a>
                                </li>
                                <li class="sidebar__item-child">
                                    <a href="#">
                                        <i class="far fa-circle"></i>
                                        <p>
                                            Right Slide
                                        </p>
                                    </a>
                                </li>
                                <li class="sidebar__item-child">
                                    <a href="">
                                        <i class="far fa-circle"></i>
                                        <p>
                                            Program
                                        </p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endif
                        <li class="sidebar__item">
                            <a class="sidebar__link">
                                <i class="fab fa-product-hunt"></i>
                                <p>
                                    Quản lý sản phẩm
                                    <i class="fas fa-angle-down"></i>
                                </p>
                            </a>
                            <ul class="sidebar__list-child">
                                <li class="sidebar__item-child">
                                    <a href="#">
                                        <i class="far fa-circle"></i>
                                        <p>
                                            Sản phẩm
                                        </p>
                                    </a>
                                </li>
                                <li class="sidebar__item-child">
                                    <a href="javascript:loadCategory()" class="category">
                                        <i class="far fa-circle"></i>
                                        <p>
                                            Danh mục
                                        </p>
                                    </a>
                                </li>
                                <li class="sidebar__item-child">
                                    <a href="javascript:loadmanufacturer()" class="manufacturer">
                                        <i class="far fa-circle"></i>
                                        <p>Hãng sản xuất</p>
                                    </a>
                                </li>
                                <li class="sidebar__item-child">
                                    <a href="javascript:loadPromotion()" class="promotion">
                                        <i class="far fa-circle"></i>
                                        <p>
                                            Khuyến mãi
                                        </p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar__item">
                            <a class="sidebar__link">
                                <i class="far fa-list-alt"></i>
                                <p>
                                    Quản lý đơn hàng
                                    <i class="fas fa-angle-down"></i>
                                </p>
                            </a>
                            <ul class="sidebar__list-child">
                                <li class="sidebar__item-child">
                                    <a href="javascript:loadOrder(1)" class="order1">
                                        <i class="far fa-circle"></i>
                                        <p>
                                            Đơn hàng chưa duyệt
                                        </p>
                                    </a>
                                </li>
                                <li class="sidebar__item-child">
                                    <a href="javascript:loadOrder(2)"  class="order2">
                                        <i class="far fa-circle"></i>
                                        <p>
                                            Đơn hàng đã duyệt
                                        </p>
                                    </a>
                                </li>
                                <li class="sidebar__item-child">
                                    <a href="javascript:loadOrder(5)">
                                        <i class="far fa-circle"></i>
                                        <p>
                                            Đơn hàng đã thanh toán
                                        </p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar__item">
                            <a class="sidebar__link">
                                <i class="fas fa-users"></i>
                                <p>
                                    Khách hàng
                                    <i class="fas fa-angle-down"></i>
                                </p>
                            </a>
                            <ul class="sidebar__list-child">
                                <li class="sidebar__item-child">
                                    <a href="#">
                                        <i class="fas fa-headset"></i>
                                        <p>
                                            Tư vấn hỗ trợ
                                        </p>
                                    </a>
                                </li>
                                <li class="sidebar__item-child">
                                    <a href="#">
                                        <i class="far fa-comment-dots"></i>
                                        <p>Feedback</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @if($infoAdmin[0]['position'] == 3 || $infoAdmin[0]['position'] == 2)
                        <li class="sidebar__item">
                            <a class="sidebar__link">
                                <i class="fas fa-history"></i>
                                <p>
                                    Lịch sử thay đổi
                                    <i class="fas fa-angle-down"></i>
                                </p>
                            </a>
                            <ul class="sidebar__list-child">
                                <li class="sidebar__item-child">
                                    <a href="#">
                                        <i class="far fa-circle"></i>
                                        <p>
                                            Sản phẩm
                                        </p>
                                    </a>
                                </li>
                                <li class="sidebar__item-child">
                                    <a href="#">
                                        <i class="far fa-circle"></i>
                                        <p>
                                            Danh mục
                                        </p>
                                    </a>
                                </li>
                                <li class="sidebar__item-child">
                                    <a href="#">
                                        <i class="far fa-circle"></i>
                                        <p>
                                            Hãng sản xuất
                                        </p>
                                    </a>
                                </li>
                                <li class="sidebar__item-child">
                                    <a href="#">
                                        <i class="far fa-circle"></i>
                                        <p>
                                            Khuyến mãi
                                        </p>
                                    </a>
                                </li>
                                <li class="sidebar__item-child">
                                    <a href="#">
                                        <i class="far fa-circle"></i>
                                        <p>
                                            Đơn hàng
                                        </p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
        </aside>
        <nav class="nav-header">
            <ul class="nav__list">
                <li class="nav__items">
                    <a href="javascript:setMargin()" class="setMargin">
                        <i class="far fa-arrow-alt-circle-left"></i>
                    </a>
                    <a href="javascript:showSidebar()">
                        <i class="fas fa-bars"></i>
                    </a>
                </li>
                <li class="nav__items">
                    <a href="{{_WEB_ROOT}}">
                        <span>Home</span>
                    </a>
                </li>
            </ul>
            <form action="#" method="get" class="form-search">
                <div class="form-earch__group">
                    <input type="text" name="" id="" class="form-search__input" placeholder="Tìm kiếm" aria-placeholder="Tìm kiếm">
                    <div class="form-search__btn">
                        <button>
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
            <ul class="nav__list">
                <li class="nav__items">
                    <a class="notify">
                        <i class="far fa-bell"></i>
                        <span class="amount-notify__icon">12</span>
                    </a>
                    <div class="drop-down__notify">
                        <!-- <span class="amount-notify">
                            12 Thông báo
                        </span> -->
                        <div class="drop-down__border"></div>
                        <a href="#" class="drop-down__item">
                            <i class="fas fa-clipboard-list"></i>
                            <span> Đơn hàng mới</span>
                        </a>
                    </div>
                </li>
                <li class="nav__items">
                    <a href="javascript:openFullscreen()" class="change-screen">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav__items">
                    <a href="{{ _WEB_ROOT .'/dang-xuat'}}" class="signout" title="Đăng xuất">
                        <i class="fas fa-sign-out-alt"></i>
                    </a>
                    <!-- <a href="#" class="signin" title="Đăng nhập">
                        <i class="fas fa-sign-in-alt"></i>
                    </a> -->
                </li>
            </ul>
        </nav>
        <div class="content-box info" id="show"></div>
    </div>
</body>
</html>