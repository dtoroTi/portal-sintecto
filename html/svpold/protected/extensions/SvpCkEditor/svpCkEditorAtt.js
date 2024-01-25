/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


CKEDITOR.replace('{__TEXT_AREA_ID__}',
        {
            extraPlugins: 'varInsert',
            language: 'es',
            extraAllowedContent : 'span[name]', 
        }
);



CKEDITOR.plugins.add('varInsert',
        {
            requires: ['richcombo'],
            init: function (editor)
            {
                //  array of strings to choose from that'll be inserted into the editor
                var stringsProd = [];
                var stringsRep = [];
                var stringsSec = [];
                
                //{__Strings__}
                //strings.push(['@@Glossary::displayList()@@', 'Glossary', 'Glossary']);

                // add the menu to the editor
                editor.ui.addRichCombo('varProduct',
                        {
                            label: 'Reporte',
                            title: 'Variables Reporte',
                            voiceLabel: 'Variables de Reporte',
                            className: 'cke_format',
                            multiSelect: false,
                            panel:
                                    {
                                        css: [editor.config.contentsCss, CKEDITOR.skin.getPath('editor')],
                                        voiceLabel: editor.lang.panelVoiceLabel
                                    },
                            init: function ()
                            {
                                this.startGroup("Insertar una variable");
                                for (var i in stringsProd)
                                {
                                    this.add(stringsProd[i][0], stringsProd[i][1], stringsProd[i][2]);
                                }
                            },
                            onClick: function (value)
                            {
                                editor.focus();
                                editor.fire('saveSnapshot');
                                editor.insertHtml(value);
                                editor.fire('saveSnapshot');
                            }
                        });

                // add the menu to the editor
                editor.ui.addRichCombo('varReport',
                        {
                            label: 'Estudio',
                            title: 'Variables Estudio',
                            voiceLabel: 'Variables de Estudio',
                            className: 'cke_format',
                            multiSelect: false,
                            panel:
                                    {
                                        css: [editor.config.contentsCss, CKEDITOR.skin.getPath('editor')],
                                        voiceLabel: editor.lang.panelVoiceLabel
                                    },
                            init: function ()
                            {
                                this.startGroup("Insertar una variable");
                                for (var i in stringsRep)
                                {
                                    this.add(stringsRep[i][0], stringsRep[i][1], stringsRep[i][2]);
                                }
                            },
                            onClick: function (value)
                            {
                                editor.focus();
                                editor.fire('saveSnapshot');
                                editor.insertHtml(value);
                                editor.fire('saveSnapshot');
                            }
                        });
                // add the menu to the editor
                editor.ui.addRichCombo('varSeccion',
                        {
                            label: 'Sección',
                            title: 'Variables de Sección',
                            voiceLabel: 'Variables de Sección',
                            className: 'cke_format',
                            multiSelect: false,
                            panel:
                                    {
                                        css: [editor.config.contentsCss, CKEDITOR.skin.getPath('editor')],
                                        voiceLabel: editor.lang.panelVoiceLabel
                                    },
                            init: function ()
                            {
                                this.startGroup("Insertar una variable");
                                for (var i in stringsSec)
                                {
                                    this.add(stringsSec[i][0], stringsSec[i][1], stringsSec[i][2]);
                                }
                            },
                            onClick: function (value)
                            {
                                editor.focus();
                                editor.fire('saveSnapshot');
                                editor.insertHtml(value);
                                editor.fire('saveSnapshot');
                            }
                        });

            }
        });




CKEDITOR.config.toolbar = [
    {name: 'document', groups: ['mode', 'document', 'doctools'], items: ['Source', '-', 'Save',  'Preview', 'Print']},
    {name: 'clipboard', groups: ['clipboard', 'undo'], items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo']},
    {name: 'editing', groups: ['find', 'selection', 'spellchecker'], items: ['Find', 'Replace', '-', 'SelectAll', '-', 'Scayt']},
    {name: 'forms', items: [ 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select']},
    '/',
    {name: 'basicstyles', groups: ['basicstyles', 'cleanup'], items: ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat']},
    {name: 'paragraph', groups: ['list', 'indent', 'blocks', 'align', 'bidi'], items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-','CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock']},
    {name: 'insert', items: ['Image',  'Table', 'HorizontalRule',  'SpecialChar', 'PageBreak']},
    '/',
    {name: 'styles', items: ['Styles', 'Format', 'Font', 'FontSize']},
    {name: 'colors', items: ['TextColor', 'BGColor']},
    {name: 'tools', items: ['Maximize', 'ShowBlocks']},
    {name: 'others', items: ['-']},
    /*{name: 'strinsert', items:['varProduct']},
    {name: 'strinsert2', items:['varReport']},
    {name: 'strinsert3', items:['varSeccion']},*/
]
;
