<div class='QTGroup'>
    <?php if ($questions): ?>
        <?php foreach ($questions as $question): ?>
            <?php
            @$answer = $answers[(string) $question['id']];
            switch ($question['type']) {
                case (XmlQuestion::QT_TEXT):
                    echo $this->renderPartial('/xmlQuestion/_QTText', array('varName' => $varName, 'question' => $question, 'answer' => $answer));
                    break;
                case (XmlQuestion::QT_TEXT_AREA):
                    echo $this->renderPartial('/xmlQuestion/_QTTextArea', array('varName' => $varName, 'question' => $question, 'answer' => $answer));
                    break;
                case (XmlQuestion::QT_RADIO):
                    echo $this->renderPartial('/xmlQuestion/_QTRadio', array('varName' => $varName, 'question' => $question, 'answer' => $answer));
                    break;
                case (XmlQuestion::QT_GROUP):
                    echo $this->renderPartial('/xmlQuestion/_QTGroup', array('varName' => $varName, 'questions' => $question, 'answers' => $answers));
                    break;
                case (XmlQuestion::QT_SELECT):
                    echo $this->renderPartial('/xmlQuestion/_QTSelect', array('varName' => $varName, 'question' => $question, 'answer' => $answer));
                    break;
                default:
                    echo "Error :" . $question['type'];
            }
            ?>
        <?php endforeach; ?>
    <?php endif; ?>
