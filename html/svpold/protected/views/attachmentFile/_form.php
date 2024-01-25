<?php
/* @var $this AttachmentFileController */
/* @var $model AttachmentFile */
/* @var $form CActiveForm */
if(!Yii::app()->user->isAdmin && !Yii::app()->user->getIsByRole()){
	$this->redirect('/noallowed.html');
}
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'AttachmentFile-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

	<p class="note">Los campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name_doc'); ?>
		<?php echo $form->textField($model,'name_doc', array('size' => 50, 'maxlength' => 100)); ?>
		<?php echo $form->error($model,'name_doc'); ?>
	</div>

	<?php $productclient=CustomerProduct::model()->findAllByAttributes(array('attachmentFileId' => $model->id));?>

	<div class="row">
        <?php echo $form->labelEx($model, 'idFDJson'); ?>
        <?php
        echo $form->dropDownList($model, 'idFDJson', CHtml::listData(
            DynamicFormJSON::model()->findAll(array('order' => 'name')), 'id', 'name'), array('prompt' => '...'));
        ?> 
        <?php echo $form->error($model, 'idFDJson'); ?>
    </div>

	<div class="row">
        <?php //echo $form->labelEx($model, 'questionnaire'); ?>
        <?php //echo $form->textArea($model, 'questionnaire', array('rows' => 15, 'cols' => 197)); ?>
        <?php //echo $form->error($model, 'questionnaire'); ?>
    </div>

	<div class="row">
        <h2><?php echo $form->label($model, 'requirements'); ?></h2>
		<?php
		$this->widget('application.extensions.SvpCkEditor.SvpCkEditor'
				, array(
			'model' => $model,
			'attribute' => 'requirements',
			'type' => 'others',
			'variables' => array_merge([]), //PdfReportType::getFullAllowedVars(), TcPdf\SvpTcPdf::$allowedVars
			)
		);
		?>
    </div>

	<div class="row">
		<?php echo $form->labelEx($model, 'fileName'); ?>
		<?php echo $form->fileField($model, 'fileName'); ?>
		<?php echo $form->error($model, 'fileName'); ?>

	<?php if(!empty($model->fileName)): // && $productclient==null): ?>
	  	<a target="_blank" href="<?php echo '/fileAttachment/'.$model->fileName; ?>"><?php echo $model->fileName ?></a>
	  	<a href="?delete=1"><span><img src="../../mantenimiento/images/remove.png"/></span></a>
	<?php //elseif(!empty($model->fileName)): ?>
		<!--<a target="_blank" href="<?php //echo '/fileAttachment/'.$model->fileName; ?>"><?php //echo $model->fileName ?></a><br>-->
	<?php endif; ?>

	<?php
        $ruta = '/fileAttachment/'.$model->fileName;
		//$ruta ='/data/svp/docs/docs/fileName/'.$model->fileName;


        if(isset($_GET['delete']))
        {
            if (empty($model->fileName)){

            }else{
                unlink(Yii::app()->basePath.'/files/fileAttachment/'.$model->fileName);
				//unlink('/data/svp/docs/docs/fileName/'.$model->fileName);
                $query = "UPDATE ses_AttachmentFile att SET att.fileName='' WHERE  att.fileName='".$model->fileName."';";
                $query = Yii::app()->db->createCommand($query)->execute();
            }
        }
	?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'fileName1'); ?>
		<?php echo $form->fileField($model, 'fileName1'); ?>
		<?php echo $form->error($model, 'fileName1'); ?>

	<?php if(!empty($model->fileName1)): //&& $productclient==null): ?>
	  	<a target="_blank" href="<?php echo '/fileAttachment/'.$model->fileName1; ?>"><?php echo $model->fileName1 ?></a>
	  	<a href="?delete1=1"><span><img src="../../mantenimiento/images/remove.png"/></span></a>
	<?php //elseif(!empty($model->fileName1)): ?>
		<!--<a target="_blank" href="<?php //echo '/fileAttachment/'.$model->fileName1; ?>"><?php //echo $model->fileName1 ?></a><br>-->
	<?php endif; ?>

	<?php
        $ruta = '/fileAttachment/'.$model->fileName1;
		//$ruta ='/data/svp/docs/docs/fileName/'.$model->fileName;


        if(isset($_GET['delete1']))
        {
            if (empty($model->fileName1)){

            }else{
                unlink(Yii::app()->basePath.'/files/fileAttachment/'.$model->fileName1);
				//unlink('/data/svp/docs/docs/fileName/'.$model->fileName);
                $query = "UPDATE ses_AttachmentFile att SET att.fileName1='' WHERE  att.fileName1='".$model->fileName1."';";
                $query = Yii::app()->db->createCommand($query)->execute();
            }
        }
	?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'fileName2'); ?>
		<?php echo $form->fileField($model, 'fileName2'); ?>
		<?php echo $form->error($model, 'fileName2'); ?>

	<?php if(!empty($model->fileName2)): //&& $productclient==null): ?>
	  	<a target="_blank" href="<?php echo '/fileAttachment/'.$model->fileName2; ?>"><?php echo $model->fileName2 ?></a>
	  	<a href="?delete2=1"><span><img src="../../mantenimiento/images/remove.png"/></span></a>
	<?php //elseif(!empty($model->fileName2)): ?>
		<!--<a target="_blank" href="<?php //echo '/fileAttachment/'.$model->fileName2; ?>"><?php //echo $model->fileName2 ?></a><br>-->
	<?php endif; ?>

	<?php
        $ruta = '/fileAttachment/'.$model->fileName2;
		//$ruta ='/data/svp/docs/docs/fileName/'.$model->fileName;


        if(isset($_GET['delete2']))
        {
            if (empty($model->fileName2)){

            }else{
                unlink(Yii::app()->basePath.'/files/fileAttachment/'.$model->fileName2);
				//unlink('/data/svp/docs/docs/fileName/'.$model->fileName);
                $query = "UPDATE ses_AttachmentFile att SET att.fileName2='' WHERE  att.fileName2='".$model->fileName2."';";
                $query = Yii::app()->db->createCommand($query)->execute();
            }
        }
	?>
	</div>


	<div class="row">
		<?php echo $form->labelEx($model, 'fileName3'); ?>
		<?php echo $form->fileField($model, 'fileName3'); ?>
		<?php echo $form->error($model, 'fileName3'); ?>

	<?php if(!empty($model->fileName3)): //&& $productclient==null): ?>
	  	<a target="_blank" href="<?php echo '/fileAttachment/'.$model->fileName3; ?>"><?php echo $model->fileName3 ?></a>
	  	<a href="?delete3=1"><span><img src="../../mantenimiento/images/remove.png"/></span></a>
	<?php //elseif(!empty($model->fileName3)): ?>
		<!--<a target="_blank" href="<?php //echo '/fileAttachment/'.$model->fileName3; ?>"><?php //echo $model->fileName3 ?></a><br>-->
	<?php endif; ?>

	<?php
        $ruta = '/fileAttachment/'.$model->fileName3;
		//$ruta ='/data/svp/docs/docs/fileName/'.$model->fileName;


        if(isset($_GET['delete3']))
        {
            if (empty($model->fileName3)){

            }else{
                unlink(Yii::app()->basePath.'/files/fileAttachment/'.$model->fileName3);
				//unlink('/data/svp/docs/docs/fileName/'.$model->fileName);
                $query = "UPDATE ses_AttachmentFile att SET att.fileName3='' WHERE  att.fileName3='".$model->fileName3."';";
                $query = Yii::app()->db->createCommand($query)->execute();
            }
        }
	?>
	</div>


	<div class="row">
		<?php echo $form->labelEx($model, 'fileName4'); ?>
		<?php echo $form->fileField($model, 'fileName4'); ?>
		<?php echo $form->error($model, 'fileName4'); ?>

	<?php if(!empty($model->fileName4)): //&& $productclient==null): ?>
	  	<a target="_blank" href="<?php echo '/fileAttachment/'.$model->fileName4; ?>"><?php echo $model->fileName4 ?></a>
	  	<a href="?delete4=1"><span><img src="../../mantenimiento/images/remove.png"/></span></a>
	<?php //elseif(!empty($model->fileName4)): ?>
		<!--<a target="_blank" href="<?php //echo '/fileAttachment/'.$model->fileName4; ?>"><?php //echo $model->fileName4 ?></a><br>-->
	<?php endif; ?>

	<?php
        $ruta = '/fileAttachment/'.$model->fileName4;
		//$ruta ='/data/svp/docs/docs/fileName/'.$model->fileName;


        if(isset($_GET['delete4']))
        {
            if (empty($model->fileName4)){

            }else{
                unlink(Yii::app()->basePath.'/files/fileAttachment/'.$model->fileName4);
				//unlink('/data/svp/docs/docs/fileName/'.$model->fileName);
                $query = "UPDATE ses_AttachmentFile att SET att.fileName4='' WHERE  att.fileName4='".$model->fileName4."';";
                $query = Yii::app()->db->createCommand($query)->execute();
            }
        }
	?>
	</div>

	<?php if(!empty($model->fileName) || !empty($model->fileName1) || !empty($model->fileName2) || !empty($model->fileName3) || !empty($model->fileName4) && $productclient!=null): ?>	
		<div class="flash-notice">
			<?php echo 'Este Archivo esta asociado a los siguientes productos: <br>';?>
			<?php foreach ($productclient as $product): ?>
				<?php echo '<b>'.$product->name.'</b> - ';?>
			<?php endforeach ?>
		</div>
	<?php endif; ?>
	

	<div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Update'); ?>
    </div>
<?php $this->endWidget(); ?>

</div><!-- form -->