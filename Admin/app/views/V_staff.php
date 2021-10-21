<div class="list-staff__tiem" id="tr-{{idAdmin}}">
    <div class="list-staff__img">
        <img src="{{avatar}}" alt="">
    </div>
    <div class="list-staff__info">
        <div class="list-staff__info-top">
            <div class="list-staff__info-top--left">
                <div class="list-staff__name">
                    <span>
                        <span>Họ tên:&nbsp;</span>
                        <input id="name-{{idAdmin}}" value="{{name}}">
                    </span>
                </div>
                <div class="list-staff__gender">
                    <span>
                        <span>Giới tính:&nbsp;</span>
                        <select name="" id="gender-{{idAdmin}}" class="custom-select">
                            {{gender}}
                        </select>
                    </span>
                </div>
                <div class="list-staff__birhday">
                    <span>
                        <span>Ngày sinh:&nbsp;</span>
                        <input type="text" value="{{birthday}}" id="birthday-{{idAdmin}}">
                    </span>
                </div>
                <div class="list-staff__phone">
                    <span>
                        <span>Số điện thoại:&nbsp;</span>
                        <input type="text" value="{{phone}}" id="phone-{{idAdmin}}">
                    </span>
                </div>
            </div>
            <div class="list-staff__info-top--right">
                <div class="list-staff__email">
                    <span>
                        <span>Email:&nbsp;</span>
                        <input type="text" value="{{email}}" id="email-{{idAdmin}}">
                    </span>
                </div>
                <div class="list-staff__address">
                    <span>
                        <span>Địa chỉ:&nbsp;</span>
                        <input type="text" value="{{address}}" id="address-{{idAdmin}}">
                    </span>
                </div>
                <div class="list-staff__position">
                    <span>
                        <span>Chức vụ:&nbsp;</span>
                        <select id="position-{{idAdmin}}" class="custom-select">
                            {{position}}
                        </select>
                    </span>
                </div>
                <div class="list-staff__workday">
                    <span>
                        <span>Ngày vào làm:&nbsp;</span>
                        <input type="text" value="{{workday}}" id="workday-{{idAdmin}}">
                    </span>
                </div>
            </div>
        </div>
        <div class="list-staff__info-end">
            <div class="list_staff__salary-basic">
                <span>
                    <span>Lương CB:&nbsp;</span>
                    <span>{{salaryBasic}}</span>
                </span>
            </div>
            <div class="list-staff__salary-position">
                <span>
                    <span>Phụ cấp CV:&nbsp;</span>
                    <span class="allowance_level-{{idAdmin}}">{{salaryPosition}}</span>
                </span>
            </div>
            <div class="list-staff__salary-work">
                <span>
                    <span>Phụ cấp KN:&nbsp;</span>
                    <input type="text" value="{{salaryWork}}" id="salaryWork-{{idAdmin}}">
                </span>
            </div>
            <div class="list-staff__bank-account">
                <span>
                    <span>STK:&nbsp;</span>
                    <input type="text" value="{{bankAccount}}" id="bank-{{idAdmin}}">
                </span>
            </div>
        </div>
    </div>
    <div class="list-staff__btn">
        <a class="btn btn-success" href="javascript:editStaff({{idAdmin}})">
            <i class="fas fa-check"></i>
        </a>
        <a href="javascript:delStaff({{idAdmin}})" class="btn btn-danger">
            <i class="fas fa-user-minus"></i>
        </a>
    </div>
</div>