<?php
require_once 'auction.php';
require_once 'database.php';

$title = $errtitle = $errdescription = $description = $errstartvalue = $startvalue = "";
$startdate = $errstartdate = $errenddate = $enddate = $errauctionstatus = $auctionstatus = $errcategory = $category =  "";
$returnmessage = "";


$db2 = Database::getDb();
$auction1 = new Auction();
$categories = $auction1->getCategories($db2);

if(isset($_POST['submit'])){

    $title = $_POST['title'];
    $description = $_POST['description'];
    $startvalue = $_POST['startvalue'];
    $startdate = $_POST['startdate'];
    $enddate = $_POST['enddate'];
    $auctionstatus = $_POST['auctionstatus'];
    $category = $_POST['category'];

    $namepattern = "/[a-zA-Z]{2,16}/";

    $db = Database::getDb();

    $auction = new Auction();
    $auction->insert($db, $title, $description, $startvalue, $startdate, $enddate, $auctionstatus, $category);

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
                <-- Choose an option

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
