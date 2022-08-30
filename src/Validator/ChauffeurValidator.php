<?php
namespace App\Validator;

final class ChauffeurValidator extends Validator {


    public function __construct(array $data)
    {
        parent::__construct($data);
        $this->validator->rule('lengthMin', 'prenom', 3);
        $this->validator->rule('lengthMin', 'nom', 3);
        $this->validator->rule('lengthMin', 'adresse', 3);
        $this->validator->rule('lengthMin', 'telephone1', 8);
        $this->validator->rule('integer', 'telephone1');
        $this->validator->rule('lengthMin', 'debut_at', 3);
    }

}