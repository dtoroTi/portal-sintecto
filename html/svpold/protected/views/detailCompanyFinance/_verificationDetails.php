<?php
echo $this->renderPartial('/detailCompanyFinance/_verificationDetail', array(
    'verificationSection' => $verificationSection,
    'company' => $verificationSection->detailCompanyFinance,
));
?>
<br>
<div class="SvpTable" style="">
    <h1>Consulta información en TransUnion</h1>
    <?php 
        Yii::import('application.extensions.TransUnion.*');
        $register = BackgroundCheck::model()->findByPk([$verificationSection->backgroundCheckId]);
        
        $type = "";
        $number = "";
        if (stristr($register->idNumber, 'CE') !== false) {
          $type = '3';
          $number = substr($register->idNumber, 2);
          $force = false;
        } else if (stristr($register->idNumber, 'PP') !== false) {
          $type = '5';
          $number = substr($register->idNumber, 2);
          $force = false;
        } else if (stristr($register->idNumber, 'NIT') !== false) {
          $type = '2';
          $number = substr($register->idNumber, 3);
          $force = false;
        } else if (stristr($register->idNumber, 'TI') !== false) {
            $type = '4';
            $number = substr($register->idNumber, 2);
            $force = false;
        } else if (stristr($register->idNumber, 'PEP') !== false) {
          $type = '12';
          $number = substr($register->idNumber, 3);
          $force = false;
        } else {
          $type = '1';
          $number = $register->idNumber;
          $force = true;
        }
    
        $id=$register->id;
   
        $toreplace = array("/", " ", "\\", "*", "CE", "NIT", "TI", "PEP", "PP");
        $numero = str_replace($toreplace, "", $number);
        $name=$numero.'_InfComercial';

        $criteria = new CDbCriteria;
        $criteria->addCondition('t.backgroundCheckId=:backgroundCheckId');
        $criteria->addCondition("t.name=:namedoc");
        $criteria->params=[':backgroundCheckId'=>$id, ':namedoc'=>$name];
        $documents = Document::model()->findAll($criteria);
    if(!$documents){?>
    <button id="infComer3" name = "infComer3" value="view_manual3">Ejecutar Consulta</button>
    <?php } ?>         
<?php
    Yii::app()->clientScript->registerScript('search3', "
        $('#infComer3').click(function(){    

            let text3 = 'Esta seguro de ejecutar la consulta de Informacion Comercial?';
            if (confirm(text3) == true) {
            event.preventDefault();

            alert('El sistema tarda un momento para generar una respuesta, por favor espere.');

            $.ajax({

                type: 'GET',

                url: '/detailFinancial/transUnionIC?codInfo=154&motConsulta=18&typedoc=".$type."&idnumber=".$number."&bckid=".$id."',

                data: $(this).serialize(),

            }).done(function(data) {
                    alert(data);
                    location.reload();

            });
            } else {
            }

        });
    ");   

    if($documents){
      foreach ($documents as $document){
        //echo 'Nombre del Documento: '.$document->name."<br>";
        //echo 'Nombre TD: '.$numero.'_CIFIN'."<br>";
        if($document->name==$name){
          //echo 'entro....';
          $iddoc=$document->id;
          $src=Yii::app()->params['urlAccesApi']['url']."/document/file/$iddoc.html";
          //$src="https://svp.securityandvision.com:2443/document/file/$iddoc.html";
        }else{
          $src="";
        }
      }
    }else{
      $src="";
    }
    
    if($src==""){
      echo '<h2>No se ha generado la Vista.</h2>';
    }else if($src!=""){

            if(empty($type) || empty($number)){
                  echo 'ocurrio un error tipo de documento no valido \n';
    
            }else{
                
                ?>
                <input type="button" name="view_TU3" id="view_TU3" value="Vista" onclick="toggleIfrm('apDiv3')" />
                <div id="apDiv3" style="visibility:hidden">
 
                <iframe id="viewsTransUnion3" src="<?= $src ?>" style="border:none; width: 100%; height: 500px;">
                </iframe>
                </div>
                <?php
            }

        }
 ?>

</div>
<script>

      function toggleIfrm(id) {
        if(document.getElementById(id).style.visibility=="hidden") {

          document.getElementById(id).style.visibility="visible";

        }else {

          document.getElementById(id).style.visibility="hidden";
          
        }

      }

</script>