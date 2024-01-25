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
				<?php echo $form->labelEx($model, 'confirmationVisitId'); ?>
				<?php echo $form->dropDownList($model, 'confirmationVisitId', 
				CHtml::listData(User::model()->findAll(
						array(
							'order' => 'firstName',
							'condition' => 'callManager=:idvalue',
							'params' => array(':idvalue' => 1))
				), 'id', 'summaryLine'), array('prompt' => '...'));  //, 'multiple'=>'multiple'
				?>
				<?php echo $form->error($model, 'confirmationVisitId'); ?>
			</div>

			<div class="row">
				<?php echo $form->labelEx($model, 'typeVisit'); ?>
				<?php
				echo $form->dropdownList($model, //
					'typeVisit', //
					array(
						'' => '...',
						'OEA' => 'OEA',
						'Preempleo' => 'Preempleo',
						'Rutina' => 'Rutina',
						'Basc Rutina' => 'Basc Rutina',
						'OEA-Preempleo' => 'OEA-Preempleo',
						'Personal Activo' => 'Personal Activo',
						'N/A' => 'N/A'
					)
				);
				?>
				<?php echo $form->error($model, 'typeVisit'); ?>
			</div>

			<div class="row">
				<?php echo $form->labelEx($model, 'authorizationFormat'); ?>
				<?php
				echo $form->dropdownList($model, //
					'authorizationFormat', //
					array(
						'' => '...',
						'Con Financiero' => 'Con Financiero',
						'Sin Financiero' => 'Sin Financiero',
						'N/A' => 'N/A',
					)
				);
				?>
				<?php echo $form->error($model, 'authorizationFormat'); ?>
			</div>

			<div class="row">
				<?php echo $form->labelEx($model, 'responsibleVisitId'); ?>
				<?php echo $form->dropDownList($model, 'responsibleVisitId', 
				CHtml::listData(User::model()->findAll(
						array(
							'order' => 'firstName')
				), 'id', 'summaryLine'), array('prompt' => '...'));  //, 'multiple'=>'multiple'
				?>
				<?php echo $form->error($model, 'responsibleVisitId'); ?>
			</div>

			<div class="row">
			<?php echo $form->label($model, 'visitProgramdateFrom'); ?>
			<?php //echo $form->textField($model, 'studyStartedOnFrom'); ?>
			<?php
				$this->widget('jqueryDateTime', array(
					'name' => 'CandidateCalls[visitProgramdateFrom]',
					'value' =>  $model->visitProgramdateFrom,
					// additional javascript options for the date picker plugin
					'options' => [
						'showAnim' => 'fold',
						'buttonText' => '...',
						'format' => 'Y-m-d H:i:s',
						'lang' => 'es',
						'showButtonPanel' => true,
					],
					'htmlOptions' => array(
						'style' => 'width:10em;'
					),
				))
			?>
				<b>Hasta</b>
				<?php
					$this->widget('jqueryDateTime', array(
						'name' => 'CandidateCalls[visitProgramdateUntil]',
						'value' =>  $model->visitProgramdateUntil,
						// additional javascript options for the date picker plugin
						'options' => [
							'showAnim' => 'fold',
							'buttonText' => '...',
							'format' => 'Y-m-d H:i:s',
							'lang' => 'es',
							'showButtonPanel' => true,
						],
						'htmlOptions' => array(
							'style' => 'width:10em;'
						),
					))
				?>
			</div>

			<div class="row buttons">
				<?php echo CHtml::submitButton('Search'); ?>
			</div>
		</td>
		<td>
			<div class="row">
				<?php echo $form->label($model,'locationSelect'); ?>
				<?php echo $form->dropDownList($model, 'locationSelect', 
				CHtml::listData(CandidateCalls::model()->findAll(
						array(
							'order' => 'location',
							//'condition' => 'visitProgramdate>=DATE(NOW())',
							'group' => 'location')
				), 'location', 'location'), ['prompt' => '', 'multiple' => true, 'selected' => 'selected', 'style' => 'width:10em; height:10em']);  
				?>
				<?php echo $form->error($model, 'locationSelect'); ?>
			</div>

			<div class="row">
			<?php echo $form->label($model, 'availabilitydateFrom'); ?>
			<?php //echo $form->textField($model, 'studyStartedOnFrom'); ?>
			<?php
				$this->widget('jqueryDateTime', array(
					'name' => 'CandidateCalls[availabilitydateFrom]',
					'value' =>  $model->availabilitydateFrom,
					// additional javascript options for the date picker plugin
					'options' => [
						'showAnim' => 'fold',
						'buttonText' => '...',
						'format' => 'Y-m-d H:i:s',
						'lang' => 'es',
						'showButtonPanel' => true,
					],
					'htmlOptions' => array(
						'style' => 'width:10em;'
					),
				))
			?>
				<b>Hasta</b>
				<?php
					$this->widget('jqueryDateTime', array(
						'name' => 'CandidateCalls[availabilitydateUntil]',
						'value' =>  $model->availabilitydateUntil,
						// additional javascript options for the date picker plugin
						'options' => [
							'showAnim' => 'fold',
							'buttonText' => '...',
							'format' => 'Y-m-d H:i:s',
							'lang' => 'es',
							'showButtonPanel' => true,
						],
						'htmlOptions' => array(
							'style' => 'width:10em;'
						),
					))
				?>
			</div>

			<div class="row">
				<?php echo $form->label($model,'formVisit'); ?>
				<?php
				echo $form->dropdownList($model, //
					'formVisit', //
					array(
						'' => '...',
						'Virtual' => 'Virtual',
						'Presencial' => 'Presencial',
					)
				);
				?>
				<?php echo $form->error($model,'formVisit'); ?>
			</div>

			<div class="row">
				<?php echo $form->label($model,'typeEvent'); ?>
				<?php
				echo $form->dropdownList($model, //
					'typeEvent', //
					array(
						'' => '...',
						'Visita' => 'Visita',
						'Documentos' => 'Documentos',
						'Visita-Documentos' => 'Visita y Documentos',
					)
				);
				?>
				<?php echo $form->error($model,'typeEvent'); ?>
			</div>
		</td>
	</tr>
</table>

<?php $this->endWidget(); ?>

</div><!-- search-form -->