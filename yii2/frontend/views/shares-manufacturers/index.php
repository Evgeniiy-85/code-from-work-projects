<?php
  use \frontend\components\Route;
  use \frontend\components\SEO;
  use yii\helpers\Html;
  
  $this->title = 'Акции мебельных фабрик';
?>

<section class="page-shares">
  <div class="shares">
	<div class="wrapper">
	<h1 class="title-section htabs">
    <span class="htab act" id="shares-factories">
      <?php print $this->title ?>
    </span>
  </h1>
      
  <div class="all" id="loader-container">
			
  <?php foreach ($models as $key => $model) { ?>
    <div class="share share-preview">
        <div class="row">
          <div class="col-xs-10 col-sm-3">
            <div class="share-logo">
              <img src="<?php print Yii::getAlias("@fileserver/shares-manufacturers/{$model->shr_image}") ?>" alt="<?php print $model->products->prod_image?>" />
            </div>
          </div>

          <div class="col-xs-12 col-sm-9">
            <div class="share-info text-left">
              <a href="<?php print $model->manufacturers->permalink() ?>"> 
                <div class="col-sm-12 factory-title">
                  <span class="shortened"><?php print "Фабрика «{$model->manufacturers->mnf_title}»";?></span>
                </div>
              </a>

              <div class="col-xs-12 hidden-sm share-date">
                <b style="color:red;">Акция проходит c&nbsp;&nbsp;
                  <?php print str_replace(
                        ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov','Dec'],
                        ['января', 'февраля', 'марта', 'апреля', 'мая', 'июня', 'июля', 'августа', 'сентября', 'октября', 'ноября', 'декабря'],
                        date('d M Y', $model->shr_start_date)
                  ) ?>
                  &nbsp;&nbsp;по&nbsp;&nbsp;
                  <?php print str_replace(
                            ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov','Dec'],
                            ['января', 'февраля', 'марта', 'апреля', 'мая', 'июня', 'июля', 'августа', 'сентября', 'октября', 'ноября', 'декабря'],
                            date('d M Y', $model->shr_end_date)
                  ) ?>
                </b>
              </div>
                
              <div class="col-xs-12 hidden-sm share-content">
                <?php print $model->shr_content?>
              </div>

              <div class="col-xs-12 hidden-sm share-description">
                <p>
                  <a data-title="<?php print $model->manufacturers->mnf_title ?>" 
                    href="<?php print $model->manufacturers->permalink()?>">
                    <span class="shortened">Показать все модели производителя</span>
                  </a>
                </p>
              </div>
              <?php if($model->manufacturers->extfields->fld_phone_opt):?>
                <div class="col-xs-12">
                  <div class="phones-preview">
                    <?php foreach(explode(';', $model->manufacturers->extfields->fld_phone_opt) as $ph): ?>
                    <span style="display: inline-block; padding-right: 16px;">
                    <small class="icon icon-phone">???</small>
                      <?php print $ph ?>
                    </span>
                    <?php if( ++$pc >= 1 ) break;
                    endforeach ?>
                  </div>
                </div>

              <?php if($model->manufacturers->mnf_site):?>
              <div class="col-xs-12 site-manufacture-preview">
                <a data-title="<?php print $model->manufacturers->mnf_title ?>" 
                  href="<?php print $model->manufacturers->mnf_site?>" target="_blank">
                  <span class="shortened">Сайт производителя фабрики</span>
                </a>
              </div>
              <?php endif ?>
              
              <?php endif ?> 
                <div class="col-xs-12 opage_price-preview">
                  <a class="opage_price" 
                    data-id="<?php print $model->manufacturers->mnf_id ?>" 
                    data-title="<?php print $model->manufacturers->mnf_title ?>" 
                    href="<?php print $model->manufacturers->permalink()?>/price">
                    <span class="price-get shortened">Отправить фабрике запрос на прайс-лист</span>
                  </a>
                </div>
            </div>
          </div>
        </div>
      </div>
    <?php } ?>
    </div>
    <?php if( !empty($pages) && ceil($pages->totalCount/$pages->defaultPageSize) > 1 ): ?>
      <div class="row paginator" id="pagination-organization">
        <div class="col-md-6">
          Страница <?php print Yii::$app->request->get('page') ? Yii::$app->request->get('page') : 1 ?> из <?php print ceil($pages->totalCount/$pages->defaultPageSize) ?>
        </div>
        <div class="col-md-6">
          <?php print Route::pagination($pages->totalCount, $pages->defaultPageSize) ?>
        </div>
      </div>
      <script>
        var ael = document.querySelectorAll('#pagination-organization a');
        for(var j in ael) ael[j].href += '#search-organizations';
      </script>
    <?php endif ?> 
  </div>
  </div>
</section>