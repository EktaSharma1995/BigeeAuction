<?php

class Category
{
    private $categoryID;
    private $name;


    public function getCategoryID()
    {
        return $this->categoryID;
    }

    public function setCategoryID($value)
    {
        $this->categoryID = $value;
    }

    public function getCategoryName()
    {
        return $this->name;

    }

    public function setCategoryName($value)
    {
        $this->name = $value;
    }
}