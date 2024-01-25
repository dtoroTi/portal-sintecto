<?php

class BackgroundCheckReportController extends CController {

    public function dailyReport() {
        set_time_limit(900);

        $reports = $this->getReportSummary();

        // Modificación solicitada por Iván 24/07/2017
        /*$date = new DateTime('now', timezone_open('America/Bogota'));
        if (!SvpMail::sendMail(
                        "Estudios Diario [" . $date->format('Y-m-d H:i:s') . "]", //
                        $reports['count'], //
                        Yii::app()->params['adminReportEmail'], array()
                )) {
            echo "Error: No se ha podido enviar el correo";
        }*/
        $date = new DateTime('now', timezone_open('America/Bogota'));
        if (!SvpMail::sendMail(
                        "Estudios Diario por Valor [" . $date->format('Y-m-d H:i:s') . "]", //
                        $reports['price'], //
                        Yii::app()->params['generalManagerMail'], array()
                )) {
            echo "Error: No se ha podido enviar el correo";
        }

        $pendingReports = BackgroundCheck::getPendingReports();

        // Modificación solicitada por Iván 24/07/2017
        /*$pendingReportsReport = $this->getPendingReportsBody($pendingReports, true);
        $date = new DateTime('now', timezone_open('America/Bogota'));

        if (!SvpMail::sendMail(
                        "Estudios Pendientes [" . $date->format('Y-m-d H:i:s') . "]", //
                        $pendingReportsReport, //
                        Yii::app()->params['pendingReportEmail'], array()
                )) {
            echo "Error: No se ha podido enviar el correo";
        }*/

        $individualPendingReports = $this->getReportsByResponsible($pendingReports);

        $fullReportByResponsible = "";

        foreach ($individualPendingReports as $userId => $pendingReports) {
            $date = new DateTime('now', timezone_open('America/Bogota'));
            $user = User::model()->findByPk($userId);

            $pendingReportsReport = $this->getPendingReportsBody($pendingReports, null, true, $user);
            $fullReportByResponsible.=$pendingReportsReport;
            if ($user && !SvpMail::sendMail(
                            "Estudios Pendientes de " . $user->name . " [" . $date->format('Y-m-d H:i:s') . "]", //
                            $pendingReportsReport, //
                            array(array('mail' => $user->username, 'name' => $user->name)
                            ), array()
                    )) {
                echo "Error: No se ha podido enviar el correo";
            }
        }

        // Modificación solicitada por Iván 24/07/2017
        /*if ($fullReportByResponsible != "") {
            $date = new DateTime('now', timezone_open('America/Bogota'));
            if (!SvpMail::sendMail(
                            "Estudios Pendientes por Analista [" . $date->format('Y-m-d H:i:s') . "]", //
                            $fullReportByResponsible, //
                            Yii::app()->params['followReportEmail'], array()
                    )) {
                echo "Error: No se ha podido enviar el correo";
            }
        }*/
    }

    public function actionLogEntry() {

        if (Yii::app()->user->isAdmin) {

            echo $this->renderPartial( 'logEntry');

        }
    }


    public function actionListclientsActive() {

        if(Yii::app()->user->getIsByRole()){
            echo $this->renderPartial( 'listclientsActive');
        }else if (Yii::app()->user->isAdmin) {
            echo $this->renderPartial( 'listclientsActive');
        }
    }

    public function actionClientsSacCSV() {
        if(Yii::app()->user->getIsByRole()){
            echo $this->renderPartial( 'clientsSacCSV');
        }else if (Yii::app()->user->isAdmin) {
            echo $this->renderPartial( 'clientsSacCSV');
        }
    }

    public function actionStudymove() {

        if(Yii::app()->user->getIsByRole()){
            echo $this->renderPartial( 'studysMove');
        }else if (Yii::app()->user->isAdmin) {
            echo $this->renderPartial( 'studysMove');
        }
    }

    public function actionPendingReportsUntilToday() {

        if(Yii::app()->user->getIsByRole()){
            $today = new DateTime('now', timezone_open('America/Bogota'));
            $pendingReports = BackgroundCheck::getPendingReports($today->format("Y-m-d"));

            $individualPendingReports = $this->getReportsByResponsible($pendingReports);

            $fullReportByResponsible = "";

            $firstPage = true;
            foreach ($individualPendingReports as $userId => $pendingReports) {
                $date = new DateTime('now', timezone_open('America/Bogota'));
                $user = User::model()->findByPk($userId);

                $pendingReportsReport = $this->getPendingReportsBody($pendingReports, null, false, $user, $firstPage);
                $firstPage = false;
                if ($user) {
                    echo $this->renderInternal(
                            Yii::app()->basePath . '/views/backgroundCheckReport/pendingReportsPrint.php'
                            , array(
                        'body' => $pendingReportsReport,
                            ), true);
                }
            }
        }else if (Yii::app()->user->isAdmin) {

            $today = new DateTime('now', timezone_open('America/Bogota'));
            $pendingReports = BackgroundCheck::getPendingReports($today->format("Y-m-d"));

            $individualPendingReports = $this->getReportsByResponsible($pendingReports);

            $fullReportByResponsible = "";

            $firstPage = true;
            foreach ($individualPendingReports as $userId => $pendingReports) {
                $date = new DateTime('now', timezone_open('America/Bogota'));
                $user = User::model()->findByPk($userId);

                $pendingReportsReport = $this->getPendingReportsBody($pendingReports, null, false, $user, $firstPage);
                $firstPage = false;
                if ($user) {
                    echo $this->renderInternal(
                            Yii::app()->basePath . '/views/backgroundCheckReport/pendingReportsPrint.php'
                            , array(
                        'body' => $pendingReportsReport,
                            ), true);
                }
            }
        }
    }

