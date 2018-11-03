<?php

require_once "../../interfaces/dao.php";
require_once "../../services/bidDao.php";
require_once "../../lib/database.php";
require_once "../../lib/forms.php";

require_once "../../connect.php";

$bidDao = new BidDao($database->getConnection());

$id = Form::dataGet("id");

$bidDao->delete($id);

header("Location: index.php");
exit();
