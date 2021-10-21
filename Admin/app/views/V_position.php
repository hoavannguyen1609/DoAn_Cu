<div class="list-position__item" id="tr-{{number}}">
    <div class="list-position__number">
        <span>{{number}}</span>
    </div>
    <div class="list-position__name">
        <input type="text" value="{{positionName}}" id="position_name-{{number}}">
    </div>
    <div class="list-position__btn">
        <a href="javascript:editPosition({{number}})" class="btn btn-success">
            <i class="fas fa-check"></i>
        </a>
        <a href="javascript:delPosition({{number}})" class="btn btn-danger">
            <i class="fas fa-user-times"></i>
        </a>
    </div>
</div>