<?php
if(isset($type)){ 
    switch ($type){
        case "selection_options":
            //Fetch Inventories available from DB
            $result = $conn->query("SELECT inventory,id FROM Inventory");
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo '<option value="'.$row["id"].'">'.$row["inventory"].'</option>';
                }
            } else {
                echo '<option value="0">No Inventories Available</option>';
            }
            break;
    }
}
?>
