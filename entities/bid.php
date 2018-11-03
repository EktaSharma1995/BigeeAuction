<?php

class Bid
{
    private $id;
    private $userId;
    private $auctionId;
    private $date;
    private $value;

    // VIEWMODEL PROPERTIES
    private $userName;
    private $auctionTitle;

    public function getId()
    {
        return $this->id;
    }

    public function setId($value)
    {
        $this->id = $value;
    }
    
    public function getUserId()
    {
        return $this->userId;
    }

    public function setUserId($value)
    {
        $this->userId = $value;
    }

    public function getAuctionId()
    {
        return $this->auctionId;
    }

    public function setAuctionId($value)
    {
        $this->auctionId = $value;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setDate($value)
    {
        $this->date = $value;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function setValue($value)
    {
        $this->value = $value;
    }

    // VIEWMODEL METHODS

    public function getUserName()
    {
        return $this->userName;
    }

    public function setUserName($value)
    {
        $this->userName = $value;
    }

    public function getAuctionTitle()
    {
        return $this->auctionTitle;
    }

    public function setAuctionTitle($value)
    {
        $this->auctionTitle = $value;
    }

}