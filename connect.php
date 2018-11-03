<?php

require_once "local.php";

$cleardb = getenv("CLEARDB_DATABASE_URL");
//echo "cleardb: " . $cleardb;

if(isset($cleardb) && strlen($cleardb) > 0) {
    //echo "tem cleardb";

    $url = parse_url($cleardb);

    $host = $url["host"];
    $database = substr($url["path"], 1);
    $user = $url["user"];
    $pass = $url["pass"];
}

// echo "host: " . $host;
// echo "database: " . $database;
// echo "user: " . $user;
// echo "pass: " . $pass;

$database = new Database($host, $database, $user, $pass);
