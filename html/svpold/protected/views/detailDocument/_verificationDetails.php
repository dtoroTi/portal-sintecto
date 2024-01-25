<div class="ProcessTab">
    <div class="SvpTable" style="width:50em">
        <table>
            <tr>
                <th width="200em">Documentos</th>
                <th width="10em">Verificación</th>
                <th width="10em">Fecha</th>
                <th width="100em">Comentario</th>
                <th>&nbsp;</th>
            </tr>
            <?php foreach ($verificationSection->detailDocuments as $document): ?>
                <?php
                echo $this->renderPartial('/detailDocument/_verificationDetail', array(
                    'verificationSection' => $verificationSection,
                    'document' => $document,
                ));
                ?>
            <?php endforeach ?>
            <?php
            if (!$verificationSection->backgroundCheck->canUpdate) {
                $document = new DetailDocument();
                echo $this->renderPartial('/detailDocument/_verificationDetail', array(
                    'verificationSection' => $verificationSection,
                    'document' => $document,
                ));
            }
            ?>
        </table>
    </div>
</div>
