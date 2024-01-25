<?php
/* @var $this SDNController */
/* @var $model SDN */

$this->breadcrumbs = array(
    'Sdns' => array('admin'),
    'Manage',
);


Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('sdn-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Sdns</h1>

<p>
  Usted puede utilizar alternatvamente los operadores (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
  or <b>=</b>) al principio de cada valor para especificar que tipo de comparación desea hacer.
</p>

<?php echo CHtml::link('Advanced Search', '#', array('class' => 'search-button')); ?>
<div class="search-form" style="display:none">
  <?php
  $this->renderPartial('_search', array(
      'model' => $model,
  ));
  ?>
</div><!-- search-form -->

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'sdn-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'entNum' => array(
            'name' => 'entNum',
            'htmlOptions' => array(
                'width' => '40px',
                'style' => 'text-align:right',
            ),
        ),
        'sdnTypeId' => array(
            'name' => 'sdnType.name',
            'filter' => CHtml::activeDropDownList($model, 'sdnTypeId', CHtml::listData(SdnType::model()->findAll(array('order' => 'name')), 'id', 'name'), array('prompt' => '...')),
            'htmlOptions' => array('width' => '100px'),
        ),
        'SDNName' => array(
            'name' => 'SDNName',
            'htmlOptions' => array(
                'width' => '400px',
                'style' => 'text-align:left',
            ),
        ),
        'SDNType' => array(
            'name' => 'SDNType',
            'htmlOptions' => array(
                'width' => '65px',
                'style' => 'text-align:left',
            ),
        ),
        'program'  => array(
            'name' => 'program',
            'htmlOptions' => array(
                'width' => '120px',
                'style' => 'text-align:left',
            ),
        ),

        'remarks',
        /*
          'title',
          'callSign',
          'vessType',
          'tonnage',
          'GRT',
          'vessFlag',
          'vessOwner',
         */
        array(
            'class' => 'CButtonColumn',
            'template' => '{view}',
        ),
    ),
));
?>
