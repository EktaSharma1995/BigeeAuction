<?php
class Auction
{
    private $title;
    private $description;
    private $startValue;
    private $creationDate;
    private $startDate;
    private $endDate;
    private $auctionStatus;
    private $auctionCategory;

    function insert($db, $title, $description, $startvalue, $startdate, $enddate, $auctionstatus, $category){
        try{

            $creationDate = date('Y-m-d', time());

            $sql = "INSERT INTO Auction (Title, Description, StartValue, CreationDate, StartDate, EndDate, AuctionStatusID, CategoryID) 
                    VALUES (:title, :description, :startvalue, :creationdate, :startdate, :enddate, :auctionstatus, :category)";

            $pdostmt = $db->prepare($sql);

            $pdostmt->bindParam(':title', $title);
            $pdostmt->bindParam(':description', $description);
            $pdostmt->bindParam(':startvalue', $startvalue);
            $pdostmt->bindParam(':creationdate', $creationDate);
            $pdostmt->bindParam(':startdate', $startdate);
            $pdostmt->bindParam(':enddate', $enddate);
            $pdostmt->bindParam(':auctionstatus', $auctionstatus);
            $pdostmt->bindParam(':category', $category);

            $count = $pdostmt->execute();
            return "Auction Created ";

        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    function listAuctions($db){
        $sql = "SELECT * FROM auction a inner join categories c on (a.categoryID = c.category_ID) inner join auction_status acs on (a.AuctionStatusID = acs.status_id)";
        $pdostm = $db->prepare($sql);
        //specify fetch method
        $pdostm->setFetchMode(PDO::FETCH_OBJ);
        $pdostm->execute();

        //fetch all result
        $auctions = $pdostm->fetchAll(PDO::FETCH_OBJ);
        return $auctions;
    }

    function listAuctionsSearch($db, $searchwords){
        $sql = "SELECT * FROM auction a inner join categories c on (a.categoryID = c.category_ID) inner join auction_status acs on (a.AuctionStatusID = acs.status_id)
                where Title like :searchwords";
        
        $pdostm = $db->prepare($sql);
        $pdostm->bindValue('searchwords', "%{$searchwords}%");
        //specify fetch method
        $pdostm->setFetchMode(PDO::FETCH_OBJ);
        $pdostm->execute();

        //var_dump($pdostm);
        //fetch all result
        $auctions = $pdostm->fetchAll(PDO::FETCH_OBJ);
        return $auctions;
    }

    function getCategories($db){
        $sql = "SELECT * FROM categories";
        $pdostm = $db->prepare($sql);
        //specify fetch method
        $pdostm->setFetchMode(PDO::FETCH_OBJ);
        $pdostm->execute();

        //fetch all result
        $categories = $pdostm->fetchAll(PDO::FETCH_OBJ);
        return $categories;
    }

}