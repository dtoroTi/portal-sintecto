<?php
$this->breadcrumbs = array(
    'Users' => array('admin'),
    CHtml::encode($model->id),
);

$this->menu = array(
    array('label' => 'List User', 'url' => array('index')),
    array('label' => 'Create User', 'url' => array('create')),
    array('label' => 'Update User', 'url' => array('update', 'id' => $model->id)),
    array('label' => 'Delete User', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => 'Manage User', 'url' => array('admin')),
);
?>

<h1>Usuario<?php echo CHtml::encode($model->id); ?></h1>

<?php if(Yii::app()->user->hasFlash('notification')):?>
    <div class="flash-notice">
        <?php echo Yii::app()->user->getFlash('notification'); ?>
    </div>
<?php endif; ?>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'username',
        'firstName',
        'lastName',
        'userType.name',
        'created',
        'modified',
        'lastLogin',
        'state',
        'city',
        'isInhouse' => array(
            'name' => 'isInhouse',
            'type' => 'boolean',
        ),
        'mustChangePassword' => array(
            'name' => 'mustChangePassword',
            'type' => 'boolean',
        ),
        'isActive' => array(
            'name' => 'isActive',
            'type' => 'boolean',
        ),
        'enforceOtp' => array(
            'name' => 'enforceOtp',
            'type' => 'boolean',
        ),
        'otpKey',
        'enforceOtpG' => array(
            'name' => 'enforceOtpG',
            'type' => 'boolean',
        ),
        'MailAssigned' => array(
            'name' => 'MailAssigned',
            'type' => 'boolean',
        ),
        'Deallocated' => array(
            'name' => 'Deallocated',
            'type' => 'boolean',
        ),
         'MailCancelled' => array(
            'name' => 'MailCancelled',
            'type' => 'boolean',
        ),
         'MailFinished' => array(
            'name' => 'MailFinished',
            'type' => 'boolean',
         ),

         'MailPublished' => array(
            'name' => 'MailPublished',
            'type' => 'boolean',
         ),

         'MailInformativeNews' => array(
            'name' => 'MailInformativeNews',
            'type' => 'boolean',
        ),
         'MailTimeImpact' => array(
            'name' => 'MailTimeImpact',
            'type' => 'boolean',
        ),
         'MailReturned' => array(
            'name' => 'MailReturned',
            'type' => 'boolean',
        ),
         'MailApprovedPric' => array(
            'name' => 'MailApprovedPric',
            'type' => 'boolean',
        ),
         'MailStudyRequest' => array(
            'name' => 'MailStudyRequest',
            'type' => 'boolean',
        ),
    ),
));
?>


    <?php if ($model->signature): ?>
        <div>
            <img src="<?= $this->createUrl('/user/signature/', array('id' => $model->id)) ?>">
        </div>
    <?php endif; ?>