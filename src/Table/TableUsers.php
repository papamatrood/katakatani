<?php
namespace App\Table;

use PDO;
use App\Table\Table;
use App\Classes\Users;

final class TableUsers extends Table {

    protected $table = 'users';

    protected $class = Users::class;



    public function findByUsername(string $username)
    {
        $prepare = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE username = :username");
        $prepare->execute(['username' => $username]);
        $prepare->setFetchMode(PDO::FETCH_CLASS, $this->class);
        $result = $prepare->fetch();
        return $result;
    }

}