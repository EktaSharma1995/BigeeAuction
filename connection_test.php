<?php

$url = parse_url(getenv("CLEARDB_DATABASE_URL"));

$host = $url["host"];
$database = substr($url["path"], 1);
$user = $url["user"];
$pass = $url["pass"];

$dsn = "mysql:host=$host;dbname=$database";

try {
    $dbc = new PDO($dsn, $user, $pass);

    $dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //$sql = "SELECT * FROM Student";

    //$pdostmt = $dbc->query($sql);
    //$pdostmt->setFetchMode(PDO::FETCH_OBJ);

    //$result = $pdostmt->fetch();
    //$result = $pdostmt->fetchAll(PDO::FETCH_OBJ);
    //$students = $pdostmt->fetchAll();

    //var_dump($students);

} catch(PDOException $e) {
    echo $e->getMessage();
}
