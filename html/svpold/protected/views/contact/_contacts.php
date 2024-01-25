<script type="text/javascript">
  function ValiduntilFD() {
    if (confirm("Está seguro de actualizar la fecha limite, para el vencimiento del formulario dinamico?")) {
        var a = document.createElement('a');
        a.href = '/contact/updateValiduntilFD?' +
                'id=<?php echo CHtml::encode($backgroundCheck->id) ?>' +
                '&datetime=' + $("#validuntilFD").val() +
                '&pc=<?php echo CHtml::encode($pc) ?>';
        a.click();

        $(this).dialog("close");
    }
  }

  function ValiduntilFDDoc() {
    if (confirm("Está seguro de actualizar la fecha limite, para el vencimiento del formulario dinamico?")) {
        var a = document.createElement('a');
        a.href = '/contact/updateValiduntilFDDoc?' +
                'id=<?php echo CHtml::encode($backgroundCheck->id) ?>' +
                '&datetime=' + $("#reciptExpiration").val() +
                '&pc=<?php echo CHtml::encode($pc) ?>';
        a.click();

        $(this).dialog("close");
    }
  }
</script>
<div class="ProcessTab">
<fieldset>
<?php 
echo CHtml::button('Envío Correo Visitadores', array('onclick' => 'ans=confirm("Está seguro de enviar el correo electronico: ' . $backgroundCheck->code. '?");if (ans) {document.location.href="/contact/contactCustomerVisit?id=' . $backgroundCheck->id . '&pc=' . $pc . '";}'));
 ?>
