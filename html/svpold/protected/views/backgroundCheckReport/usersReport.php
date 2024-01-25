<div>
    <h3>Reporte de Estudios por Usuario:</h3>
    <table style="<?= $style['table'] ?>">
        <thead>
            <tr style="<?= $style['trth'] ?>">
                <th>Usuario</th>
                <th colspan="3">Aprobados</th>
                <th >Pendiente</th>
                <th >Pendiente</th>
                <th colspan="6" style="<?= $style['thPending']?>">Pendiente</th>
            </tr>
            <tr style="<?= $style['trth'] ?>">
                <th style="width: 200pt; <?= $style['th'] ?>">&nbsp;</th>
                <th style="width: 50pt; <?= $style['th'] ?>"><?=  CHtml::encode($report['previews2Month'])?></th>
                <th style="width: 50pt; <?= $style['th'] ?>"><?=  CHtml::encode($report['previewsMonth'])?></th>
                <th style="width: 50pt; <?= $style['th'] ?>"><?=  CHtml::encode($report['thisMonth'])?></th>
                <th style="width: 50pt; <?= $style['th'] ?>">Publicación</th>
                <th style="width: 50pt; <?= $style['th'] ?>">Aprobación</th>
               <th style="width: 50pt; <?= $style['th'].$style['thPending'] ?>">Total</th>
                 <th style="width: 50pt; <?= $style['th'].$style['thPending'] ?>">En Tiempo</th>
                 <th style="width: 50pt; <?= $style['th'].$style['thPending'] ?>">Vencido<br/>1-6</th>
                 <th style="width: 50pt; <?= $style['th'].$style['thPending'] ?>">Vencido<br/>7-29</th>
                 <th style="width: 50pt; <?= $style['th'].$style['thPending'] ?>">Vencido <br/>>=30</th>
                <th style="width: 50pt; <?= $style['th'].$style['thPending'] ?>">Novedades</th>
            </tr>
        </thead>

        <?php foreach ($report['users'] as $username => $row) : ?>
            <tr style="<?= $style['trtd'] ?>">

                <td style="<?= $style['td'] ?>"><?= CHtml::encode($username) ?></td>
                <td style="<?= $style['tdValue'] ?>"><?= HtmlHelper::value(@$row[BackgroundCheck::S_NOT_PENDING][BackgroundCheck::S_APPROVED_PREVIOUS_2MONTH]) ?></td>
                <td style="<?= $style['tdValue'] ?>"><?= HtmlHelper::value(@$row[BackgroundCheck::S_NOT_PENDING][BackgroundCheck::S_APPROVED_PREVIOUS_MONTH]) ?></td>
                <td style="<?= $style['tdValue'] ?>"><?= HtmlHelper::value(@$row[BackgroundCheck::S_NOT_PENDING][BackgroundCheck::S_APPROVED_THIS_MONTH]) ?></td>
                <td style="<?= $style['tdValue'] ?>"><?= HtmlHelper::value(@$row[BackgroundCheck::S_NOT_PENDING][BackgroundCheck::S_NOT_PUBLISHED]) ?></td>
                <td style="<?= $style['tdValue'] ?>"><?= HtmlHelper::value(@$row[BackgroundCheck::S_NOT_PENDING][BackgroundCheck::S_NOT_APPROVED]) ?></td>
                <td style="<?= $style['tdValue'] ?>"><?= HtmlHelper::value(@$row[BackgroundCheck::S_PENDING][BackgroundCheck::S_TOTAL_PENDING_USER]) ?></td>
                <td style="<?= $style['tdValue'] ?>"><?= HtmlHelper::value(@$row[BackgroundCheck::S_PENDING][BackgroundCheck::S_ONTIME]) ?></td>
                <td style="<?= $style['tdValue'] ?>"><?= HtmlHelper::value(@$row[BackgroundCheck::S_PENDING][BackgroundCheck::S_OVERDUE]) ?></td>
                <td style="<?= $style['tdValue'] ?>"><?= HtmlHelper::value(@$row[BackgroundCheck::S_PENDING][BackgroundCheck::S_OVERDUE_7]) ?></td>
                <td style="<?= $style['tdValue'] ?>"><?= HtmlHelper::value(@$row[BackgroundCheck::S_PENDING][BackgroundCheck::S_OVERDUE_30]) ?></td>
                <td style="<?= $style['tdValue'] ?>"><?= HtmlHelper::value(@$row[BackgroundCheck::S_PENDING][BackgroundCheck::S_EVENTS]) ?></td>
            </tr>
        <?php endforeach; ?>
        <tr style="<?= $style['trth'] ?>">

            <td style="<?= $style['td'] ?>">TOTAL</td>
            <td style="<?= $style['tdValue'] ?>"><?= HtmlHelper::value(@$report[BackgroundCheck::S_TOTAL_NOT_PENDING][BackgroundCheck::S_APPROVED_PREVIOUS_2MONTH]) ?></td>
            <td style="<?= $style['tdValue'] ?>"><?= HtmlHelper::value(@$report[BackgroundCheck::S_TOTAL_NOT_PENDING][BackgroundCheck::S_APPROVED_PREVIOUS_MONTH]) ?></td>
            <td style="<?= $style['tdValue'] ?>"><?= HtmlHelper::value(@$report[BackgroundCheck::S_TOTAL_NOT_PENDING][BackgroundCheck::S_APPROVED_THIS_MONTH]) ?></td>
            <td style="<?= $style['tdValue'] ?>"><?= HtmlHelper::value(@$report[BackgroundCheck::S_TOTAL_NOT_PENDING][BackgroundCheck::S_NOT_PUBLISHED]) ?></td>
            <td style="<?= $style['tdValue'] ?>"><?= HtmlHelper::value(@$report[BackgroundCheck::S_TOTAL_NOT_PENDING][BackgroundCheck::S_NOT_APPROVED]) ?></td>
            <td style="<?= $style['tdValue'].$style['thPending'] ?>"><?= HtmlHelper::value(@$report[BackgroundCheck::S_TOTAL_PENDING][BackgroundCheck::S_TOTAL_PENDING_USER]) ?></td>
            <td style="<?= $style['tdValue'].$style['thPending'] ?>"><?= HtmlHelper::value(@$report[BackgroundCheck::S_TOTAL_PENDING][BackgroundCheck::S_ONTIME]) ?></td>
            <td style="<?= $style['tdValue'].$style['thPending'] ?>"><?= HtmlHelper::value(@$report[BackgroundCheck::S_TOTAL_PENDING][BackgroundCheck::S_OVERDUE]) ?></td>
            <td style="<?= $style['tdValue'].$style['thPending'] ?>"><?= HtmlHelper::value(@$report[BackgroundCheck::S_TOTAL_PENDING][BackgroundCheck::S_OVERDUE_7]) ?></td>
            <td style="<?= $style['tdValue'].$style['thPending'] ?>"><?= HtmlHelper::value(@$report[BackgroundCheck::S_TOTAL_PENDING][BackgroundCheck::S_OVERDUE_30]) ?></td>
            <td style="<?= $style['tdValue'].$style['thPending'] ?>"><?= HtmlHelper::value(@$report[BackgroundCheck::S_TOTAL_PENDING][BackgroundCheck::S_EVENTS]) ?></td>
        </tr>
    </table>
</div>
