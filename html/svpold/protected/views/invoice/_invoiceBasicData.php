<script type="text/javascript">
    function updateInvoiceData() {
        jQuery.ajax({
            // The url must be appropriate for your configuration;
            // this works with the default config of 1.1.11
            url: "<?php echo CHtml::normalizeUrl(array("invoice/getInvoiceData", "id" => $model->id)); ?>",
            type: "POST",
            dataType: "json",
//            data: {ajaxData: 2},
            error: function (xhr, tStatus, e) {
                if (!xhr) {
                    alert(" We have an error ");
                    alert(tStatus + "   " + e.message);
                } else {
                    alert("else: " + e.message); // the great unknown
                }
            },
            success: function (data) {
                $('#invoiceNumStudies').html(data.numStudies);
                $("#invoiceTotal").text('$' + parseFloat(data.total, 10).toFixed(0).replace(/(\d)(?=(\d{3})+$)/g, "$1,").toString());
                $("#invoiceTotalStudies").text('$' + parseFloat(data.totalStudies, 10).toFixed(0).replace(/(\d)(?=(\d{3})+$)/g, "$1,").toString());
            }
        });
    }
</script>


<h1>Factura de <?php echo $model->customerGroup->name . "&nbsp;&nbsp;(No." . $model->number . ")"; ?>  <?php echo CHtml::link('<i class="fa fa-edit"></i>', array('/invoice/update', 'id' => $model->id)) ?></h1>
<?php if ($model->closed): ?><h2>[ ** CERRADA ** ]</h2><?php endif; ?> 

<div class="form wide ProcessTab">
    <fieldset>
        <legend>Factura</legend> 
        <div class="row">
            <strong> <?php echo CHtml::encode($model->getAttributeLabel('invoiceDescriptor')); ?>:</strong>
            <?php echo CHtml::encode($model->invoiceDescriptor);?>
        </div>
        <div class="WideSummary">
            <ul>
                <li>
                    <b><?php echo CHtml::encode($model->getAttributeLabel('from')); ?> : </b> 
                    <?php echo CHtml::encode($model->from); ?> 
                </li>
                <li>
                    <b> <?php echo CHtml::encode($model->getAttributeLabel('until')); ?> : </b>     
                    <?php echo CHtml::encode($model->until); ?> 
                </li>
                <li>
                    <b><?php echo CHtml::encode($model->getAttributeLabel('dueOn')); ?> : </b>
                    <?php echo CHtml::encode($model->dueOn); ?>  
                </li>
                <li>
                    <b><?php echo CHtml::encode($model->getAttributeLabel('closed')); ?> : </b>
                    <?php echo CHtml::encode(Controller::$optionsYesNo[$model->closed]); ?>
                </li>
                <li>
                    <b><?php echo CHtml::encode($model->getAttributeLabel('total')); ?> : </b>
                    <span id="invoiceTotal" class="data"><?php echo "$" . HtmlHelper::amount($model->total); ?></span>
                </li>
                <li>
                    <b><?php echo CHtml::encode($model->getAttributeLabel('totalStudies')); ?> : </b>
                    <span id="invoiceTotalStudies" class="data"><?php echo "$" . HtmlHelper::amount($model->totalStudies); ?></span>
                </li>
                <li>
                    <b><?php echo CHtml::encode($model->getAttributeLabel('numStudies')); ?> : </b>
                    <span id="invoiceNumStudies" class="data"><?php echo HtmlHelper::amount($model->numStudies); ?></span>
                </li>
            </ul>
        </div>
    </fieldset>


</div>
