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
require_once "../../entities/category.php";
require_once "../../services/categoryDao.php";
require_once "../../lib/database.php";
require_once "../../lib/validate.php";
require_once "../../lib/forms.php";
require_once "../../connect.php";


$categoryDao = new CategoryDao($database->getConnection());

$categories = $categoryDao->getAllForGrid();

$message = Form::dataGet('message');

if(strlen($message) > 0)
    echo $message . "<br/><br/>";

echo "<table border='1'>";
echo "<tr><td>ID</td><td>Name</td></tr>";

foreach($categories as $category) {

    $id = $category->getCategoryID();
    $name = $category->getCategoryName();


    echo "<tr><td>$id</td><td>$name</td><td><a href='form.php?categoryid=$id'>Edit</a> <a href='delete.php?id=$id'>Delete</a></td></tr>";
}

echo "</table>";

?>
</form>
</body>
</html>