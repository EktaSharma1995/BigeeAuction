<?php

class BidDao implements Dao
{
    private $queryGetAll = "SELECT * FROM Bid";
    private $queryGet = "SELECT * FROM Bid WHERE BidID = :id";
    private $commandAdd = "INSERT INTO Bid (BidID, UserID, Date, Value) VALUES (:id, :userId, :date, :value)";
    private $commandUpdate = "UPDATE Bid SET UserID = :userId, Date = :date, Value = :value WHERE BidID = :id";
    private $commandDelete = "DELETE FROM Bid WHERE BidID = :id";

    private $dbc;

    public function __construct($dbc)
    {
        $this->dbc = $dbc;
    }

    private function bind($pdostmt, $entity)
    {
        $id = $entity->getId();
        $pdostmt->bindParam(':id', $id);

        $userId = $entity->getUserId();
        $pdostmt->bindParam(':userId', $userId);

        $date = $entity->getDate();
        $pdostmt->bindParam(':date', $date);

        $value =  $entity->getValue();
        $pdostmt->bindParam(':value', $value);
    }

    private function getEntity($object)
    {
        $entity = new Bid();

        $entity->setId($object->BidID);
        $entity->setUserId($object->UserID);
        $entity->setDate($object->Date);
        $entity->setValue($object->Value);

        return $entity;
    }

    private function getEntities($list)
    {
        $result = array();

        foreach($list as $object)
        {
            array_push($result, $this->getEntity($object));
        }

        return $result;
    }

    public function getAll()
    {
        $pdostmt = $this->dbc->query($this->queryGetAll);
        $pdostmt->setFetchMode(PDO::FETCH_OBJ);

        $result = $pdostmt->fetchAll();

        //var_dump($result);

        return $this->getEntities($result);
    }

    public function get($id)
    {
        $pdostmt = $this->dbc->prepare($this->queryGet);
        $pdostmt->setFetchMode(PDO::FETCH_OBJ);

        $pdostmt->bindParam(':id', $id);

        $pdostmt->execute();

        $result = $pdostmt->fetchAll();

        if(count($result) == 1)
            return $this->getEntity($result[0]);
        else if(count($result) == 0)
            return null;
        else
            throw new Exception("Non unique query result");
    }

    public function add($entity)
    {
        $pdostmt = $this->dbc->prepare($this->commandAdd);
        $pdostmt->setFetchMode(PDO::FETCH_OBJ);

        $this->bind($pdostmt, $entity);
        
        return $pdostmt->execute();
    }

    public function update($entity)
    {
        $pdostmt = $this->dbc->prepare($this->commandUpdate);
        $pdostmt->setFetchMode(PDO::FETCH_OBJ);

        $this->bind($pdostmt, $entity);
        
        return $pdostmt->execute();
    }

    public function delete($id)
    {
        $pdostmt = $this->dbc->prepare($this->commandDelete);
        $pdostmt->setFetchMode(PDO::FETCH_OBJ);

        $pdostmt->bindParam(':id', $id);

        return $pdostmt->execute();
    }
}