    public function actionPendingReportsCSV() {

        if(Yii::app()->user->getIsByRole()){
            $today = new DateTime('now', timezone_open('America/Bogota'));
            $pendingReports = BackgroundCheck::getPendingReports();

            echo $this->renderPartial( 'pendingReportsCSV'
                    , array(
                'pendingReports' => $pendingReports,
            ));
        }else if (Yii::app()->user->isAdmin) {

            $today = new DateTime('now', timezone_open('America/Bogota'));
            $pendingReports = BackgroundCheck::getPendingReports();

            echo $this->renderPartial( 'pendingReportsCSV'
                    , array(
                'pendingReports' => $pendingReports,
            ));
        }
    }

    public function productionReport() {

        $reports = $this->getProductionReport();

        $date = new DateTime('now', timezone_open('America/Bogota'));
        if (!SvpMail::sendMail(
                        "Reporte de Producción [" . $date->format('Y-m-d H:i:s') . "]", //
                        $reports, //
                        Yii::app()->params['generalManagerMail'], array()
                )) {
            echo "Error: No se ha podido enviar el correo";
        }
    }

    public function actionReport() {
        if (Yii::app()->user->isSuperAdmin && Yii::app()->user->name == 'admin@svision.co' &&
                ( Yii::app()->params['serverType'] == 'dev' || Yii::app()->params['serverType'] == 'devport' || Yii::app()->params['serverType'] == 'test')) {

//            $productionReport = $this->getProductionReport();
//            echo $productionReport;

            $pendingReports = BackgroundCheck::getPendingReports();
            echo $this->getPendingReportsBody($pendingReports, true, null, null, true);
//            $report = $this->getReportSummary();
//            echo $report['price'];
//            echo $report['count'];
//
//            $individualPendingReports = $this->getReportsByResponsible($pendingReports);
//
//            $fullReportByResponsible = "";
//
//            foreach ($individualPendingReports as $userId => $reports) {
//                $date = new DateTime('now', timezone_open('America/Bogota'));
//                $user = User::model()->findByPk($userId);
//
//                echo "<h1>$user->username</h1>";
//
//                $pendingReportsReport = $this->getPendingReportsBody($reports);
//                $fullReportByResponsible.=$pendingReportsReport;
//                echo $pendingReportsReport;
//            }
//            if ($fullReportByResponsible != "") {
//                echo $fullReportByResponsible;
//            }
        } else {
            $this->redirect('/');
        }
    }

    public function actionProductionReport() {
        if(Yii::app()->user->getIsByRole()){
            $productionReport = $this->getProductionReport(true);
            echo $productionReport;
        }else if (Yii::app()->user->isBilling) {
            $productionReport = $this->getProductionReport(true);
            echo $productionReport;
        } else {
            $this->redirect('/');
        }
    }

    public function actionProductionReportCSV() {
        if(Yii::app()->user->getIsByRole()){
            $productionReport = $this->getProductionReport(true, true);
            echo $productionReport;
        }else if (Yii::app()->user->isBilling) {
            $productionReport = $this->getProductionReport(true, true);
            echo $productionReport;
        } else {
            $this->redirect('/');
        }
    }

    public function actionProductionReportQty() {
        if(Yii::app()->user->getIsByRole()){
            $productionReport = $this->getProductionReport(true);
            echo $productionReport;
        }else if (Yii::app()->user->isBilling) {
            $productionReport = $this->getProductionReport(false);
            echo $productionReport;
        } else {
            $this->redirect('/');
        }
    }

    private function getReportSummary() {
        set_time_limit(900);
        $report = $this->getReportUsers();

        $bodyCount = $this->renderInternal(Yii::app()->basePath . '/views/backgroundCheckReport/dailyReport.php', array(
            'studies' => BackgroundCheck::getResultSummaryByCustomerReportTypeDaily(),
            'customerUserAccess' => CustomerUser::getUserUsageReport(),
//            'users' => User::getUserRoleReport(),
            'report' => $report,
            'userAccess' => User::getUserAccessReport(),
                )
                , true);
        $bodyValue = $this->renderInternal(Yii::app()->basePath . '/views/backgroundCheckReport/dailyValueReport.php', array(
//            'users' => User::getUserRoleReport(),
            'report' => $report,
                )
                , true);
        return array(
            'count' => $bodyCount,
            'price' => $bodyValue);
    }

