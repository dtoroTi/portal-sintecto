<?php
$this->breadcrumbs = array(
    'Background Checks' => array('admin'),
    $model->code,
);
?>

<h1>View BackgroundCheck <?php echo $model->code; ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'customer.name',
        'customerProduct.name',
        'customerUser.username',
        'customerField1' => array(
            'name' => 'customerField1',
            'label' => $model->customer->field1,
        ),
        'customerField2' => array(
            'name' => 'customerField2',
            'label' => $model->customer->field2,
        ),
        'customerField3' => array(
            'name' => 'customerField3',
            'label' => $model->customer->field3,
        ),
        'customerField4' => array(
            'name' => 'customerField4',
            'label' => $model->customer->field4,
        ),
        'customerField5' => array(
            'name' => 'customerField5',
            'label' => $model->customer->field5,
        ),
        'customerField6' => array(
            'name' => 'customerField6',
            'label' => $model->customer->field6,
        ),
        'customerField7' => array(
            'name' => 'customerField7',
            'label' => $model->customer->field7,
        ),
        'customerField8' => array(
            'name' => 'customerField8',
            'label' => $model->customer->field8,
        ),
        'customerField9' => array(
            'name' => 'customerField9',
            'label' => $model->customer->field9,
        ),
        'firstName',
        'lastName',
        'idNumber',
        'idFrom',
        'birthday',
        'relationshipStatus.name',
        'state',
        'city',
        'address',
        'area',
        'tels',
        'actualJob',
        'applyToPosition',
        'backgroundCheckStatus.name',
        'requestSystem.name',
        'studyStartedOn',
        'studyLimitOn',
        'studyFinishedOn',
        'comments',
        'personContacted',
        'result.name',
        'created',
        'modified',
    ),
));
?>


<br/>
<hr/>
<br/>
<br/>
</div>