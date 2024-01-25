<?php

/**
 * This is the model class for table "{{SDN}}".
 *
 * The followings are the available columns in table '{{SDN}}':
 * @property integer $entNum
 * @property string $SDNName
 * @property string $SDNType
 * @property string $program
 * @property string $title
 * @property string $callSign
 * @property string $vessType
 * @property string $tonnage
 * @property string $GRT
 * @property string $vessFlag
 * @property string $vessOwner
 * @property string $remarks
 *
 * The followings are the available model relations:
 * @property SdnType $sdnTypeId
 * @property SDNALT[] $sDNALTs
 */
class SDN extends CActiveRecord {

    const SDN_FILENAME = 'sdn.pip';
    const SDN_REMOTEFILENAME = 'http://www.treasury.gov/ofac/downloads/sdn.pip';

    public static $preps = array('de', 'y');
    public static $accents = array(
        'Á' => 'A',
        'É' => 'E',
        'Í' => 'I',
        'Ó' => 'O',
        'Ú' => 'U',
        'Ü' => 'U',
        'á' => 'a',
        'é' => 'e',
        'í' => 'i',
        'ó' => 'o',
        'ú' => 'u',
        'ü' => 'u',
        'ñ' => 'n',
        'Ñ' => 'N',
        "'" => ' ',
    );

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return SDN the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{SDN}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('SDNName, SDNType, program, remarks, sdnTypeId', 'required'),
            array('sdnTypeId', 'numerical'),
            array('SDNName', 'length', 'max' => 350),
            array('SDNType', 'length', 'max' => 12),
            array('program', 'length', 'max' => 50),
            array('title', 'length', 'max' => 200),
            array('callSign, GRT', 'length', 'max' => 8),
            array('vessType', 'length', 'max' => 25),
            array('tonnage', 'length', 'max' => 14),
            array('vessFlag', 'length', 'max' => 40),
            array('vessOwner', 'length', 'max' => 150),
            array('remarks', 'length', 'max' => 5000),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('entNum, SDNName, SDNType, program, title, callSign, vessType, tonnage, GRT, vessFlag, vessOwner, remarks, id, entNum, sdnTypeId', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'sDNALTs' => array(self::HAS_MANY, 'SDNALT', 'entNum'),
            'sdnType' => array(self::BELONGS_TO, 'SdnType', 'sdnTypeId'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'id',
            'entNum' => 'Rec. #',
            'SDNName' => 'Nombres',
            'SDNType' => 'Tipo',
            'program' => 'Programa',
            'title' => 'Título',
            'callSign' => 'Call Sign',
            'vessType' => 'Vess Type',
            'tonnage' => 'Tonnage',
            'GRT' => 'Grt',
            'vessFlag' => 'Vess Flag',
            'vessOwner' => 'Vess Owner',
            'remarks' => 'Anotaciones o ID',
            'sdnTypeId' => 'Lista',
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

        $criteria->compare('entNum', $this->entNum);
        $criteria->compare('SDNName', $this->SDNName, true);
        $criteria->compare('SDNType', $this->SDNType, true);
        $criteria->compare('program', $this->program, true);
        $criteria->compare('title', $this->title, true);
        $criteria->compare('callSign', $this->callSign, true);
        $criteria->compare('vessType', $this->vessType, true);
        $criteria->compare('tonnage', $this->tonnage, true);
        $criteria->compare('GRT', $this->GRT, true);
        $criteria->compare('vessFlag', $this->vessFlag, true);
        $criteria->compare('vessOwner', $this->vessOwner, true);
        $criteria->compare('remarks', $this->remarks, true);
        $criteria->compare('sdnTypeId', $this->sdnTypeId, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public static function searchRecord($firstname, $lastname, $remarks, $noPreps, $oneFirstOneLast, $allLast, $sdnTypeId) {

        $firstname = strtolower(SDN::plainEnglish($firstname));
        $lastname = strtolower(SDN::plainEnglish($lastname));
        $remarks = strtolower(SDN::plainEnglish($remarks));

        if ($noPreps) {
            $firstname = str_replace(SDN::$preps, '', $firstname);
            $lastname = str_replace(SDN::$preps, '', $lastname);
            $remarks = str_replace(SDN::$preps, '', $remarks);
        }

        $firstnames = explode(" ", $firstname);
        $lastnames = explode(" ", $lastname);
        $remarksArray = explode(" ", $remarks);

        foreach ($firstnames as $key => $link) {
            if ($link == '')
                unset($firstnames[$key]);
        }
        foreach ($lastnames as $key => $link) {
            if ($link == '')
                unset($lastnames[$key]);
        }
        foreach ($remarksArray as $key => $link) {
            if ($link == '')
                unset($remarksArray[$key]);
        }

        $matches = array_merge($firstnames, $lastnames, $remarksArray);

        $criteria = new CDbCriteria;

        $condition = array();

        $mainCond = array();
        foreach ($firstnames as $fn) {
            $mainCond[] = " SDNName like '%" . $fn . "%' ";
        }
        foreach ($lastnames as $ln) {
            $mainCond[] = " SDNName like '%" . $ln . "%' ";
        }
        if (count($mainCond) > 0) {
            $condition[] = "(" . implode(" and ", $mainCond) . ")";
        }

        foreach ($remarksArray as $rm) {
            $rm1 = str_replace('.', '', $rm);  //Remove the  
            if (strlen($rm1) > 1) {
                $condition[] = " remarks like '%" . $rm1 . "%' ";
            }
        }

        if ($oneFirstOneLast) {
            foreach ($firstnames as $fn) {
                foreach ($lastnames as $ln) {
                    $condition[] = " (SDNName like '%" . $fn . "%' and SDNName like '%" . $ln . "%')";
                }
            }
        }

        $mainCond = array();
        foreach ($lastnames as $ln) {
            $mainCond[] = " SDNName like '%" . $ln . "%' ";
        }
        if (count($mainCond) > 0) {
            $condition[] = "(" . implode(($allLast?" and ":" or "), $mainCond) . ")";
        }

        $conditions = implode(" or ", $condition);

        $criteria->condition = $conditions;

        if($sdnTypeId!= NULL || $sdnTypeId!=''){
            $criteria->addCondition("t.sdnTypeId='".$sdnTypeId."'");
        }

        $rows = SDN::model()->findAll($criteria);
        return array('rows' => $rows, 'matches' => $matches);
    }

    public static function plainEnglish($str) {
        $str = str_replace(array_keys(SDN::$accents), SDN::$accents, $str);
        return $str;
    }

    //proceso consultas OFAC
    //Natalia Henao 02/12/2021
    public static function getverifiedRecords($records){
        $ans=['verified'=>[], 'new'=>[], 'hash'=>md5(implode($records['matches']))];
        //$hashPerson=md5(implode($records['matches']));

        foreach($records['rows'] as $row){

            $verifeid=VerifiedRecords::model()->findByAttributes(['hashrecord'=>$row->getHash(), 'hashperson'=>$ans['hash']]);

            if($verifeid){
                $ans['verified'][]=$row;
            }else{
                $ans['new'][]=$row;
            }
        }
        return $ans;
    }

    public function getHash(){
        return md5($this->sdnTypeId.$this->entNum.$this->SDNName.$this->program.$this->remarks);
    }

    static public function markPaterns($str, $matches, $block) {
        usort($matches, "SDN::sortMatches");
        $matches1 = array();
        $replace1 = array();
        $matches2 = array();
        $replace2 = array();
        $i = 0;
        foreach ($matches as $match) {
            $matches1[] = '/' . $match . '/i';
            $matches2[] = sprintf("/_%d_/", $i);
            $replace1[] = sprintf("_%d_", $i);
            $replace2[] = '<span class="RedMatch">' . strtoupper($match) . '</span>';
            $i++;
        }
        $str1 = preg_replace($matches1, $replace1, $str);
        return preg_replace($matches2, $replace2, $str1);
    }

    static public function sortMatches($a, $b) {
        return (strlen($a) > strlen($b) ? -1 : 1);
    }

}
