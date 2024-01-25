<div class="SvpTable" >
  <table>
   <?php 

  $seccionpreg=$verificationSection->verificationSectionTypeId;
         if($seccionpreg==18){
          echo 'RECURSOS HUMANOS';echo "<br>";echo "<br>";echo "<br>";          
          echo "  <th> Cargo  </th>";
          echo "  <th> Cantidad </th>"; 
          foreach ($verificationSection->detailQuestions as $question){
            
            if($question['sectionTypeQuestionId']=='10' || $question['sectionTypeQuestionId']=='11' || $question['sectionTypeQuestionId']=='12' || $question['sectionTypeQuestionId']=='13' || $question['sectionTypeQuestionId']=='14' || $question['sectionTypeQuestionId']=='15' ){      
            echo $this->renderPartial('/detailQuestion/_verificationDetail', array(
                'verificationSection' => $verificationSection,
                'question' => $question,
            ));
            }
          }          
          echo "  <th> Tipo de Contrato  </th>";
          echo "  <th> Cantidad </th>"; 
          foreach ($verificationSection->detailQuestions as $question){
            
            if($question['sectionTypeQuestionId']=='16' || $question['sectionTypeQuestionId']=='17' || $question['sectionTypeQuestionId']=='21' || $question['sectionTypeQuestionId']=='22' || $question['sectionTypeQuestionId']=='23' ){      
            echo $this->renderPartial('/detailQuestion/_verificationDetail', array(
                'verificationSection' => $verificationSection,
                'question' => $question,
            ));
            }
          }    
          echo "  <th> Modalidad de Contratación </th>";
          echo "  <th> Cantidad </th>"; 
          foreach ($verificationSection->detailQuestions as $question){
            
            if($question['sectionTypeQuestionId']=='18' || $question['sectionTypeQuestionId']=='19' || $question['sectionTypeQuestionId']=='20'){      
            echo $this->renderPartial('/detailQuestion/_verificationDetail', array(
                'verificationSection' => $verificationSection,
                'question' => $question,
            ));
            }
          }            
            
        }else{
          
              foreach ($verificationSection->detailQuestions as $question){
                  echo $this->renderPartial('/detailQuestion/_verificationDetail', array(
                      'verificationSection' => $verificationSection,
                      'question' => $question,
                  ));
              }
          }
      ?>
  </table>  
</div>

<?php // print_r($verificationSection->detailQuestions);?>
