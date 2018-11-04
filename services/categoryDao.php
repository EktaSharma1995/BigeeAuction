<?php



class CategoryDao implements Dao
{
    private $queryGetAll = "SELECT * FROM category";
    private $queryGet = "SELECT categoryID, name FROM category WHERE categoryID = :categoryID";
    private $commandAdd = "INSERT INTO category (categoryID, name) VALUES (:categoryID, :name)";
    private $commandUpdate = "UPDATE category SET name = :name WHERE categoryID = :categoryID";
    private $commandDelete = "DELETE FROM category WHERE categoryID = :categoryID";

    private $queryGetAllForGrid = "
        SELECT categoryID,name
        FROM category
    ";

    private $dbc;

    public function __construct($dbc)
    {
        $this->dbc = $dbc;
    }

    private function bind($pdostmt, $entity)
    {
        $id = $entity->getCategoryID();

        if(isset($id))
        $pdostmt->bindParam(':categoryID', $id);

        $name = $entity->getCategoryName();
        $pdostmt->bindParam(':name', $name);

    }


    private function getEntity($object)
    {
        $entity = new Category();
//
//        print_r($object->{'categoryID'});
//        print_r($object->{'name'});

        $entity->setCategoryID($object->{'categoryID'});
        $entity->setCategoryName($object->{'name'});


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


    public function get($id)
    {
        $pdostmt = $this->dbc->prepare($this->queryGet);
        $pdostmt->setFetchMode(PDO::FETCH_OBJ);

        $pdostmt->bindParam(':categoryID', $id);

        $pdostmt->execute();


        $result = $pdostmt->fetchAll();


        if(count($result) == 1){
            return $this->getEntity($result[0]);
        }
        else if(count($result) == 0){
            return null;
        }
        else{
            throw new Exception("Non unique query result");
        }
    }

    public function getAllForGrid()
    {
        $pdostmt = $this->dbc->query($this->queryGetAllForGrid);
        $pdostmt->setFetchMode(PDO::FETCH_OBJ);

        $result = $pdostmt->fetchAll();

        return $this->getEntities($result);
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

        $pdostmt->execute();
    }

    public function delete($id)
    {
        $pdostmt = $this->dbc->prepare($this->commandDelete);
        $pdostmt->setFetchMode(PDO::FETCH_OBJ);

        $pdostmt->bindParam(':categoryID', $id);

        return $pdostmt->execute();
    }

    public function addCat($id,$name)
    {
            $pdostmt = $this->dbc->prepare($this->commandAdd);
            $pdostmt->bindValue(':categoryID',$id,PDO::PARAM_STR);
            $pdostmt->bindValue(':name',$name,PDO::PARAM_STR);

            $pdostmt->execute();

    }

    public function updateCat($id,$name)
    {
        $pdostmt = $this->dbc->prepare($this->commandUpdate);

        $pdostmt->bindValue(':name',$name,PDO::PARAM_STR);

        $pdostmt->execute();
    }

}