<?php
namespace App\Table;

use App\Classes\Katakatani;

final class TableKatakatani extends Table {

    protected $table = 'Katakatani';

    protected $class = Katakatani::class;



    public function allIds() : array
    {
        /**
         * @var Katakatani[]
         */
        $result = $this->all();
        $ids = [];
        foreach ($result as $value) {
            $ids[$value->getId()] = $value->getId();
        }
        return $ids;
    }

}