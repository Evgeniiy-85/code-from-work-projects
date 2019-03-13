<?php
 use yii\helpers\Html;
 use yii\widgets\ActiveForm;

$form = ActiveForm::begin([
  'id' => 'form-shares-manufacturers-filter',
  'method' => 'POST',
  'action' => '/shares-manufacturers'])
?>
<div class="box <?php print Yii::$app->session->get('SharesManufacturersFilter') ? 'box-primary box-solid' : 'box-default'?>" id="filter-shares-manufacturers">
  <div class="box-header with-border">
    <h3 class="box-title">
      ����� �����
    </h3>
  </div><!-- /.box-header -->

  <div class="box-body row">
  <?php
    print $form
      ->field($filter, "shr_manufacture", ['options' => ['class' => 'col-xs-12 form-group']])
      ->dropDownList($filter->selected_manufacturers, [
        'class' => 'form-control manufactury-picker',
      ]);
    
    print $form
      ->field($filter, "mnf_town", ['options' => ['class' => 'col-xs-12 form-group']])
      ->dropDownList($filter->selected_town, ["class" => "form-control town-picker"])
      ->label('��������� ����� ' . Html::tag('i', null, [
        'class' => 'fa fa-info-circle pull-right',
        'title' => "����� ������� ����� ������ ������ (����������, �������, ���������)\n ����� ����� ��������� ������, ����� ���� �/�, ������� �������� ������: \n ��������/����, ����������/��������, �����������/�������",
      ]));
   
    print $form->field($filter, "shr_start_date", [
      'template' => '{label}
        <div class="input-group date">
          <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
          </div>
          {input} {hint} {error}
        </div>',
      'options' => [
        'class' => 'col-xs-12 form-group'
      ]
    ])->textInput([
      'class' => 'form-control pull-right datepicker',
      'value' => $filter->shr_start_date ? $filter->shr_start_date : ''
    ]);
    
    print $form->field($filter, "shr_end_date", [
      'template' => '{label}
        <div class="input-group date">
          <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
          </div>
          {input} {hint} {error}
        </div>',
      'options' => [
        'class' => 'col-xs-12 form-group'
      ]
    ])->textInput([
      'class' => 'form-control pull-right datepicker',
      'value' => $filter->shr_end_date ? $filter->shr_end_date : ''
    ]);
  ?>

  </div><!--.box-body.row-->

  <div class="box-footer text-right" style="clear: both;">
    <a class="btn btn-default" href="<?php print "/shares-manufacturers" ?>?reset_filter=1">
      <span class="fa fa-close"></span> ��������
    </a>
    <button class="btn btn-primary">
      <span class="fa fa-search"></span> �����
    </button>
  </div><!--.box-footer-->
</div><!--.box-->
<?php ActiveForm::end() ?>
