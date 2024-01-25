<app>
<?php foreach($backgroundChecks as $backgroundCheck) :?>
<backgroundCheck code="<?php echo CHtml::encode($backgroundCheck->code)?>"
                 fullName="<?php echo CHtml::encode($backgroundCheck->fullName)?>"
                 studyStartedOn="<?php echo CHtml::encode($backgroundCheck->studyStartedOn)?>"
                 city="<?php echo CHtml::encode($backgroundCheck->city)?>"
                 state="<?php echo CHtml::encode($backgroundCheck->state)?>"
                 address="<?php echo CHtml::encode($backgroundCheck->address)?>"
                 area="<?php echo CHtml::encode($backgroundCheck->area)?>"
                 tels="<?php echo CHtml::encode($backgroundCheck->tels)?>"
                 />
<?php endforeach;?>
</app>