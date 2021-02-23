<?php
namespace App\Model\Validation;
use Cake\Validation\Validation;

class CustomValidation extends Validation {

    public static function alphaNumericWithJapaneseCheck($value) {
        return (bool) preg_match('/^\S+@\S+\.\S+$/', $value);
    }

}
