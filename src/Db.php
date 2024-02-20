<?php
namespace Root\Garageauto;
use PDO;

class Db extends PDO {

    private static $instance = null;

	public function __construct(){

		try{
			$pdo = parent::__construct('sqlite:'.dirname(__FILE__).'/garageauto.db');
			// $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
			// $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // ERRMODE_WARNING | ERRMODE_EXCEPTION | ERRMODE_SILENT
		} catch(Exception $e) {
			echo "Impossible d'accéder à la base de données SQLite : ".$e->getMessage();
			die();
		}
	}

	public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new Db();
        }
        return self::$instance;
    }

    public function getAll($objet)
    {
        $space = get_class($objet);

        $table = strtolower($this->getTableName($space));

        $query = "select * from " . $table;
        $results = $this->query($query);
        return $results->fetchAll(PDO::FETCH_CLASS, $space);
        //return $results->fetchAll();
    }

    public function getById($id, $objet)
    {
        $space = get_class($objet);

        $table = strtolower($this->getTableName($space));

        $query = "select * from " . $table . " where id=$id";
        $results = $this->query($query);
        $return = $results->fetchAll(PDO::FETCH_CLASS, $space);
        if (count($return) === 0) {
            return NULL;
        }
        return $return[0];
    }

    public function getByAttribute($name, $value, $objet)
    {
        $space = get_class($objet);

        $table = strtolower($this->getTableName($space));

        $query = "select * from " . $table . " where $name='$value'";
        $results = $this->query($query);
        return $results->fetchAll(PDO::FETCH_CLASS, $space);
    }

    public function execute($query)
    {
        $results = $this->query($query);
        return $results->fetchAll(PDO::FETCH_CLASS);
    }

    public function update($objet)
    {
        $space = get_class($objet);
        $table = strtolower($this->getTableName($space));
        $attributes = $objet->get_object_vars();
        $sql = "update " . $table . " set ";
        $count = count($attributes) - 1;
        $i = 0;
        foreach ($attributes as $attribute => $value) {
            if ($attribute === 'id') {
                $i++;
                continue;
            }
            $sql .= $attribute . '="' . $value . '"';
            if ($i < $count) {
                $sql .= ',';
            }
            $i++;
        }
        $sql .= ' where id=' . $attributes['id'];

        $query = $this->query($sql);
        $query->execute();
    }

    public function deleteById($objet)
    {
        $space = get_class($objet);

        $table = strtolower($this->getTableName($space));

        $sql = 'delete from ' . $table . ' where id=' . $objet->id;
        $query = $this->query($sql);
        $query->execute();
    }


    public function save($objet)
    {
        $space = get_class($objet);

        $table = strtolower($this->getTableName($space));

        $sql = 'insert into ' . $table;
        $attributes = $objet->get_object_vars();
        $col = '(';
        $val = '(';
        $count = count($attributes) - 1;
        $i = 0;
        foreach ($attributes as $attribute => $value) {
            if ($attribute === 'id') {
                $i++;
                continue;
            }
            $col .= $attribute;
            $val .= "'" . $value . "'";
            if ($i < $count) {
                $col .= ',';
                $val .= ',';
            }
            $i++;
        }
        $sql .= " " . $col . ') values ' . $val . ')';
        if ($this->query($sql)) {
            return 'bien enregistré';
        } else {
            return 'un problème est survenu';
        }
    }

    private function getTableName($espace)
    {
        $tab = explode('\\', $espace);
        $count = count($tab) - 1;
        return $tab[$count];
    }

}

?>