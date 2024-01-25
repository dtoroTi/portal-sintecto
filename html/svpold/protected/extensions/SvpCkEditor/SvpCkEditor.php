<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SvpCkEditor
 *
 * @author hsugieta
 */
class SvpCkEditor extends CInputWidget {
    
    public $variables;
    public $type='noFormCommands';


    function run() {
        list($name, $id) = $this->resolveNameID();
        $attribute = $this->attribute;
        $variables= $this->variables;


        $baseDir = dirname(__FILE__);
        $assets = Yii::app()->getAssetManager()->publish($baseDir . DIRECTORY_SEPARATOR . 'ckeditor');

        $cs = Yii::app()->getClientScript();
        $cs->registerCoreScript('jquery');
        $cs->registerScriptFile($assets . '/ckeditor.js');

        $replaceStrings = '';
        foreach ($variables as $var) {
            $replaceStrings .= "strings{$var['sec']}.push(['<span name=\"{$var['name']}\" style=\"background-color:#ADD8E6\">{$var['sample']}</span> ', '{$var['menu']}', '{$var['description']}']);";
        }

        switch($this->type){
            case('noFormCommands'):
                $jsFile='svpCkEditorNoFormCommands.js';
                break;
            case('advance'):
                $jsFile='svpCkEditor.js';
                break;
            case('others'):
                $jsFile='svpCkEditorAtt.js';
                break;
            default:
                $jsFile='svpCkEditor.js';
                break;
        }
        
        $js = str_replace(
                array('{__TEXT_AREA_ID__}','//{__Strings__}',)
                , array($id,$replaceStrings,)
                , file_get_contents($baseDir . DIRECTORY_SEPARATOR . $jsFile));
        $cs->registerScript('Yii.' . get_class($this) . '#' . $id, $js, CClientScript::POS_LOAD);

        $textarea = <<<EOP
                    <textarea name="{$name}" id="{$id}" rows="10" cols="80">{$this->model->$attribute}</textarea>
EOP;
        echo $textarea;
    }

}
