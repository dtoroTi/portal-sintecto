<?php

class HtmlHelper {

    static private $_stime = null;

    static function trace($msg = "") {
        if (!HtmlHelper::$_stime) {
            HtmlHelper::$_stime = microtime(true);
        }
        Yii::log(sprintf("%05f", (microtime(true) - HtmlHelper::$_stime)) . "s  " . $msg, 'trace', 'ZWF');
    }

    static function modelErrorsStr($model) {
        $ans = array();
        foreach ($model->errors as $label => $error) {

            $ans1 = $model->getAttributeLabel($label) . " => ";
            if (is_array($error)) {
                foreach ($error as $err) {
                    $ans1.=$err;
                }
            } else {
                $ans1.=$error;
            }
            $ans[] = $ans1;
        }
        return implode(", ", $ans);
    }

    static function number($num, $printCero = false) {
        if ((float) $num == 0 and ! $printCero) {
            $ans = "&nbsp;";
        } else {
            $ans = (float) $num;
        }
        return $ans;
    }

    static function value($num, $printCero = false, $ceroChar = "&nbsp;") {
        if (($num === 0 || $num === "0" || $num === NULL) and ! $printCero) {
            $ans = $ceroChar;
        } else {
            $ans = (float) $num;
        }
        return $ans;
    }

    static function amount($num, $printCero = false, $numDecimals = 0, $prefix = '', $sufix = '') {
        if (($num === NULL || trim($num) === '' || $num == 0) and ! $printCero) {
            $ans = "&nbsp;";
        } else {
            $ans = $prefix . number_format((float) $num, $numDecimals, '.', ',') . $sufix;
        }
        return $ans;
    }

    static function percent($num, $base, $printCero = false, $numDecimals = 0, $prefix = '', $sufix = '%') {
        if ($base == 0 || (($num === NULL || trim($num) === '' || $num == 0) and ! $printCero)) {
            $ans = "&nbsp;";
        } else {
            $ans = $prefix . number_format((float) $num / $base * 100, $numDecimals, '.', ',') . $sufix;
        }
        return $ans;
    }

    static function trend($num) {
        if ($num === NULL || trim($num) === '' || $num == 0) {
            $ans = 0;
        } else if ($num > 0) {
            $ans = 1;
        } else {
            $ans = -1;
        }
        return $ans;
    }

    static function completeHour($dateStr, $fullDay) {

        if (strlen($dateStr) > 0) {
            $date = new DateTime($dateStr);
            if ($fullDay) {
                $ans = $date->setTime(23, 59, 59)->format('Y-m-d H:i:s');
            } else {
                $ans = $date->setTime(0, 0, 0)->format('Y-m-d H:i:s');
            }
        } else {
            $ans = $dateStr;
        }
        return $ans;
    }

    static public function sendCsvFile($data, $headers, $fileName, $separator = null, $printHeader = true, $searchFunction = 'search') {
        set_time_limit(300);
        if (!$separator) {
            $separator = Yii::app()->user->arUser->csvSeparator;
        }

        if (is_array($data)) {
            if (count($data) > 0) {
                $model = $data[0];
                $isArray = true;
            }
        } else {
            $model = $data;
            $isArray = false;
        }

        $fp = tmpfile();
        $row = array();
        foreach ($headers as $key => $header) {
            if (is_array($header)) {
                $row[] = $model->getAttributeLabel($header['header']);
                $headers[$key]['value'] = str_replace(';', '', $header['value']);
            } else {
                $row[] = $model->getAttributeLabel($header);
            }
        }
        if ($printHeader) {
            fputcsv($fp, $row, $separator);
        }
        if (!$isArray) {
            $now = microtime(true);
            $dataProvider = $model->$searchFunction(20000);

//            $dataProvider->setPagination(false);
//        $pagination = $dataProvider->pagination;
//        $totalItems = $dataProvider->getTotalItemCount();

            $iterator = new CDataProviderIterator($dataProvider);
            $i = 0;
            foreach ($iterator as $row) {
                
                fputcsv($fp, HtmlHelper::rowValue($row, $headers), $separator);
                unset($row);
                $i++;
                if ($i % 500 == 0) {
                    gc_collect_cycles();
                }
            }
        } else {
            foreach ($data as $row) {
                fputcsv($fp, AppHelper::rowValue($row, $headers), $separator);
            }
        }

        rewind($fp);

        //  It is important to send the first three characters of UTF8  \xEF\xBB\xBF
        Yii::app()->request->sendFile($fileName . ".csv", "\xEF\xBB\xBF" . stream_get_contents($fp), "text/csv", true);
        fclose($fp);
    }

    static private function rowValue($data, $headers) {
        $row = array();
        foreach ($headers as $header) {
            if (is_array($header)) {
                $ans = '';
                eval('$ans=' . $header['value'] . ';');
            } else {
                $ans = CHtml::value($data, $header);
            }
            $row[] = $ans;
            unset($ans);
            unset($header);
        }
        return $row;
    }

}
