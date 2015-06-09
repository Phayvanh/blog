<?php

class Infrastructure_Database
{
    /*************************************Propriétés*****************************************/
    private $pdo;

    /***********************************Constructor****************************************/
    public function __construct()
    {
        $this->pdo = new PDO(DATABASE_DSN,DATABASE_USER,DATABASE_PASSWORD);
        $this->pdo->exec('SET NAMEs UTF8');
    }

    /***********************************Methods*********************************************/
    public function executeSql($sql,array $values)
    {
        $query = $this->pdo->prepare($sql);
        $query->execute($values);

        return $this->pdo->lastInsertId();
    }

    public function query($sql,array $values = array())
    {
        $query = $this->pdo->prepare($sql);
        $query->execute($values);

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function queryOne($sql,array $values = array())
    {
        $query = $this->pdo->prepare($sql);
        $query->execute($values);

        return $query->fetch(PDO::FETCH_ASSOC);
    }
}

/*

$query->execute($values);// 2 règles à respecter : autant de valeurs dans le tableau que de ? et dans le même ordre que dans le SQL

$orders = $query->fetchAll(PDO::FETCH_ASSOC);*/