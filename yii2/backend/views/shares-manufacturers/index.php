<?php
use yii\widgets\LinkPager;
use backend\components\UI;

$this->registerCssFile('/plugins/datepicker/datepicker3.css');
$this->registerJsFile('/plugins/datepicker/bootstrap-datepicker.js');
$this->registerJsFile('/plugins/datepicker/locales/bootstrap-datepicker.ru.js');

$this->title = 'Акции мебельных фабрик';
$color = '#ccc';

$this->params['breadcrumbs'][] = strip_tags($this->title);
?>

<script> 
  $(function(){
    if( $('.datepicker').size() ){
      $('.datepicker').datepicker({
        language: 'ru',
        format: 'yyyy-mm-dd',
        todayBtn: true,
        autoclose: true
      });
    }
  });
</script>

<div class="row" id="shares-manufacturers-list">
    
  <div class="col-md-3" id="filter-container">
    <?php print $this->render('part_filter', [
      'filter' => $filter,
    ]) ?>
  </div>
    
  <div class="col-md-9">
      
    <div class="clearfix">
      <a href="/<?php print Yii::$app->controller->id."/add"?>" class="add-new-item ">
        <span>
          <span class="fa fa-plus"></span>
          Добавить новую акцию
        </span>
      </a>
    </div>
      
    <div class="clearfix">
      <?php
        if ($messageModel->success) {
          print $messageModel->alertSuccess();
        }
        if ($messageModel->errors) {
          print $messageModel->alertErrors();
        }
      ?>
    </div>
      
    <?php foreach($models as $model) {?>
      <div class="box <?php print ($model->shr_end_date >= strtotime(date("Y-m-d")) ? 'box box-success' : 'box-danger')?>">
        <div class="box-header with-border">
          <?php print UI::contextMenu([
              [
                'icon' => 'fa-pencil',
                'text' => 'Редактировать',
                'href' => "/shares-manufacturers/{$model->shr_id}?manufacture={$model->manufacturers->mnf_id}",
              ],[
                'icon' => 'fa-remove',
                'text' => 'Удалить',
                'href' => "/shares-manufacturers/?delete={$model->shr_id}",
                'style'=> "color:#F44336",
                'onclick' => 'return confirm(\'Точно удалить?\')',
              ]
            ], ['class' => 'pull-right']) ?>
        </div>

        <div class="box-body row">
          <div class="col-md-3">
            <div class="share-logo">
              <?php if($model->shr_image): ?>
                <img src="<?php print Yii::getAlias("@fileserver/shares-manufacturers/{$model->shr_image}") ?>"/>
              <?php else: ?>
                <span class="fa fa-industry" style="font-size: 42px; color: #aaa; text-shadow: 1px 1px 0 #fff;" title="Логотип не загружен"></span>
              <?php endif ?>
            </div>
          </div>
            
          <div class="col-md-9">
            <div class="col-xs-12 col-sm-8">
              <div class="factory-info">
                <h3 class="factory-title">
                  <strong><?php print "Фабрика «{$model->manufacturers->mnf_title}»"?></strong>
                </h3>
              </div>
            </div>
              
            <div class="col-xs-12">
              <div class="sub-title">
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
            </div>
              
            <div class="col-xs-12 hidden-sm share-manufacturers-description">
              <br>
              <p>
                <?php print $model->shr_content?>
              </p>
            </div>
            <?php if ($model->manufacturers->extfields->fld_phone_opt): ?>
            <div class="col-xs-12">
              <div class="phones-preview">
                <?php foreach(explode(';', $model->manufacturers->extfields->fld_phone_opt) as $ph): ?>
                <span style="display: inline-block; padding-right: 16px;">
                  <small class="icon icon-phone">?</small>
                  <?php print $ph ?>
                </span>
                <?php if( ++$pc >= 1 ) break;
                endforeach ?>
              </div>
            </div>
            <?php endif ?>
          </div>
        </div>
      </div>
    <?php }?>

    <div class="col-xs-12">
      <div class="col-md-4" style="font-size: 14px; padding: 32px 0 0 0px; color: #607D8B;">
        Страница <?php print Yii::$app->request->get('page') ? Yii::$app->request->get('page') : 1 ?> из <?php print ceil($pages->totalCount/$pages->defaultPageSize) ?>
      </div>
      <div class="col-md-8">
        <div class="paginator">
          <?php print LinkPager::widget([
            'pagination' => $pages,
          ]) ?>
        </div>
      </div>
    </div>
  </div>
</div>

<style>
    #shares-manufacturers-list .factory-logo img, #shares-manufacturers-list .share-logo img {
      max-width: 200px;
    }
    #shares-manufacturers-list .share-logo img {
      margin-top: 20px;
    }
    #shares-manufacturers-list .factory-title {
      margin-top: 0;
    }
</style>
