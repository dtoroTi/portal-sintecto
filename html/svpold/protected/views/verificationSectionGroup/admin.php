<?php
/* @var $this VerificationSectionGroupController */
/* @var $model VerificationSectionGroup */

$this->breadcrumbs = array(
    'Verification Section Groups' => array('admin'),
    'Manage',
);

$this->menu = array(
    array('label' => 'Create VerificationSectionGroup', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#verification-section-group-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Grupos de Secciones </h1>



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
    'id' => 'verification-section-group-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
//        'id',
        'name',
        array(
            'class' => 'CButtonColumn',
        ),
    ),
));
?>
