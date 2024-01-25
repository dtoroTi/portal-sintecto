<div class="ProcessTab">
  <fieldset>
    <legend>
      <a name="events">
        Novedades
      </a>
    </legend>  

    <?php if (Yii::app()->user->hasFlash('events')): ?>

      <div class="flash-error">
        <?php echo Yii::app()->user->getFlash('events'); ?>
      </div>

    <?php endif; ?>

    <div class="form wide">
      <?php
      echo CHtml::beginForm(
              array('/event/update', 'code' => $backgroundCheck->code, 'pc' => $pc), //
              'post', //
              array(
          'id' => "events",
              )
      );
      ?>
        <table style="width:100%">

        <?php foreach ($events as $event): ?>
          <?php
          echo $this->renderPartial('/event/_event', array(
              'backgroundCheck' => $backgroundCheck,
              'event' => $event,
              'pc' => $pc,
          ));
          ?>
        <?php endforeach; ?>
        <?php
        $event = new Event();
        echo $this->renderPartial('/event/_event', array(
            'backgroundCheck' => $backgroundCheck,
            'event' => $event,
            'pc' => $pc,
        ));
        ?>

      </table>
    </div>
    <?php echo CHtml::endForm(); ?>
  </fieldset>
</div>