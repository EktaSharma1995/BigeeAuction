<?php

require_once "../../interfaces/dao.php";
require_once "../../entities/category.php";
require_once "../../services/categoryDao.php";
require_once "../../lib/database.php";
require_once "../../lib/validate.php";
require_once "../../lib/forms.php";

require_once "../../connect.php";

$categoryDao = new CategoryDao($database->getConnection());

$id = Form::dataGet("id");

$categoryDao->delete($id);

header("Location: index.php");
exit();
