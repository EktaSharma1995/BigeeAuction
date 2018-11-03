<?php
require_once 'auction.php';
require_once 'database.php';


$auction_id = $errauction_id = $errdescription = $description = $errstartvalue = $startvalue = $errenddate = $enddate = $errauctionstatus = $auctionstatus = $errcategory = $category =  "";
$returnmessage = "";
$content_table = "";


if(isset($_POST['submit'])){
    if(empty($_POST['searchtxt'])){
        $content_table = listAuctions();
    }else{
        $searchwords = $_POST['searchtxt'];
        $content_table = listAuctionsUsingSearch($searchwords);
    }
}else{
    $content_table = listAuctions();
}


function listAuctions(){
    try{
        $db = Database::getDb();
        $auction = new Auction();
        $auctionslist = $auction->listAuctions($db);
        $tableReturned = tableFormatter($auctionslist);
        return $tableReturned;
    }catch(PDOException $e){
        echo $e->getMessage();
    }
}

function listAuctionsUsingSearch($searchwords){
    try{
        $db = Database::getDb();
        $auction = new Auction();
        $auctionslist = $auction->listAuctionsSearch($db, $searchwords);
        $tableReturned = tableFormatter($auctionslist);
        return $tableReturned;
    }catch(PDOException $e){
        echo $e->getMessage();
    }
}

function tableFormatter($auctionslist){
    $table = "";
    if(empty($auctionslist)){
        $table = "No Auctions Found";
    }else{
        $table = "<table class='table table-hover'>";
        $table .= "<tr><th>ID</th><th>Title</th><th>Description</th><th>Start Value</th><th>Creation Date</th><th>Start Date</th><th>End Date</th><th>Status</th><th>Category</th></tr>";
        foreach($auctionslist as $a){
            $table .= "<tr><td>" . $a->AuctionID . "</td><td>" . $a->Title . "</td><td>" . $a->Description . "</td><td>" . $a->StartValue . "</td><td>" . $a->CreationDate . "</td>
            <td>" . $a->StartDate . "</td><td>" . $a->EndDate . "</td><td>" . $a->status_description . "</td><td>" . $a->category_name. "</td></tr>";
        }
        $table .= "</table>";
    }


    return $table;
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">


    <title>Admin template</title>

    <!-- Bootstrap core CSS -->
    <link href="plugins/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">

</head>

<body class="container-fluid">
<nav class="navbar navbar-expand-sm navbar-light row">
    <div class="col-12 col-sm-4 col-lg-2 logo">
        <a class="navbar-brand" href="#">
            <img src="bird.jpg" alt="Logo" style="width:40px;">
        </a>
        <div class="menu-icon" id="sidebarCollapse">
            <div class="bar1 bg-dark"></div>
            <div class="bar2 bg-dark"></div>
            <div class="bar3 bg-dark"></div>
        </div>
    </div>
    <div class="col-12 col-sm-8 col-lg-10 bg-light">
        <!--Add the rest of the bar here later on-->
    </div>
</nav>

<div class="row">
    <?php include_once "auction_dashboard_navigation.php" ?>

    <main class="col-12 col-sm-8 col-lg-10 bg-light">
        <form action="listAuctions.php" method="post" class="col-md-8 col-lg-4 col-lg-2">
            <fieldset>
                <legend>Auction</legend>
                <div class="form-group">
                    <label for="title">Search:</label><br>
                    <input type="text" name="searchtxt" id="searchtxt"/>
                    <input type="submit" value="Submit" id="submit" name='submit' class='btn btn-primary'/>
                    <br>
                </div>

                <div class="form-group">
                    <label for="category">Auctions:</label><br>
                    <div class="table-responsive-md">
                        <?php echo $content_table ?>
                    </div>
                    <br><br><br>
                </div>

            </fieldset>

        </form>

    </main>
</div>
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->

<script src="plugins/jQuery/3.3.1/jquery-3.3.1.min.js"></script>
<script src="plugins/bootstrap/4.1.3/js/bootstrap.min.js"></script>

<script>
    $(document).ready(function () {
        $('#sidebarCollapse').on('click', function () {
            $('#sidebar').toggleClass('active');
        });

    });
</script>
</body>
</html>
