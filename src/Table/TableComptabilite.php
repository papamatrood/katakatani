<?php
namespace App\Table;

use App\Classes\Comptabilite;

final class TableComptabilite extends Table {

    protected $table = 'Comptabilite';

    protected $class = Comptabilite::class;


    public function filtre() 
    {
        
    }

}