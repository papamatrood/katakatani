<?php
namespace App\Table;

use App\Classes\Chauffeur;

final class TableChauffeur extends Table {

    protected $table = 'Chauffeur';

    protected $class = Chauffeur::class;



    public function allKatakataniIdName() : array
    {
        /**
         * @var Chauffeur[]
         */
        $all = $this->all();
        $result = [];
        foreach ($all as $value) {
            $result[$value->getKatakataniId()] = $value->getPrenom() . ' (#' . $value->getKatakataniId() . ')';
        }
        return $result;
    }

}