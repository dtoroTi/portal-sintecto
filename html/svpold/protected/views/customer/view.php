<?php
if(!Yii::app()->user->isValidUser && !Yii::app()->user->getIsByRole()){
     $this->redirect('/noallowed.html');
}
$this->breadcrumbs = array(
    'Customers' => array('admin'),
    CHtml::encode($model->name),
);

$this->menu = array(
    array('label' => 'List Customer', 'url' => array('index')),
    array('label' => 'Create Customer', 'url' => array('create')),
    array('label' => 'Update Customer', 'url' => array('update', 'id' => $model->id)),
    array('label' => 'Delete Customer', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => 'Manage Customer', 'url' => array('admin')),
);
?>

<h1>Cliente #<span id="customerId"><?php echo CHtml::encode($model->id); ?></span></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id',
        'name',
        'comments',
        'field1',
        'field2',
        'field3',
        'address',
        'city',
        'notifyByMail' => array(
            'name'=>'notifyByMail',
            'type'=>'boolean'),
        'accessToReports' => array(
            'name'=>'accessToReports',
            'type'=>'boolean'),
        'accessToOfac' => array(
            'name'=>'accessToOfac',
            'type'=>'boolean'),
        'accessToCertificates' => array(
            'name'=>'accessToCertificates',
            'type'=>'boolean'),
        'sendToCertificate' => array(
            'name'=>'sendToCertificate',
            'type'=>'boolean'),
        'graphicsNews' => array(
            'name'=>'graphicsNews',
            'type'=>'boolean'),
        'created',
        'modified',
        ),
));
?>
