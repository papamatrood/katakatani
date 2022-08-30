<?php
namespace App\Validator;

final class ComptabiliteValidator extends Validator {


    public function __construct(array $data)
    {
        parent::__construct($data);
        $this->validator->rule('lengthMin', 'motif', 3);
        $this->validator->rule('lengthMin', 'date_at', 3);
    }

}