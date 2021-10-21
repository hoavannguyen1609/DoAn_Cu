<div class="category-box__item" id="tr-{{idCategory}}">
    <div class="category-box__item-number">
        <span>{{idCategory}}</span>
    </div>
    <div class="category-box__name">
        <input type="text" id="categoryName-{{idCategory}}" value="{{categoryName}}">
    </div>
    <div class="category-box__statsus">
        <a href="javascript:changeStatus({{idCategory}},'product',{{status}},'category',2)" class="btn btn-{{classStatus}} status-{{idCategory}}">
            <i class="far fa-{{classIcon}}-circle"></i>
        </a>
    </div>
    <div class="category-box__item-opera">
        <a href="javascript:editCategory({{idCategory}})" class="btn btn-outline-success">
            <i class="fas fa-check"></i>
        </a>
        <a href="javascript:delCategory({{idCategory}})" class="btn btn-outline-danger">
            <i class="fal fa-trash-alt"></i>
        </a>
    </div>
</div>