<?php

namespace App\Model;

/**
 *  class AccessoryManager.
 */
class CupcakeManager extends AbstractManager
{
    public const TABLE = 'cupcake';
    public const TABLE_ACCESSORY = 'accessory';

    /**
     * methode permettant d'ajouter un accessoire dans la base de données.
        */
    public function insert(array $cupcake)
    {


            $statement = $this->pdo->prepare(
                "INSERT INTO " . self::TABLE .
                    " (`name`, `color1`, `color2`, `color3`, `accessory_id`, `created_at`) VALUES" .
                    " (:name, :color1, :color2, :color3, :accessory_id, NOW())"
            );
            $statement->bindValue('name', $cupcake['name'], \PDO::PARAM_STR);
            $statement->bindValue('color1', $cupcake['color1'], \PDO::PARAM_STR);
            $statement->bindValue('color2', $cupcake['color2'], \PDO::PARAM_STR);
            $statement->bindValue('color3', $cupcake['color3'], \PDO::PARAM_STR);
            $statement->bindValue('accessory_id', $cupcake['accessory_id'], \PDO::PARAM_INT);

        if ($statement->execute()) {
            return (int)$this->pdo->lastInsertId();
        }
    }

    /**
     * methode permettant d'afficher  les cupckae dans la base de données.
    */
    public function selectAllCupcake()
    {
        $statement = $this->pdo->query("SELECT * FROM " . self::TABLE . " ORDER BY id DESC");
        $statement->setFetchMode(\PDO::FETCH_CLASS, self::class);
        $cupcakes = $statement->fetchAll();
        return $cupcakes;
    }
   /**
     * methode permettant d'afficher 1 element by id.
    */
    public function selectOneByIdWithAccessory(int $id): array
    {
        $statement = $this->pdo->prepare(
            'SELECT cupcake.id, cupcake.name, color1, color2, color3, url FROM ' .
                self::TABLE .
                ' JOIN accessory ON accessory.category_id=cupcake.accessory_id' .
                ' WHERE cupcake.id=:id'
        );
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch();
    }
}
