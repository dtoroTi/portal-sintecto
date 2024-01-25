<?php

/**
 * This is the model class for table "{{HtmlSection}}".
 *
 * The followings are the available columns in table '{{HtmlSection}}':
 * @property integer $id
 * @property integer $verificationSectionId
 * @property integer $verificationResultId
 * @property string $answer
 *
 * The followings are the available model relations:
 * @property VerificationResult $verificationResult
 * @property VerificationSection $verificationSection
 * 
 * @property Array $allowedVars Allowed Vars
 */
class HtmlSection extends CActiveRecord {

    private $_answerArray = null;
    private $_optionVarAnswer = null;
    private $_allowerVars = null;

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{HtmlSection}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('verificationSectionId, verificationResultId', 'required'),
            array('verificationSectionId, verificationResultId', 'numerical', 'integerOnly' => true),
            array('answer', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, verificationSectionId, verificationResultId, answer', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'verificationResult' => array(self::BELONGS_TO, 'VerificationResult', 'verificationResultId'),
            'verificationSection' => array(self::BELONGS_TO, 'VerificationSection', 'verificationSectionId'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'verificationSectionId' => 'Sección de Verificación',
            'verificationResultId' => 'Estado de Verificación',
            'answer' => 'Respuesta',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('verificationSectionId', $this->verificationSectionId);
        $criteria->compare('verificationResultId', $this->verificationResultId);
        $criteria->compare('answer', $this->answer, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return HtmlSection the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public static function createBasicRecords($verificationSectionId) {
        $htmlSection = new HtmlSection;
        $htmlSection->verificationSectionId = $verificationSectionId;
        $htmlSection->verificationResultId = VerificationResult::PENDING;
        if (!$htmlSection->save()) {
            Yii::app()->user->setFlash('verificationSection', 'Error saving the htmlSection detial');
            Yii::log("Error Saving the verification section: " . serialize($htmlSection->getErrors()), "error", "ZWF." . __CLASS__);
        }
    }

    function getAnswerArray() {
        if (!$this->_answerArray) {
            if ($this->answer != "") {
                @$ans = unserialize($this->answer);
                if ($ans === false || !is_array($ans)) {
                    $ans = array();
                }
            } else {
                $ans = array();
            }
            $this->_answerArray = $ans;
        }
        return $this->_answerArray;
    }

    public function afterSave() {
        parent::afterSave();
        $this->verificationSection->save();
        return;
    }

    public function getHtmlReport() {
        $ans = $this->replaceVarsForPdf($this->verificationSection->verificationSectionType->htmlSection);
        return $ans;
    }

    public function replaceVarsForPdf($var) {
        return preg_replace_callback(array(
            '/<span name="((rep|sec)_[a-zA-Z0-9_]+)" style="background-color:#ADD8E6">[a-zA-Z0-9_áéíóúÁÉÍÓÚüÜñÑ\&\;\#\s\.\n\(\)]*<\/span>/',
            '/<(input)\s[^>]*>/',
            '/<(select)\s[^>]*>.*<\/select>/',
            '/<(textarea)\s[^>]*>.*<\/textarea>/',
                )
                , array($this, 'callbackReplaceVarForPDF')
                , $var);
    }

    private function callbackReplaceVarForPdf($matches) {
        if (count($matches) > 2 && $matches[2] == 'rep' && isset($this->allowedVars[$matches[1]])) {
            eval('$ans=$this->verificationSection->backgroundCheck->' . $this->allowedVars[$matches[1]]['value'] . ';');
        } else if (count($matches) == 2 && $matches[1] == 'input') {
            $ans = $this->replaceInputForPdf($matches[0]);
        } else if (count($matches) == 2 && $matches[1] == 'select') {
            $ans = $this->replaceSelectForPdf($matches[0]);
        } else if (count($matches) == 2 && $matches[1] == 'textarea') {
            $ans = $this->replaceTextAreaForPdf($matches[0]);
        } else {
            $ans = $matches[0];
        }
        return $ans;
    }

    public function replaceVars($var) {
        return preg_replace_callback(array(
            '/<span name="((rep|sec)_[a-zA-Z0-9_]+)" style="background-color:#ADD8E6">[a-zA-Z0-9_áéíóúÁÉÍÓÚüÜñÑ\&\;\#\s\.\n\(\)]*<\/span>/',
            '/<(input)\s[^>]*>/',
            '/<(select)\s[^>]*>.*<\/select>/',
            '/<(textarea)\s[^>]*>.*<\/textarea>/',
                )
                , array($this, 'callbackReplaceVar')
                , $var);
    }

    private function callbackReplaceVar($matches) {
        if (count($matches) > 2 && $matches[2] == 'rep' && isset($this->allowedVars[$matches[1]])) {
            eval('$ans=$this->verificationSection->backgroundCheck->' . $this->allowedVars[$matches[1]]['value'] . ';');
        } else if (count($matches) == 2 && $matches[1] == 'input') {
            $ans = $this->replaceInput($matches[0]);
        } else if (count($matches) == 2 && $matches[1] == 'select') {
            $ans = $this->replaceSelect($matches[0]);
        } else if (count($matches) == 2 && $matches[1] == 'textarea') {
            $ans = $this->replaceTextArea($matches[0]);
        } else {
            $ans = $matches[0];
        }
        return $ans;
    }

    public function getAnswer($varName) {
        if (isset($this->answerArray[$varName])) {
            $reportValue = $this->answerArray[$varName];
        } else {
            $reportValue = '';
        }
        return $reportValue;
    }

    private function replaceInputForPdf($input) {
        if (!preg_match('/type\s*="([a-zA-Z0-9_]+)"/', $input, $type) ||
                !preg_match('/name\s*="([a-zA-Z0-9_]+)"/', $input, $varName)) {
            return "*****ERROR****";
        }


        preg_match('/value\s*="([^\"]*)"/', $input, $valueSearch);
        if (is_array($valueSearch) && count($valueSearch) == 2) {
            $value = $valueSearch[1];
        } else {
            $value = "";
        }

        $reportValue = $this->getAnswer($varName[1]);

        switch ($type[1]) {
            case 'radio':
                if ($reportValue == $value) {
                    $ans = '<span style="font-family:zapfdingbats">l</span>';
                } else {
                    $ans = '<span style="font-family:zapfdingbats">m</span>';
                }
                break;
            case 'text':
                $ans = $reportValue;
                break;
            case 'checkbox':
                if ($reportValue == $value) {
                    $ans = '<span style="font-family:zapfdingbats">3</span>';
                } else {
                    $ans = '<span style="font-family:zapfdingbats">o</span>';
                }
                break;
            default:
                $ans = '*** ERROR ***';
                break;
        }

        return $ans;
    }

    private function replaceInput($input) {
        if (!preg_match('/type\s*="([a-zA-Z0-9_]+)"/', $input, $type) ||
                !preg_match('/name\s*="([a-zA-Z0-9_]+)"/', $input, $varname)) {
            return $input;
        }

        preg_match('/value\s*="([^\"]*)"/', $input, $valueSearch);
        if (is_array($valueSearch) && count($valueSearch) == 2) {
            $value = $valueSearch[1];
        } else {
            $value = "";
        }

        switch ($type[1]) {
            case 'radio':
                $ans = $this->replaceInputRadiobutton($input, $varname[1], $value);
                break;
            case 'text':
                $ans = $this->replaceInputText($input, $varname[1], $value);
                break;
            case 'checkbox':
                $ans = $this->replaceInputCheckBox($input, $varname[1], $value);
                break;
            default:
                $ans = $input;
                break;
        }

        return $ans;
    }

    private function replaceTextAreaForPdf($input) {
        if (!preg_match('/name\s*="([a-zA-Z0-9_]+)"/', $input, $varNameArr)) {
            return "*** ERROR ***";
        }
        $varName = $varNameArr[1];

        if (isset($this->answerArray[$varName])) {
            $ans = $this->answerArray[$varName];
        } else {
            $ans = '';
        }

        return $ans;
    }

    private function replaceTextArea($input) {
        if (!preg_match('/name\s*="([a-zA-Z0-9_]+)"/', $input, $varNameArr)) {
            return $input;
        }
        $varName = $varNameArr[1];

        $patterns = array(
            '/name\s*="([a-zA-Z0-9_]+)"/',
            '/(<textarea[^>]*>)([~<]*)(<\/textarea>)/',
        );
        $replacements = array(
            'name="verificationSection[' . $this->verificationSectionId . '][_details][' . $this->id . '][$1]"',
        );

        if (isset($this->answerArray[$varName])) {
            $replacements[] = '${1}' . $this->answerArray[$varName] . '${3}';
        } else {
            $replacements[] = '${1}${3}';
        }

        $ans = preg_replace($patterns, $replacements, $input);
        return $ans;
    }

    private function replaceSelectForPdf($input) {
        if (!preg_match('/name\s*="([a-zA-Z0-9_]+)"/', $input, $varNameArr)) {
            return "*** ERROR ****";
        }
        $varName = $varNameArr[1];

        if (isset($this->answerArray[$varName])) {
            $ans = $this->answerArray[$varName];
        } else {
            $ans = '';
        }
        return $ans;
    }

    private function replaceSelect($input) {
        if (!preg_match('/name\s*="([a-zA-Z0-9_]+)"/', $input, $varNameArr)) {
            return $input;
        }
        $varName = $varNameArr[1];

        $patterns = array(
            '/name\s*="([a-zA-Z0-9_]+)"/',
        );
        $replacements = array(
            'name="verificationSection[' . $this->verificationSectionId . '][_details][' . $this->id . '][$1]"',
        );

        if (isset($this->answerArray[$varName])) {
            $this->_optionVarAnswer = $this->answerArray[$varName];
            $inputWithOptions = preg_replace_callback(array(
                '/<option([^>]*)>([^<]*)<\/option>/',
                    )
                    , array($this, 'callbackReplaceVarOption')
                    , $input);
        } else {
            $inputWithOptions = $input;
        }

        $ans = preg_replace($patterns, $replacements, $inputWithOptions);
        return $ans;
    }

    private function callbackReplaceVarOption($matches) {
        if (count($matches) == 3) {
            $patterns = array(
                '/selected\s*="([a-zA-Z0-9_]+)"/',
            );
            $replacements = array(
                '',
            );

            if (preg_match('/value\s*="([^"]+)"/', $matches[1], $valueArr)) {
                $value = $valueArr[1];
            } else {
                $value = null;
            }


            if ($value && $this->_optionVarAnswer == $value) {
                $patterns[] = '/^<option\s*/';
                $replacements[] = '<option selected="selected" ';
            }
            $ans = preg_replace($patterns, $replacements, $matches[0]);
        } else {
            $ans = $matches[0];
        }
        return $ans;
    }

    private function replaceInputText($input, $varName, $value) {
        $patterns = array(
            '/name\s*="([a-zA-Z0-9_]+)"/',
            '/value\s*="[^"]*"/',
        );
        $replacements = array(
            'name="verificationSection[' . $this->verificationSectionId . '][_details][' . $this->id . '][$1]"',
            '',
        );

        if (isset($this->answerArray[$varName])) {
            $patterns[] = '/type\s*="text"/';
            $replacements[] = 'type="text" value="' . $this->answerArray[$varName] . '"';
        }
        $ans = preg_replace($patterns, $replacements, $input);
        return $ans;
    }

    private function replaceInputCheckBox($input, $varName, $value) {
        $patterns = array(
            '/name\s*="([a-zA-Z0-9_]+)"/',
            '/checked\s*="([a-zA-Z0-9_]+)"/',
        );
        $replacements = array(
            'name="verificationSection[' . $this->verificationSectionId . '][_details][' . $this->id . '][$1]"',
            '',
        );

        if (isset($this->answerArray[$varName]) && $this->answerArray[$varName] == $value) {
            $patterns[] = '/type\s*="checkbox"/';
            $replacements[] = 'type="checkbox" checked="checked"';
        }
        $ans = preg_replace($patterns, $replacements, $input);
        return $ans;
    }

    private function replaceInputRadiobutton($input, $varName, $value) {
        $patterns = array(
            '/name\s*="([a-zA-Z0-9_]+)"/',
            '/checked\s*="([a-zA-Z0-9_]+)"/',
        );
        $replacements = array(
            'name="verificationSection[' . $this->verificationSectionId . '][_details][' . $this->id . '][$1]"',
            '',
        );

        if (isset($this->answerArray[$varName]) && $this->answerArray[$varName] == $value) {
            $patterns[] = '/type\s*="radio"/';
            $replacements[] = 'type="radio" checked="checked"';
        }
        $ans = preg_replace($patterns, $replacements, $input);
        return $ans;
    }

    public function getHtmlToFill() {
        $ans = $this->replaceVars($this->verificationSection->verificationSectionType->htmlSection);

        return $ans;
    }

    public function setHtmlAnswer($post) {
        $htmlAns = array();
        foreach ($post as $varName => $val) {
            if ($varName != 'verificationResultId') {
                if (is_array($val)) {
                    $arrayAns = array();
                    foreach ($val as $subVar => $subVal) {
                        $arrayAns[$subVar] = CHtml::encode($val);
                    }
                    $htmlAns[CHtml::encode($varName)] = serialize($arrayAns);
                } else {
                    $htmlAns[CHtml::encode($varName)] = CHtml::encode($val);
                }
            }
        }
        $this->answer = serialize($htmlAns);
        $this->verificationResultId = $post['verificationResultId'];
    }

    public function getAllowedVars() {
        if (!$this->_allowerVars) {
            $this->_allowerVars = PdfReportType::getFullAllowedVars();
        }
        return $this->_allowedVars;
    }

}
