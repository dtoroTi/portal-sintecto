<?php
/* @var $backgroundChecks BackgroundCheck[] */
?>

<div class="form wide">
    <?php echo CHtml::beginForm(array('/vetting/selectNovd/'), 'get', array('id' => 'SelectForm','target'=>'_blank')); ?>

    ESTUDIO: <b><?php echo $bgkcode; ?></b><br/>
    <?php echo CHtml::hiddenField('bgkcode','value', array('bgkcode' => 'bgkcode')); 

        $events = new Event;
        if($events){
            $DetNotificaicones = $events->getEventsStudy($bgkcode);
        }
        ?>
        
        <div class="alert alert-warning">
            <b>NOTA:</b><br> 
            Tener en cuenta, Si la fecha informada al cliente fue hace más de 1 día, el sistema no permite agregar un comentario a esta Novedad.
        </div>
        
        <fieldset>
        <table class="table-striped">
            <thead class="table-primary"> 
                <tr>
                    <th><center>Tipo</center></th>
                    <th><center>Tipo Reporte</center></th>
                    <th><center>Detalle</center></th>
                    <th><center>Fecha Informada al cliente</center></th>
                    <th><center>Días Transcurridos</center></th>
                    <th><center>Comentario</center></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            <?php  foreach ($DetNotificaicones AS $not): 

                $firstDate  = new DateTime($not->informedToCustomerOn);
                $secondDate = new DateTime("now");

                $intvl = $firstDate->diff($secondDate);
                //echo "dias: ".$intvl->days."\n";
            ?>
                <tr>
                <?php if($not->eventType->name=="Informativa"): ?>   
                    <td><font color ="#02690E"><?php echo CHtml::encode($not->eventType->name); ?></font></td>
                <?php else: ?>   
                    <td><font color ="#D32500"><?php echo CHtml::encode($not->eventType->name); ?></font></td>
                <?php endif; ?>   
                <td><?php echo CHtml::encode($not->eventTypeNews->name); ?></td>
                <td><?php echo CHtml::encode($not->detail); ?></td>
                <td><?php echo CHtml::encode($not->informedToCustomerOn); ?></td>
                <td><center><?php echo CHtml::encode($intvl->days); ?></center></td>
                <?php if(($not->customerComment==NULL || empty($not->customerComment)) && $intvl->days<=1){ ?>
                <td><textarea name="observacion_<?= $not->id ?>" id="observacion_<?= $not->id ?>" rows="2" cols="25" maxlength="255"><?php echo $not->customerComment ?></textarea>
                </td>
                <td>
                <button name="guardar"  class="btn btn-primary"><a href="javascript:submitregobs($('#observacion_<?php echo $not->id ?>').val(), '<?php echo  $not->id ?>', '<?php echo  $bgkcode ?>', '<?php echo $not->customerAnswerCode ?>')">Guardar</button>
                </td>
                <?php }else{?>
                    <td id="observacion"><?php echo $not->customerComment ?></td>
                    <td></td>
                <?php } ?>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </fieldset>
    <br/>

  
   
    <?php echo CHtml::endForm();
    ?>

</div><!-- form -->

<script>
function submitregobs(obs, id, code, answercode){

    //la condición
    if (obs.length == 0 || /^\s+$/.test(obs)) {
        alert('No ha Ingresado ningun comentario.');
    }else{
        $.ajax({
        type:'POST',
        url: "/vetting/insertComents.html",
        dataType: "json",
        data: { 
            'idn':  id,
            'obs':  obs,
            'code': code,
            'answercode':answercode,
        },
        context: document.body
        }).done(function(resp) {
            $( this ).addClass( "insertComents" );
            console.log(resp);
            if(resp>0){
                alert('¡¡EL COMENTARIO HA SIDO ENVIADO CON ÉXITO!!.');
            }
        });
    }

}
</script>
