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
        <form action="auction_insert.php" method="post" class="col-md-8 col-lg-4 col-lg-2">
            <fieldset>
                <legend>Auction</legend>
                <div class="form-group">
                    <label for="title">Title:</label><br>
                    <input type="text" name="title" id="title"/> <span id="errtitle_id" name="errtitle" style="color:red"><?php echo $errtitle; ?></span> <br>
                </div>
                <div class="form-group">
                    <label for="description">Description:</label><br>
                    <input type="text" name="description" id="description"/> <span id="errfirstname" name="errfirstname" style="color:red"><?php echo $errdescription; ?></span> <br>
                </div>
                <label for="startvalue">Start Value:</label><br>
                <input type="text" name="startvalue" id="startvalue"/> <span id="errstartvalue" name="errstartvalue" style="color:red"><?php echo $errstartvalue; ?></span> <br>

                <div class="form-group">
                    <label for="startdate">Start Date:</label><br>
                    <input type="text" name="startdate" id="startdate"/> <span id="errstartdate" name="errstartdate" style="color:red"><?php echo $errstartdate; ?></span> <br>
                </div>
                <div class="form-group">
                    <label for="enddate">End Date:</label><br>
                    <input type="text" name="enddate" id="enddate"/> <span id="errenddate" name="errenddate" style="color:red"><?php echo $errenddate; ?></span> <br>
                </div>
                <div class="form-group">
                    <label for="auctionstatus">Status:</label><br>
                    <input type="text" name="auctionstatus" id="auctionstatus"/> <span id="errauctionstatus" name="errauctionstatus" style="color:red"><?php echo $errauctionstatus; ?></span> <br>
                </div>
                <div class="form-group">
                    <label for="category">Category:</label><br>
                    <select>
                        <?php foreach ($categories as $c){
                            echo "<option value='$c->category_ID'> $c->category_name </option>";
                        } ?>
                    </select>
                    <br><br><br>

                    <span id="returnmessage" name="returnmessage"><?php echo $returnmessage ?></span>
                </div>
                <div class="form-group">
                    <input type="submit" value="Submit" id="submit" name='submit' class='btn btn-primary'/>
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
