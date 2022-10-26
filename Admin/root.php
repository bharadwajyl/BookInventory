<?php
//Check the type of the form posted
switch ($_POST["FormType"]) {
        case "selection_options":
            Inventory::Fetch(''.$_POST['FormType'].'');
            break;
        case "Inventory_create": case "Book_create": case "Inventory_display_delete": case "Inventory_display_activate": case "Inventory_display_deactivate":
            Inventory::Crud(''.$_POST['FormType'].'');
            break;
        case "Inventory_cover":
            Inventory::Uploader(''.$_POST['FormType'].'');
            break;
        default:
            require_once '../404.html';
            break;
}

//Class Inventory
class Inventory{
    public function Fetch($type){
        try {
            require("db.php");
            include("Fetch.php");
        }
        catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }
    }
    public function Crud($type){
        try {
            require("db.php");
            include("Crud.php");
        }
        catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }
    }
    public function Uploader($type){
        try {
            require("db.php");
            include("Uploader.php");
        }
        catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }
    }
}
?>
