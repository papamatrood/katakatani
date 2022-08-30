<?php
namespace App\Validator;

final class UsersValidator extends Validator {


    public function __construct(array $data)
    {
        parent::__construct($data);
        $this->validator->rule('lengthMin', 'username', 5);
        $this->validator->rule('lengthMin', 'password', 5);
    }

}