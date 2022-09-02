<?php
namespace App\Table;

use App\Classes\Katakatani;

final class TableKatakatani extends Table {

    protected $table = 'Katakatani';

    protected $class = Katakatani::class;



    public function allIdsNumeros() : array
    {
        /**
         * @var Katakatani[]
         */
        $result = $this->all();
        $ids = [];
        foreach ($result as $value) {
            $ids[$value->getId()] = $value->getNumero();
        }
        return $ids;
    }

}