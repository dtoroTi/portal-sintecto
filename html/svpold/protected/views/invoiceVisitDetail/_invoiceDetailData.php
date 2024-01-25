
<h1>Factura de <?php echo $modelinvoiceVs->user->username . "&nbsp;&nbsp;(No." . $modelinvoiceVs->id . ")"; ?>  
<?php 
if (Yii::app()->user->isAdmin || (Yii::app()->user->getIsByRole() && Yii::app()->user->getHasGlobalPermissionTo(Permission::ALL_ESTUDIOS))): 
echo CHtml::link('<i class="fa fa-edit"></i>', array('/invoiceVisit/update', 'id' => $modelinvoiceVs->id));
endif;
?></h1>
<?php if ($modelinvoiceVs->statusInvoice): ?><h2>[ ** CERRADA ** ]</h2><?php endif; ?> 

<div class="form wide ProcessTab">
    <fieldset>
        <legend>Factura</legend> 
        <div class="row">
            <strong> <?php echo CHtml::encode($modelinvoiceVs->getAttributeLabel('description')); ?>:</strong>
            <?php echo CHtml::encode($modelinvoiceVs->description);?>
        </div>
        <div class="WideSummary">
            <ul>
                <li>
                    <b><?php echo CHtml::encode($modelinvoiceVs->getAttributeLabel('from')); ?> : </b> 
                    <?php echo CHtml::encode($modelinvoiceVs->from); ?> 
                </li>
                <li>
                    <b> <?php echo CHtml::encode($modelinvoiceVs->getAttributeLabel('until')); ?> : </b>     
                    <?php echo CHtml::encode($modelinvoiceVs->until); ?> 
                </li>
                <li>
                    <b><?php echo CHtml::encode($modelinvoiceVs->getAttributeLabel('invoiceDate')); ?> : </b>
                    <?php echo CHtml::encode($modelinvoiceVs->invoiceDate); ?>  
                </li>
                <li>
                    <b><?php echo CHtml::encode($modelinvoiceVs->getAttributeLabel('statusInvoice')); ?> : </b>
                    <?php echo CHtml::encode(Controller::$optionsYesNo[$modelinvoiceVs->statusInvoice]); ?>
                </li>
                <br><br>
                <li>
                    <b><?php echo CHtml::encode($modelinvoiceVs->getAttributeLabel('numberStudies')); ?> : </b>
                    <span id="invoiceNumStudies" class="data"><?php echo HtmlHelper::amount($modelinvoiceVs->numberStudies); ?></span>
                </li>
                <li>
                    <b><?php echo CHtml::encode($modelinvoiceVs->getAttributeLabel('totalValueStudies')); ?> : </b>
                    <span id="invoiceTotal" class="data"><?php echo "$" . HtmlHelper::amount($modelinvoiceVs->totalValueStudies); ?></span>
                </li>
                <li>
                    <b><?php echo CHtml::encode($modelinvoiceVs->getAttributeLabel('totalValueAddStudies')); ?> : </b>
                    <span id="invoiceTotal" class="data"><?php echo "$" . HtmlHelper::amount($modelinvoiceVs->totalValueAddStudies); ?></span>
                </li>
                <li>
                    <b><?php echo CHtml::encode($model->getAttributeLabel('totalValueTransportation')); ?> : </b>
                    <span id="invoiceTotal" class="data"><?php echo "$" . HtmlHelper::amount($modelinvoiceVs->totalCostTansport,true); ?></span>
                </li>
                <li>
                    <b><?php echo CHtml::encode($model->getAttributeLabel('totalValueFeeding')); ?> : </b>
                    <span id="invoiceTotal" class="data"><?php echo "$" . HtmlHelper::amount($modelinvoiceVs->totalCostFeeding,true); ?></span>
                </li>
                <li>
                    <b><?php echo CHtml::encode($model->getAttributeLabel('totalValueStationery')); ?> : </b>
                    <span id="invoiceTotal" class="data"><?php echo "$" . HtmlHelper::amount($modelinvoiceVs->totalCostStationery,true); ?></span>
                </li>
            </ul>
        </div>
    </fieldset>


</div>
