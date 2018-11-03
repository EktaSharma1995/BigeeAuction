<html>
<head>
</head>

<body>
<form method='post'>

<?php

require_once "interfaces/dao.php";
require_once "entities/bid.php";
require_once "services/bidDao.php";
require_once "lib/database.php";
require_once "lib/validate.php";
require_once "lib/forms.php";

require_once "connect.php";

// ===========================================================================
// INITIALIZATION
// ===========================================================================
    
$id_error = $date_error = $userid_error = $value_error = "";

$validate = new Validate();

$bidDao = new BidDao($database->getConnection());


if (Form::isPosted()) {
    // ===========================================================================
    // FORM POSTED
    // ===========================================================================

    $operation = Form::DataPost("operation");
    
	$id = Form::dataPost("id");
	$date = Form::dataPost("date");
	$userId = Form::dataPost("userid");
	$value = Form::dataPost("value");

    if(!$validate->numeric($id))
        $id_error = "<br/>Please fill the Id";

    if(!$validate->alfanumeric($date))
        $date_error = "<br/>Please fill the date";

    if(!$validate->numeric($userId))
        $userid_error = "<br/>User Id must be numeric";

    if(!$validate->numeric($value))
    	$value_error = "<br/>Value must be numeric";


    if($validate->getResult()) {

        $entity = new Bid();

        $entity->setId($id);
        $entity->setDate($date);
        $entity->setUserId($userId);
        $entity->setValue($value);

        if($operation == 'add') {
            // Add
            $bidDao->add($entity);
            $message = "Bid added with success";
            
        } else {
            // Update
            $bidDao->update($entity);
            $message = "Bid updated with success";
        }

        header("Location: list.php?message=" . $message);
        exit();
    }

} else {
    // ===========================================================================
    // INITIAL BLANK FORM OR INVALID VALUES
    // ===========================================================================

    $id = Form::dataGet("id");
	$date = Form::dataGet("date");
	$userId = Form::dataGet("userid");
	$value = Form::dataGet("value");

	$sucess = false;
	$err = false;

    if(strlen($id) > 0) {

        $bid = $bidDao->get($id);
    
        $userId = $bid->getUserId();
        $date = $bid->getDate();
        $value = $bid->getValue();    
    
        $operation = 'update';
    } else {
        $operation = 'add';
    }
}

?>
<input type='hidden' name='operation' value='<?php echo $operation; ?>' />

Id:<br/>
<input type='text' name='id' value='<?php echo $id; ?>'>
<?php echo $id_error; ?><br/><br/>

User Id:<br/>
<input type='text' name='userid' value='<?php echo $userId; ?>'>
<?php echo $userid_error; ?><br/><br/>

Date:<br/>
<input type='text' name='date' value='<?php echo $date; ?>'>
<?php echo $date_error; ?><br/><br/>

Value:<br/>
<input type='text' name='value' value='<?php echo $value; ?>'>
<?php echo $value_error; ?><br/><br/>

<a href="index.php">cancel</a> <input type="submit" value="Save" name="register" />

</form>
</body>

</html>