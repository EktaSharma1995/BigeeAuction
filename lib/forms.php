<?php

// ===========================================================================
// Library for Forms
// ===========================================================================

// ===========================================================================
// return if the form was posted, using a named submit button technique
// ===========================================================================

class Form {
    public static function isPosted() {
        if (isset($_POST["register"]))
            return true;
        else
            return false;
    }
    
    // ===========================================================================
    // Get the $field value, submitted by GET
    // ===========================================================================
    public static function dataGet($field) {
        if (isset($_GET[$field]))
            return $_GET[$field];
        else
            return "";
    }
    
    // ===========================================================================
    // Get the $field value, submitted by POST
    // ===========================================================================
    public static function dataPost($field) {
        if (isset($_POST[$field]))
            return $_POST[$field];
        else
            return "";
    }
}
