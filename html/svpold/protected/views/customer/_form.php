<script type="text/javascript">
    function mostrar(id) {
            if (id == "SI") {
                $("#SI").show();
                $("#NO").hide();
            }
            if (id == "NO") {
                $("#SI").hide();
                $("#NO").hide();
            }
    }
</script>
<div class="form wide">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'customer-form',
        'enableAjaxValidation' => false,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
    ));
    ?>

    <p class="note">Los campos con <span class="required">*</span> son requeridos.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'customerGroupId'); ?>
        <?php
        echo $form->dropdownList($model, //
                'customerGroupId', //
                CHtml::listData(//
                        CustomerGroup::model()->findAll(array('order' => 'name asc')), 'id', 'name'), array('prompt' => 'Grupo...'));
        ?>
        <?php echo $form->error($model, 'customerGroupId'); ?>
    </div>


    <div class="row">
        <?php echo $form->labelEx($model, 'name'); ?>
        <?php echo $form->textField($model, 'name', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'name'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'Idcustomer'); ?>
        <?php echo $form->textField($model, 'Idcustomer', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'Idcustomer'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'businessLine'); ?>
        <?php echo $form->dropDownList($model, 'businessLine', Controller::$optionsBussinesLineClient); ?>
        <?php echo $form->error($model, 'businessLine'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'segment'); ?>
        <?php
        echo $form->dropdownList($model, //
            'segment', //
            array(
                'prompt' => '...',
                'Empresarial' => 'Empresarial',
                'Corporativo' => 'Corporativo',
                'Transaccional' => 'Transaccional',
            )
        );
        ?>
        <?php echo $form->error($model, 'segment'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'surveyLinkId'); ?>
        <?php
        echo $form->dropDownList($model, 'surveyLinkId', CHtml::listData(
                SurveyLink::model()->findAll(array('order' => 'name')), 'id', 'name'), array('prompt' => '...'));
        ?> 
        <?php echo $form->error($model, 'surveyLinkId'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'incremental'); ?>
        <?php
        echo $form->dropdownList($model, //
            'incremental', //
            array(
                'SI' => 'SI',
                'NO' => 'NO',
            )
        );
        ?>
        <?php echo $form->error($model, 'incremental'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'customerClassification'); ?>
        <?php
        echo $form->dropdownList($model, //
            'customerClassification', //
            array(
                '' => 'N/A',
                'BAU INT' => 'BAU INT',
                'FFMM (FAC)' => 'FFMM (FAC)',
                'Sierra Col INT' => 'Sierra Col INT',
                'Cenet - Alianza' => 'Cenet - Alianza',
                'Nuevo BAU 2023' => 'Nuevo BAU 2023',
                'Nuevo 2024 Upsell' => 'Nuevo 2024 Upsell',
                'Nuevo 2024 Crosss sell' => 'Nuevo 2024 Crosss sell',
                'Nuevo 2024 Temporales' => 'Nuevo 2024 Temporales',
                'Nuevo 2024 BPO' => 'Nuevo 2024 BPO',
                'BAU ET' => 'BAU ET',
                'SierraCol ET' => 'SierraCol ET',
                'Nuevo BAU ET 2023' => 'Nuevo BAU ET 2023',
                'Nuevo 2024' => 'Nuevo 2024',
                'Nuevo 2024 Upsell ET' => 'Nuevo 2024 Upsell ET',
                'Nuevo 2024 Crosss sell ET' => 'Nuevo 2024 Crosss sell ET',
                'Urgent' => 'Urgent',
                'Tusdatos' => 'Tusdatos',
                'Consultoria Bau' => 'Consultoria Bau',
                'Consultoria Sierracol' => 'Consultoria Sierracol',

            )
        );
        ?>
        <?php echo $form->error($model, 'customerClassification'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'increaseDateIPC'); ?>
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'name' => 'Customer[increaseDateIPC]',
            'value' => $model->increaseDateIPC,
            // additional javascript options for the date picker plugin
            'options' => array(
                'showAnim' => 'fold',
                'buttonText' => '...',
                'dateFormat' => 'yy-mm-dd',
                'showButtonPanel' => true,
                'changeYear' => true,
                'changeMonth' => true,
            ),
            'htmlOptions' => array(
                'style' => 'height:20px;',
            ),
        ));
        ?>
        <?php echo $form->error($model, 'increaseDateIPC'); ?>
    </div>

    <div class="row">    
        <?php echo $form->labelEx($model, 'businessRelationShip'); ?>
        <?php echo $form->dropDownList($model, 'businessRelationShip', Controller::$optionsBusinessRelationShip); ?>
        <?php echo $form->error($model, 'businessRelationShip'); ?>   
    </div>

    <div class="row">    
        <?php echo $form->labelEx($model, 'inputChannel'); ?>
        <?php echo $form->dropDownList($model, 'inputChannel', Controller::$optionsInputChannel); ?>
        <?php echo $form->error($model, 'inputChannel'); ?>   
    </div>

    <div class="row">    
        <?php echo $form->labelEx($model, 'policies'); ?>
        <?php echo $form->dropDownList($model, 'policies', Controller::$optionsYesNoNANull); ?>
        <?php echo $form->error($model, 'policies'); ?>   
    </div>

    <div class="row">    
        <?php echo $form->labelEx($model, 'otherIf'); ?>
        <?php echo $form->dropDownList($model, 'otherIf', Controller::$optionsCalificationCuantitative); ?>
        <?php echo $form->error($model, 'otherIf'); ?>   
    </div>  

    <div class="row">
        <?php echo $form->labelEx($model, 'contractStartDate'); ?>
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'name' => 'Customer[contractStartDate]',
            'value' => $model->contractStartDate,
            // additional javascript options for the date picker plugin
            'options' => array(
                'showAnim' => 'fold',
                'buttonText' => '...',
                'dateFormat' => 'yy-mm-dd',
                'showButtonPanel' => true,
                'changeYear' => true,
                'changeMonth' => true,
            ),
            'htmlOptions' => array(
                'style' => 'height:20px;',
            ),
        ));
        ?>
        <?php echo $form->error($model, 'contractStartDate'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'contractEndDate'); ?>
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'name' => 'Customer[contractEndDate]',
            'value' => $model->contractEndDate,
            // additional javascript options for the date picker plugin
            'options' => array(
                'showAnim' => 'fold',
                'buttonText' => '...',
                'dateFormat' => 'yy-mm-dd',
                'showButtonPanel' => true,
                'changeYear' => true,
                'changeMonth' => true,
            ),
            'htmlOptions' => array(
                'style' => 'height:20px;',
            ),
        ));
        ?>
        <?php echo $form->error($model, 'contractEndDate'); ?>
    </div>

    <?php if ($model->customerGroupId==Customer::GROUP_CENET) : ?>
    <div class="row">
        <?php echo $form->labelEx($model, 'dateValidation'); ?>
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'name' => 'Customer[dateValidation]',
            'value' => $model->dateValidation,
            // additional javascript options for the date picker plugin
            'options' => array(
                'showAnim' => 'fold',
                'buttonText' => '...',
                'dateFormat' => 'yy-mm-dd',
                'showButtonPanel' => true,
                'changeYear' => true,
                'changeMonth' => true,
            ),
            'htmlOptions' => array(
                'style' => 'height:20px;',
            ),
        ));
        ?>
        <?php echo $form->error($model, 'dateValidation'); ?>
    </div>
    <?php endif; ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'comments'); ?>
        <?php echo $form->textArea($model, 'comments', array('rows' => 6, 'cols' => 50)); ?>
        <?php echo $form->error($model, 'comments'); ?>
    </div>
    <div class="row">
        <?php 
            echo $form->labelEx($model, 'logo');
            echo $form->fileField($model, 'logo');
            echo $form->error($model, 'logo');
        
        ?>
        <?php if(!empty($model->logo)): ?>
        <img width="40" src="<?php echo '/files/logo/'.$model->logo ?>"/>
        <a href="?delete=1">  --->Eliminar Imagen<---</a>
        <?php endif; ?>

       <?php
        //creado por Jonathan
        ?>

        <?php
        $ruta = './files/logo/'.$model->logo;

        if(isset($_GET['delete']))
        {
            if (empty($model->logo)){

            }else{
                unlink('./files/logo/'.$model->logo);
                $query = "UPDATE ses_Customer SET logo='' WHERE  logo='".$model->logo."';";
                $query = Yii::app()->db->createCommand($query)->execute();
            }
        }
        ?>

        <?php
        //creado por Jonathan */
        ?>
    </div>

    <?php for ($i = 1; $i <= Customer::MAX_FIELDS; $i++): ?>
        <div class="row">
            <?php echo $form->labelEx($model, "field{$i}"); ?>
            <?php echo $form->textField($model, "field{$i}", array('size' => 60, 'maxlength' => 255)); ?>
            <?php echo $form->error($model, "field{$i}"); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($model, "optionsField{$i}"); ?>
            <?php echo $form->textArea($model,"optionsField{$i}", array('rows' => 6, 'cols' => 50)); ?>
            <?php echo $form->error($model, "optionsField{$i}"); ?>
        </div>
    <?php endfor; ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'address'); ?>
        <?php echo $form->textField($model, 'address', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'address'); ?>
    </div>


    <div class="row">
        <?php echo $form->labelEx($model, 'city'); ?>
        <?php echo $form->textField($model, 'city', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'city'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'isActive'); ?>
        <?php echo $form->dropDownList($model, 'isActive', Controller::$optionsYesNo); ?>
        <?php echo $form->error($model, 'isActive'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'notifyByMail'); ?>
        <?php echo $form->dropDownList($model, 'notifyByMail', Controller::$optionsYesNo); ?>
        <?php echo $form->error($model, 'notifyByMail'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'sendToCertificate'); ?>
        <?php echo $form->dropDownList($model, 'sendToCertificate', Controller::$optionsYesNo); ?>
        <?php echo $form->error($model, 'sendToCertificate'); ?>

        <a style="padding-left: 10px;"></a><b>Clave Certificado:</b>
        <?php echo $form->dropDownList($model, 'certificateKey', Controller::$optionsYesNo); ?>
        <?php echo $form->error($model, 'certificateKey'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'concept'); ?>
        <?php echo $form->dropDownList($model, 'concept', Controller::$optionsYesNo); ?>
        <?php echo $form->error($model, 'concept'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'accessToReports'); ?>
        <?php echo $form->dropDownList($model, 'accessToReports', Controller::$optionsYesNo); ?>
        <?php echo $form->error($model, 'accessToReports'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'accessToTemporalReports'); ?>
        <?php echo $form->dropDownList($model, 'accessToTemporalReports', Controller::$optionsYesNo); ?>
        <?php echo $form->error($model, 'accessToTemporalReports'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'accessToOfac'); ?>
        <?php echo $form->dropDownList($model, 'accessToOfac', Controller::$optionsYesNo); ?>
        <?php echo $form->error($model, 'accessToOfac'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'accessToCompanyReports'); ?>
        <?php echo $form->dropDownList($model, 'accessToCompanyReports', Controller::$optionsYesNo); ?>
        <?php echo $form->error($model, 'accessToCompanyReports'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'accessToanexos'); ?>
        <?php echo $form->dropDownList($model, 'accessToanexos', Controller::$optionsYesNo); ?>
        <?php echo $form->error($model, 'accessToanexos'); ?>
    </div>
    
    <div class="row">
        <?php echo $form->labelEx($model, 'accessToCertificates'); ?>
        <?php echo $form->dropDownList($model, 'accessToCertificates', Controller::$optionsYesNo); ?>
        <?php echo $form->error($model, 'accessToCertificates'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'graphicsNews'); ?>
        <?php echo $form->dropDownList($model, 'graphicsNews', Controller::$optionsYesNo); ?>
        <?php echo $form->error($model, 'graphicsNews'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'preliminary'); ?>
        <?php echo $form->dropDownList($model, 'preliminary', Controller::$optionsYesNo); ?>
        <?php echo $form->error($model, 'preliminary'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'isPilot'); ?>
        <?php echo $form->dropDownList($model, 'isPilot', Controller::$optionsYesNo); ?>
        <?php echo $form->error($model, 'isPilot'); ?>
    </div>


    <div class="row">
        <?php echo $form->labelEx($model, 'salaryEarnedCust'); ?>
        <?php echo $form->dropDownList($model, 'salaryEarnedCust', Controller::$optionsYesNo); ?>
        <?php echo $form->error($model, 'salaryEarnedCust'); ?>
    </div>   
     
    <div class="row">
        <?php echo $form->labelEx($model, 'isRecover'); ?>
        <?php echo $form->dropDownList($model, 'isRecover', Controller::$optionsYesNo); ?>
        <?php echo $form->error($model, 'isRecover'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'manyAdvSources'); ?>
        <?php echo $form->dropDownList($model, 'manyAdvSources', Controller::$optionsYesNo); ?>
        <?php echo $form->error($model, 'manyAdvSources'); ?>
    </div>

    <fieldset>
    <legend>Fuentes caidas que afectan los estudios</legend>
        <div class="row">
            <?php echo $form->labelEx($model, 'isJepms'); ?>
            <?php echo $form->checkBox($model, 'isJepms'); ?>
            <?php echo $form->error($model, 'isJepms'); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($model, 'isPolicia'); ?>
            <?php echo $form->checkBox($model, 'isPolicia'); ?>
            <?php echo $form->error($model, 'isPolicia'); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($model, 'isProcuraduria'); ?>
            <?php echo $form->checkBox($model, 'isProcuraduria'); ?>
            <?php echo $form->error($model, 'isProcuraduria'); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($model, 'isContaduria'); ?>
            <?php echo $form->checkBox($model, 'isContaduria'); ?>
            <?php echo $form->error($model, 'isContaduria'); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($model, 'isRnmc'); ?>
            <?php echo $form->checkBox($model, 'isRnmc'); ?>
            <?php echo $form->error($model, 'isRnmc'); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($model, 'isJuzgadostyba'); ?>
            <?php echo $form->checkBox($model, 'isJuzgadostyba'); ?>
            <?php echo $form->error($model, 'isJuzgadostyba'); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($model, 'isSimit'); ?>
            <?php echo $form->checkBox($model, 'isSimit'); ?>
            <?php echo $form->error($model, 'isSimit'); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($model, 'isLibretamilitar'); ?>
            <?php echo $form->checkBox($model, 'isLibretamilitar'); ?>
            <?php echo $form->error($model, 'isLibretamilitar'); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($model, 'isInhabilidades'); ?>
            <?php echo $form->checkBox($model, 'isInhabilidades'); ?>
            <?php echo $form->error($model, 'isInhabilidades'); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($model, 'isListaonu'); ?>
            <?php echo $form->checkBox($model, 'isListaonu'); ?>
            <?php echo $form->error($model, 'isListaonu'); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($model, 'isOfac'); ?>
            <?php echo $form->checkBox($model, 'isOfac'); ?>
            <?php echo $form->error($model, 'isOfac'); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($model, 'isInterpol'); ?>
            <?php echo $form->checkBox($model, 'isInterpol'); ?>
            <?php echo $form->error($model, 'isInterpol'); ?>
        </div>
    </fieldset>
    
    <div class="row">
        <?php echo $form->labelEx($model, 'quantitativeEvaluation'); ?>
        <?php echo $form->dropDownList($model, 'quantitativeEvaluation', Controller::$optionsYesNo); ?>
        <?php echo $form->error($model, 'quantitativeEvaluation'); ?>
    </div>
    
    <div class="row">
        <?php echo $form->labelEx($model, 'inquiriesTD'); ?>
        <?php echo $form->numberField($model, 'inquiriesTD', array('size' => 60, 'maxlength' => 10)); ?>
        <?php echo $form->error($model, 'inquiriesTD'); ?>

        <a style="padding-left: 10px;"></a><b>Usuario TD:</b>
            <select id="status" name="status" onChange="mostrar(this.value);">
                <option>....</option>
                <option value="SI">Si</option>
                <option value="NO">No</option>
            </select>
    </div>

    <div id="SI" style="display: none;">
    <fieldset>
        <legend><b>Tus Datos</b></legend>  
        <div class='row'>
            <a style="padding-left: 90px;"></a>Usuario:
            <?php echo $form->textField($model, 'UsuarioTD',array('size'=>30, 'maxlength'=> 255)); ?>
            <a style="padding-left: 10px;"></a>Clave:
            <?php echo $form->passwordField($model, 'ClaveTD',array('size'=>30, 'maxlength'=> 255)); ?>
        </div>
    </fieldset>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'userId'); ?>
        <?php echo $form->dropDownList($model, 'userId', //
                CHtml::listData(User::model()->findAll(array('order' => 'isActive desc,firstName')), 'id', 'summaryLine'), array('prompt' => '...'));
        ?>
<?php echo $form->error($model, 'userId'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'sacId'); ?>
        <?php echo $form->dropDownList($model, 'sacId', //
            CHtml::listData(User::model()->findAll(array('order' => 'isActive desc,firstName')), 'id', 'summaryLine'), array('prompt' => '...'));
        ?>
        <?php echo $form->error($model, 'sacId'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'salesmanId'); ?>
        <?php echo $form->dropDownList($model, 'salesmanId', //
                CHtml::listData(User::model()->findAll(array('order' => 'isActive desc,firstName')), 'id', 'summaryLine'), array('prompt' => '...'));
        ?>
<?php echo $form->error($model, 'salesmanId'); ?>
    </div>

    <div class="row buttons">
    <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->