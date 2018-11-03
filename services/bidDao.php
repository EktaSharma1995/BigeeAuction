<?php

class BidDao implements Dao
{
    private $queryGetAll = "SELECT * FROM bid";
    private $queryGet = "SELECT * FROM bid WHERE BidID = :id";
    private $commandAdd = "INSERT INTO bid (UserID, AuctionID, Date, Value) VALUES (:userId, :auctionId, :date, :value)";
    private $commandUpdate = "UPDATE bid SET UserID = :userId, AuctionID = :auctionId, Date = :date, Value = :value WHERE BidID = :id";
    private $commandDelete = "DELETE FROM bid WHERE BidID = :id";

    private $queryGetAllForGrid = "
        SELECT b.*, a.Title as AuctionTitle, u.Name as UserName 
        FROM bid b 
            INNER JOIN auction a ON b.AuctionID = a.AuctionID 
            INNER JOIN user u on b.UserID = u.UserID
    ";

    private $dbc;

    public function __construct($dbc)
    {
        $this->dbc = $dbc;
    }

    private function bind($pdostmt, $entity)
    {
        $id = $entity->getId();

        if(isset($id))
            $pdostmt->bindParam(':id', $id);

        $userId = $entity->getUserId();
        $pdostmt->bindParam(':userId', $userId);

        $auctionId = $entity->getAuctionId();
        $pdostmt->bindParam(':auctionId', $auctionId);

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
        $entity->setAuctionId($object->AuctionID);
        $entity->setDate($object->Date);
        $entity->setValue($object->Value);

        // VIEWMODEL DATA

        if(isset($object->UserName))
            $entity->setUserName($object->UserName);

        if(isset($object->AuctionTitle))
            $entity->setAuctionTitle($object->AuctionTitle);

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

        return $this->getEntities($result);
    }

    public function getAllForGrid()
    {
        $pdostmt = $this->dbc->query($this->queryGetAllForGrid);
        $pdostmt->setFetchMode(PDO::FETCH_OBJ);

        $result = $pdostmt->fetchAll();

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