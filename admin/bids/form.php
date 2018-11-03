<html>
<head>
</head>

<body>
<form method='post'>

<?php

require_once "../../interfaces/dao.php";
require_once "../../entities/bid.php";
require_once "../../services/bidDao.php";
require_once "../../lib/database.php";
require_once "../../lib/validate.php";
require_once "../../lib/forms.php";

require_once "../../connect.php";

// ===========================================================================
// INITIALIZATION
// ===========================================================================
    
$error = $id_error = $date_error = $userid_error = $auctionid_error = $value_error = "";

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
    $auctionId = Form::dataPost("auctionId");
	$value = Form::dataPost("value");

    if(!$validate->alfanumeric($date))
        $date_error = "<br/>Please fill the date";

    if(!$validate->numeric($userId))
        $userid_error = "<br/>User Id must be numeric";

    if(!$validate->numeric($auctionId))
        $auctionid_error = "<br/>Auction Id must be numeric";

    if(!$validate->numeric($value))
    	$value_error = "<br/>Value must be numeric";


    if($validate->getResult()) {

        $entity = new Bid();

        $entity->setDate($date);
        $entity->setUserId($userId);
        $entity->setAuctionId($auctionId);
        $entity->setValue($value);

        if($operation == 'add') {
            // Add
            $bidDao->add($entity);
            $message = "Bid added with success";
            
        } else {
            // Update
            $entity->setId($id);
            $bidDao->update($entity);
            $message = "Bid updated with success";
        }

        header("Location: index.php?message=" . $message);
        exit();
    }

} else {
    // ===========================================================================
    // INITIAL BLANK FORM OR INVALID VALUES
    // ===========================================================================

    $id = Form::dataGet("id");
	$date = Form::dataGet("date");
    $userId = Form::dataGet("userid");
    $auctionId = Form::dataGet("auctionId");
	$value = Form::dataGet("value");

	$sucess = false;
	$err = false;

    if(strlen($id) > 0) {

        $bid = $bidDao->get($id);
    
        if(isset($bid)) {
            $userId = $bid->getUserId();
            $auctionId = $bid->getAuctionId();
            $date = $bid->getDate();
            $value = $bid->getValue();    
        
            $operation = 'update';
            } else {
            $error = "No record found.";
        }
    } else {
        $operation = 'add';
    }
}

?>
<input type='hidden' name='operation' value='<?php echo $operation; ?>' />
<input type='hidden' name='id' value='<?php echo $id; ?>'>

<?php echo $error; ?><br/><br/>

User Id:<br/>
<input type='text' name='userid' value='<?php echo $userId; ?>'>
<?php echo $userid_error; ?><br/><br/>

Auction Id:<br/>
<input type='text' name='auctionId' value='<?php echo $auctionId; ?>'>
<?php echo $auctionid_error; ?><br/><br/>

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