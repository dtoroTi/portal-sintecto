<?php

class CustomerProductController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    //public $layout='//layouts/column2';
    public $defaultAction = 'admin';

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $model = $this->loadModel($id);
        if (isset($_POST['verification'])) {
            VerificationInProduct::model()->deleteAllByAttributes(array('customerProductId' => $model->id));
            foreach ($_POST['verification'] as $id => $verification) {
                if (isset($verification['include']) && ($verification['include'] == true)) {
                    $newVerification = new VerificationInProduct;
                    $newVerification->weight = $verification['weight'];
                    $newVerification->showOrder = $verification['showOrder'];
                    $newVerification->cost = $verification['cost'];
                    $newVerification->price = $verification['price'];
                    $newVerification->comments = $verification['comments'];
                    $newVerification->verificationSectionTypeId = $id;
                    $newVerification->customerProductId = $model->id;
                    $newVerification->save();
                }
            }
        }
        $this->render('view', array(
            'model' => $model,
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new CustomerProduct;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['CustomerProduct'])) {
            $model->attributes = $_POST['CustomerProduct'];
            
            if($_POST['CustomerProduct']['isStandard']==1)
            {
                $model->description = $this->htmlStandard(); 
                $model->description2 = $this->htmlStandard(); 
            }else{
                $model->description = $this->htmlStandardNew();
                $model->description2 = $this->htmlStandardNew(); 
            }
            
            if ($model->save())
                WebUser::logAccess("Creo Producto : {$model->name}, al cliente: {$model->customer->name}");
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['CustomerProduct'])) {

            $modelOld=$model->getAttributes(true);

            $model->attributes = $_POST['CustomerProduct'];

            $modelNew=$model->getAttributes(true);

            WebUser::logRecordChange("Cambio Producto Cliente: {$model->customer->name}:{$model->name}", null, get_class($model), $modelNew, $modelOld);

            if ($model->save()) {
                if (!isset($_POST['continue'])) {
                    $this->redirect(array('view', 'id' => $model->id));
                }
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionEditDescription($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['CustomerProduct'])) {
            $p = new CHtmlPurifier();
            $p->options = array('URI.AllowedSchemes' => array(
                    'span' => true,
                )
            );
            $text = $p->purify($_POST['CustomerProduct']['description']);

            $model->description = $text;



            if ($model->save()) {
                //WebUser::logAccess("Modifico Desc.");
                WebUser::logAccess("Modifico Desc, del cliente : {$model->customer->name} Producto: {$model->name}");
                if (!isset($_POST['continue'])) {
                    $this->redirect(array('admin'));
                }
            }
        }

        $this->render('editDescription', array(
            'model' => $model,
        ));
    }

    public function actionEditDescriptionFac($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['CustomerProduct'])) {
            $p = new CHtmlPurifier();
            $p->options = array('URI.AllowedSchemes' => array(
                'span' => true,
            )
            );
            $text = $p->purify($_POST['CustomerProduct']['facturacion']);

            $model->facturacion = $text;



            if ($model->save()) {
                WebUser::logAccess("Modifico Fac.");
                if (!isset($_POST['continue'])) {
                    $this->redirect(array('admin'));
                }
            }
        }

        $this->render('editDescriptionFac', array(
            'model' => $model,
        ));
    }
    public function actionEditDescriptionGlosar($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['CustomerProduct'])) {
            $p = new CHtmlPurifier();
            $p->options = array('URI.AllowedSchemes' => array(
                'span' => true,
            )
            );
            $text = $p->purify($_POST['CustomerProduct']['glossary']);

            $model->glossary = $text;



            if ($model->save()) {
                WebUser::logAccess("Modifico Glosar.");
                if (!isset($_POST['continue'])) {
                    $this->redirect(array('admin'));
                }
            }
        }

        $this->render('editDescriptionGlosar', array(
            'model' => $model,
        ));
    }


    public function actionEditXmlFormat($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['CustomerProduct'])) {
            $model->attributes = $_POST['CustomerProduct'];

            if ($model->save()) {
                if (!isset($_POST['continue'])) {
                    $this->redirect(array('admin'));
                }
                $model->refresh();
            }
        }

        $this->render('editXmlFormat', array(
            'model' => $model,
        ));
    }

    public function actionEditDescriptionNew($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['CustomerProduct'])) {
            $p = new CHtmlPurifier();
            $p->options = array('URI.AllowedSchemes' => array(
                    'span' => true,
                )
            );
            $text = $p->purify($_POST['CustomerProduct']['description2']);

            $model->description2 = $text;



            if ($model->save()) {
                //WebUser::logAccess("Modifico Desc.");
                WebUser::logAccess("Modifico Desc New, del cliente : {$model->customer->name} Producto: {$model->name}");
                if (!isset($_POST['continue'])) {
                    $this->redirect(array('admin'));
                }
            }
        }

        $this->render('editDescriptionNew', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            $this->loadModel($id)->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        } else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = GridViewFilter::getFilter('CustomerProduct', 'search');
        if (isset($_GET['CustomerProduct']))
            $model->attributes = $_GET['CustomerProduct'];

        if (isset($_GET['_export'])) {
            $this->renderPartial('_csvAdmin', array(
                'model' => $model,
            ));
        } else {
            $this->render('admin', array(
                'model' => $model,
            ));
        }
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        if (Yii::app()->user->getIsByRole()) {
			return CustomerProduct::model()->findByPk($id);
		}else if (Yii::app()->user->isAdmin) {
            $model = CustomerProduct::model()->findByPk($id);
            if ($model === null)
                throw new CHttpException(404, 'The requested page does not exist.');
            return $model;
        }else{
            throw new CHttpException(404, 'The requested page does not exist.');
        }
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'customer-product-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public static function htmlStandard(){
        $textHtml='<p style="text-align:left;"> </p>
        <table style="width:1100px;" border="1" cellspacing="0" cellpadding="0" align="center"><tbody><tr><td style="text-align:center;"> </td>
        <td style="text-align:center;"><strong><span style="font-size:small;">PARAMETRIZACIÓN CLIENTES TRANSACCIONALES</span></strong></td>
        <td style="text-align:left;"> 
        <p>Código. S-GC-FR-18<br />Versión:1<br />Fecha: 13/03/2023<br /> Página 1 de 3</p>
        </td>
        </tr></tbody></table><table style="width:1100px;" border="1" cellspacing="0" cellpadding="0" align="center"><tbody><tr><td style="text-align:center;"><span style="color:#002060;font-size:x-large;"><strong>Parámetro Estándar</strong></span></td>
        </tr></tbody></table><table style="width:1100px;background-color:#002060;" border="1" cellspacing="0" cellpadding="0" align="center"><tbody><tr><td class="xl66" rowspan="2" width="530" height="30"><span style="font-size:small;color:#ffffff;">Certificado cédula de ciudadanía<span class="font6" style="color:#ff0000;"> **</span><span class="font5"> (Cancelado por muerte/Extranjería/Falsa identidad)</span></span></td>
        <td class="xl67" style="text-align:center;background-color:#ffc7ce;width:202px;" rowspan="2"><span style="font-size:small;color:#9c0006;">CH</span></td>
        <td class="xl68" width="544"><span style="font-size:small;color:#ffffff;">Rama Judicial Justicia Siglo XXI (TYBA)</span></td>
        <td class="xl69" style="text-align:center;background-color:#ffeb9c;width:198px;"><span style="font-size:small;color:#9c5700;">CHM</span></td>
        </tr><tr><td class="xl68" width="544"><span style="color:#ffffff;font-size:small;">Procesos Penales </span></td>
        <td class="xl69" style="text-align:center;background-color:#ffc7ce;width:198px;"><span style="font-size:small;color:#9c0006;">CH</span></td>
        </tr><tr><td class="xl66" width="530" height="20"><span style="font-size:small;color:#ffffff;">Antecedentes disciplinarios Procuraduría</span></td>
        <td class="xl67" style="text-align:center;background-color:#ffc7ce;width:202px;"><span style="font-size:small;color:#9c0006;">CH</span></td>
        <td class="xl68" width="544"><span style="font-size:small;color:#ffffff;">Antecedentes Personería de Bogotá</span></td>
        <td class="xl69" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:small;color:#006100;">SH</span></td>
        </tr><tr><td class="xl66" width="530" height="20"><span style="font-size:small;color:#ffffff;">Contraloría</span></td>
        <td class="xl69" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:small;color:#006100;">SH</span></td>
        <td class="xl68" width="544"><span style="font-size:small;color:#ffffff;">Policía Nacional (Preséntese inmediatamente /Actualmente no es requerido)</span></td>
        <td class="xl67" style="text-align:center;background-color:#ffc7ce;width:202px;"><span style="font-size:small;color:#9c0006;">CH</span></td>
        </tr><tr><td class="xl66" width="530" height="20"><span style="font-size:small;color:#ffffff;">INPEC</span></td>
        <td class="xl67" style="text-align:center;background-color:#ffc7ce;width:202px;"><span style="font-size:small;color:#9c0006;">CH</span></td>
        <td class="xl68" width="544"><span style="font-size:small;color:#ffffff;">SIMIT</span></td>
        <td class="xl69" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:small;color:#006100;">SH</span></td>
        </tr><tr><td class="xl66" rowspan="2" width="530" height="20"><span style="font-size:small;color:#ffffff;">Registro Nacional de medidas correctivas<span style="color:#ff0000;">**</span> </span></td>
        <td class="xl69" style="text-align:center;background-color:#ffeb9c;width:198px;" rowspan="2"><span style="font-size:small;color:#9c5700;">CHM</span></td>
        <td class="xl68" width="544"><span style="font-size:small;color:#ffffff;"><span>Multas por estado de embriaguez o sustancias Psicoactivas</span></span></td>
        <td class="xl69" style="text-align:center;background-color:#ffc7ce;width:198px;"><span style="font-size:small;color:#9c0006;">CH</span></td>
        </tr><tr><td class="xl68" width="544"><span style="color:#ffffff;font-size:small;">SIMUR </span></td>
        <td class="xl69" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:small;color:#006100;">SH</span></td>
        </tr><tr><td class="xl66" width="530" height="20"><span style="font-size:small;color:#ffffff;">SECOP<span style="color:#ff0000;">**</span></span></td>
        <td class="xl69" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:small;color:#006100;">SH</span></td>
        <td class="xl68" width="544"><span style="font-size:small;color:#ffffff;">RUNT</span></td>
        <td class="xl69" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:small;color:#006100;">SH</span></td>
        </tr><tr><td class="xl66" width="530" height="20"><span style="font-size:small;color:#ffffff;">Inhabilidades Delitos Sexuales<span style="color:#ff0000;">**</span></span></td>
        <td class="xl67" style="text-align:center;background-color:#ffc7ce;width:202px;"><span style="font-size:small;color:#9c0006;">CH</span></td>
        <td class="xl68" width="544"><span style="font-size:small;color:#ffffff;">Libreta Militar</span></td>
        <td class="xl69" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:small;color:#006100;">SH</span></td>
        </tr></tbody></table><table style="width:1100px;" border="1" cellspacing="0" cellpadding="0" align="center"><tbody><tr><td style="width:950px;background-color:#002060;text-align:center;"><span style="font-size:medium;color:#ffffff;">          Rama Judicial JEPMS (Juzgados de Ejecución de Penas y Medidas de Seguridad)       </span></td>
        <td style="background-color:#002060;text-align:center;">
        <p><span style="color:#ffffff;">  </span><span style="color:#ffffff;font-size:small;">Búsqueda por ID</span></p>
        </td>
        </tr></tbody></table><table style="width:1100px;" border="1" cellspacing="0" cellpadding="0" align="center"><colgroup><col width="530" /><col width="202" /><col width="544" /><col width="198" /></colgroup><tbody><tr><td class="xl67" width="530" height="20"><span style="font-size:x-small;">Cali</span></td>
        <td class="xl66" style="text-align:center;background-color:#ffc7ce;width:202px;"><span style="font-size:x-small;color:#9c0006;">CH</span></td>
        <td class="xl67" width="544"><span style="font-size:x-small;">Popayán</span></td>
        <td class="xl66" style="text-align:center;background-color:#ffc7ce;width:202px;"><span style="font-size:x-small;color:#9c0006;">CH</span></td>
        </tr><tr><td class="xl67" width="530" height="20"><span style="font-size:x-small;">Ibague</span></td>
        <td class="xl667" style="text-align:center;background-color:#ffc7ce;width:202px;"><span style="font-size:x-small;color:#9c0006;">CH</span></td>
        <td class="xl67" width="544"><span style="font-size:x-small;">Buga</span></td>
        <td class="xl66" style="text-align:center;background-color:#ffc7ce;width:202px;"><span style="font-size:x-small;color:#9c0006;">CH</span></td>
        </tr><tr><td class="xl67" width="530" height="20"><span style="font-size:x-small;">Neiva</span></td>
        <td class="xl66" style="text-align:center;background-color:#ffc7ce;width:202px;"><span style="font-size:x-small;color:#9c0006;">CH</span></td>
        <td class="xl67" width="544"><span style="font-size:x-small;">Medellin</span></td>
        <td class="xl66" style="text-align:center;background-color:#ffc7ce;width:202px;"><span style="font-size:x-small;color:#9c0006;">CH</span></td>
        </tr><tr><td class="xl67" width="530" height="20"><span style="font-size:x-small;">Bogota</span></td>
        <td class="xl66" style="text-align:center;background-color:#ffc7ce;width:202px;"><span style="font-size:x-small;color:#9c0006;">CH</span></td>
        <td class="xl67" width="544"><span style="font-size:x-small;">Villavicencio</span></td>
        <td class="xl66" style="text-align:center;background-color:#ffc7ce;width:202px;"><span style="font-size:x-small;color:#9c0006;">CH</span></td>
        </tr><tr><td class="xl67" width="530" height="20"><span style="font-size:x-small;">Pasto</span></td>
        <td class="xl66" style="text-align:center;background-color:#ffc7ce;width:202px;"><span style="font-size:x-small;color:#9c0006;">CH</span></td>
        <td class="xl67" width="544"><span style="font-size:x-small;">Florencia</span></td>
        <td class="xl66" style="text-align:center;background-color:#ffc7ce;width:202px;"><span style="font-size:x-small;color:#9c0006;">CH</span></td>
        </tr><tr><td class="xl67" width="530" height="20"><span style="font-size:x-small;">Monteria</span></td>
        <td class="xl66" style="text-align:center;background-color:#ffc7ce;width:202px;"><span style="font-size:x-small;color:#9c0006;">CH</span></td>
        <td class="xl67" width="544"><span style="font-size:x-small;">Quibdo</span></td>
        <td class="xl66" style="text-align:center;background-color:#ffc7ce;width:202px;"><span style="font-size:x-small;color:#9c0006;">CH</span></td>
        </tr><tr><td class="xl67" width="530" height="20"><span style="font-size:x-small;">Armenia</span></td>
        <td class="xl66" style="text-align:center;background-color:#ffc7ce;width:202px;"><span style="font-size:x-small;color:#9c0006;">CH</span></td>
        <td class="xl67" width="544"><span style="font-size:x-small;">Pereira</span></td>
        <td class="xl66" style="text-align:center;background-color:#ffc7ce;width:202px;"><span style="font-size:x-small;color:#9c0006;">CH</span></td>
        </tr><tr><td class="xl67" width="530" height="20"><span style="font-size:x-small;">Tunja</span></td>
        <td class="xl66" style="text-align:center;background-color:#ffc7ce;width:202px;"><span style="font-size:x-small;color:#9c0006;">CH</span></td>
        <td class="xl67" width="544"><span style="font-size:x-small;">Manizales</span></td>
        <td class="xl66" style="text-align:center;background-color:#ffc7ce;width:202px;"><span style="font-size:x-small;color:#9c0006;">CH</span></td>
        </tr><tr><td class="xl67" width="530" height="20"><span style="font-size:x-small;">Palmira</span></td>
        <td class="xl66" style="text-align:center;background-color:#ffc7ce;width:202px;"><span style="font-size:x-small;color:#9c0006;">CH</span></td>
        <td class="xl67" width="544"><span style="font-size:x-small;">Bucaramanga</span></td>
        <td class="xl66" style="text-align:center;background-color:#ffc7ce;width:202px;"><span style="font-size:x-small;color:#9c0006;">CH</span></td>
        </tr><tr><td class="xl67" width="530" height="20"><span style="font-size:x-small;">Cartagena</span></td>
        <td class="xl66" style="text-align:center;background-color:#ffc7ce;width:202px;"><span style="font-size:x-small;color:#9c0006;">CH</span></td>
        <td class="xl67" width="544"><span style="font-size:x-small;">Barranquilla</span></td>
        <td class="xl66" style="text-align:center;background-color:#ffc7ce;width:202px;"><span style="font-size:x-small;color:#9c0006;">CH</span></td>
        </tr></tbody></table><table style="width:1100px;" border="1" cellspacing="0" cellpadding="0" align="center"><tbody><tr><td style="width:950px;background-color:#002060;text-align:center;"><span style="font-size:large;color:#ffffff;">Listas vinculantes</span></td>
        <td style="background-color:#002060;text-align:center;">
        <p><span style="color:#ffffff;">  </span><span style="color:#ffffff;font-size:small;">Búsqueda por ID</span></p>
        </td>
        </tr></tbody></table><table style="width:1100px;" border="1" cellspacing="0" cellpadding="0" align="center"><colgroup><col width="530" /><col width="202" /><col width="544" /><col width="198" /></colgroup><tbody><tr><td class="xl67" width="530" height="35"><span style="font-size:x-small;">Department of State list of Foreign Terrorist Organizations FTO</span></td>
        <td class="xl66" style="text-align:center;background-color:#ffc7ce;width:202px;"><span style="font-size:x-small;color:#9c0006;">CH</span></td>
        <td class="xl67" width="544"><span style="font-size:x-small;">EU Consolidated list of sanctions</span></td>
        <td class="xl66" style="text-align:center;background-color:#ffc7ce;width:202px;"><span style="font-size:x-small;color:#9c0006;">CH</span></td>
        </tr><tr><td class="xl67" width="530" height="35"><span style="font-size:x-small;">Lista Departamento de Estado EEUU Organizaciones extranjeras terroristas FTO</span></td>
        <td class="xl66" style="text-align:center;background-color:#ffc7ce;width:202px;"><span style="font-size:x-small;color:#9c0006;">CH</span></td>
        <td class="xl67" width="544"><span style="font-size:x-small;">Lista Unión Europea de organizaciones terroristas</span></td>
        <td class="xl66" style="text-align:center;background-color:#ffc7ce;width:202px;"><span style="font-size:x-small;color:#9c0006;">CH</span></td>
        </tr><tr><td class="xl67" width="530" height="20"><span style="font-size:x-small;">EU Consolidated list of sanctions terrorism</span></td>
        <td class="xl66" style="text-align:center;background-color:#ffc7ce;width:202px;"><span style="font-size:x-small;color:#9c0006;">CH</span></td>
        <td class="xl67" width="544"><span style="font-size:x-small;">UN Security council list</span></td>
        <td class="xl66" style="text-align:center;background-color:#ffc7ce;width:202px;"><span style="font-size:x-small;color:#9c0006;">CH</span></td>
        </tr><tr><td class="xl67" width="530" height="35"><span style="font-size:x-small;">Lista Unión Europea de personas catalogadas como terroristas</span></td>
        <td class="xl66" style="text-align:center;background-color:#ffc7ce;width:202px;"><span style="font-size:x-small;color:#9c0006;">CH</span></td>
        <td class="xl67" width="544"><span style="font-size:x-small;">Lista Consejo de Seguridad de la ONU</span></td>
        <td class="xl66" style="text-align:center;background-color:#ffc7ce;width:202px;"><span style="font-size:x-small;color:#9c0006;">CH</span></td>
        </tr></tbody></table><table style="width:1100px;" border="1" cellspacing="0" cellpadding="0" align="center"><tbody><tr><td style="width:950px;background-color:#002060;text-align:center;"><span style="font-size:large;color:#ffffff;">Listas restrictivas</span></td>
        <td style="background-color:#002060;text-align:center;">
        <p><span style="color:#ffffff;font-size:small;">   Búsqueda por ID</span></p>
        </td>
        </tr></tbody></table><table style="width:1100px;" border="1" cellspacing="0" cellpadding="0" align="center"><colgroup><col width="530" /><col width="202" /><col width="544" /><col width="198" /></colgroup><tbody><tr><td class="xl68" width="530" height="20">Lista Panama Papers</td>
        <td class="xl69" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:x-small;color:#006100;">SH</span></td>
        <td class="xl68" width="544">The Arms Export Control Act (AECA)</td>
        <td class="xl69" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:x-small;color:#006100;">SH</span></td>
        </tr><tr><td class="xl68" width="530" height="35">Lista personas y empresas vinculadas al escandalo Panama Papers</td>
        <td class="xl69" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:x-small;color:#006100;">SH</span></td>
        <td class="xl68" width="544">Ley de Control de Exportación de Armas (AECA)</td>
        <td class="xl69" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:x-small;color:#006100;">SH</span></td>
        </tr><tr><td class="xl68" width="530" height="20">World Bank Listing of Ineligible Firms and Individuals</td>
        <td class="xl69" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:x-small;color:#006100;">SH</span></td>
        <td class="xl68" width="544">Comité de Sanciones del Grupo BID</td>
        <td class="xl69" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:x-small;color:#006100;">SH</span></td>
        </tr><tr><td class="xl68" width="530" height="35">Empresas sancionadas Banco Mundial</td>
        <td class="xl69" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:x-small;color:#006100;">SH</span></td>
        <td class="xl68" width="544">Comité BID empresas sancionadas por prácticas fraudulentas, corruptas, colusorias, coercitivas u obstructivas</td>
        <td class="xl69" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:x-small;color:#006100;">SH</span></td>
        </tr><tr><td class="xl68" width="530" height="20">Consolidated Canadian Autonomous Sanctions List</td>
        <td class="xl69" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:x-small;color:#006100;">SH</span></td>
        <td class="xl68" width="544">EEUU Denied Persons List BIS</td>
        <td class="xl69" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:x-small;color:#006100;">SH</span></td>
        </tr><tr><td class="xl68" width="530" height="20">Lista Consolidada de sanciones autonomas de Canada</td>
        <td class="xl69" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:x-small;color:#006100;">SH</span></td>
        <td class="xl68" width="544">Lista de Personas prohibidas a exportar EEUU</td>
        <td class="xl69" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:x-small;color:#006100;">SH</span></td>
        </tr><tr><td class="xl68" width="530" height="20">EEUU Entity List BIS</td>
        <td class="xl69" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:x-small;color:#006100;">SH</span></td>
        <td class="xl68" width="544">Foreign Corrupt Practices Act List EEUU</td>
        <td class="xl66" style="text-align:center;background-color:#ffc7ce;width:202px;"><span style="font-size:x-small;color:#9c0006;">CH</span></td>
        </tr><tr><td class="xl68" width="530" height="20">Lista Entes prohibidos a recibir mercancias EEUU</td>
        <td class="xl69" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:x-small;color:#006100;">SH</span></td>
        <td class="xl68" width="544">Lista Ley de Prácticas Corruptas en el Extranjero FCPA EEUU</td>
        <td class="xl66" style="text-align:center;background-color:#ffc7ce;width:202px;"><span style="font-size:x-small;color:#9c0006;">CH</span></td>
        </tr><tr><td class="xl68" width="530" height="35">Office of Foreign Assets Control OFAC</td>
        <td class="xl69" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:x-small;color:#006100;">SH</span></td>
        <td class="xl68" width="544">List of Foreign Financial Institutions Subject to Correspondent Account or Payable-Through Account Sanctions (CAPTA List)</td>
        <td class="xl69" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:x-small;color:#006100;">SH</span></td>
        </tr><tr><td class="xl68" width="530" height="45">OFAC Lista Clinton</td>
        <td class="xl66" style="text-align:center;background-color:#ffc7ce;width:202px;"><span style="font-size:x-small;color:#9c0006;">CH</span></td>
        <td class="xl68" width="544">Lista de Instituciones Financieras Extranjeras sujetas a Sanciones por Cuenta Corresponsal o Cuenta Pagadera (Lista CAPTA)</td>
        <td class="xl69" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:x-small;color:#006100;">SH</span></td>
        </tr><tr><td class="xl68" width="530" height="20">OFAC Non-SDN Palestinian Legislative Council (NS-PLC) list</td>
        <td class="xl66" style="text-align:center;background-color:#ffc7ce;width:202px;"><span style="font-size:x-small;color:#9c0006;">CH</span></td>
        <td class="xl68" width="544">UK HM Treasury sanctions list</td>
        <td class="xl69" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:x-small;color:#006100;">SH</span></td>
        </tr><tr><td class="xl68" width="530" height="20">OFAC Foreign Sanctions Evaders (FSE) List</td>
        <td class="xl66" style="text-align:center;background-color:#ffc7ce;width:202px;"><span style="font-size:x-small;color:#9c0006;">CH</span></td>
        <td class="xl68" width="544">Lista de entes sancionados Gran Bretaña</td>
        <td class="xl69" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:x-small;color:#006100;">SH</span></td>
        </tr><tr><td class="xl68" width="530" height="20">OFAC Lista de evasores de sanciones extranjeras (FSE)</td>
        <td class="xl66" style="text-align:center;background-color:#ffc7ce;width:202px;"><span style="font-size:x-small;color:#9c0006;">CH</span></td>
        <td class="xl68" width="544">Lista OSFI Canada</td>
        <td class="xl69" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:x-small;color:#006100;">SH</span></td>
        </tr><tr><td class="xl68" width="530" height="35">OFAC Sectoral Sanctions Identifications (SSI) List</td>
        <td class="xl66" style="text-align:center;background-color:#ffc7ce;width:202px;"><span style="font-size:x-small;color:#9c0006;">CH</span></td>
        <td class="xl68" width="544">Lista Office of the Superintendent of Financial Institutions Canada</td>
        <td class="xl69" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:x-small;color:#006100;">SH</span></td>
        </tr><tr><td class="xl68" width="530" height="35">OFAC Lista de identificaciones de sancionadas sectoriales (SSI)</td>
        <td class="xl66" style="text-align:center;background-color:#ffc7ce;width:202px;"><span style="font-size:x-small;color:#9c0006;">CH</span></td>
        <td class="xl68" width="544">Lista del Consejo Legislativo Palestino no SDN (NS-PLC)</td>
        <td class="xl69" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:x-small;color:#006100;">SH</span></td>
        </tr><tr><td class="xl68" width="530" height="20">OFAC Non-SDN Menu-Based Sanctions List (NS-MBS List)</td>
        <td class="xl66" style="text-align:center;background-color:#ffc7ce;width:202px;"><span style="font-size:x-small;color:#9c0006;">CH</span></td>
        <td class="xl68" width="544">EEUU Unverified List BIS</td>
        <td class="xl69" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:x-small;color:#006100;">SH</span></td>
        </tr><tr><td class="xl68" width="530" height="35">OFAC Lista de sanciones basada en menús no SDN (Lista NS-MBS)</td>
        <td class="xl66" style="text-align:center;background-color:#ffc7ce;width:202px;"><span style="font-size:x-small;color:#9c0006;">CH</span></td>
        <td class="xl68" width="544">Entes no elegibles para recibir artículos sujetos a las Regulaciones de la Administración de Exportaciones EEUU</td>
        <td class="xl69" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:x-small;color:#006100;">SH</span></td>
        </tr><tr><td class="xl68" width="530" height="20">OFAC Non-SDN Iranian Sanctions Act (NS-ISA) List</td>
        <td class="xl66" style="text-align:center;background-color:#ffc7ce;width:202px;"><span style="font-size:x-small;color:#9c0006;">CH</span></td>
        <td class="xl68" width="544">OFAC Lista de la Ley de sanciones iraníes no SDN (NS-ISA)</td>
        <td class="xl66" style="text-align:center;background-color:#ffc7ce;width:202px;"><span style="font-size:x-small;color:#9c0006;">CH</span></td>
        </tr></tbody></table><table style="width:1100px;" border="1" cellspacing="0" cellpadding="0" align="center"><tbody><tr><td style="width:950px;background-color:#002060;text-align:center;"><span style="font-size:large;color:#ffffff;">Noticias Reputacionales</span></td>
        <td style="background-color:#002060;text-align:center;">
        <p><span style="color:#ffffff;font-size:small;">  Búsqueda </span><span style="color:#ffffff;font-size:small;">por Denominación </span></p>
        </td>
        </tr></tbody></table><table style="width:1100px;" border="1" cellspacing="0" cellpadding="0" align="center"><colgroup><col width="530" /><col width="202" /><col width="544" /><col width="198" /></colgroup><tbody><tr><td class="xl67" width="530" height="20">Noticias extraditados Corte Suprema de Justicia</td>
        <td class="xl66" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:x-small;color:#006100;">SH</span></td>
        <td class="xl67" width="544">Noticias Fiscalía General de la Nación LAFT</td>
        <td class="xl66" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:x-small;color:#006100;">SH</span></td>
        </tr><tr><td class="xl67" width="530" height="20">Noticias Policía Nacional LAFT</td>
        <td class="xl66" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:x-small;color:#006100;">SH</span></td>
        <td class="xl67" width="544">Noticias Presidencia LAFT</td>
        <td class="xl66" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:x-small;color:#006100;">SH</span></td>
        </tr><tr><td class="xl67" width="530" height="20">Actividades corruptas o illegales Insight Crime</td>
        <td class="xl66" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:x-small;color:#006100;">SH</span></td>
        <td class="xl67" width="544">Fugitivos DEA</td>
        <td class="xl66" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:x-small;color:#006100;">SH</span></td>
        </tr><tr><td class="xl67" width="530" height="20">Lista de Personas y Grupos Terroristas Guardia Civil Española</td>
        <td class="xl66" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:x-small;color:#006100;">SH</span></td>
        <td class="xl67" width="544">Fugitivos más buscados por la DEA</td>
        <td class="xl66" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:x-small;color:#006100;">SH</span></td>
        </tr><tr><td class="xl67" width="530" height="20">Interpol Red notices</td>
        <td class="xl66" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:x-small;color:#006100;">SH</span></td>
        <td class="xl67" width="544">Enviromental Protection Agency (EPA) Fugitives</td>
        <td class="xl66" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:x-small;color:#006100;">SH</span></td>
        </tr><tr><td class="xl67" width="530" height="20">Boletines Rojos Interpol</td>
        <td class="xl66" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:x-small;color:#006100;">SH</span></td>
        <td class="xl67" width="544">Fugitivos Agencia de Protección del medio Ambiente EEUU (EPA)</td>
        <td class="xl66" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:x-small;color:#006100;">SH</span></td>
        </tr><tr><td class="xl67" width="530" height="20">DSS Most Wanted</td>
        <td class="xl66" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:x-small;color:#006100;">SH</span></td>
        <td class="xl67" width="544">CBI Most Wanted</td>
        <td class="xl66" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:x-small;color:#006100;">SH</span></td>
        </tr><tr><td class="xl67" width="530" height="20">DSS (Diplomatic Security Service) más buscados</td>
        <td class="xl66" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:x-small;color:#006100;">SH</span></td>
        <td class="xl67" width="544">CBI (Central Bureau of Investigation) más buscados</td>
        <td class="xl66" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:x-small;color:#006100;">SH</span></td>
        </tr><tr><td class="xl67" width="530" height="20">ICE Most Wanted</td>
        <td class="xl66" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:x-small;color:#006100;">SH</span></td>
        <td class="xl67" width="544">FBI Most Wanted</td>
        <td class="xl66" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:x-small;color:#006100;">SH</span></td>
        </tr><tr><td class="xl67" width="530" height="20">ICE (Immigration and Customs Enforcement) más buscados</td>
        <td class="xl66" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:x-small;color:#006100;">SH</span></td>
        <td class="xl67" width="544">FBI (Federal Bureau of Investigation) más buscados</td>
        <td class="xl66" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:x-small;color:#006100;">SH</span></td>
        </tr><tr><td class="xl67" width="530" height="20">UK Most Wanted</td>
        <td class="xl66" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:x-small;color:#006100;">SH</span></td>
        <td class="xl67" width="544">UE EUROPOL Most Wanted</td>
        <td class="xl66" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:x-small;color:#006100;">SH</span></td>
        </tr><tr><td class="xl67" width="530" height="20">Gran Bretaña más buscados</td>
        <td class="xl66" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:x-small;color:#006100;">SH</span></td>
        <td class="xl67" width="544">EUROPOL más buscados</td>
        <td class="xl66" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:x-small;color:#006100;">SH</span></td>
        </tr></tbody></table><table style="width:1100px;" border="1" cellspacing="0" cellpadding="0" align="center"><tbody><tr><td style="width:950px;background-color:#002060;text-align:center;"><span style="font-size:large;color:#ffffff;">Boletines</span></td>
        <td style="background-color:#002060;text-align:center;">
        <p><span style="color:#ffffff;font-size:small;">Búsqueda por Denominación </span></p>
        </td>
        </tr></tbody></table><table style="width:1100px;" border="1" cellspacing="0" cellpadding="0" align="center"><colgroup><col width="530" /><col width="202" /><col width="544" /><col width="198" /></colgroup><tbody><tr><td class="xl67" width="530" height="35">Boletín de deudores de la Contraloría General de la nación</td>
        <td class="xl66" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:x-small;color:#006100;">SH</span></td>
        <td class="xl67" width="544">Proveedores ficticios DIAN</td>
        <td class="xl66" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:x-small;color:#006100;">SH</span></td>
        </tr><tr><td class="xl67" width="530" height="35">Deudores Contraloría general de la nación reporte trimestral</td>
        <td class="xl66" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:x-small;color:#006100;">SH</span></td>
        <td class="xl67" width="544">Noticias Procuraduría General de la Nación</td>
        <td class="xl66" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:x-small;color:#006100;">SH</span></td>
        </tr><tr><td class="xl67" width="530" height="35">Contadores sancionados Junta Central de Contadores JCC</td>
        <td class="xl66" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:x-small;color:#006100;">SH</span></td>
        <td class="xl67" width="544">Boletines Superintendencia Solidaria</td>
        <td class="xl66" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:x-small;color:#006100;">SH</span></td>
        </tr><tr><td class="xl67" width="530" height="20">Contadores sancionados JCC</td>
        <td class="xl66" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:x-small;color:#006100;">SH</span></td>
        <td class="xl67" width="544">Boletines Superintendencia de Industria y Comercio</td>
        <td class="xl66" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:x-small;color:#006100;">SH</span></td>
        </tr><tr><td class="xl67" width="530" height="20">Entes Sancionados SECOP</td>
        <td class="xl66" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:x-small;color:#006100;">SH</span></td>
        <td class="xl67" width="544">Boletines Superintendencia Financiera</td>
        <td class="xl66" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:x-small;color:#006100;">SH</span></td>
        </tr><tr><td class="xl67" width="530" height="20">Entes sancionados por contratación pública SECOP</td>
        <td class="xl66" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:x-small;color:#006100;">SH</span></td>
        <td class="xl67" width="544">Boletines Superintendencia de Sociedades</td>
        <td class="xl66" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:x-small;color:#006100;">SH</span></td>
        </tr></tbody></table><table style="width:1100px;" border="1" cellspacing="0" cellpadding="0" align="center"><tbody><tr><td style="width:950px;background-color:#002060;text-align:center;"><span style="font-size:large;color:#ffffff;">PEPS</span></td>
        <td style="background-color:#002060;text-align:center;">
        <p><span style="color:#ffffff;font-size:small;">Búsqueda por Denominación </span></p>
        </td>
        </tr></tbody></table><table style="width:1100px;" border="1" cellspacing="0" cellpadding="0" align="center"><colgroup><col width="530" /><col width="202" /><col width="544" /><col width="198" /></colgroup><tbody><tr><td class="xl67" width="530" height="20">Relacionados a PEPS Colombia</td>
        <td class="xl66" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:x-small;color:#006100;">SH</span></td>
        <td class="xl67" width="544">Candidatos elecciones 2019</td>
        <td class="xl66" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:x-small;color:#006100;">SH</span></td>
        </tr><tr><td class="xl67" width="530" height="20">Magistrados y funcionarios Consejo de Estado</td>
        <td class="xl66" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:x-small;color:#006100;">SH</span></td>
        <td class="xl67" width="544">Magistrados y funcionarios Consejo Nacional Electoral</td>
        <td class="xl66" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:x-small;color:#006100;">SH</span></td>
        </tr><tr><td class="xl67" width="530" height="20">Magistrados y funcionarios Consejo Superior de la Judicatura</td>
        <td class="xl66" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:x-small;color:#006100;">SH</span></td>
        <td class="xl67" width="544">Magistrados y funcionarios</td>
        <td class="xl66" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:x-small;color:#006100;">SH</span></td>
        </tr><tr><td class="xl67" width="530" height="20">Magistrados y funcionarios Corte Suprema de Justicia</td>
        <td class="xl66" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:x-small;color:#006100;">SH</span></td>
        <td class="xl67" width="544">Embajadas en Colombia</td>
        <td class="xl66" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:x-small;color:#006100;">SH</span></td>
        </tr><tr><td class="xl67" width="530" height="20">Embajadas en el exterior</td>
        <td class="xl66" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:x-small;color:#006100;">SH</span></td>
        <td class="xl67" width="544">Estructura de Gobierno</td>
        <td class="xl66" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:x-small;color:#006100;">SH</span></td>
        </tr><tr><td class="xl67" width="530" height="20">Funcionarios de alto nivel Fuerzas Militares</td>
        <td class="xl66" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:x-small;color:#006100;">SH</span></td>
        <td class="xl67" width="544">Funcionarios públicos alto nivel gobernaciones y asambleas</td>
        <td class="xl66" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:x-small;color:#006100;">SH</span></td>
        </tr><tr><td class="xl67" width="530" height="20">Funcionarios públicos nivel municipal, alcaldes y concejales</td>
        <td class="xl66" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:x-small;color:#006100;">SH</span></td>
        <td class="xl67" width="544">Funcionarios públicos alto nivel del orden nacional</td>
        <td class="xl66" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:x-small;color:#006100;">SH</span></td>
        </tr><tr><td class="xl67" width="530" height="20">Funcionarios partidos políticos y candidatos no elegidos</td>
        <td class="xl66" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:x-small;color:#006100;">SH</span></td>
        <td class="xl67" width="544">Colombia</td>
        <td class="xl66" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:x-small;color:#006100;">SH</span></td>
        </tr></tbody></table><table style="width:1100px;" border="1" cellspacing="0" cellpadding="0" align="center"><tbody><tr><td style="width:950px;background-color:#002060;text-align:center;"><span style="font-size:medium;color:#ffffff;">PEPS Internacionales</span></td>
        <td style="background-color:#002060;text-align:center;">
        <p><span style="color:#ffffff;font-size:small;">     Búsqueda por        Denominación </span></p>
        </td>
        </tr></tbody></table><table style="width:1100px;" border="1" cellspacing="0" cellpadding="0" align="center"><colgroup><col width="530" /><col width="202" /><col width="544" /><col width="198" /></colgroup><tbody><tr><td class="xl67" width="530" height="20">Alemania</td>
        <td class="xl66" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:x-small;color:#006100;">SH</span></td>
        <td class="xl67" width="544">Argentina</td>
        <td class="xl66" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:x-small;color:#006100;">SH</span></td>
        </tr><tr><td class="xl67" width="530" height="20">Belgica</td>
        <td class="xl66" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:x-small;color:#006100;">SH</span></td>
        <td class="xl67" width="544">Bielorrusia</td>
        <td class="xl66" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:x-small;color:#006100;">SH</span></td>
        </tr><tr><td class="xl67" width="530" height="20">Bolivia</td>
        <td class="xl66" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:x-small;color:#006100;">SH</span></td>
        <td class="xl67" width="544">Brasil</td>
        <td class="xl66" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:x-small;color:#006100;">SH</span></td>
        </tr><tr><td class="xl67" width="530" height="20">Canadá</td>
        <td class="xl66" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:x-small;color:#006100;">SH</span></td>
        <td class="xl67" width="544">Chile</td>
        <td class="xl66" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:x-small;color:#006100;">SH</span></td>
        </tr><tr><td class="xl67" width="530" height="20">Costa Rica</td>
        <td class="xl66" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:x-small;color:#006100;">SH</span></td>
        <td class="xl67" width="544">Cuba</td>
        <td class="xl66" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:x-small;color:#006100;">SH</span></td>
        </tr><tr><td class="xl67" width="530" height="20">Ecuador</td>
        <td class="xl66" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:x-small;color:#006100;">SH</span></td>
        <td class="xl67" width="544">España</td>
        <td class="xl66" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:x-small;color:#006100;">SH</span></td>
        </tr><tr><td class="xl67" width="530" height="20">Estonia</td>
        <td class="xl66" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:x-small;color:#006100;">SH</span></td>
        <td class="xl67" width="544">Finlandia</td>
        <td class="xl66" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:x-small;color:#006100;">SH</span></td>
        </tr><tr><td class="xl67" width="530" height="20">Francia</td>
        <td class="xl66" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:x-small;color:#006100;">SH</span></td>
        <td class="xl67" width="544">Islandia</td>
        <td class="xl66" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:x-small;color:#006100;">SH</span></td>
        </tr><tr><td class="xl67" width="530" height="20">Letonia</td>
        <td class="xl66" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:x-small;color:#006100;">SH</span></td>
        <td class="xl67" width="544">Lituania</td>
        <td class="xl66" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:x-small;color:#006100;">SH</span></td>
        </tr><tr><td class="xl67" width="530" height="20">México</td>
        <td class="xl66" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:x-small;color:#006100;">SH</span></td>
        <td class="xl67" width="544">Nicaragua</td>
        <td class="xl66" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:x-small;color:#006100;">SH</span></td>
        </tr><tr><td class="xl67" width="530" height="20">Noruega</td>
        <td class="xl66" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:x-small;color:#006100;">SH</span></td>
        <td class="xl67" width="544">Países Bajos</td>
        <td class="xl66" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:x-small;color:#006100;">SH</span></td>
        </tr><tr><td class="xl67" width="530" height="20">Paraguay</td>
        <td class="xl66" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:x-small;color:#006100;">SH</span></td>
        <td class="xl67" width="544">Otros</td>
        <td class="xl66" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:x-small;color:#006100;">SH</span></td>
        </tr><tr><td class="xl67" width="530" height="20">Perú</td>
        <td class="xl66" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:x-small;color:#006100;">SH</span></td>
        <td class="xl67" width="544">Polonia</td>
        <td class="xl66" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:x-small;color:#006100;">SH</span></td>
        </tr><tr><td class="xl67" width="530" height="20">República Bolivariana de Venezuela</td>
        <td class="xl66" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:x-small;color:#006100;">SH</span></td>
        <td class="xl67" width="544">República de El Salvador</td>
        <td class="xl66" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:x-small;color:#006100;">SH</span></td>
        </tr><tr><td class="xl67" width="530" height="20">República de Guatemala</td>
        <td class="xl66" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:x-small;color:#006100;">SH</span></td>
        <td class="xl67" width="544">República de Honduras</td>
        <td class="xl66" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:x-small;color:#006100;">SH</span></td>
        </tr><tr><td class="xl67" width="530" height="20">República de Panamá</td>
        <td class="xl66" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:x-small;color:#006100;">SH</span></td>
        <td class="xl67" width="544">Suecia</td>
        <td class="xl66" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:x-small;color:#006100;">SH</span></td>
        </tr><tr><td class="xl67" width="530" height="20">Uruguay</td>
        <td class="xl66" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:x-small;color:#006100;">SH</span></td>
        <td class="xl67" width="544">Venezuela</td>
        <td class="xl66" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:x-small;color:#006100;">SH</span></td>
        </tr></tbody></table><table style="width:1100px;" border="1" cellspacing="0" cellpadding="0" align="center"><tbody><tr><td class="xl66" style="background-color:#002060;width:550px;height:40px;"><span style="font-size:medium;color:#ffffff;">Figuras Públicas</span></td>
        <td class="xl67" style="width:215px;background-color:#002060;"> </td>
        <td class="xl68" style="width:550px;background-color:#002060;"><span style="color:#ffffff;font-size:medium;">Contratación Pública</span></td>
        <td class="xl69" style="width:168px;background-color:#002060;text-align:center;"><span style="color:#ffffff;font-size:small;">Búsqueda por Denominación </span></td>
        </tr></tbody></table><table style="width:1100px;" border="1" cellspacing="0" cellpadding="0" align="center"><tbody><tr><td class="xl67" style="width:535px;height:22px;">Figuras públicas Colombia - SIGEP</td>
        <td class="xl66" style="text-align:center;background-color:#ffeb9c;width:198px;"><span style="font-size:x-small;color:#9c5700;">CHM</span></td>
        <td class="xl67" width="544">Grandes contratistas del estado en Colombia</td>
        <td class="xl66" style="text-align:center;background-color:#ffeb9c;width:198px;"><span style="font-size:x-small;color:#9c5700;">CHM</span></td>
        </tr></tbody></table><table style="width:1100px;" border="1" cellspacing="0" cellpadding="0" align="center"><tbody><tr><td class="xl64" style="background-color:#002060;width:520px;height:50px;"><span style="color:#ffffff;font-size:small;">Rama Judicial Unificada - <span class="font6">Búsqueda por Denominación </span><span class="font5">con coincidencia al 100%</span></span></td>
        <td class="xl65" style="text-align:center;width:207px;background-color:#ffffff;"><span style="color:#000000;font-size:x-small;">N/A</span></td>
        <td class="xl64" style="background-color:#002060;width:544px;text-align:left;"><span style="color:#ffffff;font-size:small;">Proveedores ficticios DIAN</span></td>
        <td class="xl65" style="text-align:center;width:205px;background-color:#ffc7ce;"><span style="color:#9c0006;">CH</span></td>
        </tr></tbody></table><p style="text-align:left;"><span style="font-size:small;"><strong><span style="color:#ff0000;">                                        **</span> Requiere fecha de expedición del documento de identidad</strong></span></p>
        <table style="width:1100px;" border="1" cellspacing="0" cellpadding="0" align="center"><colgroup><col width="530" /><col width="202" /><col width="544" /><col width="198" /></colgroup><tbody><tr><td class="xl75" style="background-color:#002060;width:530px;height:25px;text-align:left;"><strong><span style="color:#ffffff;font-size:small;">LABORAL  <span style="color:#ffcc00;">3 últimas experiencias de HV </span></span></strong></td>
        <td class="xl76" style="text-align:center;background-color:#002060;width:202px;"><strong><span style="color:#ffffff;font-size:small;">Concepto</span></strong></td>
        <td class="xl82" style="text-align:left;background-color:#002060;width:742px;" colspan="2"><span style="font-size:small;"><strong><span style="color:#ffffff;">ACADEMICO <span class="font6" style="color:#ffcc00;">Estudios formales finalizados  en Colombia </span></span></strong></span></td>
        </tr><tr><td class="xl71" height="15">Carta laboral no verídica </td>
        <td class="xl67" style="text-align:center;background-color:#ffc7ce;width:202px;"><span style="font-size:x-small;color:#9c0006;">CH</span></td>
        <td class="xl73">Diploma no verídico </td>
        <td class="xl67" style="text-align:center;background-color:#ffc7ce;width:202px;"><span style="font-size:x-small;color:#9c0006;">CH</span></td>
        </tr><tr><td class="xl71" height="15">Retiro con justa causa</td>
        <td class="xl67" style="text-align:center;background-color:#ffc7ce;width:202px;"><span style="font-size:x-small;color:#9c0006;">CH</span></td>
        <td class="xl73">No verificable por cierre de la institución </td>
        <td class="xl67" style="text-align:center;background-color:#ffeb9c;width:198px;"><span style="font-size:x-small;color:#9c5700;">CHM</span></td>
        </tr><tr><td class="xl71" height="15">Jefe inmediato no lo contrataría</td>
        <td class="xl67" style="text-align:center;background-color:#ffeb9c;width:198px;"><span style="font-size:x-small;color:#9c5700;">CHM</span></td>
        <td class="xl73">No registra en la institución (Con y sin documentos)</td>
        <td class="xl67" style="text-align:center;background-color:#ffeb9c;width:198px;"><span style="font-size:x-small;color:#9c5700;">CHM</span></td>
        </tr><tr><td class="xl71" height="15">Jefe inmediato no lo recomienda</td>
        <td class="xl67" style="text-align:center;background-color:#ffeb9c;width:198px;"><span style="font-size:x-small;color:#9c5700;">CHM</span></td>
        <td class="xl73">Vacaciones (5 épocas del año)</td>
        <td class="xl74" style="text-align:center;background-color:#5b9bd5;">NC</td>
        </tr><tr><td class="xl71" height="40">Jefe inmediato no lo recomienda y no lo volvería a contratar </td>
        <td class="xl67" style="text-align:center;background-color:#ffeb9c;width:198px;"><span style="font-size:x-small;color:#9c5700;">CHM</span></td>
        <td class="xl79" width="544">Cierre con portales (ICFES, Universidades, RHETUS, Etc.) SI no tenemos diplomas o documentos  finalizar dejando la trazabilidad completa</td>
        <td class="xl66" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:x-small;color:#006100;">SH</span></td>
        </tr><tr><td class="xl72" width="530" height="32">Si contamos con datos de contacto del jefe inmediato, pero no es efectiva dejando gestión</td>
        <td class="xl66" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:x-small;color:#006100;">SH</span></td>
        <td class="xl78" width="544">*Costo por validaciones académicas donde generen cobro / adicional Escalar a SAC para cobro</td>
        <td class="xl81" style="text-align:center;background-color:#5b9bd5;">SI</td>
        </tr><tr><td class="xl71" height="40">En caso de no contar con datos de jefes inmediatos escalar a SAC (no afecta concepto final pero se debe dejar novedad)</td>
        <td class="xl66" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:x-small;color:#006100;">SH</span></td>
        <td class="xl77">* Escalar a SAC cuando presente estudios en el exterior, además informar si se debe generar pago</td>
        <td class="xl81" style="text-align:center;background-color:#5b9bd5;">SI</td>
        </tr><tr><td class="xl72" width="530" height="45">Si no suministra datos de contacto de jefe inmediato</td>
        <td class="xl66" style="text-align:center;background-color:#ffeb9c;width:198px;"><span style="font-size:x-small;color:#9c5700;">CHM</span></td>
        <td class="xl84" style="background-color:#002060;width:742px;" colspan="2"><strong><span style="color:#ffffff;font-size:small;">PERSONAL  y FAMILIAR / 1 DE CADA 1 <span class="font6" style="color:#ffcc00;">(Si no tiene pestaña de refrencias N/A)</span></span></strong></td>
        </tr><tr><td class="xl72" style="text-align:left;" width="530" height="45">Cuando son temporales y no registra datos de jefe inmediato </td>
        <td class="xl66" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:x-small;color:#006100;">SH</span></td>
        <td class="xl84" style="background-color:#ffffff;width:742px;">No lo recomienda</td>
        <td class="x" style="text-align:center;background-color:#ffeb9c;width:198px;"><span style="font-size:x-small;color:#9c5700;">CHM</span></td>
        </tr><tr><td class="xl72" style="text-align:left;" width="530" height="45">No verificable por empresa liquidada con homologación de historial pensional efectiva</td>
        <td class="xl66" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:x-small;color:#006100;">SH</span></td>
        <td class="xl84" style="background-color:#ffffff;width:742px;" rowspan="5" colspan="2"><br /><br />      </td>
        </tr><tr><td class="xl72" width="530" height="32">No verificable por empresa liquidada con homologación de historial pensional (No efectiva) </td>
        <td class="xl67" style="text-align:center;background-color:#ffeb9c;width:198px;"><span style="font-size:x-small;color:#9c5700;">CHM</span></td>
        </tr><tr><td class="xl71" style="text-align:left;" height="20">No verificable con ninguna fuente o tercero</td>
        <td class="xl67" style="text-align:center;background-color:#ffeb9c;width:198px;"><span style="font-size:x-small;color:#9c5700;">CHM</span></td>
        </tr><tr><td class="xl72" width="530" height="32">Se puede Cerrar procesos con Historial, Portales ARL, Aportes en Línea SI no tenemos carta laboral o historial laboral dejando la trazabilidad</td>
        <td class="xl66" style="text-align:center;background-color:#c6efce;width:198px;"><span style="font-size:x-small;color:#006100;">SH</span></td>
        </tr><tr><td class="xl72" width="530" height="32">Costo por validaciones laborales en donde generen cobro / adicional escalar a SAC para cobro</td>
        <td class="xl81" style="text-align:center;background-color:#5b9bd5;">SI</td>
        </tr></tbody></table><table style="width:1100px;" border="1" cellspacing="0" cellpadding="0" align="center"><colgroup><col width="530" /><col width="202" /><col width="544" /><col width="198" /></colgroup><tbody><tr><td class="xl74" style="width:568px;height:335px;" rowspan="8"><span style="font-size:small;"><strong><span class="font6">Visita domiciliaria  Pre empleo</span></strong><span class="font5"> (Si no tiene producto con tarifa virtual por defecto es presencial )                       </span></span></td>
        <td class="xl77" style="width:225px;" rowspan="8">Autorizaciones, Carta de presentación.</td>
        <td class="xl70" width="544">Tiempo estimado 45 min. Desarrollo del cuestionario en el sitio social que defina el evaluado.<br /><br /><br />                  </td>
        <td class="xl66" style="text-align:left;" width="198">Informativo </td>
        </tr><tr><td class="xl67" height="70">Reconocimiento espacial del inmueble buscando vinculo con el evaluado. Se diligencian y firman los formatos de autorización y se entregan los documentos solicitados.</td>
        <td class="xl66" style="text-align:left;"> </td>
        </tr><tr><td class="xl67" height="20">Debe estar presente en la visita el candidato </td>
        <td class="xl66" style="text-align:left;"> </td>
        </tr><tr><td class="xl65" height="40">Registro fotográfico: 4 fotos (fachada, nomenclatura, espacio social y candidato).                             </td>
        <td class="xl66" style="text-align:left;"> </td>
        </tr><tr><td class="xl67" height="20">Si se identifica que el candidato no reside en la vivienda</td>
        <td class="xl68" style="background-color:#ffc7ce;width:196px;text-align:left;"><span style="font-size:x-small;color:#9c0006;">CH</span></td>
        </tr><tr><td class="xl65" height="20">Niveles de peligrosidad en la vivienda altos </td>
        <td class="xl69" style="background-color:#ffeb9c;width:195px;text-align:left;"><span style="font-size:x-small;color:#9c5700;">CHM</span></td>
        </tr><tr><td class="xl67" height="20">Situación de hacinamiento </td>
        <td class="xl69" style="background-color:#ffeb9c;width:198px;text-align:left;"><span style="font-size:x-small;color:#9c5700;">CHM</span></td>
        </tr><tr><td class="xl67" height="20">Consumo de Drogas</td>
        <td class="xl69" style="background-color:#ffeb9c;width:198px;text-align:left;"><span style="font-size:x-small;color:#9c5700;">CHM</span></td>
        </tr></tbody></table><table style="width:1100px;" border="1" cellspacing="0" cellpadding="0" align="center"><colgroup><col width="530" /><col width="202" /><col width="544" /><col width="198" /></colgroup><tbody><tr><td class="xl74" style="width:550px;height:897px;" rowspan="26"><strong><span style="font-size:medium;">Visita domiciliaria rutina /BASC/OEA Actualización </span></strong></td>
        <td class="xl65" style="width:160px;" rowspan="12">
        <p><strong>Pre empleo</strong> : Autorizaciones especial para esta tipo de componente, Carta de presentación, Muestra grafológica.</p>
        </td>
        <td class="xl70" style="width:550px;">Tiempo estimado 45 min. Desarrollo del cuestionario en el sitio social que defina el evaluado.<br /><br /><br />                  </td>
        <td class="xl66" width="198">Informativo </td>
        </tr><tr><td class="xl67" height="70">Reconocimiento espacial del inmueble buscando vinculo con el evaluado. Se diligencian y firman los formatos de autorización y se entregan los documentos solicitados.</td>
        <td class="xl66"> </td>
        </tr><tr><td class="xl67" height="20">Debe estar presente en la visita el candidato </td>
        <td class="xl66"> </td>
        </tr><tr><td class="xl65" height="40">Registro fotográfico: 4 fotos (fachada,, nomenclatura, espacio social y candidato).                             </td>
        <td class="xl66"> </td>
        </tr><tr><td class="xl65" height="20">Si se identifica que el candidato no reside en la vivienda</td>
        <td class="xl68" style="background-color:#ffc7ce;width:202px;text-align:left;"><span style="font-size:x-small;color:#9c0006;">CH</span></td>
        </tr><tr><td class="xl65" height="20">Referencia de vecindario no lo recomiendan </td>
        <td class="xl69" style="background-color:#ffffff;width:198px;text-align:left;"> </td>
        </tr><tr><td class="xl65" height="20">No lo recomiendan</td>
        <td class="xl69" style="background-color:#ffeb9c;width:198px;text-align:left;"><span style="font-size:x-small;color:#9c5700;">CHM</span></td>
        </tr><tr><td class="xl65" height="20">No brinda el documento (dejar descrito el motivo por el que no lo entrega)</td>
        <td class="xl69" style="background-color:#c6efce;width:198px;text-align:left;"><span style="font-size:x-small;color:#006100;">SH</span></td>
        </tr><tr><td class="xl65" height="20">Niveles de peligrosidad en la vivienda altos </td>
        <td class="xl69" style="background-color:#ffeb9c;width:198px;text-align:left;"><span style="font-size:x-small;color:#9c5700;">CHM</span></td>
        </tr><tr><td class="xl65" height="20">Situación de hacinamiento </td>
        <td class="xl69" style="background-color:#ffeb9c;width:198px;text-align:left;"><span style="font-size:x-small;color:#9c5700;">CHM</span></td>
        </tr><tr><td class="xl65" height="40"><strong><span class="font6">Estudio socioeconómico</span></strong><span class="font5"><strong>:</strong> Análisis de déficit en ingresos Vs Egresos </span></td>
        <td class="xl69" style="background-color:#ffeb9c;width:198px;text-align:left;"><span style="font-size:x-small;color:#9c5700;">CHM</span></td>
        </tr><tr><td class="xl65" height="40"><span class="font6">Consumo de Drogas</span></td>
        <td class="xl69" style="background-color:#ffeb9c;width:198px;text-align:left;"><span style="font-size:x-small;color:#9c5700;">CHM</span></td>
        </tr><tr><td class="xl65" rowspan="14" height="470"><strong><span class="font6">Rutina/Actualización </span></strong><span class="font5">: Autorizaciones especial para esta tipo de componente, Carta de presentación, condiciones de bioseguridad. Muestra grafológica, Estudio de seguridad anterior (Sintecto y/o Proveedor anterior)</span></td>
        <td class="xl70">Tiempo estimado 45 min. Desarrollo del cuestionario en el sitio social que defina el evaluado.<br /><br /><br />                  </td>
        <td class="xl66">Informativo </td>
        </tr><tr><td class="xl67" height="70">Reconocimiento espacial del inmueble buscando vinculo con el evaluado. Se diligencian y firman los formatos de autorización y se entregan los documentos solicitados.</td>
        <td class="xl66"> </td>
        </tr><tr><td class="xl67" height="20">Debe estar presente en la visita el candidato </td>
        <td class="xl66"> </td>
        </tr><tr><td class="xl65" height="40">Registro fotográfico: 4 fotos (fachada,, nomenclatura, espacio social y candidato).                             </td>
        <td class="xl66"> </td>
        </tr><tr><td class="xl65" height="20">Si se identifica que el candidato no reside en la vivienda</td>
        <td class="xl68" style="background-color:#ffc7ce;width:202px;text-align:left;"><span style="font-size:x-small;color:#9c0006;">CH</span></td>
        </tr><tr><td class="xl65" height="20">Referencia de Vecindario </td>
        <td class="xl68" style="background-color:#ffffff;width:202px;text-align:left;"> </td>
        </tr><tr><td class="xl65" style="text-align:left;" height="20">No lo recomiendan </td>
        <td class="xl69" style="background-color:#ffeb9c;width:198px;text-align:left;"><span style="font-size:x-small;color:#9c5700;">CHM</span></td>
        </tr><tr><td class="xl65" height="20">No brinda el documento (dejar descrito el motivo por el que no lo entrega)</td>
        <td class="xl69" style="background-color:#c6efce;width:198px;text-align:left;"><span style="font-size:x-small;color:#006100;">SH</span></td>
        </tr><tr><td class="xl65" height="20">Niveles de peligrosidad en la vivienda altos </td>
        <td class="xl69" style="background-color:#ffeb9c;width:198px;text-align:left;"><span style="font-size:x-small;color:#9c5700;">CHM</span></td>
        </tr><tr><td class="xl65" height="20">Situación de hacinamiento </td>
        <td class="xl69" style="background-color:#ffeb9c;width:198px;text-align:left;"><span style="font-size:x-small;color:#9c5700;">CHM</span></td>
        </tr><tr><td class="xl65" height="40">Estudio socioeconómico: Análisis de déficit en ingresos Vs Egresos </td>
        <td class="xl69" style="background-color:#ffeb9c;width:198px;text-align:left;"><span style="font-size:x-small;color:#9c5700;">CHM</span></td>
        </tr><tr><td class="xl65" height="44"><strong><span class="font6">Preguntas especiales rutina</span></strong><span class="font5">, si refiere algo que pueda impactar la compañía </span></td>
        <td class="xl69" style="background-color:#ffeb9c;width:198px;text-align:left;"><span style="font-size:x-small;color:#9c5700;">CHM</span></td>
        </tr><tr><td class="xl65" height="44"><strong><span class="font6">Comparativo </span></strong><span class="font5"> informe anterior, si genero un aumento alto en bienes inmuebles </span></td>
        <td class="xl69" style="background-color:#ffeb9c;width:198px;text-align:left;"><span style="font-size:x-small;color:#9c5700;">CHM</span></td>
        </tr><tr><td class="xl65" height="44"><span class="font6">Consumo de Drogas</span></td>
        <td class="xl69" style="background-color:#ffeb9c;width:198px;text-align:left;"><span style="font-size:x-small;color:#9c5700;"><span>CHM</span></span></td>
        </tr></tbody></table><table style="width:1100px;" border="1" cellspacing="0" cellpadding="0" align="center"><colgroup><col width="530" /><col width="202" /><col width="544" /><col width="198" /></colgroup><tbody><tr><td class="xl73" style="width:565px;height:40px;" rowspan="2"><strong>Análisis financiero (Consulta en central de riesgo)</strong></td>
        <td class="xl65" style="width:230px;" rowspan="2">Autorización tratamiento datos </td>
        <td class="xl66" style="width:578px;">Si no registra mora en sus obligaciones </td>
        <td class="xl68" style="background-color:#c6efce;width:198px;text-align:left;"><span style="font-size:x-small;color:#006100;">SH</span></td>
        </tr><tr><td class="xl66" style="width:545px;height:20px;">Si registra mora desde un SMLV</td>
        <td class="xl67" style="background-color:#ffeb9c;width:198px;text-align:left;"><span style="font-size:x-small;color:#9c5700;">CHM</span></td>
        </tr><tr><td class="xl65" height="40"><strong><span class="font6">Formato</span><span class="font5"> </span></strong></td>
        <td class="xl72" width="202">Formato enviado por el candidato </td>
        <td class="xl66">Validar que esté completo </td>
        <td class="xl66">Informativo </td>
        </tr></tbody></table><table style="width:1100px;" border="1" cellspacing="0" cellpadding="0" align="center"><colgroup><col width="530" /><col width="202" /><col width="544" /><col width="198" /></colgroup><tbody><tr><td class="xl71" style="background-color:#002060;width:540px;height:22px;"><span style="font-size:small;color:#ffffff;">Poligrafía pre empleo </span></td>
        <td class="xl72" style="width:240px;text-align:center;"> </td>
        <td class="xl73" style="background-color:#002060;width:520px;"><span style="color:#ffffff;font-size:small;">Poligrafía Rutina/Especifica</span></td>
        <td class="xl72" style="width:210px;text-align:center;"> </td>
        </tr><tr><td class="xl79" height="15"><strong>Resultado cuantitativo </strong></td>
        <td class="xl72" style="text-align:center;"> </td>
        <td class="xl79"><strong>Resultado cuantitativo </strong></td>
        <td class="xl72" style="text-align:center;"> </td>
        </tr><tr><td class="xl74" height="15">Reacción significativa </td>
        <td class="xl66" style="background-color:#ffc7ce;width:202px;text-align:center;"><span style="font-size:x-small;color:#9c0006;">CH</span></td>
        <td class="xl74">Reacción significativa </td>
        <td class="xl66" style="background-color:#ffc7ce;width:202px;text-align:center;"><span style="font-size:x-small;color:#9c0006;">CH</span></td>
        </tr><tr><td class="xl74" height="15">NO Reacción significativa </td>
        <td class="xl68" style="background-color:#c6efce;width:198px;text-align:center;"><span style="font-size:x-small;color:#006100;">SH</span></td>
        <td class="xl74">NO Reacción significativa </td>
        <td class="xl68" style="background-color:#c6efce;width:198px;text-align:center;"><span style="font-size:x-small;color:#006100;">SH</span></td>
        </tr><tr><td class="xl79" height="15"><strong>Resultado cualitativo  </strong></td>
        <td class="xl72" style="text-align:center;"> </td>
        <td class="xl79"><strong>Resultado cualitativo  </strong></td>
        <td class="xl72" style="text-align:center;"> </td>
        </tr><tr><td class="xl75" width="530" height="15">Admisión de consumo drogas</td>
        <td class="xl67" style="background-color:#ffeb9c;width:198px;text-align:center;"><span style="font-size:x-small;color:#9c5700;">CHM</span></td>
        <td class="xl75" width="544">Admisión de consumo drogas</td>
        <td class="xl67" style="background-color:#ffeb9c;width:198px;text-align:center;"><span style="font-size:x-small;color:#9c5700;">CHM</span></td>
        </tr><tr><td class="xl75" width="530" height="32">Admisión de consumo alcohol con alta frecuencia (más de dos veces a la semana) y no social </td>
        <td class="xl67" style="background-color:#ffeb9c;width:198px;text-align:center;"><span style="font-size:x-small;color:#9c5700;">CHM</span></td>
        <td class="xl75" width="544">Admisiones de antecedentes  </td>
        <td class="xl66" style="background-color:#ffc7ce;width:202px;text-align:center;"><span style="font-size:x-small;color:#9c0006;">CH</span></td>
        </tr><tr><td class="xl75" width="530" height="15">Admisión de hurto</td>
        <td class="xl66" style="background-color:#ffc7ce;width:202px;text-align:center;"><span style="font-size:x-small;color:#9c0006;">CH</span></td>
        <td class="xl75" width="544">Admisión de vínculos propios con grupos al margen </td>
        <td class="xl66" style="background-color:#ffc7ce;width:202px;text-align:center;"><span style="font-size:x-small;color:#9c0006;">CH</span></td>
        </tr><tr><td class="xl75" width="530" height="15">Admisiones de antecedentes  </td>
        <td class="xl66" style="background-color:#ffc7ce;width:202px;text-align:center;"><span style="font-size:x-small;color:#9c0006;">CH</span></td>
        <td class="xl75" width="544">Preguntas de conducta laboral que sean negativas </td>
        <td class="xl67" style="background-color:#ffeb9c;width:198px;text-align:center;"><span style="font-size:x-small;color:#9c5700;">CHM</span></td>
        </tr><tr><td class="xl75" width="530" height="15">Admisión de vínculos propios con grupos al margen</td>
        <td class="xl66" style="background-color:#ffc7ce;width:202px;text-align:center;"><span style="font-size:x-small;color:#9c0006;">CH</span></td>
        </tr><tr><td class="xl75" width="530" height="15">Admisiones laborales</td>
        <td class="xl66" style="background-color:#ffeb9c;width:198px;text-align:center;"><span style="font-size:x-small;color:#9c5700;">CHM</span></td>
        </tr><tr><td class="xl75" width="530" height="15">Documentos no verídicos</td>
        <td class="xl66" style="background-color:#ffc7ce;width:202px;text-align:center;"><span style="font-size:x-small;color:#9c0006;">CH</span></td>
        </tr></tbody></table><table style="width:1100px;" border="1" cellspacing="0" cellpadding="0" align="center"><colgroup><col width="530" /><col width="202" /></colgroup><tbody><tr><td class="xl70" style="background-color:#002060;width:732px;height:50px;" colspan="2"><span style="color:#ffffff;font-size:medium;">Realizar Preliminar para dar continuidad al procesos, el concepto se debe emitir en jornada contraria a la solicitud</span></td>
        </tr><tr><td style="background-color:#a8d1c3;">Adversos</td>
        <td class="xl69">SI</td>
        </tr><tr><td style="background-color:#a8d1c3;">Financiero</td>
        <td class="xl69">SI</td>
        </tr><tr><td class="xl69" height="18">Avanzar</td>
        <td class="xl69" style="background-color:#c6efce;">SH</td>
        </tr><tr><td class="xl69" height="18">Elevar a SAC para evaluar continuidad</td>
        <td class="xl69" style="background-color:#ffeb9c;">CHM</td>
        </tr><tr><td class="xl69" height="18">Elevar a SAC para evaluar continuidad</td>
        <td class="xl69" style="background-color:#ffc7ce;">CH</td>
        </tr></tbody></table><table style="width:1100px;" border="1" cellspacing="0" cellpadding="0" align="center"><tbody><tr><td style="background-color:#002060;text-align:center;"><strong><span style="color:#ffffff;">FECHA</span></strong></td>
        <td style="background-color:#002060;text-align:center;"><strong><span style="color:#ffffff;">RESPONSABLE</span></strong></td>
        <td style="background-color:#002060;text-align:center;"><strong><span style="color:#ffffff;">MODIFICACIÓN</span></strong></td>
        <td style="background-color:#002060;text-align:center;"><strong><span style="color:#ffffff;">OBSERVACIÓN</span></strong></td>
        </tr><tr><td> </td>
        <td> </td>
        <td> </td>
        <td> </td>
        </tr><tr><td> </td>
        <td> </td>
        <td> </td>
        <td> </td>
        </tr><tr><td> </td>
        <td> </td>
        <td> </td>
        <td> </td>
        </tr></tbody></table>';
        return $textHtml;
    }

    public static function htmlStandardNew(){
        $textHtmlNew='<p style="text-align: left;">&nbsp;</p>
        <table style="width: 1100px;" border="1" cellspacing="0" cellpadding="0" align="center">
        <tbody>
        <tr>
        <td style="text-align: center;">&nbsp;</td>
        <td style="text-align: center;"><strong>PARAMETRIZACI&Oacute;N CLIENTES</strong></td>
        <td style="text-align: left;">&nbsp;
        <p>C&oacute;digo. S-GC-FR-18<br />Versi&oacute;n:2<br />Fecha: 11/05/2023<br /> P&aacute;gina 1 de 3</p>
        </td>
        </tr>
        </tbody>
        </table>
        <table style="width: 1100px;" border="1" cellspacing="0" cellpadding="0" align="center">
        <tbody>
        <tr>
        <td style="text-align: center;"><span style="color: #002060; font-size: x-large;"><strong>Par&aacute;metro Est&aacute;ndar</strong></span></td>
        </tr>
        </tbody>
        </table>
        <table style="width: 1100px;" border="1" cellspacing="0" cellpadding="0" align="center">
        <tbody>
        <tr>
        <td style="text-align: left; background-color: #002060;"><span style="font-size: medium; color: #ffffff;"><strong>Autorizaciones</strong></span></td>
        <td style="text-align: center;">&nbsp;</td>
        </tr>
        <tr>
        <td style="text-align: left; background-color: #002060;"><span style="font-size: medium; color: #ffffff;"><strong>Adversos</strong></span></td>
        <td style="text-align: left;">Fecha de expedici&oacute;n de la C&eacute;dula / Fotocopia de la C&eacute;dula</td>
        </tr>
        </tbody>
        </table>
        <table style="width: 1100px;" border="1" cellspacing="0" cellpadding="0" align="center">
        <tbody>
        <tr>
        <td style="text-align: center; background-color: #002060;"><span style="color: #ffffff; font-size: large;">Realizar Preliminar para dar continuidad al proceso, el concepto se debe emitir en jornada contraria a la solicitud&nbsp;</span></td>
        </tr>
        </tbody>
        </table>
        <table style="width: 1100px;" border="1" cellspacing="0" cellpadding="0" align="center">
        <tbody>
        <tr>
        <td><span style="font-size: small;">Adversos</span></td>
        <td style="text-align: center;"><span style="font-size: small;">Si_&nbsp; No_</span></td>
        <td rowspan="6"><span style="font-size: small;">* El cliente debe aportar la autorizaci&oacute;n firmada, para cumplir con el tiempo de jornada contraria. &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</span></td>
        </tr>
        <tr>
        <td><span style="font-size: small;">Financiero</span></td>
        <td style="text-align: center;"><span style="font-size: small;">Si_&nbsp; No_</span></td>
        </tr>
        <tr>
        <td><span style="font-size: small;"><strong>CONCEPTO</strong></span></td>
        <td style="text-align: center;">&nbsp;</td>
        </tr>
        <tr>
        <td><span style="font-size: small;">Avanzar</span></td>
        <td style="text-align: center;"><span style="font-size: small;">N/A</span></td>
        </tr>
        <tr>
        <td><span style="font-size: small;">Elevar a SAC para evaluar continuidad</span></td>
        <td style="text-align: center;"><span style="font-size: small;">N/A</span></td>
        </tr>
        <tr>
        <td><span style="font-size: small;">Elevar a SAC para evaluar continuidad</span></td>
        <td style="text-align: center;"><span style="font-size: small;">N/A</span></td>
        </tr>
        </tbody>
        </table>
        <table style="width: 1100px; background-color: #002060;" border="1" cellspacing="0" cellpadding="0" align="center">
        <tbody>
        <tr>
        <td class="xl66" rowspan="5" width="505" height="30">
        <p><span style="font-size: small; color: #ffffff;">Certificado c&eacute;dula de ciudadan&iacute;a<span class="font6" style="color: #ff0000;"> **</span></span><span style="color: #ffffff; font-size: small;">(Cancelado por muerte</span><span style="color: #ffffff; font-size: small;">/Extranjer&iacute;a/</span><span style="color: #ffffff; font-size: small;">Falsa identidad)</span></p>
        </td>
        <td class="xl67" style="background-color: #ffc7ce; width: 202px; text-align: center;" rowspan="5">
        <p><span style="font-size: small; color: #9c0006;"><br /></span></p>
        <p><span style="font-size: small; color: #9c0006;">CH</span></p>
        </td>
        <td class="xl68" width="544"><span style="font-size: small; color: #ffffff;">Rama Judicial Justicia Siglo XXI (TYBA)</span></td>
        <td class="xl69" style="text-align: center; width: 198px; background-color: #f9f9f9;">&nbsp;</td>
        </tr>
        <tr>
        <td style="background-color: #fafaf9;"><span style="color: #000000; font-size: small;">Procesos en juzgados familiares o s&oacute;lo 1 proceso civil&nbsp;<br /></span></td>
        <td class="xl69" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        </tr>
        <tr>
        <td style="background-color: #fafaf9;"><span style="font-size: small; color: #000000;">Antecedentes Personer&iacute;a de Bogot&aacute;</span></td>
        <td class="xl69" style="background-color: #ffc7ce; width: 202px; text-align: center;"><span style="font-size: x-small; color: #9c0006;">CH</span></td>
        </tr>
        <tr>
        <td style="background-color: #fafaf9;"><span style="font-size: small;">Procesos Penales&nbsp;</span></td>
        <td class="xl67" style="background-color: #ffc7ce; width: 202px; text-align: center;"><span style="font-size: x-small; color: #9c0006;">CH</span></td>
        </tr>
        <tr>
        <td style="background-color: #fafaf9;"><span style="font-size: small;">2 procesos civiles o m&aacute;s</span></td>
        <td class="xl69" style="text-align: center; background-color: #ffeb9c; width: 198px;"><span style="font-size: x-small; color: #9c5700;">CHM</span></td>
        </tr>
        </tbody>
        </table>
        <table style="width: 1100px; background-color: #002060;" border="1" cellspacing="0" cellpadding="0" align="center">
        <tbody>
        <tr>
        <td class="xl66" width="530" height="20"><span style="font-size: small; color: #ffffff;">Antecedentes disciplinarios Procuradur&iacute;a&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</span></td>
        <td class="xl67" style="text-align: center; background-color: #ffc7ce; width: 202px;"><span style="font-size: small; color: #9c0006;">CH</span></td>
        <td class="xl68" width="544"><span style="font-size: small; color: #ffffff;">Antecedentes Personer&iacute;a de Bogot&aacute;</span></td>
        <td class="xl69" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: small; color: #006100;">SH</span></td>
        </tr>
        <tr>
        <td class="xl66" width="530" height="20"><span style="font-size: small; color: #ffffff;">Contralor&iacute;a</span></td>
        <td class="xl69" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: small; color: #006100;">SH</span></td>
        <td class="xl68" width="544"><span style="font-size: small; color: #ffffff;">Polic&iacute;a Nacional (Pres&eacute;ntese inmediatamente /Actualmente no es requerido)</span></td>
        <td class="xl67" style="text-align: center; background-color: #ffc7ce; width: 202px;"><span style="font-size: small; color: #9c0006;">CH</span></td>
        </tr>
        <tr>
        <td class="xl66" rowspan="4" width="530" height="20"><span style="font-size: small; color: #ffffff;">INPEC</span></td>
        <td class="xl67" style="text-align: center; background-color: #ffc7ce; width: 202px;" rowspan="4"><span style="font-size: small; color: #9c0006;">CH</span></td>
        <td class="xl68" width="544"><span style="font-size: small; color: #ffffff;">SIMIT - SIMUR</span></td>
        <td class="xl69" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: small; color: #006100;">SH</span></td>
        </tr>
        <tr>
        <td style="background-color: #faf9f9;"><span style="font-size: small;">Si es cargo conductor&nbsp;&nbsp;<br /></span></td>
        <td class="xl69" style="text-align: center; background-color: #ffc7ce; width: 198px;"><span style="font-size: small; color: #9c0006;">CH</span></td>
        </tr>
        <tr>
        <td style="background-color: #faf9f9;"><span style="color: #000000; font-size: small;">Multas superiores a 1 mill&oacute;n</span></td>
        <td class="xl69" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: small; color: #006100;">SH</span></td>
        </tr>
        <tr>
        <td style="background-color: #faf9f9;"><span style="font-size: small; color: #000000;">Multas por estado de embriaguez o Sustancias Psicoactivas</span></td>
        <td class="xl69" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: small; color: #006100;">SH</span></td>
        </tr>
        </tbody>
        </table>
        <table style="width: 1100px; background-color: #002060;" border="1" cellspacing="0" cellpadding="0" align="center">
        <tbody>
        <tr>
        <td class="xl66" width="520" height="20"><span style="font-size: small; color: #ffffff;">Registro Nacional de medidas correctivas<span style="color: #ff0000;">**</span>&nbsp;</span></td>
        <td class="xl69" style="text-align: center; background-color: #ffc7ce; width: 202px;"><span style="font-size: small; color: #9c0006;">CH</span></td>
        <td class="xl68" width="544"><span style="font-size: small; color: #ffffff;"><span>RUNT</span></span></td>
        <td class="xl69" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: small; color: #006100;">SH</span></td>
        </tr>
        <tr>
        <td class="xl66" width="520" height="20"><span style="font-size: small; color: #ffffff;">SECOP<span style="color: #ff0000;">**</span></span></td>
        <td class="xl69" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: small; color: #006100;">SH</span></td>
        <td class="xl68" width="544"><span style="font-size: small; color: #ffffff;">Libreta Milita</span></td>
        <td class="xl69" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: small; color: #006100;">SH</span></td>
        </tr>
        <tr>
        <td class="xl66" width="520" height="20"><span style="font-size: small; color: #ffffff;">Inhabilidades Delitos Sexuales<span style="color: #ff0000;">**</span></span></td>
        <td class="xl67" style="text-align: center; background-color: #ffc7ce; width: 202px;"><span style="font-size: small; color: #9c0006;">CH</span></td>
        <td class="xl68" width="544"><span style="font-size: small; color: #ffffff;">Contadur&iacute;a</span></td>
        <td class="xl69" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: small; color: #006100;">SH</span></td>
        </tr>
        </tbody>
        </table>
        <table style="width: 1100px;" border="1" cellspacing="0" cellpadding="0" align="center">
        <tbody>
        <tr>
        <td style="width: 950px; background-color: #002060; text-align: center;"><span style="font-size: medium; color: #ffffff;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Rama Judicial JEPMS (Juzgados de Ejecuci&oacute;n de Penas y Medidas de Seguridad)&nbsp; &nbsp; &nbsp; &nbsp;</span></td>
        <td style="background-color: #002060; text-align: center;">
        <p><span style="color: #ffffff;">&nbsp; </span><span style="color: #ffffff; font-size: small;">B&uacute;squeda por ID</span></p>
        </td>
        </tr>
        </tbody>
        </table>
        <table style="width: 1100px;" border="1" cellspacing="0" cellpadding="0" align="center"><colgroup><col width="530" /><col width="202" /><col width="544" /><col width="198" /></colgroup>
        <tbody>
        <tr>
        <td class="xl67" width="530" height="20"><span style="font-size: x-small;">Cali</span></td>
        <td class="xl66" style="text-align: center; background-color: #ffc7ce; width: 202px;"><span style="font-size: x-small; color: #9c0006;">CH</span></td>
        <td class="xl67" width="544"><span style="font-size: x-small;">Popay&aacute;n</span></td>
        <td class="xl66" style="text-align: center; background-color: #ffc7ce; width: 202px;"><span style="font-size: x-small; color: #9c0006;">CH</span></td>
        </tr>
        <tr>
        <td class="xl67" width="530" height="20"><span style="font-size: x-small;">Ibague</span></td>
        <td class="xl667" style="text-align: center; background-color: #ffc7ce; width: 202px;"><span style="font-size: x-small; color: #9c0006;">CH</span></td>
        <td class="xl67" width="544"><span style="font-size: x-small;">Buga</span></td>
        <td class="xl66" style="text-align: center; background-color: #ffc7ce; width: 202px;"><span style="font-size: x-small; color: #9c0006;">CH</span></td>
        </tr>
        <tr>
        <td class="xl67" width="530" height="20"><span style="font-size: x-small;">Neiva</span></td>
        <td class="xl66" style="text-align: center; background-color: #ffc7ce; width: 202px;"><span style="font-size: x-small; color: #9c0006;">CH</span></td>
        <td class="xl67" width="544"><span style="font-size: x-small;">Medellin</span></td>
        <td class="xl66" style="text-align: center; background-color: #ffc7ce; width: 202px;"><span style="font-size: x-small; color: #9c0006;">CH</span></td>
        </tr>
        <tr>
        <td class="xl67" width="530" height="20"><span style="font-size: x-small;">Bogota</span></td>
        <td class="xl66" style="text-align: center; background-color: #ffc7ce; width: 202px;"><span style="font-size: x-small; color: #9c0006;">CH</span></td>
        <td class="xl67" width="544"><span style="font-size: x-small;">Villavicencio</span></td>
        <td class="xl66" style="text-align: center; background-color: #ffc7ce; width: 202px;"><span style="font-size: x-small; color: #9c0006;">CH</span></td>
        </tr>
        <tr>
        <td class="xl67" width="530" height="20"><span style="font-size: x-small;">Pasto</span></td>
        <td class="xl66" style="text-align: center; background-color: #ffc7ce; width: 202px;"><span style="font-size: x-small; color: #9c0006;">CH</span></td>
        <td class="xl67" width="544"><span style="font-size: x-small;">Florencia</span></td>
        <td class="xl66" style="text-align: center; background-color: #ffc7ce; width: 202px;"><span style="font-size: x-small; color: #9c0006;">CH</span></td>
        </tr>
        <tr>
        <td class="xl67" width="530" height="20"><span style="font-size: x-small;">Monteria</span></td>
        <td class="xl66" style="text-align: center; background-color: #ffc7ce; width: 202px;"><span style="font-size: x-small; color: #9c0006;">CH</span></td>
        <td class="xl67" width="544"><span style="font-size: x-small;">Quibdo</span></td>
        <td class="xl66" style="text-align: center; background-color: #ffc7ce; width: 202px;"><span style="font-size: x-small; color: #9c0006;">CH</span></td>
        </tr>
        <tr>
        <td class="xl67" width="530" height="20"><span style="font-size: x-small;">Armenia</span></td>
        <td class="xl66" style="text-align: center; background-color: #ffc7ce; width: 202px;"><span style="font-size: x-small; color: #9c0006;">CH</span></td>
        <td class="xl67" width="544"><span style="font-size: x-small;">Pereira</span></td>
        <td class="xl66" style="text-align: center; background-color: #ffc7ce; width: 202px;"><span style="font-size: x-small; color: #9c0006;">CH</span></td>
        </tr>
        <tr>
        <td class="xl67" width="530" height="20"><span style="font-size: x-small;">Tunja</span></td>
        <td class="xl66" style="text-align: center; background-color: #ffc7ce; width: 202px;"><span style="font-size: x-small; color: #9c0006;">CH</span></td>
        <td class="xl67" width="544"><span style="font-size: x-small;">Manizales</span></td>
        <td class="xl66" style="text-align: center; background-color: #ffc7ce; width: 202px;"><span style="font-size: x-small; color: #9c0006;">CH</span></td>
        </tr>
        <tr>
        <td class="xl67" width="530" height="20"><span style="font-size: x-small;">Palmira</span></td>
        <td class="xl66" style="text-align: center; background-color: #ffc7ce; width: 202px;"><span style="font-size: x-small; color: #9c0006;">CH</span></td>
        <td class="xl67" width="544"><span style="font-size: x-small;">Bucaramanga</span></td>
        <td class="xl66" style="text-align: center; background-color: #ffc7ce; width: 202px;"><span style="font-size: x-small; color: #9c0006;">CH</span></td>
        </tr>
        <tr>
        <td class="xl67" width="530" height="20"><span style="font-size: x-small;">Cartagena</span></td>
        <td class="xl66" style="text-align: center; background-color: #ffc7ce; width: 202px;"><span style="font-size: x-small; color: #9c0006;">CH</span></td>
        <td class="xl67" width="544"><span style="font-size: x-small;">Barranquilla</span></td>
        <td class="xl66" style="text-align: center; background-color: #ffc7ce; width: 202px;"><span style="font-size: x-small; color: #9c0006;">CH</span></td>
        </tr>
        </tbody>
        </table>
        <table style="width: 1100px;" border="1" cellspacing="0" cellpadding="0" align="center">
        <tbody>
        <tr>
        <td style="width: 950px; background-color: #002060; text-align: center;"><span style="font-size: large; color: #ffffff;">Listas vinculantes</span></td>
        <td style="background-color: #002060; text-align: center;">
        <p><span style="color: #ffffff;">&nbsp; </span><span style="color: #ffffff; font-size: small;">B&uacute;squeda por ID</span></p>
        </td>
        </tr>
        </tbody>
        </table>
        <table style="width: 1100px;" border="1" cellspacing="0" cellpadding="0" align="center"><colgroup><col width="530" /><col width="202" /><col width="544" /><col width="198" /></colgroup>
        <tbody>
        <tr>
        <td class="xl67" width="530" height="35"><span style="font-size: x-small;">Department of State list of Foreign Terrorist Organizations FTO</span></td>
        <td class="xl66" style="text-align: center; background-color: #ffc7ce; width: 202px;"><span style="font-size: x-small; color: #9c0006;">CH</span></td>
        <td class="xl67" width="544"><span style="font-size: x-small;">EU Consolidated list of sanctions</span></td>
        <td class="xl66" style="text-align: center; background-color: #ffc7ce; width: 202px;"><span style="font-size: x-small; color: #9c0006;">CH</span></td>
        </tr>
        <tr>
        <td class="xl67" width="530" height="35"><span style="font-size: x-small;">Lista Departamento de Estado EEUU Organizaciones extranjeras terroristas FTO</span></td>
        <td class="xl66" style="text-align: center; background-color: #ffc7ce; width: 202px;"><span style="font-size: x-small; color: #9c0006;">CH</span></td>
        <td class="xl67" width="544"><span style="font-size: x-small;">Lista Uni&oacute;n Europea de organizaciones terroristas</span></td>
        <td class="xl66" style="text-align: center; background-color: #ffc7ce; width: 202px;"><span style="font-size: x-small; color: #9c0006;">CH</span></td>
        </tr>
        <tr>
        <td class="xl67" width="530" height="20"><span style="font-size: x-small;">EU Consolidated list of sanctions terrorism</span></td>
        <td class="xl66" style="text-align: center; background-color: #ffc7ce; width: 202px;"><span style="font-size: x-small; color: #9c0006;">CH</span></td>
        <td class="xl67" width="544"><span style="font-size: x-small;">UN Security council list</span></td>
        <td class="xl66" style="text-align: center; background-color: #ffc7ce; width: 202px;"><span style="font-size: x-small; color: #9c0006;">CH</span></td>
        </tr>
        <tr>
        <td class="xl67" width="530" height="35"><span style="font-size: x-small;">Lista Uni&oacute;n Europea de personas catalogadas como terroristas</span></td>
        <td class="xl66" style="text-align: center; background-color: #ffc7ce; width: 202px;"><span style="font-size: x-small; color: #9c0006;">CH</span></td>
        <td class="xl67" width="544"><span style="font-size: x-small;">Lista Consejo de Seguridad de la ONU</span></td>
        <td class="xl66" style="text-align: center; background-color: #ffc7ce; width: 202px;"><span style="font-size: x-small; color: #9c0006;">CH</span></td>
        </tr>
        </tbody>
        </table>
        <table style="width: 1100px;" border="1" cellspacing="0" cellpadding="0" align="center">
        <tbody>
        <tr>
        <td style="width: 950px; background-color: #002060; text-align: center;"><span style="font-size: large; color: #ffffff;">Listas restrictivas</span></td>
        <td style="background-color: #002060; text-align: center;">
        <p><span style="color: #ffffff; font-size: small;">&nbsp; &nbsp;B&uacute;squeda por ID</span></p>
        </td>
        </tr>
        </tbody>
        </table>
        <table style="width: 1100px;" border="1" cellspacing="0" cellpadding="0" align="center"><colgroup><col width="530" /><col width="202" /><col width="544" /><col width="198" /></colgroup>
        <tbody>
        <tr>
        <td class="xl68" width="530" height="20">Lista Panama Papers</td>
        <td class="xl69" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        <td class="xl68" width="544">The Arms Export Control Act (AECA)</td>
        <td class="xl69" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        </tr>
        <tr>
        <td class="xl68" width="530" height="35">Lista personas y empresas vinculadas al escandalo Panama Papers</td>
        <td class="xl69" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        <td class="xl68" width="544">Ley de Control de Exportaci&oacute;n de Armas (AECA)</td>
        <td class="xl69" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        </tr>
        <tr>
        <td class="xl68" width="530" height="20">World Bank Listing of Ineligible Firms and Individuals</td>
        <td class="xl69" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        <td class="xl68" width="544">Comit&eacute; de Sanciones del Grupo BID</td>
        <td class="xl69" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        </tr>
        <tr>
        <td class="xl68" width="530" height="35">Empresas sancionadas Banco Mundial</td>
        <td class="xl69" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        <td class="xl68" width="544">Comit&eacute; BID empresas sancionadas por pr&aacute;cticas fraudulentas, corruptas, colusorias, coercitivas u obstructivas</td>
        <td class="xl69" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        </tr>
        <tr>
        <td class="xl68" width="530" height="20">Consolidated Canadian Autonomous Sanctions List</td>
        <td class="xl69" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        <td class="xl68" width="544">EEUU Denied Persons List BIS</td>
        <td class="xl69" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        </tr>
        <tr>
        <td class="xl68" width="530" height="20">Lista Consolidada de sanciones autonomas de Canada</td>
        <td class="xl69" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        <td class="xl68" width="544">Lista de Personas prohibidas a exportar EEUU</td>
        <td class="xl69" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        </tr>
        <tr>
        <td class="xl68" width="530" height="20">EEUU Entity List BIS</td>
        <td class="xl69" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        <td class="xl68" width="544">Foreign Corrupt Practices Act List EEUU</td>
        <td class="xl66" style="text-align: center; background-color: #ffc7ce; width: 202px;"><span style="font-size: x-small; color: #9c0006;">CH</span></td>
        </tr>
        <tr>
        <td class="xl68" width="530" height="20">Lista Entes prohibidos a recibir mercancias EEUU</td>
        <td class="xl69" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        <td class="xl68" width="544">Lista Ley de Pr&aacute;cticas Corruptas en el Extranjero FCPA EEUU</td>
        <td class="xl66" style="text-align: center; background-color: #ffc7ce; width: 202px;"><span style="font-size: x-small; color: #9c0006;">CH</span></td>
        </tr>
        <tr>
        <td class="xl68" width="530" height="35">Office of Foreign Assets Control OFAC</td>
        <td class="xl69" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        <td class="xl68" width="544">List of Foreign Financial Institutions Subject to Correspondent Account or Payable-Through Account Sanctions (CAPTA List)</td>
        <td class="xl69" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        </tr>
        <tr>
        <td class="xl68" width="530" height="45">OFAC Lista Clinton</td>
        <td class="xl66" style="text-align: center; background-color: #ffc7ce; width: 202px;"><span style="font-size: x-small; color: #9c0006;">CH</span></td>
        <td class="xl68" width="544">Lista de Instituciones Financieras Extranjeras sujetas a Sanciones por Cuenta Corresponsal o Cuenta Pagadera (Lista CAPTA)</td>
        <td class="xl69" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        </tr>
        <tr>
        <td class="xl68" width="530" height="20">OFAC Non-SDN Palestinian Legislative Council (NS-PLC) list</td>
        <td class="xl66" style="text-align: center; background-color: #ffc7ce; width: 202px;"><span style="font-size: x-small; color: #9c0006;">CH</span></td>
        <td class="xl68" width="544">UK HM Treasury sanctions list</td>
        <td class="xl69" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        </tr>
        <tr>
        <td class="xl68" width="530" height="20">OFAC Foreign Sanctions Evaders (FSE) List</td>
        <td class="xl66" style="text-align: center; background-color: #ffc7ce; width: 202px;"><span style="font-size: x-small; color: #9c0006;">CH</span></td>
        <td class="xl68" width="544">Lista de entes sancionados Gran Breta&ntilde;a</td>
        <td class="xl69" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        </tr>
        <tr>
        <td class="xl68" width="530" height="20">OFAC Lista de evasores de sanciones extranjeras (FSE)</td>
        <td class="xl66" style="text-align: center; background-color: #ffc7ce; width: 202px;"><span style="font-size: x-small; color: #9c0006;">CH</span></td>
        <td class="xl68" width="544">Lista OSFI Canada</td>
        <td class="xl69" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        </tr>
        <tr>
        <td class="xl68" width="530" height="35">OFAC Sectoral Sanctions Identifications (SSI) List</td>
        <td class="xl66" style="text-align: center; background-color: #ffc7ce; width: 202px;"><span style="font-size: x-small; color: #9c0006;">CH</span></td>
        <td class="xl68" width="544">Lista Office of the Superintendent of Financial Institutions Canada</td>
        <td class="xl69" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        </tr>
        <tr>
        <td class="xl68" width="530" height="35">OFAC Lista de identificaciones de sancionadas sectoriales (SSI)</td>
        <td class="xl66" style="text-align: center; background-color: #ffc7ce; width: 202px;"><span style="font-size: x-small; color: #9c0006;">CH</span></td>
        <td class="xl68" width="544">Lista del Consejo Legislativo Palestino no SDN (NS-PLC)</td>
        <td class="xl69" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        </tr>
        <tr>
        <td class="xl68" width="530" height="20">OFAC Non-SDN Menu-Based Sanctions List (NS-MBS List)</td>
        <td class="xl66" style="text-align: center; background-color: #ffc7ce; width: 202px;"><span style="font-size: x-small; color: #9c0006;">CH</span></td>
        <td class="xl68" width="544">EEUU Unverified List BIS</td>
        <td class="xl69" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        </tr>
        <tr>
        <td class="xl68" width="530" height="35">OFAC Lista de sanciones basada en men&uacute;s no SDN (Lista NS-MBS)</td>
        <td class="xl66" style="text-align: center; background-color: #ffc7ce; width: 202px;"><span style="font-size: x-small; color: #9c0006;">CH</span></td>
        <td class="xl68" width="544">Entes no elegibles para recibir art&iacute;culos sujetos a las Regulaciones de la Administraci&oacute;n de Exportaciones EEUU</td>
        <td class="xl69" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        </tr>
        <tr>
        <td class="xl68" width="530" height="20">OFAC Non-SDN Iranian Sanctions Act (NS-ISA) List</td>
        <td class="xl66" style="text-align: center; background-color: #ffc7ce; width: 202px;"><span style="font-size: x-small; color: #9c0006;">CH</span></td>
        <td class="xl68" width="544">OFAC Lista de la Ley de sanciones iran&iacute;es no SDN (NS-ISA)</td>
        <td class="xl66" style="text-align: center; background-color: #ffc7ce; width: 202px;"><span style="font-size: x-small; color: #9c0006;">CH</span></td>
        </tr>
        </tbody>
        </table>
        <table style="width: 1100px;" border="1" cellspacing="0" cellpadding="0" align="center">
        <tbody>
        <tr>
        <td style="width: 950px; background-color: #002060; text-align: center;"><span style="font-size: large; color: #ffffff;">Noticias Reputacionales</span></td>
        <td style="background-color: #002060; text-align: center;">
        <p><span style="color: #ffffff; font-size: small;">&nbsp; B&uacute;squeda&nbsp;</span><span style="color: #ffffff; font-size: small;">por Denominaci&oacute;n&nbsp;</span></p>
        </td>
        </tr>
        </tbody>
        </table>
        <table style="width: 1100px;" border="1" cellspacing="0" cellpadding="0" align="center"><colgroup><col width="530" /><col width="202" /><col width="544" /><col width="198" /></colgroup>
        <tbody>
        <tr>
        <td class="xl67" width="530" height="20">Noticias extraditados Corte Suprema de Justicia</td>
        <td class="xl66" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        <td class="xl67" width="544">Noticias Fiscal&iacute;a General de la Naci&oacute;n LAFT</td>
        <td class="xl66" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        </tr>
        <tr>
        <td class="xl67" width="530" height="20">Noticias Polic&iacute;a Nacional LAFT</td>
        <td class="xl66" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        <td class="xl67" width="544">Noticias Presidencia LAFT</td>
        <td class="xl66" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        </tr>
        <tr>
        <td class="xl67" width="530" height="20">Actividades corruptas o illegales Insight Crime</td>
        <td class="xl66" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        <td class="xl67" width="544">Fugitivos DEA</td>
        <td class="xl66" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        </tr>
        <tr>
        <td class="xl67" width="530" height="20">Lista de Personas y Grupos Terroristas Guardia Civil Espa&ntilde;ola</td>
        <td class="xl66" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        <td class="xl67" width="544">Fugitivos m&aacute;s buscados por la DEA</td>
        <td class="xl66" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        </tr>
        <tr>
        <td class="xl67" width="530" height="20">Interpol Red notices</td>
        <td class="xl66" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        <td class="xl67" width="544">Enviromental Protection Agency (EPA) Fugitives</td>
        <td class="xl66" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        </tr>
        <tr>
        <td class="xl67" width="530" height="20">Boletines Rojos Interpol</td>
        <td class="xl66" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        <td class="xl67" width="544">Fugitivos Agencia de Protecci&oacute;n del medio Ambiente EEUU (EPA)</td>
        <td class="xl66" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        </tr>
        <tr>
        <td class="xl67" width="530" height="20">DSS Most Wanted</td>
        <td class="xl66" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        <td class="xl67" width="544">CBI Most Wanted</td>
        <td class="xl66" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        </tr>
        <tr>
        <td class="xl67" width="530" height="20">DSS (Diplomatic Security Service) m&aacute;s buscados</td>
        <td class="xl66" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        <td class="xl67" width="544">CBI (Central Bureau of Investigation) m&aacute;s buscados</td>
        <td class="xl66" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        </tr>
        <tr>
        <td class="xl67" width="530" height="20">ICE Most Wanted</td>
        <td class="xl66" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        <td class="xl67" width="544">FBI Most Wanted</td>
        <td class="xl66" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        </tr>
        <tr>
        <td class="xl67" width="530" height="20">ICE (Immigration and Customs Enforcement) m&aacute;s buscados</td>
        <td class="xl66" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        <td class="xl67" width="544">FBI (Federal Bureau of Investigation) m&aacute;s buscados</td>
        <td class="xl66" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        </tr>
        <tr>
        <td class="xl67" width="530" height="20">UK Most Wanted</td>
        <td class="xl66" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        <td class="xl67" width="544">UE EUROPOL Most Wanted</td>
        <td class="xl66" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        </tr>
        <tr>
        <td class="xl67" width="530" height="20">Gran Breta&ntilde;a m&aacute;s buscados</td>
        <td class="xl66" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        <td class="xl67" width="544">EUROPOL m&aacute;s buscados</td>
        <td class="xl66" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        </tr>
        </tbody>
        </table>
        <table style="width: 1100px;" border="1" cellspacing="0" cellpadding="0" align="center">
        <tbody>
        <tr>
        <td style="width: 950px; background-color: #002060; text-align: center;"><span style="font-size: large; color: #ffffff;">Boletines</span></td>
        <td style="background-color: #002060; text-align: center;">
        <p><span style="color: #ffffff; font-size: small;">B&uacute;squeda por Denominaci&oacute;n&nbsp;</span></p>
        </td>
        </tr>
        </tbody>
        </table>
        <table style="width: 1100px;" border="1" cellspacing="0" cellpadding="0" align="center"><colgroup><col width="530" /><col width="202" /><col width="544" /><col width="198" /></colgroup>
        <tbody>
        <tr>
        <td class="xl67" width="530" height="35">Bolet&iacute;n de deudores de la Contralor&iacute;a General de la naci&oacute;n</td>
        <td class="xl66" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        <td class="xl67" width="544">Proveedores ficticios DIAN</td>
        <td class="xl66" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        </tr>
        <tr>
        <td class="xl67" width="530" height="35">Deudores Contralor&iacute;a general de la naci&oacute;n reporte trimestral</td>
        <td class="xl66" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        <td class="xl67" width="544">Noticias Procuradur&iacute;a General de la Naci&oacute;n</td>
        <td class="xl66" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        </tr>
        <tr>
        <td class="xl67" width="530" height="35">Contadores sancionados Junta Central de Contadores JCC</td>
        <td class="xl66" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        <td class="xl67" width="544">Boletines Superintendencia Solidaria</td>
        <td class="xl66" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        </tr>
        <tr>
        <td class="xl67" width="530" height="20">Contadores sancionados JCC</td>
        <td class="xl66" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        <td class="xl67" width="544">Boletines Superintendencia de Industria y Comercio</td>
        <td class="xl66" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        </tr>
        <tr>
        <td class="xl67" width="530" height="20">Entes Sancionados SECOP</td>
        <td class="xl66" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        <td class="xl67" width="544">Boletines Superintendencia Financiera</td>
        <td class="xl66" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        </tr>
        <tr>
        <td class="xl67" width="530" height="20">Entes sancionados por contrataci&oacute;n p&uacute;blica SECOP</td>
        <td class="xl66" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        <td class="xl67" width="544">Boletines Superintendencia de Sociedades</td>
        <td class="xl66" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        </tr>
        </tbody>
        </table>
        <table style="width: 1100px;" border="1" cellspacing="0" cellpadding="0" align="center">
        <tbody>
        <tr>
        <td style="width: 950px; background-color: #002060; text-align: center;"><span style="font-size: large; color: #ffffff;">PEPS</span></td>
        <td style="background-color: #002060; text-align: center;">
        <p><span style="color: #ffffff; font-size: small;">B&uacute;squeda por Denominaci&oacute;n&nbsp;</span></p>
        </td>
        </tr>
        </tbody>
        </table>
        <table style="width: 1100px;" border="1" cellspacing="0" cellpadding="0" align="center"><colgroup><col width="530" /><col width="202" /><col width="544" /><col width="198" /></colgroup>
        <tbody>
        <tr>
        <td class="xl67" width="530" height="20">Relacionados a PEPS Colombia</td>
        <td class="xl66" style="text-align: center; background-color: #ffeb9c; width: 198px;"><span style="font-size: x-small; color: #9c5700;">CHM</span></td>
        <td class="xl67" width="544">Candidatos elecciones 2019</td>
        <td class="xl66" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        </tr>
        <tr>
        <td class="xl67" width="530" height="20">Magistrados y funcionarios Consejo de Estado</td>
        <td class="xl66" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        <td class="xl67" width="544">Magistrados y funcionarios Consejo Nacional Electoral</td>
        <td class="xl66" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        </tr>
        <tr>
        <td class="xl67" width="530" height="20">Magistrados y funcionarios Consejo Superior de la Judicatura</td>
        <td class="xl66" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        <td class="xl67" width="544">Magistrados y funcionarios</td>
        <td class="xl66" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        </tr>
        <tr>
        <td class="xl67" width="530" height="20">Magistrados y funcionarios Corte Suprema de Justicia</td>
        <td class="xl66" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        <td class="xl67" width="544">Embajadas en Colombia</td>
        <td class="xl66" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        </tr>
        <tr>
        <td class="xl67" width="530" height="20">Embajadas en el exterior</td>
        <td class="xl66" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        <td class="xl67" width="544">Estructura de Gobierno</td>
        <td class="xl66" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        </tr>
        <tr>
        <td class="xl67" width="530" height="20">Funcionarios de alto nivel Fuerzas Militares</td>
        <td class="xl66" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        <td class="xl67" width="544">Funcionarios p&uacute;blicos alto nivel gobernaciones y asambleas</td>
        <td class="xl66" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        </tr>
        <tr>
        <td class="xl67" width="530" height="20">Funcionarios p&uacute;blicos nivel municipal, alcaldes y concejales</td>
        <td class="xl66" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        <td class="xl67" width="544">Funcionarios p&uacute;blicos alto nivel del orden nacional</td>
        <td class="xl66" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        </tr>
        <tr>
        <td class="xl67" width="530" height="20">Funcionarios partidos pol&iacute;ticos y candidatos no elegidos</td>
        <td class="xl66" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        <td class="xl67" width="544">Colombia</td>
        <td class="xl66" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        </tr>
        </tbody>
        </table>
        <table style="width: 1100px;" border="1" cellspacing="0" cellpadding="0" align="center">
        <tbody>
        <tr>
        <td style="width: 950px; background-color: #002060; text-align: center;"><span style="font-size: medium; color: #ffffff;">PEPS Internacionales</span></td>
        <td style="background-color: #002060; text-align: center;">
        <p><span style="color: #ffffff; font-size: small;">&nbsp; &nbsp; &nbsp;B&uacute;squeda por&nbsp; &nbsp; &nbsp; &nbsp; Denominaci&oacute;n&nbsp;</span></p>
        </td>
        </tr>
        </tbody>
        </table>
        <table style="width: 1100px;" border="1" cellspacing="0" cellpadding="0" align="center"><colgroup><col width="530" /><col width="202" /><col width="544" /><col width="198" /></colgroup>
        <tbody>
        <tr>
        <td class="xl67" width="530" height="20">Alemania</td>
        <td class="xl66" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        <td class="xl67" width="544">Argentina</td>
        <td class="xl66" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        </tr>
        <tr>
        <td class="xl67" width="530" height="20">Belgica</td>
        <td class="xl66" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        <td class="xl67" width="544">Bielorrusia</td>
        <td class="xl66" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        </tr>
        <tr>
        <td class="xl67" width="530" height="20">Bolivia</td>
        <td class="xl66" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        <td class="xl67" width="544">Brasil</td>
        <td class="xl66" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        </tr>
        <tr>
        <td class="xl67" width="530" height="20">Canad&aacute;</td>
        <td class="xl66" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        <td class="xl67" width="544">Chile</td>
        <td class="xl66" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        </tr>
        <tr>
        <td class="xl67" width="530" height="20">Costa Rica</td>
        <td class="xl66" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        <td class="xl67" width="544">Cuba</td>
        <td class="xl66" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        </tr>
        <tr>
        <td class="xl67" width="530" height="20">Ecuador</td>
        <td class="xl66" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        <td class="xl67" width="544">Espa&ntilde;a</td>
        <td class="xl66" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        </tr>
        <tr>
        <td class="xl67" width="530" height="20">Estonia</td>
        <td class="xl66" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        <td class="xl67" width="544">Finlandia</td>
        <td class="xl66" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        </tr>
        <tr>
        <td class="xl67" width="530" height="20">Francia</td>
        <td class="xl66" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        <td class="xl67" width="544">Islandia</td>
        <td class="xl66" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        </tr>
        <tr>
        <td class="xl67" width="530" height="20">Letonia</td>
        <td class="xl66" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        <td class="xl67" width="544">Lituania</td>
        <td class="xl66" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        </tr>
        <tr>
        <td class="xl67" width="530" height="20">M&eacute;xico</td>
        <td class="xl66" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        <td class="xl67" width="544">Nicaragua</td>
        <td class="xl66" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        </tr>
        <tr>
        <td class="xl67" width="530" height="20">Noruega</td>
        <td class="xl66" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        <td class="xl67" width="544">Pa&iacute;ses Bajos</td>
        <td class="xl66" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        </tr>
        <tr>
        <td class="xl67" width="530" height="20">Paraguay</td>
        <td class="xl66" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        <td class="xl67" width="544">Otros</td>
        <td class="xl66" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        </tr>
        <tr>
        <td class="xl67" width="530" height="20">Per&uacute;</td>
        <td class="xl66" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        <td class="xl67" width="544">Polonia</td>
        <td class="xl66" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        </tr>
        <tr>
        <td class="xl67" width="530" height="20">Rep&uacute;blica Bolivariana de Venezuela</td>
        <td class="xl66" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        <td class="xl67" width="544">Rep&uacute;blica de El Salvador</td>
        <td class="xl66" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        </tr>
        <tr>
        <td class="xl67" width="530" height="20">Rep&uacute;blica de Guatemala</td>
        <td class="xl66" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        <td class="xl67" width="544">Rep&uacute;blica de Honduras</td>
        <td class="xl66" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        </tr>
        <tr>
        <td class="xl67" width="530" height="20">Rep&uacute;blica de Panam&aacute;</td>
        <td class="xl66" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        <td class="xl67" width="544">Suecia</td>
        <td class="xl66" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        </tr>
        <tr>
        <td class="xl67" width="530" height="20">Uruguay</td>
        <td class="xl66" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        <td class="xl67" width="544">Venezuela</td>
        <td class="xl66" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        </tr>
        </tbody>
        </table>
        <table style="width: 1100px;" border="1" cellspacing="0" cellpadding="0" align="center">
        <tbody>
        <tr>
        <td class="xl66" style="background-color: #002060; width: 550px; height: 40px;"><span style="font-size: medium; color: #ffffff;">Figuras P&uacute;blicas</span></td>
        <td class="xl67" style="width: 215px; background-color: #002060;">&nbsp;</td>
        <td class="xl68" style="width: 550px; background-color: #002060;"><span style="color: #ffffff; font-size: medium;">Contrataci&oacute;n P&uacute;blica</span></td>
        <td class="xl69" style="width: 168px; background-color: #002060; text-align: center;"><span style="color: #ffffff; font-size: small;">B&uacute;squeda por Denominaci&oacute;n&nbsp;</span></td>
        </tr>
        </tbody>
        </table>
        <table style="width: 1100px;" border="1" cellspacing="0" cellpadding="0" align="center">
        <tbody>
        <tr>
        <td class="xl67" style="width: 535px; height: 22px;">Figuras p&uacute;blicas Colombia - SIGEP</td>
        <td class="xl66" style="text-align: center; background-color: #ffeb9c; width: 198px;"><span style="font-size: x-small; color: #9c5700;">CHM</span></td>
        <td class="xl67" width="544">Grandes contratistas del estado en Colombia</td>
        <td class="xl66" style="text-align: center; background-color: #ffeb9c; width: 198px;"><span style="font-size: x-small; color: #9c5700;">CHM</span></td>
        </tr>
        </tbody>
        </table>
        <table style="width: 1100px;" border="1" cellspacing="0" cellpadding="0" align="center">
        <tbody>
        <tr>
        <td class="xl64" style="background-color: #002060; width: 520px; height: 50px;"><span style="color: #ffffff; font-size: small;">Rama Judicial Unificada - <span class="font6">B&uacute;squeda por Denominaci&oacute;n </span><span class="font5">con coincidencia al 100%</span></span></td>
        <td class="xl65" style="text-align: center; width: 207px; background-color: #ffffff;"><span style="color: #000000; font-size: x-small;">N/A</span></td>
        <td class="xl64" style="background-color: #002060; width: 544px; text-align: left;"><span style="color: #ffffff; font-size: small;">Proveedores ficticios DIAN</span></td>
        <td class="xl65" style="text-align: center; width: 205px; background-color: #ffc7ce;"><span style="color: #9c0006;">CH</span></td>
        </tr>
        </tbody>
        </table>
        <p style="text-align: left;"><span style="font-size: small;"><strong><span style="color: #ff0000;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;** Requiere fecha de expedici&oacute;n del documento de identidad, el cliente debe adjuntar fecha desde la solicitud de lo contrario no se tendr&aacute; en cuenta tal consulta en el resultado.</span></strong></span></p>
        <table style="width: 1100px;" border="1" cellspacing="0" cellpadding="0" align="center"><colgroup><col width="530" /><col width="202" /><col width="544" /><col width="198" /></colgroup>
        <tbody>
        <tr>
        <td class="xl75" style="background-color: #002060; width: 530px; height: 25px; text-align: left;"><strong><span style="color: #ffffff; font-size: small;">LABORAL</span></strong></td>
        <td class="xl76" style="text-align: center; background-color: #002060; width: 202px;"><strong><span style="color: #ffffff; font-size: small;">Concepto</span></strong></td>
        <td class="xl82" style="text-align: left; background-color: #002060; width: 742px;"><span style="font-size: small;"><strong><span style="color: #ffffff;">ACADEMICO</span></strong></span></td>
        <td class="xl76" style="text-align: center; background-color: #002060; width: 202px;"><strong><span style="color: #ffffff; font-size: small;">Concepto</span></strong></td>
        </tr>
        <tr>
        <td class="xl71" height="15">Confirmaci&oacute;n telef&oacute;nica sobre cargo y periodo laborado con el &aacute;rea de RR.HH., Nomina o Contabilidad.</td>
        <td style="text-align: center;"><span style="font-size: small;">Si✔&nbsp; No_</span></td>
        <td class="xl73">Estudios formales finalizados</td>
        <td style="text-align: center;"><span style="font-size: small;">Si_&nbsp; No_</span></td>
        </tr>
        <tr>
        <td class="xl71" height="15">Confirmaci&oacute;n telef&oacute;nica sobre su desempe&ntilde;o con el Jefe inmediato/Modelo de informe con evaluaci&oacute;n cualitativa</td>
        <td style="text-align: center;"><span style="font-size: small;">Si✔&nbsp; No_</span></td>
        <td class="xl73">&iquest;Cu&aacute;les?</td>
        <td style="text-align: center;"><span style="font-size: small;">Todos</span></td>
        </tr>
        <tr>
        <td class="xl71" height="15">Aplica Verificaci&oacute;n Nacional</td>
        <td style="text-align: center;"><span style="font-size: small;">Si✔&nbsp; No_</span></td>
        <td class="xl73">Estudios En Curso</td>
        <td style="text-align: center;"><span style="font-size: small;">Si✔&nbsp; No_</span></td>
        </tr>
        <tr>
        <td class="xl71" height="15">Aplica Verificaci&oacute;n Extranjera</td>
        <td style="text-align: center;"><span style="font-size: small;">Si_&nbsp; No✔</span></td>
        <td class="xl73">Estudios Aplazados</td>
        <td style="text-align: center;"><span style="font-size: small;">Si✔&nbsp; No_</span></td>
        </tr>
        <tr>
        <td class="xl71" height="40">Verificaci&oacute;n en cantidad de experiencias</td>
        <td style="text-align: center;"><span style="font-size: small;">Si✔&nbsp; No_</span></td>
        <td class="xl79" width="544">Tiempo de Aplazado</td>
        <td style="text-align: center;"><span style="font-size: small;">1 semestre</span></td>
        </tr>
        <tr>
        <td class="xl72" width="530" height="32">&nbsp;</td>
        <td style="text-align: center;"><span style="font-size: small;">3 &uacute;ltimas</span></td>
        <td class="xl78" width="544">Aplica verificaci&oacute;n de Primaria</td>
        <td style="text-align: center;"><span style="font-size: small;">Si_&nbsp; No✔</span></td>
        </tr>
        <tr>
        <td class="xl71" height="40">Verificaci&oacute;n en cantidad de a&ntilde;os</td>
        <td style="text-align: center;"><span style="font-size: small;">Si_&nbsp; No✔</span></td>
        <td class="xl77">Aplica verificaci&oacute;n de cursos, diplomados</td>
        <td style="text-align: center;"><span style="font-size: small;">Si✔&nbsp; No_</span></td>
        </tr>
        <tr>
        <td class="xl71" height="40">&nbsp;</td>
        <td style="text-align: center;"><span style="font-size: small;">N/A</span></td>
        <td class="xl77">&iquest;Cu&aacute;ntos?</td>
        <td style="text-align: center;"><span style="font-size: small;">Asociados al cargo</span></td>
        </tr>
        <tr>
        <td class="xl71" height="40">Otras, &iquest;Cu&aacute;les?: ________________________________</td>
        <td style="text-align: center;">&nbsp;</td>
        <td class="xl77">Aplica Verificaci&oacute;n Nacional</td>
        <td style="text-align: center;"><span style="font-size: small;">Si✔&nbsp; No_</span></td>
        </tr>
        <tr>
        <td class="xl71" height="15">Carta laboral no ver&iacute;dica&nbsp;</td>
        <td class="xl67" style="text-align: center; background-color: #ffc7ce; width: 202px;"><span style="font-size: x-small; color: #9c0006;">CH</span></td>
        <td class="xl73">Aplica Verificaci&oacute;n Extranjera</td>
        <td style="text-align: center;"><span style="font-size: small;">Si_&nbsp; No✔</span></td>
        </tr>
        <tr>
        <td class="xl71" height="15">Retiro con justa causa</td>
        <td class="xl67" style="text-align: center; background-color: #ffc7ce; width: 202px;"><span style="font-size: x-small; color: #9c0006;">CH</span></td>
        <td class="xl73">Diploma no ver&iacute;dico</td>
        <td class="xl67" style="text-align: center; background-color: #ffc7ce; width: 202px;"><span style="font-size: x-small; color: #9c0006;">CH</span></td>
        </tr>
        <tr>
        <td class="xl71" height="15">Jefe inmediato no lo contratar&iacute;a</td>
        <td class="xl67" style="text-align: center; background-color: #ffeb9c; width: 198px;"><span style="font-size: x-small; color: #9c5700;">CHM</span></td>
        <td class="xl73">No verificable por cierre de la instituci&oacute;n&nbsp;</td>
        <td class="xl67" style="text-align: center; background-color: #ffeb9c; width: 198px;"><span style="font-size: x-small; color: #9c5700;">CHM</span></td>
        </tr>
        <tr>
        <td class="xl71" height="15">Jefe inmediato no lo recomienda</td>
        <td class="xl67" style="text-align: center; background-color: #ffeb9c; width: 198px;"><span style="font-size: x-small; color: #9c5700;">CHM</span></td>
        <td class="xl73">No registra en la instituci&oacute;n (por perdida de la instituci&oacute;n, da&ntilde;o por parte de la instituci&oacute;n)</td>
        <td class="xl67" style="text-align: center; background-color: #ffeb9c; width: 198px;"><span style="font-size: x-small; color: #9c5700;">CHM</span></td>
        </tr>
        <tr>
        <td class="xl71" height="15">Jefe inmediato no lo recomienda y no lo volver&iacute;a a contratar</td>
        <td class="xl67" style="text-align: center; background-color: #ffc7ce; width: 202px;"><span style="font-size: x-small; color: #9c0006;">CH</span></td>
        <td class="xl73">No registra en la instituci&oacute;n (Con y sin documentos)</td>
        <td class="xl74" style="text-align: center; background-color: #ffc7ce; width: 202px;"><span style="font-size: x-small; color: #9c0006;">CH</span></td>
        </tr>
        <tr>
        <td class="xl71" height="40">Si contamos con datos de contacto del jefe inmediato, pero no es efectiva la gesti&oacute;n (dejar trazabilidad clara y completa)</td>
        <td class="xl67" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        <td class="xl79" width="544">Receso Acad&eacute;mico - Vacaciones (5 &eacute;pocas del a&ntilde;o)</td>
        <td class="xl66" style="text-align: center; background-color: #5b9bd5;">NC</td>
        </tr>
        <tr>
        <td class="xl72" width="530" height="32">En caso de no contar con datos de jefes inmediatos (no afecta concepto final pero se debe dejar novedad)</td>
        <td class="xl66" style="text-align: center; background-color: #ffeb9c; width: 198px;"><span style="font-size: x-small; color: #9c5700;">CHM</span></td>
        <td class="xl78" width="544">Cierre con portales (ICFES, Universidades, RHETUS, Etc.) Si no tenemos diplomas o documentos finalizar dejando la trazabilidad completa</td>
        <td class="xl81" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        </tr>
        <tr>
        <td class="xl71" height="40">Empresa homologada por historial pensional (efectiva)</td>
        <td class="xl66" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        <td class="xl77">Validar Tarjeta profesional (si aplica para la profesi&oacute;n)</td>
        <td style="text-align: center;"><span style="font-size: small;">Si✔&nbsp; No_</span></td>
        </tr>
        <tr>
        <td class="xl72" width="530" height="45">No verificable, empresa no homologada con historial pensional o ninguna fuente o tercero (No efectiva)</td>
        <td class="xl66" style="text-align: center; background-color: #ffeb9c; width: 198px;"><span style="font-size: x-small; color: #9c5700;">CHM</span></td>
        <td class="xl78" width="544">Si no la tiene</td>
        <td class="xl66" style="text-align: center; background-color: #ffeb9c; width: 198px;"><span style="font-size: x-small; color: #9c5700;">CHM</span></td>
        </tr>
        <tr>
        <td class="xl71" height="40">Vac&iacute;os Laborales</td>
        <td style="text-align: center;"><span style="font-size: small;">Si_&nbsp; No✔</span></td>
        <td class="xl77">A&ntilde;o rural, servicio social, contrato de aprendizaje o pr&aacute;ctica</td>
        <td style="text-align: center;"><span style="font-size: small;">N/A</span></td>
        </tr>
        <tr>
        <td class="xl71" height="40">Se validan superior a 1 mes</td>
        <td style="text-align: center;"><span style="font-size: small;">Informativo</span></td>
        <td class="xl77">Costo por validaciones acad&eacute;micas donde generen cobro / adicional Escalar a SAC para cobro</td>
        <td style="text-align: center;"><span style="font-size: small;">Si✔&nbsp; No_</span></td>
        </tr>
        <tr>
        <td class="xl71" height="40">Se puede cerrar procesos con historia laboral, portales ARL, Aportes en L&iacute;nea, dejando la trazabilidad clara y completa.</td>
        <td class="xl66" style="text-align: center; background-color: #c6efce; width: 198px;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        <td class="xl77">Escalar a SAC cuando presente estudios en el exterior, adem&aacute;s informar si se debe generar pago*</td>
        <td style="text-align: center;"><span style="font-size: small;">Si_&nbsp; No✔</span></td>
        </tr>
        <tr>
        <td class="xl71" height="40">Costo por validaciones laborales en donde generen cobro / adicional escalar a SAC para cobro</td>
        <td style="text-align: center;"><span style="font-size: small;">Si✔&nbsp; No_</span></td>
        <td class="xl77">* Si arriba se marc&oacute; No en verificaciones extranjeras, hacer caso omiso a este punto.</td>
        <td style="text-align: center;">&nbsp;</td>
        </tr>
        <tr>
        <td rowspan="5" colspan="2">&nbsp;</td>
        <td class="xl84" style="background-color: #002060; width: 742px;" colspan="2"><strong><span style="color: #ffffff; font-size: small;">REFERENCIAS <span class="font6" style="color: #ffcc00;">(Si no tiene pesta&ntilde;a de referencias N/A)</span></span></strong></td>
        </tr>
        <tr>
        <td class="xl84" style="background-color: #002060; width: 742px;"><strong><span style="color: #ffffff; font-size: small;">Tipo de Referencia</span></strong></td>
        <td class="xl84" style="background-color: #002060; width: 742px;"><strong><span style="color: #ffffff; font-size: small;">Cantidad</span></strong></td>
        </tr>
        <tr>
        <td class="xl72" width="530" height="32">Personal</td>
        <td style="text-align: center;"><span style="font-size: small;">1</span></td>
        </tr>
        <tr>
        <td class="xl72" width="530" height="32">No lo recomienda</td>
        <td class="xl67" style="text-align: center; background-color: #ffeb9c; width: 198px;"><span style="font-size: x-small; color: #9c5700;">CHM</span></td>
        </tr>
        <tr>
        <td class="xl71" style="text-align: left;" height="20">Si no responde ninguna referencia (dejar trazabilidad clara y completa)</td>
        <td class="xl67" style="text-align: center; background-color: #ffeb9c; width: 198px;"><span style="font-size: x-small; color: #9c5700;">CHM</span></td>
        </tr>
        </tbody>
        </table>
        <table style="width: 1100px;" border="1" cellspacing="0" cellpadding="0" align="center"><colgroup><col width="530" /><col width="202" /><col width="544" /><col width="198" /></colgroup>
        <tbody>
        <tr>
        <td class="xl75" style="background-color: #002060; width: 550px; height: 25px; text-align: left;"><strong><span style="color: #ffffff; font-size: small;">VISITA DOMICILIARIA</span></strong></td>
        <td class="xl76" style="text-align: center; background-color: #002060; width: 202px;"><strong><span style="color: #ffffff; font-size: small;">DOCUMENTACI&Oacute;N</span></strong></td>
        <td class="xl82" style="text-align: left; background-color: #002060; width: 740px;">&nbsp;</td>
        <td class="xl76" style="text-align: center; background-color: #002060; width: 260px;"><strong><span style="color: #ffffff; font-size: small;">Concepto</span></strong></td>
        </tr>
        <tr>
        <td class="xl74" style="width: 775px; height: 335px;" rowspan="15"><span style="font-size: small;"><strong><span class="font6">Visita domiciliaria&nbsp; Pre empleo</span></strong><span class="font5"> (Si no tiene producto con tarifa virtual por defecto es presencial )&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span></span></td>
        <td class="xl77" style="width: 265px;" rowspan="15">Autorizaciones, Carta de presentaci&oacute;n.</td>
        <td class="xl70">Tiempo estimado 45 min. Desarrollo del cuestionario en el sitio social que defina el evaluado.<br /><br /><br /> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td class="xl66" style="text-align: center;" width="198">Informativo&nbsp;</td>
        </tr>
        <tr>
        <td class="xl67" height="70">Reconocimiento espacial del inmueble buscando vinculo con el evaluado. Se diligencian y firman los formatos de autorizaci&oacute;n y se entregan los documentos solicitados.</td>
        <td class="xl66" style="text-align: center;">&nbsp;</td>
        </tr>
        <tr>
        <td class="xl67" height="20">Debe estar presente en la visita un miembro de la familia</td>
        <td style="text-align: center;"><span style="font-size: small;">Si✔&nbsp; No_</span></td>
        </tr>
        <tr>
        <td class="xl67" height="20">Registro fotogr&aacute;fico</td>
        <td style="text-align: center;"><span style="font-size: small;">Si✔&nbsp; No_</span></td>
        </tr>
        <tr>
        <td class="xl65" height="40">4 fotos (fachada, nomenclatura, espacio social y candidato).&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td class="xl66" style="text-align: center;">&nbsp;</td>
        </tr>
        <tr>
        <td class="xl65" height="40">Otro, &iquest;Cu&aacute;l?: __________________</td>
        <td class="xl66" style="text-align: center;">&nbsp;</td>
        </tr>
        <tr>
        <td class="xl67" height="20">Si se identifica que el candidato no reside en la vivienda</td>
        <td class="xl68" style="background-color: #ffc7ce; width: 196px; text-align: center;"><span style="font-size: x-small; color: #9c0006;">CH</span></td>
        </tr>
        <tr>
        <td class="xl65" height="20">Niveles de peligrosidad en la vivienda altos&nbsp;</td>
        <td class="xl69" style="background-color: #ffeb9c; width: 195px; text-align: center;"><span style="font-size: x-small; color: #9c5700;">CHM</span></td>
        </tr>
        <tr>
        <td class="xl67" height="20">Situaci&oacute;n de hacinamiento&nbsp;</td>
        <td class="xl69" style="background-color: #ffeb9c; width: 198px; text-align: center;"><span style="font-size: x-small; color: #9c5700;">CHM</span></td>
        </tr>
        <tr>
        <td class="xl67" height="20">Referencia de vecindario</td>
        <td style="text-align: center;"><span style="font-size: small;">Si_&nbsp; No✔</span></td>
        </tr>
        <tr>
        <td class="xl67" height="20">No lo recomiendan o</td>
        <td style="text-align: center;"><span style="font-size: small;">N/A</span></td>
        </tr>
        <tr>
        <td class="xl67" height="20">No brinda el documento (dejar descrito el motivo por el que no lo entrega)</td>
        <td style="text-align: center;"><span style="font-size: small;">N/A</span></td>
        </tr>
        <tr>
        <td class="xl67" height="20">Pol&iacute;tica familiaridad</td>
        <td style="text-align: center;"><span style="font-size: small;">Si_&nbsp; No✔</span></td>
        </tr>
        <tr>
        <td class="xl67" height="20">Si tiene familiares de 1 l&iacute;nea de consanguinidad laborando en la empresa</td>
        <td style="text-align: center;"><span style="font-size: small;">N/A</span></td>
        </tr>
        <tr>
        <td class="xl67" height="20">Consumo de Drogas</td>
        <td class="xl69" style="background-color: #ffeb9c; width: 198px; text-align: center;"><span style="font-size: x-small; color: #9c5700;">CHM</span></td>
        </tr>
        </tbody>
        </table>
        <table style="width: 1100px;" border="1" cellspacing="0" cellpadding="0" align="center"><colgroup><col width="530" /><col width="202" /><col width="544" /><col width="198" /></colgroup>
        <tbody>
        <tr>
        <td class="xl74" style="width: 550px; height: 897px;" rowspan="34"><strong><span style="font-size: medium;">Visita domiciliaria rutina /BASC/OEA Actualizaci&oacute;n&nbsp;</span></strong></td>
        <td class="xl65" style="width: 160px;" rowspan="16">
        <p><strong>Pre empleo</strong> : Autorizaciones especial para esta tipo de componente, Carta de presentaci&oacute;n, Muestra grafol&oacute;gica.</p>
        </td>
        <td class="xl70" style="width: 550px;">Tiempo estimado 45 min. Desarrollo del cuestionario en el sitio social que defina el evaluado.<br /><br /><br /> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td class="xl66" style="text-align: center;" width="198">Informativo</td>
        </tr>
        <tr>
        <td class="xl67" height="70">Reconocimiento espacial del inmueble buscando vinculo con el evaluado. Se diligencian y firman los formatos de autorizaci&oacute;n y se entregan los documentos solicitados.</td>
        <td class="xl66" style="text-align: center;" width="198">Informativo</td>
        </tr>
        <tr>
        <td class="xl67" height="20">Debe estar presente en la visita el candidato&nbsp;</td>
        <td style="text-align: center;"><span style="font-size: small;">Si✔&nbsp; No_</span></td>
        </tr>
        <tr>
        <td class="xl67" height="20">Registro fotogr&aacute;fico</td>
        <td style="text-align: center;"><span style="font-size: small;">Si✔&nbsp; No_</span></td>
        </tr>
        <tr>
        <td class="xl65" height="40">4 fotos (fachada, nomenclatura, espacio social y candidato).&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td class="xl66" style="text-align: center;">&nbsp;</td>
        </tr>
        <tr>
        <td class="xl65" height="40">Otro, &iquest;Cu&aacute;l?: __________________</td>
        <td class="xl66" style="text-align: center;">&nbsp;</td>
        </tr>
        <tr>
        <td class="xl65" height="20">Si se identifica que el candidato no reside en la vivienda</td>
        <td class="xl68" style="background-color: #ffc7ce; width: 202px; text-align: center;"><span style="font-size: x-small; color: #9c0006;">CH</span></td>
        </tr>
        <tr>
        <td class="xl65" height="20">Referencia de vecindario</td>
        <td style="text-align: center;"><span style="font-size: small;">Si✔&nbsp; No_</span></td>
        </tr>
        <tr>
        <td class="xl65" height="20">No lo recomiendan</td>
        <td class="xl69" style="background-color: #ffeb9c; width: 198px; text-align: center;"><span style="font-size: x-small; color: #9c5700;">CHM</span></td>
        </tr>
        <tr>
        <td class="xl65" height="20">No brinda el documento (dejar descrito el motivo por el que no lo entrega)</td>
        <td class="xl69" style="background-color: #c6efce; width: 198px; text-align: center;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        </tr>
        <tr>
        <td class="xl65" height="20">Niveles de peligrosidad en la vivienda altos&nbsp;</td>
        <td class="xl69" style="background-color: #ffeb9c; width: 198px; text-align: center;"><span style="font-size: x-small; color: #9c5700;">CHM</span></td>
        </tr>
        <tr>
        <td class="xl65" height="20">Situaci&oacute;n de hacinamiento&nbsp;</td>
        <td class="xl69" style="background-color: #ffeb9c; width: 198px; text-align: center;"><span style="font-size: x-small; color: #9c5700;">CHM</span></td>
        </tr>
        <tr>
        <td class="xl65" height="40"><strong><span class="font6">Estudio socioecon&oacute;mico</span></strong><span class="font5"><strong>:</strong> An&aacute;lisis de d&eacute;ficit en ingresos Vs Egresos&nbsp;</span></td>
        <td class="xl69" style="background-color: #ffeb9c; width: 198px; text-align: center;"><span style="font-size: x-small; color: #9c5700;">CHM</span></td>
        </tr>
        <tr>
        <td class="xl65" height="20">Pol&iacute;tica familiaridad</td>
        <td style="text-align: center;"><span style="font-size: small;">Si✔&nbsp; No_</span></td>
        </tr>
        <tr>
        <td class="xl65" height="20">Si tiene familiares de 1 l&iacute;nea de consanguinidad laborando en la empresa</td>
        <td class="xl69" style="background-color: #ffeb9c; width: 198px; text-align: center;"><span style="font-size: x-small; color: #9c5700;">CHM</span></td>
        </tr>
        <tr>
        <td class="xl65" height="40"><span class="font6">Consumo de Drogas</span></td>
        <td class="xl69" style="background-color: #ffeb9c; width: 198px; text-align: center;"><span style="font-size: x-small; color: #9c5700;">CHM</span></td>
        </tr>
        <tr>
        <td class="xl65" rowspan="18" height="470"><strong><span class="font6">Rutina/Actualizaci&oacute;n </span></strong><span class="font5">: Autorizaciones especial para esta tipo de componente, Carta de presentaci&oacute;n, condiciones de bioseguridad. Muestra grafol&oacute;gica, Estudio de seguridad anterior (Sintecto y/o Proveedor anterior)</span></td>
        <td class="xl70">Tiempo estimado 45 min. Desarrollo del cuestionario en el sitio social que defina el evaluado.<br /><br /><br /> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td class="xl66" style="text-align: center;">Informativo</td>
        </tr>
        <tr>
        <td class="xl67" height="70">Reconocimiento espacial del inmueble buscando vinculo con el evaluado. Se diligencian y firman los formatos de autorizaci&oacute;n y se entregan los documentos solicitados.</td>
        <td class="xl66" style="text-align: center;">Informativo</td>
        </tr>
        <tr>
        <td class="xl67" height="20">Debe estar presente en la visita el candidato&nbsp;</td>
        <td style="text-align: center;"><span style="font-size: small;">Si✔&nbsp; No_</span></td>
        </tr>
        <tr>
        <td class="xl67" height="20">Registro fotogr&aacute;fico</td>
        <td style="text-align: center;"><span style="font-size: small;">Si✔&nbsp; No_</span></td>
        </tr>
        <tr>
        <td class="xl65" height="40">4 fotos (fachada, nomenclatura, espacio social y candidato).&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td class="xl66" style="text-align: center;">&nbsp;</td>
        </tr>
        <tr>
        <td class="xl65" height="40">Otro, &iquest;Cu&aacute;l?: __________________</td>
        <td class="xl66" style="text-align: center;">&nbsp;</td>
        </tr>
        <tr>
        <td class="xl65" height="20">Si se identifica que el candidato no reside en la vivienda</td>
        <td class="xl68" style="background-color: #ffc7ce; width: 202px; text-align: center;"><span style="font-size: x-small; color: #9c0006;">CH</span></td>
        </tr>
        <tr>
        <td class="xl65" height="20">Referencia de Vecindario&nbsp;</td>
        <td style="text-align: center;"><span style="font-size: small;">Si✔&nbsp; No_</span></td>
        </tr>
        <tr>
        <td class="xl65" style="text-align: left;" height="20">No lo recomiendan&nbsp;</td>
        <td class="xl69" style="background-color: #ffeb9c; width: 198px; text-align: center;"><span style="font-size: x-small; color: #9c5700;">CHM</span></td>
        </tr>
        <tr>
        <td class="xl65" height="20">No brinda el documento (dejar descrito el motivo por el que no lo entrega)</td>
        <td class="xl69" style="background-color: #c6efce; width: 198px; text-align: center;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        </tr>
        <tr>
        <td class="xl65" height="20">Niveles de peligrosidad en la vivienda altos&nbsp;</td>
        <td class="xl69" style="background-color: #ffeb9c; width: 198px; text-align: center;"><span style="font-size: x-small; color: #9c5700;">CHM</span></td>
        </tr>
        <tr>
        <td class="xl65" height="20">Situaci&oacute;n de hacinamiento&nbsp;</td>
        <td class="xl69" style="background-color: #ffeb9c; width: 198px; text-align: center;"><span style="font-size: x-small; color: #9c5700;">CHM</span></td>
        </tr>
        <tr>
        <td class="xl65" height="40"><strong><span class="font6">Estudio socioecon&oacute;mico:</span></strong> An&aacute;lisis de d&eacute;ficit en ingresos Vs Egresos&nbsp;</td>
        <td class="xl69" style="background-color: #ffeb9c; width: 198px; text-align: center;"><span style="font-size: x-small; color: #9c5700;">CHM</span></td>
        </tr>
        <tr>
        <td class="xl65" height="20">Pol&iacute;tica familiaridad</td>
        <td style="text-align: center;"><span style="font-size: small;">Si✔&nbsp; No_</span></td>
        </tr>
        <tr>
        <td class="xl65" height="20">Si tiene familiares de 1 l&iacute;nea de consanguinidad laborando en la empresa</td>
        <td class="xl69" style="background-color: #ffeb9c; width: 198px; text-align: center;"><span style="font-size: x-small; color: #9c5700;">CHM</span></td>
        </tr>
        <tr>
        <td class="xl65" height="44"><strong><span class="font6">Preguntas especiales rutina</span></strong><span class="font5">, si refiere algo que pueda impactar la compa&ntilde;&iacute;a&nbsp;</span></td>
        <td class="xl69" style="background-color: #ffeb9c; width: 198px; text-align: center;"><span style="font-size: x-small; color: #9c5700;">CHM</span></td>
        </tr>
        <tr>
        <td class="xl65" height="44"><strong><span class="font6">Comparativo </span></strong><span class="font5">&nbsp;informe anterior, si genero un aumento alto en bienes inmuebles&nbsp;</span></td>
        <td class="xl69" style="background-color: #ffc7ce; width: 196px; text-align: center;"><span style="font-size: x-small; color: #9c0006;">CH</span></td>
        </tr>
        <tr>
        <td class="xl65" height="44"><span class="font6">Consumo de Drogas</span></td>
        <td class="xl69" style="background-color: #ffeb9c; width: 198px; text-align: center;"><span style="font-size: x-small; color: #9c5700;"><span>CHM</span></span></td>
        </tr>
        </tbody>
        </table>
        <table style="width: 1100px;" border="1" cellspacing="0" cellpadding="0" align="center"><colgroup><col width="530" /><col width="202" /><col width="544" /><col width="198" /></colgroup>
        <tbody>
        <tr>
        <td class="xl75" style="background-color: #002060; width: 645px; height: 25px; text-align: left;"><strong><span style="color: #ffffff; font-size: small;">FINANCIERO</span></strong></td>
        <td class="xl76" style="text-align: center; background-color: #002060; width: 240px;"><strong><span style="color: #ffffff; font-size: small;">DOCUMENTACI&Oacute;N</span></strong></td>
        <td class="xl82" style="text-align: left; background-color: #002060; width: 800px;">&nbsp;</td>
        <td class="xl76" style="text-align: center; background-color: #002060; width: 250px;"><strong><span style="color: #ffffff; font-size: small;">Concepto</span></strong></td>
        </tr>
        <tr>
        <td class="xl71" rowspan="2" height="40"><strong><span class="font6">An&aacute;lisis Financiero (central de riesgo) </span></strong>Si✔&nbsp; No_</td>
        <td class="xl66" style="text-align: center;" rowspan="2">Autorizaci&oacute;n tratamiento datos</td>
        <td class="xl77">Si no registra mora en sus obligaciones</td>
        <td class="xl69" style="background-color: #c6efce; width: 198px; text-align: center;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        </tr>
        <tr>
        <td class="xl77">Si registra mora desde un SMLV</td>
        <td class="xl69" style="background-color: #ffeb9c; width: 198px; text-align: center;"><span style="font-size: x-small; color: #9c5700;"><span>CHM</span></span></td>
        </tr>
        <tr>
        <td class="xl71" height="40"><strong><span class="font6">Formato Financiero </span></strong>Si_&nbsp; No✔</td>
        <td class="xl66" style="text-align: center;">Formato enviado por el candidato</td>
        <td class="xl77">Validar que est&eacute; completo</td>
        <td style="text-align: center;"><span style="font-size: small;">Informativo</span></td>
        </tr>
        <tr>
        <td class="xl71" height="40"><strong><span class="font6">Consulta de Instrucmentos P&uacute;blicos </span></strong>Si_&nbsp; No✔</td>
        <td class="xl66" style="text-align: center;">Consulta Superintendencia de Notariado &amp; Registro</td>
        <td class="xl77">Variaciones en el Patrimonio (consulta vs. lo que proporciona el evaluado en la visita)</td>
        <td class="xl69" style="background-color: #c6efce; width: 198px; text-align: center;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        </tr>
        <tr>
        <td class="xl71" rowspan="2" colspan="2" height="40">&nbsp;</td>
        <td class="xl77">Variaciones en el Patrimonio por en un bien o propiedad</td>
        <td class="xl69" style="background-color: #ffeb9c; width: 198px; text-align: center;"><span style="font-size: x-small; color: #9c5700;"><span>CHM</span></span></td>
        </tr>
        <tr>
        <td class="xl77">Variaciones en el Patrimonio por dos o m&aacute;s bienes o propiedades</td>
        <td class="xl69" style="background-color: #ffc7ce; width: 196px; text-align: center;"><span style="font-size: x-small; color: #9c0006;">CH</span></td>
        </tr>
        </tbody>
        </table>
        <table style="width: 1100px;" border="1" cellspacing="0" cellpadding="0" align="center"><colgroup><col width="530" /><col width="202" /><col width="544" /><col width="198" /></colgroup>
        <tbody>
        <tr>
        <td class="xl75" style="background-color: #002060; width: 645px; height: 25px; text-align: left;"><strong><span style="color: #ffffff; font-size: small;">PRUEBAS</span></strong></td>
        <td class="xl76" style="text-align: center; background-color: #002060; width: 240px;">&nbsp;</td>
        <td class="xl82" style="text-align: left; background-color: #002060; width: 800px;">&nbsp;</td>
        <td class="xl76" style="text-align: center; background-color: #002060; width: 250px;"><strong><span style="color: #ffffff; font-size: small;">Concepto</span></strong></td>
        </tr>
        <tr>
        <td class="xl71" rowspan="3" height="40">Pruebas Psicot&eacute;cnicas (Kompedisc, Proa K, Eros K)</td>
        <td class="xl66" style="text-align: center;">Datos de candidato</td>
        <td class="xl77">Porcentaje General de 0% a 40%</td>
        <td class="xl69" style="background-color: #ffc7ce; width: 196px; text-align: center;"><span style="font-size: x-small; color: #9c0006;">CH</span></td>
        </tr>
        <tr>
        <td class="xl66" style="text-align: center;">Datos de candidato</td>
        <td class="xl77">Porcentaje General de 41% a 69%</td>
        <td class="xl69" style="background-color: #ffeb9c; width: 198px; text-align: center;"><span style="font-size: x-small; color: #9c5700;"><span>CHM</span></span></td>
        </tr>
        <tr>
        <td class="xl66" style="text-align: center;">Datos de candidato</td>
        <td class="xl77">Porcentaje General de 70% a 100%</td>
        <td class="xl69" style="background-color: #c6efce; width: 198px; text-align: center;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        </tr>
        <tr>
        <td class="xl71" rowspan="3" height="40">Pruebas Valores o Integridad (Antes Plus-Pro)</td>
        <td class="xl66" style="text-align: center;">Datos de candidato</td>
        <td class="xl77">Porcentaje General de 0% a 30%</td>
        <td class="xl69" style="background-color: #ffc7ce; width: 196px; text-align: center;"><span style="font-size: x-small; color: #9c0006;">CH</span></td>
        </tr>
        <tr>
        <td class="xl66" style="text-align: center;">Datos de candidato</td>
        <td class="xl77">Porcentaje General de 31% a 60%</td>
        <td class="xl69" style="background-color: #ffeb9c; width: 198px; text-align: center;"><span style="font-size: x-small; color: #9c5700;"><span>CHM</span></span></td>
        </tr>
        <tr>
        <td class="xl66" style="text-align: center;">Datos de candidato</td>
        <td class="xl77">Porcentaje General de 61% a 100%</td>
        <td class="xl69" style="background-color: #c6efce; width: 198px; text-align: center;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        </tr>
        </tbody>
        </table>
        <table style="width: 1100px;" border="1" cellspacing="0" cellpadding="0" align="center"><colgroup><col width="530" /><col width="202" /><col width="544" /><col width="198" /></colgroup>
        <tbody>
        <tr>
        <td class="xl75" style="background-color: #002060; width: 645px; height: 25px; text-align: left;"><strong><span style="color: #ffffff; font-size: small;">Poligraf&iacute;a pre empleo </span></strong></td>
        <td class="xl76" style="text-align: center; background-color: #002060; width: 240px;"><strong><span style="color: #ffffff; font-size: small;">Concepto</span></strong></td>
        <td class="xl82" style="text-align: left; background-color: #002060; width: 800px;"><span style="font-size: small;"><strong><span style="color: #ffffff;">Poligraf&iacute;a Rutina/Especifica</span></strong></span></td>
        <td class="xl76" style="text-align: center; background-color: #002060; width: 250px;"><strong><span style="color: #ffffff; font-size: small;">Concepto</span></strong></td>
        </tr>
        <tr>
        <td class="xl71" height="20">&nbsp;</td>
        <td class="xl66" style="text-align: center;">&nbsp;</td>
        <td class="xl77">&nbsp;</td>
        <td class="xl69">&nbsp;</td>
        </tr>
        <tr>
        <td class="xl71"><strong><span>Resultado cuantitativo</span></strong></td>
        <td class="xl66" style="text-align: center;">&nbsp;</td>
        <td class="xl71" height="40"><strong><span>Resultado cuantitativo</span></strong></td>
        <td class="xl69">&nbsp;</td>
        </tr>
        <tr>
        <td class="xl72" width="530" height="32">Reacci&oacute;n significativa</td>
        <td class="xl69" style="background-color: #ffc7ce; width: 196px; text-align: center;"><span style="font-size: x-small; color: #9c0006;">CH</span></td>
        <td class="xl78" width="544">Reacci&oacute;n significativa</td>
        <td class="xl69" style="background-color: #ffc7ce; width: 196px; text-align: center;"><span style="font-size: x-small; color: #9c0006;">CH</span></td>
        </tr>
        <tr>
        <td class="xl72" width="530" height="32">NO Reacci&oacute;n significativa</td>
        <td class="xl69" style="background-color: #c6efce; width: 198px; text-align: center;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        <td class="xl78" width="544">NO Reacci&oacute;n significativa</td>
        <td class="xl69" style="background-color: #c6efce; width: 198px; text-align: center;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        </tr>
        <tr>
        <td class="xl71" height="20">&nbsp;</td>
        <td class="xl66" style="text-align: center;">&nbsp;</td>
        <td class="xl77">&nbsp;</td>
        <td class="xl69">&nbsp;</td>
        </tr>
        <tr>
        <td class="xl71"><strong><span>Resultado cualitativo</span></strong></td>
        <td class="xl66" style="text-align: center;">&nbsp;</td>
        <td class="xl71" height="40"><strong><span>Resultado cualitativo</span></strong></td>
        <td class="xl69">&nbsp;</td>
        </tr>
        <tr>
        <td class="xl71" height="20">&nbsp;</td>
        <td class="xl66" style="text-align: center;">&nbsp;</td>
        <td class="xl77">&nbsp;</td>
        <td class="xl69">&nbsp;</td>
        </tr>
        <tr>
        <td class="xl72" width="530" height="32">Admisi&oacute;n de consumo drogas</td>
        <td class="xl69" style="background-color: #ffeb9c; width: 198px; text-align: center;"><span style="font-size: x-small; color: #9c5700;"><span>CHM</span></span></td>
        <td class="xl78" width="544">Admisi&oacute;n de consumo drogas</td>
        <td class="xl69" style="background-color: #ffeb9c; width: 198px; text-align: center;"><span style="font-size: x-small; color: #9c5700;"><span>CHM</span></span></td>
        </tr>
        <tr>
        <td class="xl72" width="530" height="32">Admisi&oacute;n de consumo alcohol con alta frecuencia (m&aacute;s de dos veces a la semana) y no social</td>
        <td class="xl69" style="background-color: #ffeb9c; width: 198px; text-align: center;"><span style="font-size: x-small; color: #9c5700;"><span>CHM</span></span></td>
        <td class="xl78" width="544">Admisiones de antecedentes</td>
        <td class="xl69" style="background-color: #ffc7ce; width: 196px; text-align: center;"><span style="font-size: x-small; color: #9c0006;">CH</span></td>
        </tr>
        <tr>
        <td class="xl72" width="530" height="32">Admisi&oacute;n de hurto</td>
        <td class="xl69" style="background-color: #ffc7ce; width: 196px; text-align: center;"><span style="font-size: x-small; color: #9c0006;">CH</span></td>
        <td class="xl78" width="544">Admisi&oacute;n de v&iacute;nculos propios con grupos al margen</td>
        <td class="xl69" style="background-color: #ffc7ce; width: 196px; text-align: center;"><span style="font-size: x-small; color: #9c0006;">CH</span></td>
        </tr>
        <tr>
        <td class="xl72" width="530" height="32">Admisiones de antecedentes</td>
        <td class="xl69" style="background-color: #ffc7ce; width: 196px; text-align: center;"><span style="font-size: x-small; color: #9c0006;">CH</span></td>
        <td class="xl78" width="544">Preguntas de conducta laboral que sean negativas</td>
        <td class="xl69" style="background-color: #ffeb9c; width: 198px; text-align: center;"><span style="font-size: x-small; color: #9c5700;"><span>CHM</span></span></td>
        </tr>
        <tr>
        <td class="xl72" width="530" height="32">Admisi&oacute;n de consumo drogas</td>
        <td class="xl69" style="background-color: #ffc7ce; width: 196px; text-align: center;"><span style="font-size: x-small; color: #9c0006;">CH</span></td>
        <td class="xl78" rowspan="3" colspan="2" width="544">&nbsp;</td>
        </tr>
        <tr>
        <td class="xl72" width="530" height="32">Admisi&oacute;n de consumo drogas</td>
        <td class="xl69" style="background-color: #ffeb9c; width: 198px; text-align: center;"><span style="font-size: x-small; color: #9c5700;"><span>CHM</span></span></td>
        </tr>
        <tr>
        <td class="xl72" width="530" height="32">Admisi&oacute;n de consumo drogas</td>
        <td class="xl69" style="background-color: #ffc7ce; width: 196px; text-align: center;"><span style="font-size: x-small; color: #9c0006;">CH</span></td>
        </tr>
        </tbody>
        </table>
        <table style="width: 1100px;" border="1" cellspacing="0" cellpadding="0" align="center"><colgroup><col width="530" /><col width="202" /><col width="544" /><col width="198" /></colgroup>
        <tbody>
        <tr>
        <td class="xl75" style="background-color: #002060; width: 550px; height: 25px; text-align: center;"><strong><span style="color: #ffffff; font-size: small;">Documentos Necesarios Para la Publicaci&oacute;n</span></strong></td>
        <td class="xl76" style="text-align: center; background-color: #002060; width: 240px;"><strong><span style="color: #ffffff; font-size: small;">Concepto</span></strong></td>
        </tr>
        <tr>
        <td class="xl72" width="530">C&eacute;dula Ciudadan&iacute;a, Extranjer&iacute;a, Pasaporte o ID</td>
        <td class="xl69" style="background-color: #ffeb9c; width: 198px; text-align: center;"><span style="font-size: x-small; color: #9c5700;"><span>CHM</span></span></td>
        </tr>
        <tr>
        <td class="xl72" width="530">Certificados Acad&eacute;micos</td>
        <td class="xl69" style="background-color: #c6efce; width: 198px; text-align: center;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        </tr>
        <tr>
        <td class="xl72" width="530">Tarjeta Profesional</td>
        <td class="xl69" style="background-color: #ffeb9c; width: 198px; text-align: center;"><span style="font-size: x-small; color: #9c5700;"><span>CHM</span></span></td>
        </tr>
        <tr>
        <td class="xl72" width="530">Certificados Laborales</td>
        <td class="xl69" style="background-color: #c6efce; width: 198px; text-align: center;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        </tr>
        <tr>
        <td class="xl72" width="530">Hist&oacute;rial Pensional</td>
        <td class="xl69" style="background-color: #c6efce; width: 198px; text-align: center;"><span style="font-size: x-small; color: #006100;">SH</span></td>
        </tr>
        <tr>
        <td class="xl72" width="530">Formato Financiero</td>
        <td class="xl69" style="background-color: #ffeb9c; width: 198px; text-align: center;"><span style="font-size: x-small; color: #9c5700;"><span>CHM</span></span></td>
        </tr>
        <tr>
        <td class="xl72" width="530">Autorizaciones Sintecto</td>
        <td class="xl69" style="background-color: #ffc7ce; width: 196px; text-align: center;"><span style="font-size: x-small; color: #9c0006;">CH</span></td>
        </tr>
        <tr>
        <td class="xl72" width="530">Autorizaciones Anexas del Cliente</td>
        <td class="xl69" style="background-color: #ffeb9c; width: 198px; text-align: center;"><span style="font-size: x-small; color: #9c5700;"><span>CHM</span></span></td>
        </tr>
        <tr>
        <td class="xl72" width="530">Registro Fotogr&aacute;fico</td>
        <td class="xl69" style="background-color: #ffc7ce; width: 196px; text-align: center;"><span style="font-size: x-small; color: #9c0006;">CH</span></td>
        </tr>
        <tr>
        <td class="xl72" width="530">Carta de Presentaci&oacute;n</td>
        <td class="xl69" style="background-color: #ffeb9c; width: 198px; text-align: center;"><span style="font-size: x-small; color: #9c5700;"><span>CHM</span></span></td>
        </tr>
        <tr>
        <td class="xl72" width="530">Muestra Grafol&oacute;gica</td>
        <td class="xl69" style="background-color: #ffeb9c; width: 198px; text-align: center;"><span style="font-size: x-small; color: #9c5700;"><span>CHM</span></span></td>
        </tr>
        <tr>
        <td class="xl72" width="530">Formato de Afiliaci&oacute;n EPS</td>
        <td class="xl69" style="background-color: #ffeb9c; width: 198px; text-align: center;"><span style="font-size: x-small; color: #9c5700;"><span>CHM</span></span></td>
        </tr>
        <tr>
        <td class="xl72" width="530">Formato de Afiliaci&oacute;n Pensiones</td>
        <td class="xl69" style="background-color: #ffeb9c; width: 198px; text-align: center;"><span style="font-size: x-small; color: #9c5700;"><span>CHM</span></span></td>
        </tr>
        <tr>
        <td class="xl72" width="530">Formato de Afiliaci&oacute;n Cesant&iacute;as</td>
        <td class="xl69" style="background-color: #ffeb9c; width: 198px; text-align: center;"><span style="font-size: x-small; color: #9c5700;"><span>CHM</span></span></td>
        </tr>
        <tr>
        <td class="xl72" width="530">&nbsp;</td>
        <td class="xl72" style="text-align: center;" width="530">N/A</td>
        </tr>
        <tr>
        <td class="xl72" width="530">&nbsp;</td>
        <td class="xl72" style="text-align: center;" width="530">N/A</td>
        </tr>
        <tr>
        <td class="xl72" width="530">&nbsp;</td>
        <td class="xl72" style="text-align: center;" width="530">N/A</td>
        </tr>
        </tbody>
        </table>
        <p><strong style="font-size: small;"><span style="color: #ff0000;">* Todos los documentos soporte de consultas, verificaciones y/o pruebas son OBLIGATORIOS,</span></strong></p>
        <p><strong style="font-size: small;"></strong><strong style="font-size: small;"><span style="color: #ff0000;">por tal motivo no se mencionan en la lista.</span></strong></p>';
        return $textHtmlNew;
    }

}
