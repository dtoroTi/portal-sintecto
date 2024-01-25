<?php
/* @var $this CandidateCallsController */
/* @var $model CandidateCalls */
/* @var $form CActiveForm */
$datetime = new CDbExpression('NOW()');
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>
<table>
	<tr>

		<td>
			<div class="row">
				<?php echo $form->label($model,'citySelect'); ?>
				<?php echo $form->dropDownList($model, 'citySelect', 
				CHtml::listData(BackgroundCheck::model()->findAll(
						array(
                            'join' => 'INNER JOIN ses_CandidateCalls can',
							'order' => 'city',
							'condition' => 't.id=can.backgroundcheckId',
							'group' => 'city')
				), 'city', 'city'), ['multiple' => true, 'selected' => 'selected', 'style' => 'width:10em; height:10em']);  
				?>
				<?php echo $form->error($model, 'citySelect'); ?>
			</div>

            <div class="row buttons">
				<?php echo CHtml::submitButton('Search'); ?>
			</div>
		</td>
	</tr>
</table>

<?php $this->endWidget(); ?>

</div><!-- search-form -->