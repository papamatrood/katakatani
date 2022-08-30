<?php
namespace App\Validator;

final class KatakataniValidator extends Validator {


    public function __construct(array $data)
    {
        parent::__construct($data);
        $this->validator->rule('lengthMin', 'prix_achat', 5);
        $this->validator->rule('lengthMin', 'matricule', 5);
    }

}