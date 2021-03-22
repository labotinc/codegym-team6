<?php
namespace App\Model\Validation;
use Cake\Validation\Validation;

class CustomValidation extends Validation {

    public static function alphaNumericWithJapaneseCheck($value) {
        return (bool) preg_match('/^[a-zA-Z0-9]+$/', $value);
    }

    public static function cardNameCheck($value) {
        return (bool) preg_match('/^[a-zA-Z0-9\s]+$]*$/', $value);
    }
}
