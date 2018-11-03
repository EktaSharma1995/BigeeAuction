<?php



$auction_id = $errauction_id = $errdescription = $description = $errstartvalue = $startvalue = $errenddate = $enddate = $errauctionstatus = $auctionstatus = $errcategory = $category =  "";
$content_table = "";


    if(isset($_POST['listauctions'])){
        
        $content_table = listAuctions();
        
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



    function listAuctions(){
        try{            
            $dbc = startConnection();
            $sql = "SELECT * FROM Auction";
            $pdostmt = $dbc->query($sql);
            $pdostmt->setFetchMode(PDO::FETCH_OBJ);
            //var_dump($pdostmt->fetchAll());
            $auctions = $pdostmt->fetchAll();

            $table = "<table>";
            $table .= "<tr><th>ID</th><th>Description</th><th>Start Value</th><th>Creation Date</th><th>End Date</th><th>Status</th><th>Category</th></tr>";
                foreach($auctions as $a){
                $table .= "<tr><td>" . $a->AuctionID . "</td><td>" . $a->Description . "</td><td>" . $a->StartValue . "</td><td>" . $a->CreationDate . "</td><td>" . $a->EndDate . "</td>
                        <td>" . $a->AuctionStatusID . "</td><td>" . $a->CategoryID . "</td></tr>";
            }
            $table .= "</table>";
            
            return $table;

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
           
                <form action="listauctions2.php" method="post">
                    <fieldset>
                    <legend>Auction</legend>    
                        
                        <input type="submit" value="Show List" id="listauction" name='listauctions' />
                        <input type="button" value="Return" onclick="document.location='index.php';" />
                        <span id="content_table" name="content_table"><?php echo $content_table ?></span>
                    </fieldset>

                </form>

            </div>

            <script src="js/javascript.js"></script>
        </div>
    </body>
    
</html>

