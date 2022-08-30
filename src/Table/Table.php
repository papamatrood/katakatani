<?php
namespace App\Table;

use App\Connection;
use Exception;
use PDO;

abstract class Table {

    protected $table = null;

    protected $class = null;

    protected $pdo;


    public function __construct()
    {
        if (is_null($this->table)) {
            throw new Exception("La l'attribut 'table' dans la classe (" . get_class($this) . ") est null");
        }
        if (is_null($this->class)) {
            throw new Exception("La l'attribut 'class' dans la classe (" . get_class($this) . ") est null");
        }

        $this->pdo = Connection::getPDO();
    }

    public function all() : array
    {
        $query = $this->pdo->query("SELECT * FROM {$this->table}");
        $result = $query->fetchAll(PDO::FETCH_CLASS, $this->class);
        if($result === false) throw new Exception('Aucun résultat n\'a été trouvé');
        return $result;
    }

    public function find(int $id)
    {
        $prepare = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE id = :id");
        $prepare->execute(['id' => $id]);
        $prepare->setFetchMode(PDO::FETCH_CLASS, $this->class);
        $result = $prepare->fetch();
        if($result === false) throw new Exception('Aucun résultat n\'a été trouvé');
        return $result;
    }

    public function create(array $data) : int
    {
        $attributs = [];
        $donnees   = [];
        foreach ($data as $key => $value) {
            $attributs[] = "$key = :$key";
            if( strpos($key, 'prix') !== false) {
                $donnees[$key] = (int) str_replace(' ', '', $value);
            }else{
                $donnees[$key] = $value ?: null;
            }
        }
        
        $atts = implode(', ', $attributs);
        $prepare = $this->pdo->prepare("INSERT INTO {$this->table} SET {$atts}");
        $result = $prepare->execute($donnees);
        if($result === false) throw new Exception("L'enregistrement n'a pas pu être effectué !");
        return $this->pdo->lastInsertId();
    }

    public function update(array $data, int $id) : int
    {
        $attributs = [];
        $donnees   = [];
        foreach ($data as $key => $value) {
            $attributs[] = "$key = :$key";
            if( strpos($key, 'prix') !== false) {
                $donnees[$key] = (int) str_replace(' ', '', $value);
            }else{
                $donnees[$key] = $value ?: null;
            }
        }
        
        $atts = implode(', ', $attributs);
        $prepare = $this->pdo->prepare("UPDATE {$this->table} SET {$atts} WHERE id = :id");
        $result = $prepare->execute(array_merge($donnees, ['id' => $id]));
        if($result === false) throw new Exception("La modification n'a pas pu être effectuée !");
        return $id;
    }

    public function delete(int $id) : void
    {
        $prepare = $this->pdo->prepare("DELETE FROM {$this->table} WHERE id = ?");
        $result = $prepare->execute([$id]);
        if($result === false) throw new Exception("La suppression n'a pas pu être effectuée !");
    }

}