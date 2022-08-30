<?php
namespace App\Validator;

use Valitron\Validator as ValitronValidator;

abstract class Validator extends ValitronValidator {

    protected $validator;

    protected $data = [];


    public function __construct(array $data)
    {
        $this->data = $data;
        ValitronValidator::lang('fr');
        $v = new ValitronValidator($data);
        $this->validator = $v;
    }

    public function validate() : bool
    {
        return $this->validator->validate();
    }

    public function errors($field = null) : array
    {
        return $this->validator->errors($field);
    }

}