</fieldset>
</div>
<?php
if($backgroundCheck->customerProduct->viewDynamicForm==1){?>
<div class="ProcessTab">
  <?php if($backgroundCheck->customer->isRecover==0){?>
  <fieldset>
    <legend>
      <a name="contacts">
        Contactos
      </a>
    </legend>  

      <div class="flash-notice">
        <?php echo 'La <b>RESOLUCIÓN 5050 DE 2016, </b> Establece que el envío de SMS y/o USSD con fines comerciales y/o publicitarios solo podrán ser enviados a los usuarios entre las ocho de la mañana (8:00 a. m.) y las nueve de la noche (9:00 p. m.).';?>
      </div>

    <center>
    <div>
      <b><?php echo CHtml::encode($backgroundCheck->getAttributeLabel('validuntilFD')); ?>:</b>
      <?php 
      $this->widget('jqueryDateTime', [
          'name' => 'validuntilFD',
          'value' => $backgroundCheck->validuntilFD,
          // additional javascript options for the date picker plugin
          'options' => [
              'showAnim' => 'fold',
              'buttonText' => '...',
              'format' => 'Y-m-d H:i:s',
              'lang' => 'es',
              'showButtonPanel' => true,
              'changeYear' => true,
              'changeMonth' => true,
          ],
          'htmlOptions' => [
              'style' => 'width:10em;',
              'readonly' => 'readonly',
          ],
        ]);
      ?>
      <b style="padding-left: 2px;">
      <?php
        if (!$backgroundCheck->statusFD==1) {
          $disabled='';
        }else{
          $disabled='true';
        }

        echo CHtml::button('Actualizar', array('onclick' =>'ValiduntilFD();', 'disabled'=>$disabled));
      ?>

      <?php if (Yii::app()->user->hasFlash('datelimitsucces')): ?>
        <div class="flash-success">
          <?php echo Yii::app()->user->getFlash('datelimitsucces'); ?>
        </div>
      <?php endif; ?>

      <?php if (Yii::app()->user->hasFlash('datelimit')): ?>
        <div class="flash-error">
          <?php echo Yii::app()->user->getFlash('datelimit'); ?>
        </div>
      <?php endif; ?>

    </div><br>
    <div>
        <?php
            echo CHtml::button('Envío Correo Electrónico', array('onclick' => 'ans=confirm("Está seguro de enviar el correo electronico: ' . $backgroundCheck->code. '?");if (ans) {document.location.href="/contact/contactCustomer?id=' . $backgroundCheck->id . '&pc=' . $pc . '";}', 'disabled'=>$disabled));
        ?>
        <?php
            echo CHtml::button('Envío Mensaje de Texto', array('onclick' => 'ans=confirm("Está seguro de enviar el mensaje de texto : ' . $backgroundCheck->code. '?");if (ans) {document.location.href="/contact/sendTextMessage?id=' . $backgroundCheck->id . '&pc=' . $pc . '";}', 'disabled'=>$disabled));
        ?>
        <?php
            echo CHtml::button('Llamar', array('onclick' => 'ans=confirm("Está seguro de realizar la llamada : ' . $backgroundCheck->code. '?");if (ans) {document.location.href="/contact/sendToCallInd?id=' . $backgroundCheck->id . '&pc=' . $pc . '";}', 'disabled'=>$disabled));
        ?>
    </div>
    </center><br><br>
    <div class="form wide">
      <?php
        echo CHtml::beginForm(
        array('/contact/update', 'code' => $backgroundCheck->code, 'pc' => $pc), //
        'post', //
        array(
          'id' => "contacts",
        )
      );
      ?>
        <table style="width:100%">

        <?php foreach ($contacts as $contact): ?>
          <?php
          echo $this->renderPartial('/contact/_contact', array(
              'backgroundCheck' => $backgroundCheck,
              'contact' => $contact,
              'pc' => $pc,
          ));
          ?>
        <?php endforeach; ?>
        <?php
        /*$contact = new Contact();
        echo $this->renderPartial('/contact/_contact', array(
            'backgroundCheck' => $backgroundCheck,
            'contact' => $contact,
            'pc' => $pc,
        ));*/
        ?>

      </table>
    </div>
    <?php echo CHtml::endForm(); ?>
  </fieldset>
  <?php }else if($backgroundCheck->customer->isRecover==1){?>
  <fieldset>
    <legend>
      <a name="contacts">
        Recaudo
      </a>
    </legend>  
    <center>
    <div>
      <?php 

        if (!$backgroundCheck->statusFD==1) {
          $disabled='';
        }else{
          $disabled='true';
        }

        echo CHtml::button('Envío Correo Electrónico SP', array('onclick' => 'ans=confirm("Está seguro de enviar el correo electronico: ' . $backgroundCheck->code. '?");if (ans) {document.location.href="/contact/contactCustomerRecover?id=' . $backgroundCheck->id . '&pc=' . $pc . '&val=1";}', 'disabled'=>$disabled));
      ?>
      <b>Limite Formulario Dinámico SP:</b>
      <?php 

      $this->widget('jqueryDateTime', [
          'name' => 'validuntilFD',
          'value' => $backgroundCheck->validuntilFD,
          // additional javascript options for the date picker plugin
          'options' => [
              'showAnim' => 'fold',
              'buttonText' => '...',
              'format' => 'Y-m-d H:i:s',
              'lang' => 'es',
              'showButtonPanel' => true,
              'changeYear' => true,
              'changeMonth' => true,
          ],
          'htmlOptions' => [
              'style' => 'width:10em;',
              'readonly' => 'readonly',
          ],
        ]);
      ?>
      <b style="padding-left: 2px;">
      <?php
        echo CHtml::button('Actualizar', array('onclick' =>'ValiduntilFD();', 'disabled'=>$disabled));
      ?><br><br>

      <?php if (Yii::app()->user->hasFlash('datelimitsucces')): ?>
        <div class="flash-success">
          <?php echo Yii::app()->user->getFlash('datelimitsucces'); ?>
        </div>
      <?php endif; ?>

      <?php if (Yii::app()->user->hasFlash('datelimit')): ?>
        <div class="flash-error">
          <?php echo Yii::app()->user->getFlash('datelimit'); ?>
        </div>
      <?php endif; ?>
      <?php
          if (!$backgroundCheck->reciptFileStatus==1) {
            $disabled2='';
          }else{
            $disabled2='true';
          }
      
          echo CHtml::button('Envío Correo Electrónico Doc.', array('onclick' => 'ans=confirm("Está seguro de enviar el correo electronico: ' . $backgroundCheck->code. '?");if (ans) {document.location.href="/contact/contactCustomerRecover?id=' . $backgroundCheck->id . '&pc=' . $pc . '&val=2";}', 'disabled'=>$disabled2));
      ?>
      <b>Limite Formulario Dinámico Doc:</b>
          <?php 
    
          $this->widget('jqueryDateTime', [
              'name' => 'reciptExpiration',
              'value' => $backgroundCheck->reciptExpiration,
              // additional javascript options for the date picker plugin
              'options' => [
                  'showAnim' => 'fold',
                  'buttonText' => '...',
                  'format' => 'Y-m-d H:i:s',
                  'lang' => 'es',
                  'showButtonPanel' => true,
                  'changeYear' => true,
                  'changeMonth' => true,
              ],
              'htmlOptions' => [
                  'style' => 'width:10em;',
                  'readonly' => 'readonly',
              ],
            ]);
          ?>
          <b style="padding-left: 2px;">
          <?php
            echo CHtml::button('Actualizar', array('onclick' =>'ValiduntilFDDoc();', 'disabled'=>$disabled2));
          ?>
    </div>
    </center><br><br>
    <div class="form wide">
      <?php
        echo CHtml::beginForm(
        array('/contact/update', 'code' => $backgroundCheck->code, 'pc' => $pc), //
        'post', //
        array(
          'id' => "contacts",
        )
      );
      ?>
        <table style="width:100%">

        <?php foreach ($contacts as $contact): ?>
          <?php
          echo $this->renderPartial('/contact/_contact', array(
              'backgroundCheck' => $backgroundCheck,
              'contact' => $contact,
              'pc' => $pc,
          ));
          ?>
        <?php endforeach; ?>
        <?php
        /*$contact = new Contact();
        echo $this->renderPartial('/contact/_contact', array(
            'backgroundCheck' => $backgroundCheck,
            'contact' => $contact,
            'pc' => $pc,
        ));*/
        ?>

      </table>
    </div>
    <?php echo CHtml::endForm(); ?>
  </fieldset>
  <?php } ?>

  <fieldset>
    <legend>
      <a name="logDynamicForms">
        Log Formulario Dinámico
      </a>
    </legend>  

    <div>

        <?php if (Yii::app()->user->hasFlash('contacts')): ?>
          <div class="flash-success">
            <?php echo Yii::app()->user->getFlash('contacts'); ?>
          </div>
        <?php endif; ?>
                    
        <?php if (Yii::app()->user->hasFlash('contactsError')): ?>
          <div class="flash-error">
            <?php echo Yii::app()->user->getFlash('contactsError'); ?>
          </div>
        <?php endif; ?>

        <?php
            $logDynamicForms=LogDynamicForm::model()->findAllByAttributes(['backgroundcheckId'=>$backgroundCheck->id], ['order'=>'idDynamicForm']);
            if($backgroundCheck->ooidFD!="" || $logDynamicForms){
              
              if($backgroundCheck->customer->isRecover==0){
                echo CHtml::button('Actualizar Log', array('onclick' => '{document.location.href="/contact/logDinamycForm?id=' . $backgroundCheck->id . '&pc=' . $pc . '";}', 'disabled'=>$disabled));
              ?>
              <?php
                  echo CHtml::button('Restablecer Clave Candidato', array('onclick' => 'ans=confirm("Está seguro de restablecer la clave del candidato en el formulario dinámico? ");if (ans) {document.location.href="/contact/restorepassword?id=' . $backgroundCheck->id . '&pc=' . $pc . '";}', 'disabled'=>$disabled));
              }
              ?>
            <?php
                //echo CHtml::button('Eliminar Formulario Dinámico', array('onclick' => 'ans=confirm("Está seguro de eliminar el formulario dinámico? ");if (ans) {document.location.href="/contact/deleteDynamicForm?id=' . $backgroundCheck->id . '&pc=' . $pc . '";}', 'disabled'=>$disabled));
            ?>
            <br><br>
            <center>
            <table style="width:100%">
            <tr>
              <th>IP</th>
              <th>Comentarios</th>
              <th>Creado</th>
            </tr>
            <?php 
            //if($logDynamicForms){
              foreach ($logDynamicForms as $logDynamicForm){
                echo $this->renderPartial('/contact/_logDinamycForm', array(
                  'backgroundCheck' => $backgroundCheck,
                  'logDynamicForm' => $logDynamicForm,
                  'pc' => $pc,
                ));
              }
            //}
            ?>
            </table>
            <?php
            }else{
            ?>
              <div class="flash-notice">
                <?php echo 'La persona asociada a este estudio, no se le ha enviado un correo con el Formulario Dinámico.';?>
              </div>
          <?php
            }
          ?>
    </div>
    </center><br>

  </fieldset>
</div>
<?php } ?>
</div><!--form-->