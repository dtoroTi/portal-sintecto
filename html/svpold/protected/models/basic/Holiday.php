<?php

/**
 * This is the model class for table "{{Holiday}}".
 *
 * The followings are the available columns in table '{{Holiday}}':
 * @property integer $id
 * @property string $holiday
 */
class Holiday extends CActiveRecord {

    static private $_holidays = null;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Holiday the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{Holiday}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('holiday', 'required'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, holiday', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'holiday' => 'Holiday',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('holiday', $this->holiday, true);

        GridViewFilter::setFilter($this, 'search');

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    static public function addWorkingDays($date, $ndays) {
        // $startDate and $endDate are strings

        if (is_string($date)) {

            $newDate = new DateTime($date);
        } elseif (is_a($date, 'DateTime')) {
            $newDate = clone $date;
        } else {
            throw new Exception('Not Date');
        }
        $newDate = Holiday::addWorkingDaysDateTime($newDate, $ndays);
        return $newDate->format('Y/m/d H:i:s');
    }

    static public function addWorkingDaysReport($date, $ndays) {
        // $startDate and $endDate are strings

        if (is_string($date)) {

            $newDate = new DateTime($date);
        } elseif (is_a($date, 'DateTime')) {
            $newDate = clone $date;
        } else {
            throw new Exception('Not Date');
        }
        $newDate = Holiday::addWorkingDaysDateTime($newDate, $ndays);
        return $newDate->format('Y/m/d');
    }

    static public function addWorkingDaysDash($date, $ndays) {
        // $startDate and $endDate are strings

        if (is_string($date)) {

            $newDate = new DateTime($date);
        } elseif (is_a($date, 'DateTime')) {
            $newDate = clone $date;
        } else {
            throw new Exception('Not Date');
        }
        $newDate = Holiday::addWorkingDaysDateTime($newDate, $ndays);
        return $newDate->format('Y-m-d');
    }

    static public function addWorkingDaysDateTime($date, $ndays) {
        // $startDate and $endDate are strings

        if (is_string($date)) {
            $newDate = new DateTime($date);
        } elseif (is_a($date, 'DateTime')) {
            $newDate = clone $date;
        } else {
            throw new Exception('Not Date');
        }
        while ($ndays > 0) {
            $newDate->add(new DateInterval('P1D'));
            if (Holiday::isWorkingDay($newDate)) {
                $ndays--;
            }
        }
        return $newDate;
    }


    static public function subWorkingDays($date, $ndays) {
        // $startDate and $endDate are strings

        if (is_string($date)) {

            $newDate = new DateTime($date);
        } elseif (is_a($date, 'DateTime')) {
            $newDate = clone $date;
        } else {
            throw new Exception('Not Date');
        }
        $newDate = Holiday::subWorkingDaysDateTime($newDate, $ndays);
        return $newDate->format('Y/m/d');
    }
    static public function subWorkingDaysDateTime($date, $ndays) {
        // $startDate and $endDate are strings

        if (is_string($date)) {
            $newDate = new DateTime($date);
        } elseif (is_a($date, 'DateTime')) {
            $newDate = clone $date;
        } else {
            throw new Exception('Not Date');
        }
        while ($ndays > 0) {
            $newDate->sub(new DateInterval('P1D'));
            if (Holiday::isWorkingDay($newDate)) {
                $ndays--;
            }
        }
        return $newDate;
    }

    static public function numOfWorkingDays($startDate, $endDate) {
        // $startDate and $endDate are strings
        $days = 0;

        $date1 = new DateTime($startDate);
        $date2 = new DateTime($endDate);

        if (($date1->format("Y") >= 2012) && ($date2->format("Y") >= 2012)) {
            $date1->add(new DateInterval('P1D'));
            while ($date1->format('Ymd') <= $date2->format('Ymd')) {
                if (Holiday::isWorkingDay($date1)) {
                    $days++;
                }
                $date1->add(new DateInterval('P1D'));
            }
        }
        return $days;
    }

    static private function isHoliday($date) {
        if (Holiday::$_holidays == null) {
            $holidayRecords = Holiday::model()->findAll();
            $MyHolidays = array();
            foreach ($holidayRecords as $holidayRecord) {
                $holiday = new DateTime($holidayRecord->holiday);
                $MyHolidays[$holiday->format('Ymd')] = true;
            }
            Holiday::$_holidays = $MyHolidays;
        }
        $ans = isset(Holiday::$_holidays[$date->format('Ymd')]);
        return $ans;
    }

    static public function isWorkingDay($date) {
        return (($date->format('w') > 0) && ($date->format('w') < 6) && !Holiday::isHoliday($date) );
    }

    public static function dateToStringSp($date) {
        $months = array(
            '1' => 'Enero',
            '2' => 'Febrero',
            '3' => 'Marzo',
            '4' => 'Abril',
            '5' => 'Mayo',
            '6' => 'Junio',
            '7' => 'Julio',
            '8' => 'Agosto',
            '9' => 'Septiembre',
            '10' => 'Octubre',
            '11' => 'Noviembre',
            '12' => 'Diciembre',
        );
        $days = array(
            '0' => 'Domingo',
            '1' => 'Lunes',
            '2' => 'Martes',
            '3' => 'Miercoles',
            '4' => 'Jueves',
            '5' => 'Viernes',
            '6' => 'Sábado',
        );

        $d = new DateTime($date);

        $ans = (int) $d->format('d') . ' de ' . $months[(int) $d->format('m')] . ' de ' . (int) $d->format('Y');

        return $ans;
    }

}
