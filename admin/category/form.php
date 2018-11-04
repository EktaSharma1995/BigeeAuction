<html>
<head>
</head>

<body>
<form method='post'>

<?php

require_once "../../interfaces/dao.php";
require_once "../../entities/category.php";
require_once "../../services/categoryDao.php";
require_once "../../lib/database.php";
require_once "../../lib/validate.php";
require_once "../../lib/forms.php";

require_once "../../connect.php";

// ===========================================================================
// INITIALIZATION
// ===========================================================================
    
$error = $id_error = $name_error =  "";

$validate = new Validate();

$categoryDao = new CategoryDao($database->getConnection());


if (Form::isPosted()) {
    // ===========================================================================
    // FORM POSTED
    // ===========================================================================

    $operation = Form::DataPost("operation");
    
	$id = Form::dataPost('categoryid');
	$name = Form::dataPost('categoryname');

    if(!$validate->name($name))
        $name_error = "<br/>Please fill the name";

    if($validate->getResult()) {

        $entity = new Category();

        $entity->setCategoryID($id);
        $entity->setCategoryName($name);

        if($operation == 'add') {

            // Add
            $categoryDao->add($entity);
//            $categoryDao->addCat($id,$name);
            $message = "Category added with success";
            
        } else {
            // Update
            $entity->setCategoryID($id);
            $categoryDao->update($entity);
            $message = "Category updated with success";

        }

        header("Location: index.php?message=" . $message);
        exit();
    }

} else {
    // ===========================================================================
    // INITIAL BLANK FORM OR INVALID VALUES
    // ===========================================================================
    $id = Form::dataGet('categoryid');
	$name = Form::dataGet('categoryname');

	$success = false;
	$err = false;

    if(strlen($id) > 0) {

        $category = $categoryDao->get($id);
    
        if(isset($category)) {
            $name = $category->getCategoryName();

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

Category ID:<br/>
<input type='text' name='categoryid' value='<?php echo $id; ?>'>
<?php echo $id_error; ?><br/><br/>

Category Name:<br/>
<input type='text' name='categoryname' value='<?php echo $name; ?>'>
<?php echo $name_error; ?><br/><br/>


<a href="index.php">cancel</a> <input type="submit" value="Save" name="register" />

</form>
</body>

</html>