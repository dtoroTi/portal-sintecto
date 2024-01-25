<?php
/* @var $this CandidateCallsController */
/* @var $model CandidateCalls */
if(!Yii::app()->user->isAdmin && !Yii::app()->user->getIsByRole()){
	$this->redirect('/noallowed.html');
}

/*$this->menu=array(
	array('label'=>'List CandidateCalls', 'url'=>array('index')),
	array('label'=>'Create CandidateCalls', 'url'=>array('create')),
	array('label'=>'View CandidateCalls', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage CandidateCalls', 'url'=>array('admin')),
);*/
?>

<?php 
	if($pc==1){
		$this->breadcrumbs=array(
			'Llamadas asignadas'=>array('admintoAssign'),
			$model->id=>array('view','id'=>$model->id),
			'Update',
		);		
		?>
		<h1>Actualizar Asignación de Llamada <?php echo $model->id; ?></h1>
		<?php
		$this->renderPartial('_formtoAssignCalls', array('model'=>$model)); 
	}else if($pc==2){
		$this->breadcrumbs=array(
			'Llamadas a Cargo'=>array('admintoManager'),
			$model->id=>array('view','id'=>$model->id),
			'Update',
		);		
		?>
		<h1>Datos de Llamada a cargo <?php echo $model->id; ?></h1>
		<?php
		$this->renderPartial('_form', array('model'=>$model)); 
	}else{	
		$this->breadcrumbs=array(
			'Llamadas programadas'=>array('admin'),
			$model->id=>array('view','id'=>$model->id),
			'Update',
		);	
		?>
		<h1>Datos de Llamadas por responsable <?php echo $model->id; ?></h1>
		<?php
		$this->renderPartial('_form', array('model'=>$model)); 
	}
?>