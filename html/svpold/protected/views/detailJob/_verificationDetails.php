<div class="SvpTable" style="">
    <table>
        <tr>
            <th width="75em">Inicio</th>
            <th width="75em">Fin</th>
            <th width="30em">Tiempo</th>
            <th>Compañía</th>
            <th>Ciudad</th>
            <th>Cargo</th>
            <th>Activo</th>
            <th>Verificación</th>
            <th>Comentario</th>
        </tr>
        <?php $previousWork = null; 
              $resultA=0;
              $resultM=0;
        ?>
        <?php foreach ($verificationSection->detailJobs as $job): ?>
            <?php
            if ($previousWork && VerificationSection::diffTimeIsBiggerThan(
                    $previousWork, $job->startedOn, DetailJob::INACTIVITY_WARNING_DAYS)):
                ?>
                <tr class="inactivity">
                    <td><?php echo CHtml::encode(substr($previousWork, 0, 7)); ?></td>
                    <td><?php echo CHtml::encode(substr($job->startedOn, 0, 7)); ?></td>
                    <td><?php echo VerificationSection::diffTime($previousWork, $job->startedOn); ?></td>
                    <td colspan="6">Periodo sin Descripción por más de <?php echo CHtml::encode(DetailJob::INACTIVITY_WARNING_DAYS); ?> días</td>

                </tr>

            <?php endif ?>
            <?php $previousWork = $job->finishedOn; 
            if($job->activityTypeId==1 || $job->activityTypeId==2){
                $total = VerificationSection::diffTime($job->startedOn, $job->finishedOn);
                $numeros = preg_match_all('!\d+!', $total, $matches);
                $valA=(int)$matches[0][0];
                $valM=(int)$matches[0][1];
                $resultA=$resultA + $valA;
                $resultM=$resultM + $valM;
            }

            ?>
            <tr>
                <td><?php echo CHtml::encode(substr($job->startedOn, 0, 10)); ?></td>
                <td><?php echo ($job->stillWorking ? '-- --' : CHtml::encode(substr($job->finishedOn, 0, 10))); ?></td>
                <td><?php echo VerificationSection::diffTime($job->startedOn, $job->finishedOn); ?></td>
                <?php if ($job->activityTypeId == null || $job->activityTypeId == ActivityType::EMPLOYED || $job->activityTypeId == ActivityType::SELF_EMPLOYED) : ?>
                    <td><?php echo CHtml::encode($job->company); ?></td>
                <?php else: ?>
                    <td><?php echo CHtml::encode($job->activityType->name); ?></td>
                <?php endif; ?>
                <td><?php echo CHtml::encode($job->city); ?></td>
                <td><?php echo CHtml::encode($job->lastPosition); ?></td>
                <td><?php echo Controller::stringYesNo($job->stillWorking); ?></td>
                <td><?php echo CHtml::encode($job->verificationResult->name); ?></td>
                <td><?php echo CHtml::encode($job->comments) ?></td>

            </tr>
        <?php endforeach; 

            $resultMA=0;
            for ($i = 0; $i <= $resultM; $i++) {
                if($resultM>=12){
                    $resultM = $resultM -12;
                    $resultMA++;
                }else{
                    $resultM = $resultM;
                }
            }

            $resultAT = $resultA + $resultMA;
            $total_tiempo= $resultAT.'a, '.$resultM.'m';
        ?>
        <?php
        if ($previousWork && !$job->stillWorking && VerificationSection::diffTimeIsBiggerThan(
                        $previousWork, "now", DetailJob::INACTIVITY_WARNING_DAYS)):
            ?>
            <?php $now = new DateTime("now"); ?>
            <tr class="inactivity">
                <td><?php echo CHtml::encode(substr($previousWork, 0, 7)); ?></td>
                <td><?php echo CHtml::encode(substr($now->format("Y-m"), 0, 7)); ?></td>
                <td><?php echo VerificationSection::diffTime($previousWork, "now"); ?></td>
                <td colspan="6">Periodo sin Descripción por más de <?php echo CHtml::encode(DetailJob::INACTIVITY_WARNING_DAYS); ?> días</td>

            </tr>

<?php endif ?>
        <tr>
            <th width="50em"></th>
            <th width="50em"></th>
            <th width="80em"><?php echo CHtml::encode($total_tiempo); ?></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
    </table>

    <h4 style="color:#FF0000";>  <b>Antes de proceder con la validación del Empleador ACTUAL, REVISAR SI SE PUEDE (Autorización) en caso de no contar con ella, llamar al candidato (a) y confirmar.</b></h4>

    <?php //echo CHtml::button('Envío Correos Verificación',array('submit' => array('detailJob/sendEmailJob', 'verificationSection'=>$verificationSection->id), 'class'=>'WithoutAdverse')); ?>

<?php foreach ($verificationSection->detailJobs as $job): ?>
        <?php
        echo $this->renderPartial('/detailJob/_verificationDetail', array(
            'verificationSection' => $verificationSection,
            'job' => $job,
        ));
        ?>
    <?php endforeach; ?>
    <?php
    if ($verificationSection->backgroundCheck->canUpdate) {
        $job = new DetailJob();
        echo $this->renderPartial('/detailJob/_verificationDetail', array(
            'verificationSection' => $verificationSection,
            'job' => $job,
        ));
    }
    ?>
</div>
