<?php

namespace App\Model;

/**
 *  class AccessoryManager.
 */
class AccessoryManager extends AbstractManager
{
    public const TABLE = 'accessory';

    /**
     * methode permettant d'ajouter un accessoire dans la base de données.
    */

    public function insert(array $accessory)
    {
        $query = 'INSERT INTO ' . self::TABLE . ' (idname, url) VALUES (:name, :url)';
        $statement = $this->pdo->prepare($query);
        $statement->bindValue('name', $accessory['name'], \PDO::PARAM_STR);
        $statement->bindValue('url', $accessory['url'], \PDO::PARAM_STR);
        $statement->execute();
    }
}
