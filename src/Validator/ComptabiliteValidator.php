<?php
namespace App\Validator;

final class ComptabiliteValidator extends Validator {


    public function __construct(array $data)
    {
        parent::__construct($data);
        $this->validator->rule('subset', 'motif', array_keys(MOTIFS));
        $this->validator->rule('lengthMin', 'date_at', 3);
    }

}