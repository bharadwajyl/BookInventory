<?php
switch ($type){
    case "Inventory_create":
        //Variable
        $inventory = $_POST['inventory'];
        //Check for input field & replace all special characters except space
        $inventory == "" ? die(print("failure: Blank fields not allowed")) : $inventory = trim($inventory,'\'"');
        //Create new Inventory
        $conn->query("INSERT INTO Inventory (inventory, status) VALUES ('$inventory', '1')") === TRUE ? print("success: Inventory Created") :
        die(print_r("failure: Please try again"));
        break;
    case "Book_create":
        //Varibles
        $values = array ("inventory" => ''.$_POST["Inventory"].'', "book" => ''.$_POST["book"].'', "quantity" => ''.$_POST["quantity"].'', "cost" => ''.$_POST["cost"].'');
        $error = false;
        foreach ($values as $fields){
            if (empty($fields)) { $error = true; }
        }
        
        //Check if fields are empty
        if ($error) {
             die(print("failure: All fields are mandatory"));
        }
        else if ($values["inventory"] == "0"){
            die(print("failure: No Inventory found"));
        }
        else if (!is_numeric($values["quantity"]) || !is_numeric($values["cost"])){
            die(print("failure: Only numerical values are allowed"));
        }
        else if (strlen($values["quantity"]) >= 5){
            die(print("failure: Quantity is too high to handle"));
        }
        else if (strlen($values["cost"]) >= 10){
            die(print("failure: Cost is too high"));
        } else{
            $values["book"] =  trim($values["book"],'\'"');
            $values["quantity"] =  trim($values["quantity"],'\'"');
            $values["cost"] =  trim($values["cost"],'\'"');
        }
        //Insert book into Inventory
        $conn->query("INSERT INTO Books (inventoryid, bookname, quantity, cost) VALUES ('".$values['inventory']."', '".$values['book']."', '".$values['quantity']."','".$values['cost']."')") === TRUE ? print("success: Book added to the Inventory") :
        die(print("failure: Please try again"));
        break;
    case "Inventory_display_delete":
        strpos($type, "Inventory") !== false ? $table = "Inventory" : $table = "Books";
        foreach ($_POST[''.$table.'_action'] as $inventory){
            //Delete Inventory & Books
            $conn->query("DELETE FROM $table WHERE id = $inventory")  === TRUE ? $message = "success: Deletion successfull" :
            $message = "failure: Error occured";
        }
        print($message);
        break;
    case "Inventory_display_activate": case "Inventory_display_deactivate":
        strpos($type, "Inventory") !== false ? $table = "Inventory" : $table = "Books";
        strpos($type, "deactivate") !== false ? $status = "0" : $status = "1";
        foreach ($_POST[''.$table.'_action'] as $inventory){
            //Delete Inventory & Books
            $conn->query("UPDATE $table set status = '$status' WHERE id = $inventory")  === TRUE ? $message = "success: Status changed" :
            $message = "failure: Error occured";
        }
        print($message);
        break;
    default:
        require_once '../404.html';
        break;
}
?>
