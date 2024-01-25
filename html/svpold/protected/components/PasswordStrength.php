<?php

class PasswordStrength extends CValidator {

  public $strength;
  public $allowEmpty=false;
  private $weak_pattern = '/^(?=.*[a-zA-Z0-9]).{5,}$/';
  private $strong_pattern = '/^(?=.*\d(?=.*\d))(?=.*[a-zA-Z](?=.*[a-zA-Z])).{8,}$/';

  /**
   * Validates the attribute of the object.
   * If there is any error, the error message is added to the object.
   * @param CModel $object the object being validated
   * @param string $attribute the attribute being validated
   */
  protected function validateAttribute($object, $attribute) {
    // check the strength parameter used in the validation rule of our model
    if ($this->strength == 'weak')
      $pattern = $this->weak_pattern;
    elseif ($this->strength == 'strong')
      $pattern = $this->strong_pattern;

    // extract the attribute value from it's model object
    $value = $object->$attribute;
    if (!($this->allowEmpty && strlen($value)==0) && !preg_match($pattern, $value)) {
      $this->addError($object, $attribute, 'La palabra clave es muy débil, por favor utilice una combinación de números, letras mayusculas y minúsculas de más de 8 caracters ');
    }
  }

  /**
   * Returns the JavaScript needed for performing client-side validation.
   * @param CModel $object the data object being validated
   * @param string $attribute the name of the attribute to be validated.
   * @return string the client-side validation script.
   * @see CActiveForm::enableClientValidation
   */
  public function clientValidateAttribute($object, $attribute) {

    // check the strength parameter used in the validation rule of our model
    if ($this->strength == 'weak')
      $pattern = $this->weak_pattern;
    elseif ($this->strength == 'strong')
      $pattern = $this->strong_pattern;

    $condition = "!value.match({$pattern})";

    return "
if(" . $condition . ") {
    messages.push(" . CJSON::encode('La palabra clave está muy insegural!') . ");
}
";
  }

}
