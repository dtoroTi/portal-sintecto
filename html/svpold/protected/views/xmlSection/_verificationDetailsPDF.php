<?php

$pdf->commands($verificationSection->verificationSectionType->questionsPDFXml,
        $verificationSection->xmlSection->answerArray,
        $verificationSection);
