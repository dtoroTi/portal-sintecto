<?php
if(!Yii::app()->user->isAdmin && !Yii::app()->user->getIsByRole()){
     $this->redirect('/noallowed.html');
}
$this->breadcrumbs = array(
    'Customers' => array('admin'),
    CHtml::encode($model->name) => array('view', 'id' => CHtml::encode($model->id)),
    'Update',
);

$this->menu = array(
    array('label' => 'List Customer', 'url' => array('index')),
    array('label' => 'Create Customer', 'url' => array('create')),
    array('label' => 'View Customer', 'url' => array('view', 'id' => $model->id)),
    array('label' => 'Manage Customer', 'url' => array('admin')),
);
?>

<h1>Update Customer <?php echo CHtml::encode($model->id); ?></h1>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>

<?php
//echo CHtml::button('Borrar el cliente', Yii::app()->createUrl('/customer/delete/' . $model->id), array(
//    'type' => 'POST',
//    'confirm' => 'Esta seguro de borrar el cliente de la base de datos?',
//        ), array('id' => 'deleteCustomer',));

//echo CHtml::button('Borrar el cliente',
//    array(
//        'submit'=>array('/customer/delete/','id'=>$model->id),
//        'confirm' => 'Esta seguro de borrar el cliente de la base de datos??',
//        'id' => 'deleteCustomer',
//    )
//);
?>