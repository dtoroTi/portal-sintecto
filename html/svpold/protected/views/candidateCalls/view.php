<?php
/* @var $this CandidateCallsController */
/* @var $model CandidateCalls */


/*$this->breadcrumbs=array(
	'Candidate Calls'=>array('index'),
	$model->id,
);*/

/*$this->menu=array(
	array('label'=>'List CandidateCalls', 'url'=>array('index')),
	array('label'=>'Create CandidateCalls', 'url'=>array('create')),
	array('label'=>'Update CandidateCalls', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete CandidateCalls', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CandidateCalls', 'url'=>array('admin')),
);*/
?>

<h1>Vista datos Llamadas #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'backgroundcheck.code',
		'callManager.name',
		'callReschedulingManager.name',
		'dateRegistrationEffective',
		'dateRegistrationNotEffective',
		'observation',
		'confirmationVisitId',
		'typeVisit',
		'authorizationFormat',
		'responsibleVisitId',
		'visitProgramdate',
		'location',
		'referenceAddress',
		'neighborhood',
		'availability',
		'availabilitydate',
		'statusVisit',
	),
)); ?>
