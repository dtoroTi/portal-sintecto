<?php
    echo $this->renderPartial('/detailCompanyFinantialAnalys/_verificationDetail', array(
        'verificationSection' => $verificationSection,
        'company' => $verificationSection->detailCompanyFinantialAnalys,
    ));
?>