    private function getPendingReportsBody($reports, $publishPending = null, $printHeader = true, $responsible = null, $firstPage = true) {
        $printSection = array(
            'isPendingToApprove' => false,
            'isPendingToPublish' => false,
            'isPendingOverdue' => false,
            'isPendingOnTimeWithEvent' => false,
            'isPendingOnTimeWithOutEvent' => false,
        );

        $atLeastOne = false;

        foreach ($printSection as $key => $section) {
            foreach ($reports as $report) {
                if ($report->$key) {
                    $printSection[$key] = true;
                    $atLeastOne = true;
                    break;
                }
            }
        }

        if ($atLeastOne) {
            $body = $this->renderInternal((Yii::app()->basePath . '/views/backgroundCheckReport/pendingReports.php'), array(
                'reports' => $reports,
                'printSection' => $printSection,
                'printHeader' => $printHeader,
                'responsible' => $responsible,
                'firstPage' => $firstPage,
                    )
                    , true);
        } else {
            $body = null;
        }
        return $body;
    }

    private function getReportsByResponsible($reports) {

        $ans = array();
        foreach ($reports as $report) {
            foreach ($report->assignedUsers as $assignedUser) {
                $responsible = $assignedUser;
                if (!empty($responsible)) {
                    if (!isset($ans[$responsible->user->id])) {
                        $ans[$responsible->user->id] = array();
                    }
                    $ans[$responsible->user->id][] = $report;
                }
            }
        }
        return $ans;
    }

