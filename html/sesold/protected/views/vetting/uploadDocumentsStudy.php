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

<div class="alert alert-warning">
    <b>NOTA:</b><br> 
    La carga de los documentos se encuentra habilitada una vez el estudio es solicitado,  
    esto unicamente hasta que desde SINTECTO cambie el estado del proceso.
</div>
<h4>Cargue de Documentos a estudios Solicitados</h4>

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
                    <th><center>Expedido</center></th>
                    <th><center>Teléfono</center></th>
                    <th><center>Cargo Aspira</center></th>
                    <th><center>Estado</center></th>
                    <th><center>Subir Documentos</center></th>
                    <th><center>Documentos</center></th>                                      
                </tr>
            </thead>
            <tbody>
               <?php 
                $customerUser = Yii::app()->user->arUser->customerId;

                $criteria = new CDbCriteria;
        
                $criteria->addCondition('t.customerId=:customerId');
                $criteria->addCondition("t.backgroundCheckStatusId=1 OR t.backgroundCheckStatusId=5");
                $criteria->params=[':customerId'=>$customerUser];
                $criteria->order = 't.id DESC';
                $Regsubidos= BackgroundCheck::model()->findAll($criteria);

                foreach ($Regsubidos as $result ): 
                $results = BackgroundCheckStatus::model()->findByPk($result['backgroundCheckStatusId']);

                ?>
                    <tr>
                        <td><?php echo $result['code']; ?></td>
                        <td><?php echo $result['firstName'].' '.$result['lastName']; ?></td>
                        <td><?php echo $result['idNumber']; ?></td>
                        <td><?php echo $result['idFrom']; ?></td>
                        <td><?php echo $result['tels']; ?></td>
                        <td><?php echo $result['applyToPosition']; ?></td>
                        <td><?php echo $results['name']; ?></td>
                        <td><center><button type="button" id="<?php echo $result['code']; ?>" data-toggle="modal" data-target="#dialogupload" class="secc_docs btn-primary btn-sm" data-descr="<?php echo $result['firstName'].' '.$result['lastName']; ?>"><img src="../../mantenimiento/images/subirDocs.png"/></center></button></td>
                      
                        <?php 

                        $criteria = new CDbCriteria;
                                
                        $criteria->addCondition('t.backgroundCheckId=:backgroundCheckId');
                        $criteria->params=[':backgroundCheckId'=>$result['id']];
                        $documents = Document::model()->findAll($criteria);
                        
                        ?>

                        <td>  
                        <?php foreach ($documents as $doc): ?> 
                            <?php //echo $doc['name'].'.'.$doc['extension']; ?>
                            <?php 
                                echo CHtml::link($doc['name'].'.'.$doc['extension'], array('/Vetting/file', 'id' => $doc['id']), array('target' => '_blank')) ?>
                            <?php 
                            if($result['backgroundCheckStatusId']==BackgroundCheckStatus::REQUESTED): ?>
                                <a href="<?php echo $this->createUrl('Vetting/deleteDocumentsClient', array('id' => $doc['id'], 'code' =>$result['code'])) ?>" 
                                title="Borrar"
                                onClick="return (confirm('Realmente desea borrar <?php echo $doc['name'].'.'.$doc['extension']; ?> del código de estudio <?php echo $result['code']; ?> ?'));"> 
                                    <span><img src="../../mantenimiento/images/remove.png"/></span> 
                                </a>
                            <?php 
                            endif;
                            ?>
                            <br>
                            <?php
                            endforeach; ?>   
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </fieldset>
</div>

<div class="modal fade" id="dialogupload" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <?php
                    $form = $this->beginWidget('CActiveForm', [
                        'id' => 'company-security-evaluation-form',
                        'enableAjaxValidation' => false,
                        'action' => ['/vetting/uploadDocuments'],
                        'method'=>'POST',
                        'htmlOptions' => (['enctype' => 'multipart/form-data']),
                        ]
                    );
                ?>    
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Documentos relacionados</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="alert alert-warning">
                    <b>NOTA:</b><br> 
                    La cantidad de archivos es de 5 en cada solicitud, sin embargo, si es requerido puede seguir cargando documentos mientras el estudio continue en proceso o solicitado.
                </div>
                <div class="modal-body">
                <b>Ref: <input type="text" name="code" id="code" value="" class="redondeado confondo" style="width:15%" readonly/></b>
                <b>Nombres: <input type="text" name="name" id="name" value="" class="redondeado confondo" style="width:50%" readonly/></b><br><br>

                <?php for ($i = 1; $i <= 5; $i++) : ?>
                    <div class="row"  style="padding-left: 45px; visibility: <?php echo ($i > 2 ? 'hidden' : 'visible') ?>" id="docFile<?php echo $i ?>">
                        <input type="file" name="DocForm[doc<?php echo $i ?>]" id="DocForm[doc<?php echo $i ?>]" style="width:50%" accept="doc/*,docx/*,pdf/*,jpg/*,png/*"/><br><br>
                        <?php if ($i < 5 and $i > 1): ?>
                            <input  type="button" value="Más archivos" style="width:20%" onClick="js:$('#docFile<?php echo ($i + 1) ?>').css('visibility', 'visible');
                                            $(this).css('visibility', 'hidden');"/>
                            <?php endif ?>
                    </div>
                <?php endfor; ?>

                <div class="upload-msg"></div><!--Para mostrar la respuesta del archivo llamado via ajax -->
                </div>
                <div class="modal-footer">
                    <input type="submit"></input>
                </div>
                <?php $this->endWidget(); ?>
            </div>
        </div>
</div>

<script src="../../mantenimiento/js/jquery-3.5.1.min.js"></script>
<script src="../../mantenimiento/js/bootstrap.min.js"></script>
<script src="../../mantenimiento/js/datatables.min.js"></script>
<script type="text/javascript">


$(document).ready( function () {
    $('#mytable').DataTable();
} );

$(document).on('click', '.secc_docs', function () {
    var code = $(this).attr('id');
    $('#code').val(code);
    var descr = $(this).attr('data-descr');
    $('#name').val(descr);
});

//Llamar ventanas modal
$('#myModal').on('shown.bs.modal', function () {
    $('#myInput').trigger('focus')
})

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

$(document).on('change','input[type="file"]',function(){

	var fileName = this.files[0].name;
	var fileSize = this.files[0].size;

    patron=/(\"|\')/
    if(fileName.split('.').length!=2 || patron.test(fileName)) {
        alert('Sólo debe haber un punto en el archivo, el de la extensión únicamente, ninguno en el nombre!!')
        this.value = '';
		this.files[0].name = '';
    }else if(fileSize > 20000000){
		alert('El archivo no debe superar los 20MB.');
		this.value = '';
		this.files[0].name = '';
	}else{
		// recuperamos la extensión del archivo
		var ext = fileName.split('.').pop();

		// Convertimos en minúscula porque 
		// la extensión del archivo puede estar en mayúscula
		ext = ext.toLowerCase();

		switch (ext) {
			case 'doc':
			case 'docx':
			case 'pdf':
            case 'png':
			case 'jpg': break;
			default:
				alert('El archivo no tiene la extensión adecuada (doc, docx, pdf, jpg y png).');
				this.value = ''; // reset del valor
				this.files[0].name = '';
		}
	}
});
</script>
</script>
