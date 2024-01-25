<?php
if(!Yii::app()->user->isSuperAdmin && !Yii::app()->user->getIsByRole()){
     $this->redirect('/noallowed.html');
}
if(isset($usrSenior) && $usrSenior==1){
	$this->breadcrumbs=array(
		'Users'=>array('adminSenior'),
		CHtml::encode($model->id),
		'Update',
	);
}else{
	$this->breadcrumbs=array(
		'Users'=>array('admin'),
		CHtml::encode($model->id)=>array('view','id'=>CHtml::encode($model->id)),
		'Update',
	);
}

$this->menu=array(
	array('label'=>'List User', 'url'=>array('index')),
	array('label'=>'Create User', 'url'=>array('create')),
	array('label'=>'View User', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage User', 'url'=>array('admin')),
);
?>

<?php 
if(isset($usrSenior) && $usrSenior==1){?>
	<h1>Actualizar Senior Asignado <?php echo CHtml::encode($model->id); ?></h1>
<?php
	echo $this->renderPartial('_formSenior', array('model'=>$model)); 
}else{?>
	<h1>Update User <?php echo CHtml::encode($model->id); ?></h1>
<?php	
	echo $this->renderPartial('_form', array('model'=>$model)); 
}
	

?>