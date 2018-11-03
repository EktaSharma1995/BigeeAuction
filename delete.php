<?php



$auction_id = $errauction_id = $errdescription = $description = $errstartvalue = $startvalue = $errenddate = $enddate = $errauctionstatus = $auctionstatus = $errcategory = $category =  "";
$returndescription = "";
   
    if(isset($_POST['deleteauction'])){
        
        $id = $_POST['auction_id'];
        $errauction_id = delete($id);
        
    }

   function startConnection(){
        $host = 'localhost';
        $dbname = 'aphp';
        $user = 'root';
        $pass = '';

        $dsn = "mysql:host=localhost;dbname=aphp";

        $dbc = new PDO($dsn, $user, $pass);
        $dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        return $dbc;
    }

    
    function delete($auctionid){
        try{
            $dbc = startConnection();
            $sql = "DELETE FROM Auction WHERE AuctionID = :auctionid";

            $pdostmt = $dbc->prepare($sql);
            $pdostmt->bindParam(':auctionid', $auctionid);

            $count = $pdostmt->execute();
            //echo $count->rowCount();
            if ($pdostmt->rowCount() > 0){
                return "Auction deleted";    
            }else{
                return "Auction not found";
            }
            
        

        }catch(PDOException $e){
            echo $e->getMessage();
        }
        
        
    }


?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Lab 07</title>
        <link rel="stylesheet" href="template/stylesheet.css">
    </head>
    <body>
    
        <div id="wrapper">
            

            <div id="content_div">
           
                <form action="delete.php" method="post">
                    <fieldset>
                    <legend>Auction</legend>    
                        <label for="auction_id">Id:</label><br>
                        <input type="text" name="auction_id" id="auction_id"/> <span id="errauction_id" name="errauction_id" style="color:red"><?php echo $errauction_id; ?></span> <br>
                        

                    <div>
                        
                        <input type="submit" value="Delete" id="deleteauction" name='deleteauction' />
                        <input type="button" value="Return" onclick="document.location='index.php';" />
                        
                    </div>
                    </fieldset>

                </form>

            </div>

        </div>
    </body>
    
</html>

