<div class="manufacturer-box__item" id="tr-{{idmanufacturer}}">
    <div class="manufacturer-box__item-number">
        <span>{{idmanufacturer}}</span>
    </div>
    <div class="manufacturer-box__name">
        <input type="text" id="manufacturerName-{{idmanufacturer}}" value="{{manufacturerName}}">
    </div>
    <div class="manufacturer-box__item-opera">
        <a href="javascript:editmanufacturer({{idmanufacturer}})" class="btn btn-outline-success">
            <i class="fas fa-check"></i>
        </a>
        <a href="javascript:delmanufacturer({{idmanufacturer}})" class="btn btn-outline-danger">
            <i class="fal fa-trash-alt"></i>
        </a>
    </div>
</div>