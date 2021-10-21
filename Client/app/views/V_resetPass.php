<section>
    <div class="grid wide">
        <div class="row no-gutters">
            <div class="l-10 m-10 c-10 mx-auto content-resetPass">
                <div class="resetPas-title text-center">
                    <div>
                        Đặt lại mật khẩu
                    </div>
                </div>
                <div class="l-12 c-12 m-12">
                    <form id="resetPass" class="l-6 m-8 c-10 mx-auto" method="post">
                        <input type="hidden" name="idCustomer" value="{{$idCustomer[0]['id_customer']}}">
                        <div class="resetPass__items">
                            <label>Mật khẩu mới:</label>
                            <div class="resetPass__input">
                                <input type="text" autocomplete="off" name="newPass" class="form-control" placeholder="Nhập mật khẩu mới">
                                <p class="text-doctrine font-italic newPass mt-1 mb-0"></p>
                            </div>
                        </div>
                        <div class="resetPass__items">
                            <label>Nhập lại mật khẩu mới:</label>
                            <div class="resetPass__input">
                                <input type="text" autocomplete="off" name="confirmNewpass" class="form-control" placeholder="Nhập lại mật khẩu mới">
                                <p class="text-doctrine font-italic confirmNewpass mt-1 mb-0"></p>
                            </div>
                        </div>
                        <div class="resetPass__items">
                            <div class="resetPass__btn">
                                <button type="submit" class="btn">Xác nhận</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>