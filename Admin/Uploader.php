<?php
switch ($type){
    case "Inventory_cover":
        $target_dir = "Inventory/";
        $target_file = $target_dir . basename($_FILES["cover"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $check = getimagesize($_FILES["cover"]["tmp_name"]);
        
        // Check if file already exists
        if (file_exists($target_file)) {
         print
          $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 500000) {
          echo "Sorry, your file is too large.";
          $uploadOk = 0;
        }

        break;
}
?>