    public function getProductionReport($getPrice = true, $csv = false) {
        $timeZone = new DateTimeZone('America/Bogota');
        $now = new DateTime('now', $timeZone);

        $firstDayOfThisMonth = new DateTime("first day of this month  00:00:00", $timeZone);
        $firstDayOfPreviousMonth = new DateTime("first day of previous month  00:00:00", $timeZone);
        $firstDayOfPrevious2Month = clone $firstDayOfPreviousMonth;
        $firstDayOfPrevious2Month->modify("first day of previous month 00:00:00");
        $firstDayOfPrevious3Month = clone $firstDayOfPrevious2Month;
        $firstDayOfPrevious3Month->modify("first day of previous month 00:00:00");
        $firstDayOfPrevious4Month = clone $firstDayOfPrevious3Month;
        $firstDayOfPrevious4Month->modify("first day of previous month 00:00:00");
        $firstDayOfNextMonth = new DateTime("first day of next month  00:00:00", $timeZone);

        $previous3Month = $firstDayOfPrevious3Month->format('Y_m');
        $previous2Month = $firstDayOfPrevious2Month->format('Y_m');
        $previousMonth = $firstDayOfPreviousMonth->format('Y_m');
        $thisMonth = $firstDayOfThisMonth->format('Y_m');
        $nextMonth = $firstDayOfNextMonth->format('Y_m');
        $newDay = clone $now;
        $today = $now->format('Y/m/d');
        $todayPM1D = Holiday::subWorkingDays($today, 1);
        $todayP1D = Holiday::addWorkingDaysReport($today, 1);
        $todayP2D = Holiday::addWorkingDaysReport($today, 2);
        $todayP3D = Holiday::addWorkingDaysReport($today, 3);

        $where = '('
//                . '  t.resultId=:pending'
                . ' customer.customerGroupId<>:savId' // AND customer.id=1
                . ') '
        ;

        if ($getPrice) {
            $counter = '(backgroundCheck.price+backgroundCheck.additionalPrice)';
        } else {
            $counter = 1;
        }


        $params = array(
//            ':pending' => Result::PENDING,
//            ':firstDate' => $firstDayOfPrevious2Month->format('Y-m-d'),
//            ':noResult' => Result::NO_RESULT,
//            ':cancelled' => BackgroundCheckStatus::CANCELLED,
//            ':notReachable' => BackgroundCheckStatus::NOT_REACHABLE,
            ':savId' => CustomerGroup::SAV_ID,
        );

        $customerProducts1 = Yii::app()->db->createCommand()
                ->select('customerProduct.id as customerProductId, ' .
                        ' Sum( if (date_format(invoice.invoiceDate,"%Y_%m")="' . $previous3Month . '",' . $counter . ',0)) as i_' . $previous3Month . ', ' .
                        ' Sum( if (date_format(invoice.invoiceDate,"%Y_%m")="' . $previous2Month . '",' . $counter . ',0)) as i_' . $previous2Month . ', ' .
                        ' Sum( if (date_format(invoice.invoiceDate,"%Y_%m")="' . $previousMonth . '",' . $counter . ',0)) as i_' . $previousMonth . ', ' .
                        ' Sum( if (date_format(invoice.invoiceDate,"%Y_%m")="' . $thisMonth . '",' . $counter . ',0)) as i_' . $thisMonth . ', ' .
                        ' Sum( if (date_format(invoice.invoiceDate,"%Y_%m")="' . $nextMonth . '",' . $counter . ',0)) as i_' . $nextMonth .
                        '')
                ->from('{{BackgroundCheck}} as backgroundCheck')
                ->Join('{{Invoice}} as invoice', 'invoice.id=backgroundCheck.invoiceId and invoice.invoiceDate is not NULL')
                ->join('{{CustomerProduct}} as customerProduct', 'backgroundCheck.customerProductId=customerProduct.id')
                ->Join('{{Customer}} as customer', 'backgroundCheck.customerId=customer.id')
                ->where($where, $params)
                ->group('customerProduct.id')
                ->queryAll();

        $customerProducts2 = Yii::app()->db->createCommand()
                ->select('customerProduct.id as customerProductId, ' .
                        ' Sum( if (date_format(backgroundCheck.deliveredToCustomerOn,"%Y_%m")="' . $previous3Month . '",' . $counter . ',0)) as p_' . $previous3Month . ', ' .
                        ' Sum( if (date_format(backgroundCheck.deliveredToCustomerOn,"%Y_%m")="' . $previous2Month . '",' . $counter . ',0)) as p_' . $previous2Month . ', ' .
                        ' Sum( if (date_format(backgroundCheck.deliveredToCustomerOn,"%Y_%m")="' . $previousMonth . '",' . $counter . ',0)) as p_' . $previousMonth . ', ' .
                        ' Sum( if (date_format(backgroundCheck.deliveredToCustomerOn,"%Y_%m")="' . $thisMonth . '",' . $counter . ',0)) as p_' . $thisMonth . ', ' .
                        ' Sum( if (backgroundCheck.reportAvailable=0 and backgroundCheck.backgroundCheckStatusId<>2 and date_format(backgroundCheck.studyLimitOn,"%Y_%m")="' . $thisMonth . '",' . $counter . ',0)) as pendingThisMonth, ' .
                        ' Sum( if (backgroundCheck.reportAvailable=0 and backgroundCheck.backgroundCheckStatusId<>2 and date_format(backgroundCheck.studyLimitOn,"%Y/%m/%d")="' . $today . '",' . $counter . ',0)) as pendingToday, ' .
                        ' Sum( if (backgroundCheck.reportAvailable=0 and backgroundCheck.backgroundCheckStatusId<>2 and date_format(backgroundCheck.studyLimitOn,"%Y/%m/%d")="' . $todayP1D . '",' . $counter . ',0)) as pendingTodayP1D, ' .
                        ' Sum( if (backgroundCheck.reportAvailable=0 and backgroundCheck.backgroundCheckStatusId<>2 and date_format(backgroundCheck.studyLimitOn,"%Y/%m/%d")="' . $todayP2D . '",' . $counter . ',0)) as pendingTodayP2D, ' .
                        ' Sum( if (backgroundCheck.reportAvailable=0 and backgroundCheck.backgroundCheckStatusId<>2 and date_format(backgroundCheck.studyLimitOn,"%Y/%m/%d")="' . $todayP3D . '",' . $counter . ',0)) as pendingTodayP3D, ' .
                        ' Sum( if (backgroundCheck.reportAvailable=0 and backgroundCheck.backgroundCheckStatusId<>2 and date_format(backgroundCheck.studyLimitOn,"%Y/%m/%d")<"' . $today . '",' . $counter . ',0)) as pendingOverdue, ' .
                        ' Sum( if (date_format(backgroundCheck.deliveredToCustomerOn,"%Y/%m/%d")="' . $todayPM1D . '",' . $counter . ',0)) as finishedDayBefore, ' .
                        ' Sum( if (date_format(backgroundCheck.deliveredToCustomerOn,"%Y/%m/%d")="' . $today . '",' . $counter . ',0)) as finishedToday, ' .
                        ' Sum( if ((backgroundCheck.reportAvailable=0) and backgroundCheck.backgroundCheckStatusId<>2,' . $counter . ',0)) as pending, ' .
                        //' Sum( if ((backgroundCheck.backgroundCheckStatusId=4), 1, 0)) as processFinal, ' .
                        //' Sum( if (((backgroundCheck.backgroundCheckStatusId=1) or backgroundCheck.backgroundCheckStatusId=5), 1,0)) as processEjec, ' .
                        ' Sum( if (date_format(backgroundCheck.studyStartedOn,"%Y/%m/%d")="' . $todayPM1D . '",' . $counter . ',0)) as startedDayBefore, ' .
                        ' Sum( if (date_format(backgroundCheck.studyStartedOn,"%Y/%m/%d")="' . $today . '",' . $counter . ',0)) as startedToday, ' .
                        ' Sum( if (date_format(backgroundCheck.studyStartedOn,"%Y/%m/%d")>"' . $today . '",' . $counter . ',0)) as startedAfterToday ' .
                        '')
                ->from('{{BackgroundCheck}} as backgroundCheck')
                ->join('{{CustomerProduct}} as customerProduct', 'backgroundCheck.customerProductId=customerProduct.id')
                ->Join('{{Customer}} as customer', 'backgroundCheck.customerId=customer.id')
                ->where($where, $params)
                ->group('customerProduct.id')
                ->queryAll();


   /*     if ($getPrice) {

            $customerProducts4 = Yii::app()->db->createCommand()
                    ->select('product.id as productId, ' .
                            'invoice.customerGroupId as customerGroupId,' .
                            'product.name as productName, ' .
                            ' Sum( if (date_format(invoice.invoiceDate,"%Y_%m")="' . $previous3Month . '",(invoiceDetail.qty*invoiceDetail.unitValue),0)) as i_' . $previous3Month . ', ' .
                            ' Sum( if (date_format(invoice.invoiceDate,"%Y_%m")="' . $previous2Month . '",(invoiceDetail.qty*invoiceDetail.unitValue),0)) as i_' . $previous2Month . ', ' .
                            ' Sum( if (date_format(invoice.invoiceDate,"%Y_%m")="' . $previousMonth . '",(invoiceDetail.qty*invoiceDetail.unitValue),0)) as i_' . $previousMonth . ', ' .
                            ' Sum( if (date_format(invoice.invoiceDate,"%Y_%m")="' . $thisMonth . '",(invoiceDetail.qty*invoiceDetail.unitValue),0)) as i_' . $thisMonth . ', ' .
                            ' Sum( if (date_format(invoice.invoiceDate,"%Y_%m")="' . $nextMonth . '",(invoiceDetail.qty*invoiceDetail.unitValue),0)) as i_' . $nextMonth .
                            '')
                    ->from('{{InvoiceDetail}} as invoiceDetail')
                    ->Join('{{Invoice}} as invoice', 'invoice.id=invoiceDetail.invoiceId and invoice.invoiceDate is not NULL')
                    ->join('{{Product}} as product', 'invoiceDetail.productId=product.id')
                    ->join('{{CustomerGroup}} as customerGroup', 'invoice.customerGroupId=customerGroup.id')
                    ->where(' invoice.customerGroupid<>:savId', array(':savId' => CustomerGroup::SAV_ID,))
                    ->group('invoice.customerGroupId')
                    ->order('customerGroup.name')
                    ->queryAll();
        } else { */
            $customerProducts4 = array();
      //  }

        $customerProducts = array();
        foreach ($customerProducts4 as $row) {
            $customerProducts['i' . $row['customerGroupId']] = array('customerGroupId' => $row['customerGroupId'], 'data' => $row);
        }

        $customerProducts3 = CustomerProduct::model()->with('customer', 'customer.customerGroup','typeProduct')
                                                     ->findAll(array('order' => 'customerGroup.name asc, t.name asc'));
        foreach ($customerProducts3 as $customerProduct) {
            $customerProducts['b' . $customerProduct->id] = array('prod' => $customerProduct, 'data' => array());
        }

        $customerGroupArr = array();
        $customerGroups = CustomerGroup::model()->findAll(array('order' => 'name asc'));
        foreach ($customerGroups as $customerGroup) {
            $customerGroupArr[$customerGroup->id] = $customerGroup;
        }

        foreach ($customerProducts1 as $row) {
            $customerProducts['b' . $row['customerProductId']]['data'] = $row;
        }

        foreach ($customerProducts2 as $row) {
            $customerProducts['b' . $row['customerProductId']]['data'] = $customerProducts['b' . $row['customerProductId']]['data'] + $row;
        }

        foreach ($customerProducts as $customerProductId => $row) {
            if ($customerProductId[0] == 'b') {
                $total = 0;
                foreach ($row['data'] as $varname => $value) {
                    if ($varname != 'customerProductId') {
                        $total+=(int) $value;
                    }
                }
                if ($total == 0) {
                    unset($customerProducts[$customerProductId]);
                }
            }
        }


        if (!$csv) {
            $body = $this->renderInternal(Yii::app()->basePath . '/views/backgroundCheckReport/productionReports.php', array(
                'customerGroupArr' => $customerGroupArr,
                'customerProducts' => $customerProducts,
                'previous3Month' => $previous3Month,
                'previous2Month' => $previous2Month,
                'previousMonth' => $previousMonth,
                'thisMonth' => $thisMonth,
                'nextMonth' => $nextMonth,
                'today' => $today,
                'todayP1D' => $todayP1D,
                'todayP2D' => $todayP2D,
                'todayP3D' => $todayP3D,
                'todayPM1D' => $todayPM1D,
                'getPrice' => $getPrice,
                    )
                    , true);
            return $body;
        } else {
            $body = $this->renderInternal(Yii::app()->basePath . '/views/backgroundCheckReport/productionReportsCSV.php', array(
                'customerGroupArr' => $customerGroupArr,
                'customerProducts' => $customerProducts,
                'previous3Month' => $previous3Month,
                'previous2Month' => $previous2Month,
                'previousMonth' => $previousMonth,
                'thisMonth' => $thisMonth,
                'nextMonth' => $nextMonth,
                'today' => $today,
                'todayP1D' => $todayP1D,
                'todayP2D' => $todayP2D,
                'todayP3D' => $todayP3D,
                'todayPM1D' => $todayPM1D,
                'getPrice' => $getPrice,
                    )
                    , true);
        }
    }

