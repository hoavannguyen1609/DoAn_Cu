<div class="promotion-box__item" id="tr-{{idPromotion}}">
    <div class="promotion-box__code">
        <span>{{idPromotion}}</span>
    </div>
    <div class="promotion-box__name">
        <input type="text" id="promotion-{{idPromotion}}" value="{{promotionName}}">
    </div>
    <div class="promotion-box__opera">
        <a href="javascript:editPromotion({{idPromotion}})" class="btn btn-outline-success">
            <i class="fas fa-check"></i>
        </a>
        <a href="javascript:delPromotion({{idPromotion}})" class="btn btn-outline-danger">
            <i class="far fa-trash-alt"></i>
        </a>
    </div>
</div>