<section>
    <div class="grid wide">
        <div class="row no-guttters">
            <div class="l-12 c-12 m-12 py-5 ">
                <div class="confirm-OTP-box l-6 l-o-3 m-8 m-o-2 c-10 c-o-1 py-4  bg-white px-3">
                    <div class="h4 text-center text-333">Xác nhận tài khoản</div>
                    <div class="h5 text-center text-doctrine"><i>CellphoneS đã gửi mã bảo mật gồm 6 chữ số về Email của bạn</i></div>
                    <form class="confirm-OTP-group mt-4 px-3" method="post" id="confirm-otp">
                        <div class="confirm-OTP__items">
                            <input type="text" placeholder="Nhập mã bảo mật gồm 6 chữ số" class="form-control" name="confirm-otp" autocomplete="off" >
                            <input type="hidden" name="idCustomer" value="{{$idCustomer[0]['id_customer']}}">
                        </div>
                        <div class="confirm-OTP__items py-3 text-center">
                            <button type="submit" class="btn confirmOTP">Xác nhận</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>