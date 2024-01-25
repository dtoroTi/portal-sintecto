<?php
/* @var $this CustomerUserController */
/* @var $model CustomerUser */
if(!Yii::app()->user->isValidUser && !Yii::app()->user->getIsByRole()){
     $this->redirect('/noallowed.html');
}
$this->breadcrumbs = array(
    'Customer Users' => array('admin'),
    CHtml::encode($model->id),
);

$this->menu = array(
    array('label' => 'List CustomerUser', 'url' => array('index')),
    array('label' => 'Create CustomerUser', 'url' => array('create')),
    array('label' => 'Update CustomerUser', 'url' => array('update', 'id' => $model->id)),
    array('label' => 'Delete CustomerUser', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => 'Manage CustomerUser', 'url' => array('admin')),
);
?>

<h1>Usuario de Cliente #<?php echo CHtml::encode($model->id); ?></h1>

<?php if (Yii::app()->user->hasFlash('notification')): ?>
    <div class="flash-notice">
        <?php echo Yii::app()->user->getFlash('notification'); ?>
    </div>
<?php endif; ?>


<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'customer.name',
        'username',
        'firstName',
        'lastName',
        'created',
        'modified',
        'isActive' => array(
            'name' => 'isActive',
            'type' => 'boolean',
        ),
        'lastLogin',
        'lastLoginIP',
        'sessionValidUntil',
        'mustChangePassword' => array(
            'name' => 'mustChangePassword',
            'type' => 'boolean',
        ),
        'isSupervisor' => array(
            'name' => 'isSupervisor',
            'type' => 'boolean',
        ),
        'enforceOtp' => array(
            'name' => 'enforceOtp',
            'type' => 'boolean',
        ),
        'otpKey',
        'accessToReports' => array(
            'name' => 'accessToReports',
            'type' => 'boolean'),
        'notifyByMail' => array(
            'name' => 'notifyByMail',
            'type' => 'boolean'),
        'accessToOfac' => array(
            'name' => 'accessToOfac',
            'type' => 'boolean'),
    ),
));
?>