    public function getReportUsers() {

        $timeZone = new DateTimeZone('America/Bogota');
        $now = new DateTime('now', $timeZone);

        $firstDayOfThisMonth = new DateTime("first day of this month  00:00:00", $timeZone);
        $firstDayOfPreviousMonth = new DateTime("first day of previous month  00:00:00", $timeZone);
        $firstDayOfPrevious2Month = clone $firstDayOfPreviousMonth;
        $firstDayOfPrevious2Month->modify("first day of previous month 00:00:00");
        $firstDayOfNextMonth = new DateTime("first day of next month  00:00:00", $timeZone);

        $where = '('
//                . '  t.resultId=:pending'
                . '  t.approvedOn >= :firstDate'
                . ' or (t.approvedOn is Null)'
                . ' or (t.invoiceId is Null)'
                . ' or (t.invoiceId is not Null and invoice.closed=0)'
                . ') '
                . ' and t.backgroundCheckStatusId not in (:cancelled,:partialCancelled) '
                . ' and (customer.customerGroupId<>:savId) '
        ;

        $params = array(
//            ':pending' => Result::PENDING,
            ':firstDate' => $firstDayOfPrevious2Month->format('Y-m-d'),
//            ':noResult' => Result::NO_RESULT,
            ':cancelled' => BackgroundCheckStatus::CANCELLED,
            ':partialCancelled' => BackgroundCheckStatus::PARTIAL_CANCELLED,
            ':savId' => CustomerGroup::SAV_ID,
        );

        $reports = Yii::app()->db->createCommand()
                ->select('t.id')
                ->from('{{BackgroundCheck}} as t')
                ->leftJoin('{{Invoice}} as invoice', 't.invoiceId=invoice.id')
                ->leftJoin('{{Customer}} as customer', 't.customerId=customer.id')
                ->where($where, $params)
                ->query();

        $ans = array(
            'users' => array(),
            'customerGroup' => array(),
        );

        $ans['users'] = array();
        $ans['customerGroup'] = array();
        $ans['priceCustomerGroup'] = array();


        foreach ($reports as $reportRow) {
            unset($report);
            $report = BackgroundCheck::model()->findByPk($reportRow['id']);
            if ($report->customer->customerGroupId == 2) {
                if ($report->deliveredToCustomerOn != NULL) {
                    $publishedOn = new DateTime($report->deliveredToCustomerOn, $timeZone);
                }
            }
            if (!$report->customer->customerGroup) {
                $customerGroup = 'Sin Grupo-' . $report->customer->name;
            } else {
                $customerGroup = $report->customer->customerGroup->name;
            }

            if (!$report->responsible) {
                $responsibleName = 'NO ASIGNADO';
            } else {
                $responsibleName = $report->responsible->user->username;
            }

            $customerProduct = strtoupper(trim($report->customerProduct->name));

            if (!isset($ans['users'][$responsibleName])) {
                $ans['users'][$responsibleName] = array(
                    BackgroundCheck::S_PENDING => array(),
                    BackgroundCheck::S_NOT_PENDING => array(),
                );
            }

            if (!isset($ans['customerGroup'][$customerGroup])) {
                $ans['customerGroup'][$customerGroup] = array();
                $ans['priceCustomerGroup'][$customerGroup] = array();
            }

            if (!isset($ans['customerGroup'][$customerGroup][$customerProduct])) {
                $ans['customerGroup'][$customerGroup][$customerProduct] = array(
                    BackgroundCheck::S_PENDING => array(),
                    BackgroundCheck::S_NOT_PENDING => array(),
                );
                $ans['priceCustomerGroup'][$customerGroup][$customerProduct] = array(
                    BackgroundCheck::S_PENDING => array(),
                    BackgroundCheck::S_NOT_PENDING => array(),
                );
            }

            //                if ($report->price<=0){
            //                    print("{$report->code}:{$report->customer->name}:{$report->customerProduct->name}:{$report->studyLimitOn}:{$report->backgroundCheckStatus->name}:{$report->price}<br/>");
            //                }

            if ($report->isProcessing) {

                $diff = $report->overdueDays;

                if ($diff >= 30) {
                    @$ans['users'][$responsibleName][BackgroundCheck::S_PENDING][BackgroundCheck::S_OVERDUE_30]+= 1;
                    @$ans['customerGroup'][$customerGroup][$customerProduct][BackgroundCheck::S_PENDING][BackgroundCheck::S_OVERDUE_30]+= 1;
                    @$ans['priceCustomerGroup'][$customerGroup][BackgroundCheck::S_PENDING][BackgroundCheck::S_OVERDUE_30]+= $report->totalPrice;
                } else if ($diff >= 7) {
                    @$ans['users'][$responsibleName][BackgroundCheck::S_PENDING][BackgroundCheck::S_OVERDUE_7]+= 1;
                    @$ans['customerGroup'][$customerGroup][$customerProduct][BackgroundCheck::S_PENDING][BackgroundCheck::S_OVERDUE_7]+= 1;
                    @$ans['priceCustomerGroup'][$customerGroup][BackgroundCheck::S_PENDING][BackgroundCheck::S_OVERDUE_7]+= $report->totalPrice;
                } else if ($diff > 0) {

                    @$ans['users'][$responsibleName][BackgroundCheck::S_PENDING][BackgroundCheck::S_OVERDUE]+= 1;
                    @$ans['customerGroup'][$customerGroup][$customerProduct][BackgroundCheck::S_PENDING][BackgroundCheck::S_OVERDUE]+= 1;
                    @$ans['priceCustomerGroup'][$customerGroup][BackgroundCheck::S_PENDING][BackgroundCheck::S_OVERDUE]+= $report->totalPrice;
                } else {
                    @$ans['users'][$responsibleName][BackgroundCheck::S_PENDING][BackgroundCheck::S_ONTIME]+= 1;
                    @$ans['customerGroup'][$customerGroup][$customerProduct][BackgroundCheck::S_PENDING][BackgroundCheck::S_ONTIME]+= 1;
                    @$ans['priceCustomerGroup'][$customerGroup][BackgroundCheck::S_PENDING][BackgroundCheck::S_ONTIME]+= $report->totalPrice;
                }
                @$ans['users'][$responsibleName][BackgroundCheck::S_PENDING][BackgroundCheck::S_TOTAL_PENDING_USER]+= 1;
                @$ans['customerGroup'][$customerGroup][$customerProduct][BackgroundCheck::S_PENDING][BackgroundCheck::S_TOTAL_PENDING_USER]+= 1;
                @$ans['priceCustomerGroup'][$customerGroup][BackgroundCheck::S_PENDING][BackgroundCheck::S_TOTAL_PENDING_USER]+= $report->totalPrice;
                if ($report->numberOfEvents > 0) {
                    @$ans['users'][$responsibleName][BackgroundCheck::S_PENDING][BackgroundCheck::S_EVENTS]+= 1;
                    @$ans['customerGroup'][$customerGroup][$customerProduct][BackgroundCheck::S_PENDING][BackgroundCheck::S_EVENTS]+= 1;
                }
            } else {
                $publishedOn = NULL;
                if ($report->deliveredToCustomerOn != NULL && $report->deliveredToCustomerOn != '0000-00-00 00:00:00') {
                    $publishedOn = new DateTime($report->deliveredToCustomerOn, $timeZone);
                }
                if (empty($report->approvedOn) || $report->approvedOn == '0000-00-00 00:00:00') {
                    @$ans['users'][$responsibleName][BackgroundCheck::S_NOT_PENDING][BackgroundCheck::S_NOT_APPROVED]+= 1;
                    @$ans['customerGroup'][$customerGroup][$customerProduct][BackgroundCheck::S_NOT_PENDING][BackgroundCheck::S_NOT_APPROVED]+= 1;
                    @$ans['priceCustomerGroup'][$customerGroup][BackgroundCheck::S_NOT_PENDING][BackgroundCheck::S_NOT_APPROVED]+= $report->totalPrice;
                } elseif (empty($publishedOn)) {
                    @$ans['users'][$responsibleName][BackgroundCheck::S_NOT_PENDING][BackgroundCheck::S_NOT_PUBLISHED]+= 1;
                    @$ans['customerGroup'][$customerGroup][$customerProduct][BackgroundCheck::S_NOT_PENDING][BackgroundCheck::S_NOT_PUBLISHED]+= 1;
                    @$ans['priceCustomerGroup'][$customerGroup][BackgroundCheck::S_NOT_PENDING][BackgroundCheck::S_NOT_PUBLISHED]+= $report->totalPrice;
                } elseif ($publishedOn >= $firstDayOfThisMonth) {
                    @$ans['users'][$responsibleName][BackgroundCheck::S_NOT_PENDING][BackgroundCheck::S_APPROVED_THIS_MONTH]+= 1;
                    @$ans['customerGroup'][$customerGroup][$customerProduct][BackgroundCheck::S_NOT_PENDING][BackgroundCheck::S_APPROVED_THIS_MONTH]+= 1;
                    @$ans['priceCustomerGroup'][$customerGroup][BackgroundCheck::S_NOT_PENDING][BackgroundCheck::S_APPROVED_THIS_MONTH]+= $report->totalPrice;
                } elseif ($publishedOn >= $firstDayOfPreviousMonth) {
                    @$ans['users'][$responsibleName][BackgroundCheck::S_NOT_PENDING][BackgroundCheck::S_APPROVED_PREVIOUS_MONTH]+= 1;
                    @$ans['customerGroup'][$customerGroup][$customerProduct][BackgroundCheck::S_NOT_PENDING][BackgroundCheck::S_APPROVED_PREVIOUS_MONTH]+= 1;
                    @$ans['priceCustomerGroup'][$customerGroup][BackgroundCheck::S_NOT_PENDING][BackgroundCheck::S_APPROVED_PREVIOUS_MONTH]+= $report->totalPrice;
                } elseif ($publishedOn >= $firstDayOfPrevious2Month) {
                    @$ans['users'][$responsibleName][BackgroundCheck::S_NOT_PENDING][BackgroundCheck::S_APPROVED_PREVIOUS_2MONTH]+= 1;
                    @$ans['customerGroup'][$customerGroup][$customerProduct][BackgroundCheck::S_NOT_PENDING][BackgroundCheck::S_APPROVED_PREVIOUS_2MONTH]+= 1;
                    @$ans['priceCustomerGroup'][$customerGroup][BackgroundCheck::S_NOT_PENDING][BackgroundCheck::S_APPROVED_PREVIOUS_2MONTH]+= $report->totalPrice;
                }

                if (!$report->invoice) {
                    @$ans['priceCustomerGroup'][$customerGroup][BackgroundCheck::S_NOT_PENDING][BackgroundCheck::S_NO_INVOICE]+= $report->totalPrice;
                } elseif ($report->invoice->closed == 0) {
                    @$ans['priceCustomerGroup'][$customerGroup][BackgroundCheck::S_NOT_PENDING][BackgroundCheck::S_OPEN_INVOICE]+= $report->totalPrice;
                }
            }
            if ($report->totalPrice <= 0) {
                @$ans['priceCustomerGroup'][$customerGroup][BackgroundCheck::S_NO_PRICE]+= 1;
            }
        }

        ksort($ans['users']);
        ksort($ans['customerGroup']);
        ksort($ans['priceCustomerGroup']);

        foreach ($ans['customerGroup'] as $customerName => $arr) {
            ksort($ans['customerGroup'][$customerName]);
        }

        $monthWorkingDays = Holiday::numOfWorkingDays($firstDayOfThisMonth->format('Y-m-d'), $firstDayOfNextMonth->format('Y-m-d'));
        $workingDays = Holiday::numOfWorkingDays($firstDayOfThisMonth->format('Y-m-d'), $now->format('Y-m-d'));

        $ans['previews2Month'] = $firstDayOfPrevious2Month->format('Y-m');
        $ans['previewsMonth'] = $firstDayOfPreviousMonth->format('Y-m');
        $ans['thisMonth'] = $firstDayOfThisMonth->format('Y-m');
        $ans['monthProportion'] = $workingDays / $monthWorkingDays;

        foreach ($ans['users'] as $username => $user) {
            foreach ($user[BackgroundCheck::S_PENDING] as $key => $val) {
                @$ans[BackgroundCheck::S_TOTAL_PENDING][$key]+= $val;
            }
            foreach ($user[BackgroundCheck::S_NOT_PENDING] as $key => $val) {
                @$ans[BackgroundCheck::S_TOTAL_NOT_PENDING][$key]+= $val;
            }
        }

        foreach ($ans['priceCustomerGroup'] as $cutomerGroupName => $customerGroup) {
            if (isset($customerGroup[BackgroundCheck::S_PENDING])) {
                foreach ($customerGroup[BackgroundCheck::S_PENDING] as $key => $val) {
                    @$ans['price'][BackgroundCheck::S_TOTAL_PENDING][$key]+= $val;
                }
            }
            if (isset($customerGroup[BackgroundCheck::S_NOT_PENDING])) {
                foreach ($customerGroup[BackgroundCheck::S_NOT_PENDING] as $key => $val) {
                    @$ans['price'][BackgroundCheck::S_TOTAL_NOT_PENDING][$key]+= $val;
                }
            }
        }

        return $ans;
    }

    public function actionExportworkplanCSV() {

        if (Yii::app()->user->isAdmin || Yii::app()->user->getIsByRole()) {

            $today = new DateTime('now', timezone_open('America/Bogota'));
            $pendingReports = BackgroundCheck::getPendingworkplan();
            $requestsReports = BackgroundCheck::getRequestsSAC();

            echo $this->renderPartial( 'exportworkplanCSV'
                    , array(
                'pendingReports' => $pendingReports,
                'requestsReports' => $requestsReports,
            ));
        }
    }

}
//comment