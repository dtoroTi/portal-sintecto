<table>
    <tr>
        <td>
            Secci&oacute;n:
        </td>
        <td>
            <?php
            echo CHtml::dropDownList(//
                    'documents' .
                    '[' . ($document->isNewRecord ? 'new' : $document->id) . ']' .
                    '[verificationSectionId]'
                    , //
                    $document->verificationSectionId, //
                    CHtml::listData(
                            $backgroundCheck->verificationSections, //
                            'id', //
                            'sectionName')
                    , array('prompt' => '...')
            );
            ?>
        </td>
        <td>
            nombre:
        </td>
        <td>
            <?php
            echo CHtml::textField('documents' .
                    '[' . ($document->isNewRecord ? 'new' : $document->id) . '][name]', $document->name);
            ?>.<?php echo CHtml::encode($document->extension); ?>
        </td>
        <td>
            Tamaño de Imagen:
        </td>
        <td>
            <?php
            echo CHtml::dropDownList(//
                    'documents' .
                    '[' . ($document->isNewRecord ? 'new' : $document->id) . ']' .
                    '[imageSizeId]'
                    , //
                    $document->imageSizeId, //
                    CHtml::listData(
                            ImageSize::model()->findAll(), //
                            'id', //
                            'name')
                    , array('prompt' => '...')
            );
            ?>
        </td>
        <?php if ($document->isNewRecord): ?>
            <td>
                Resolución:
            </td>
            <td>
                <?php
                echo CHtml::dropDownList(//
                        'documents' .
                        '[' . ($document->isNewRecord ? 'new' : $document->id) . ']' .
                        '[dpi]'
                        , //
                        $document->dpi, //
                        Document::getResolutionList()
                        , array('prompt' => '...')
                );
                ?>
            </td>
        <?php endif; ?>
        <td>
            Orden:
        </td>
        <td>
            <?php
            echo CHtml::textField('documents' .
                    '[' . ($document->isNewRecord ? 'new' : $document->id) . '][showOrder]', $document->showOrder);
            ?>
        </td>
        <td>
            Descripci&oacute;n:
        </td>
        <td>
            <?php
            echo CHtml::textField('documents' .
                    '[' . ($document->isNewRecord ? 'new' : $document->id) . '][description]', $document->description);
            ?>
        </td>
        <?php if (!$document->isNewRecord && $backgroundCheck->canUpdate): ?>
            <td >
                <div class="ServiceButton">
                    <a href="<?php echo $this->createUrl('/document/deleteDocument/', array('id' => $document->id)) ?>" 
                       class="ui-button ui-button-icon-only ui-widget ui-state-default ui-corner-all ServiceButton" 
                       title="Borrar"
                       onClick="return (confirm('Realmente desea borrar \'<?php echo $document->name; ?>\'?'));"> 
                        <span class="ui-button-icon-primary ui-icon ui-icon-trash"></span> 
                        <span class="ui-button-text">Button</span> 
                    </a> 
                </div>
            </td>
        <?php endif; ?>
    </tr>
    <?php if ($document->isNewRecord): ?>
        <tr>
            <td>
                Documento:
            </td>
            <td>
                <?php echo CHtml::fileField('documents[new][doc]', 'doc'); ?>
            </td>  
            <td>
                <?php echo CHtml::submitButton('Actualizar', array('onClick' => 'this.disabled=true;this.form.submit();')); ?>
            </td>
        </tr>
    <?php endif; ?>
</table>
