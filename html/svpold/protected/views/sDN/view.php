<?php
/* @var $this SDNController */
/* @var $model SDN */

$this->breadcrumbs=array(
	'Sdns'=>array('admin'),
	CHtml::encode($model->title),
);

?>

<h1>View SDN #<?php echo CHtml::encode($model->entNum); ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'sdnType.name',
		'entNum',
		'SDNName',
		'SDNType',
		'program',
		'title',
		'callSign',
		'vessType',
		'tonnage',
		'GRT',
		'vessFlag',
		'vessOwner',
		'remarks',
	),
)); ?>
