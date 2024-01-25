<?php
echo $this->renderPartial('/detailCompanyVisit/_verificationDetail', array(
    'verificationSection' => $verificationSection,
    'company' => $verificationSection->detailCompanyVisit,
));
?>
