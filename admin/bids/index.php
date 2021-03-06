<html>
<head>
<style>
table, th, td {
   border: 1px solid black;
}
</style>
</head>

<body>
<form>

<a href='form.php'>Insert</a><br/><br/>

<?php

require_once "../../interfaces/dao.php";
require_once "../../entities/bid.php";
require_once "../../services/bidDao.php";
require_once "../../lib/database.php";
require_once "../../lib/validate.php";
require_once "../../lib/forms.php";
require_once "../../connect.php";


$bidDao = new BidDao($database->getConnection());

$bids = $bidDao->getAllForGrid();

$message = Form::dataGet('message');

if(strlen($message) > 0)
    echo $message . "<br/><br/>";

echo "<table border='1'>";
echo "<tr><td>Auction</td><td>User</td><td>Date</td><td>Value</td><td></td></tr>";

foreach($bids as $bid) {

    $id = $bid->getId();
    $userName = $bid->getUserName();
    $auctionTitle = $bid->getAuctionTitle();
    $date = $bid->getDate();
    $value = $bid->getValue();

    echo "<tr><td>$auctionTitle</td><td>$userName</td><td>$date</td><td>$value</td><td><a href='form.php?id=$id'>Edit</a> <a href='delete.php?id=$id'>Delete</a></td></tr>";
}

echo "</table>";

?>
</form>
</body>
</html>