<div class="model-menu__models__items-wrap module_menu_models" id="module_menu_models">
    <input type="hidden" name="subModels" id="moduleMenuSubModels" value="{$subModels}">
    <ul class="model-menu__models__items grid isotope js-RangeGrid" style="position: relative; height: 513.894px;">
    </ul>
</div>
{literal}
<style>
    #module_menu_models ul>li:before {
        content:none;
    }
    #module_menu_models .model-menu__models__items__item__button__title,  #module_menu_models .model-menu__sub-models__set__submodel{
        color:black!important;
        font-size:2.3em!important;
    }
    
    #module_menu_models p.model-menu__sub-models__set__submodel__text, #module_menu_models p.model-menu__sub-models__set__submodel__value,
    #module_menu_models p.model-menu__sub-models__set__submodel__value + p, #module_menu_models p.model-menu__models__items__item__button__value,
    #module_menu_models .model-menu__models__items.nonmetal, #module_menu_models .model-menu__sub-models__set__promo__inner,
    #module_menu_models .grid__item.model-menu__sub-models__set__promo, #module_menu_models .model-menu__models__items__item__button__specs-wrapper,
    #module_menu_models p.model-summary__title__price, #module_menu_models h2.model-menu__item__title
    {
        display: none!important;
    }
    #module_menu_models .model-menu__sub-models__set {
        display: block!important;
    }
    #module_menu_models ul.model-menu__models__items {
        height: auto!important;
    }

    #module_menu_models a.model-menu__item__submodel {
        color:white;
    }
</style>
<script>window.jQuery || document.write('<script src="http://code.jquery.com/jquery-1.11.3.min.js"><\/script>')</script> 
{/literal}
{if $is_mobile neq 'Y'}{literal}
<script>
$(document).ready(function(){
    var subModelsType = $('.module_menu_models #moduleMenuSubModels').val();
            
    if(subModelsType){
        var model = 'div.model-menu__sub-models__set[data-id="'+ subModelsType +'"] div.grid__item.three-quarters';
        var subModels = $(model).html();
        $('#module_menu_models ul').append(subModels);
        
        $('#module_menu_models').find('img.image.js-lazyload').each(function(){
            var src = $(this).attr('data-src');
            $(this).attr('src', src);
        });
        $('#module_menu_models li.grid__item').css('display', 'inherit!important')
    }else{
        var models = $('ul.model-menu__models__items.grid.isotope.js-RangeGrid').html();
        $('#module_menu_models ul').append(models);
    }
        });
</script>
{/literal}
{else}{literal}
    <script>
    $(document).ready(function(){
    var subModelsType = $('.module_menu_models #moduleMenuSubModels').val();
            
    if(subModelsType){
        $.get('/_nav/', function (data) {
            subModelsType = subModelsType.toLowerCase();
            if(subModelsType === 'gs f') {
                subModelsType = 'gs';
            }
            var content = $('div.accordion-item__content a.model-menu__item__submodel[href*="/car-models/' + subModelsType + '/"]', data).
                parents('article.accordion-item').children('div.accordion-item__content.js-accordionItemContent');
           
            content.find('ul.grid img.image.js-lazyload').each(function(){
                var src = $(this).attr('data-src');
                $(this).attr('src', src);
            });
            $('#module_menu_models').append(content) 
        });  
        $('#module_menu_models li.grid__item').css('display', 'inherit!important')
    }else{
        $('#module_menu_models').load('/_nav/ div.content.content-unconstrained.js-main-content');
    }
});
</script>
{/literal}
{/if}