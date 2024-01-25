<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ProcessView.css" />
<link rel="stylesheet" href="../../css/Chart.css">
<link rel="stylesheet" href="../../css/Bootstrap.css">
<link rel="stylesheet" href="../../css/datatables.min.css">
<?php
$this->breadcrumbs = array(
    'Background Checks' => array('admin'),
    'Create',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('background-check-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<!--<div class="alert alert-danger">
    <b>NOTA:</b><br> 
    Tener en cuenta que los archivos con extensión: doc, docx y xlsx no cuentan con visualización, solo es 
    posible descargarlos. 
</div>-->

<h4>Visualización y Descarga de Documentos por estudio de Seguridad</h4>

<!--<div class="form-group">
    <input type="text" class="form-control pull-right" style="width:30%" id="search" placeholder="Buscar registros...">
</div>-->

<div class="container">
    <fieldset>
        <table  id="mytable" cellspacing="0" style="width: 100%;" class="table table-sm table-striped table-hover table-bordered">
            <thead>
                <tr>
                    <th><center>Ref.</center></th>
                    <th><center>Nombres</center></th>
                    <th><center>No. ID</center></th>
                    <th><center>Teléfono</center></th>
                    <th><center>Cargo Aspira</center></th>
                    <th><center>Fecha Solicitud</center></th>
                    <th><center>Estado</center></th>
                    <th><center>Visualizar</center></th>
                    <th><center>Descargar</center></th>
                </tr>
            </thead>
            <tbody>
               <?php 
//hola
                $date2 = new \DateTime(" "); //'first day of this Month'
                $Date=$date2->format('Y-m-d');

                $customerUser = Yii::app()->user->arUser->customerId;

                $criteria = new CDbCriteria;
        
                $criteria->addCondition('t.customerId=:customerId');
                $criteria->addCondition("t.backgroundCheckStatusId=1 or t.backgroundCheckStatusId=4  or t.backgroundCheckStatusId=5");
                $criteria->addCondition("t.studyStartedOn >= DATE_SUB(NOW(),INTERVAL 6 MONTH)");
                $criteria->with=['backgroundCheckStatus'];
                $criteria->params=[':customerId'=>$customerUser];
                $criteria->order = 't.id DESC';
                $Regsubidos= BackgroundCheck::model()->findAll($criteria);

                foreach ($Regsubidos as $result ): ?>
                    <tr>
                        <td><?php echo $result->code; ?></td>
                        <td><?php echo $result->firstName.' '.$result->lastName; ?></td>
                        <td><?php echo $result->idNumber; ?></td>
                        <td><?php echo $result->tels; ?></td>
                        <td><?php echo $result->applyToPosition; ?></td>
                        <td><center><?php echo $result->studyStartedOn; ?></center></td>
                        <td><?php echo $result->backgroundCheckStatus->name; ?></td>
                      
                        <?php 

                        $criteria = new CDbCriteria;
                                
                        $criteria->addCondition('t.backgroundCheckId=:backgroundCheckId');
                        $criteria->params=[':backgroundCheckId'=>$result['id']];
                        $documents = Document::model()->findAll($criteria);
                        
                        ?>

                        <td>  
                        <?php foreach ($documents as $doc): ?> 
                            <?php echo CHtml::link($doc['name'].'.'.$doc['extension'], array('/Vetting/file', 'id' => $doc['id']), array('target' => '_blank')) ?>
                            <br>
                        <?php endforeach; ?>   
                        </td>

                        <td><center>  
                        <?php foreach ($documents as $doc): ?> 
                            <a href="<?php echo $this->createUrl('/Vetting/fileSaveAs', array('id' => $doc['id'])) ?>"
                            title="Descargar"
                            onClick="return (confirm('Realmente desea descargar el archivo: <?php echo $doc['name'].'.'.$doc['extension']; ?> ?'));"> 
                                <span><img src="../../mantenimiento/images/down-arrow.png"/></span> 
                            </a>
                            <br>
                        <?php endforeach; ?>   
                        </center></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </fieldset>
</div>

<script src="../../mantenimiento/js/jquery-3.5.1.min.js"></script>
<script src="../../mantenimiento/js/bootstrap.min.js"></script>
<script src="../../mantenimiento/js/datatables.min.js"></script>
<script type="text/javascript">


$(document).ready( function () {
    $('#mytable').DataTable();
} );

 $(document).ready(function(){
    $("#search").keyup(function(){
    _this = this;
    // Show only matching TR, hide rest of them
    $.each($("#mytable tbody tr"), function() {
    if($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)
    $(this).hide();
    else
    $(this).show();
    });
    });
});
</script>
</script>
