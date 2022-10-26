<?php
require("db.php");
//Variables
$list_count = 0;
//Fetch all Inventory details
$sql = "SELECT Inventory.id, Inventory.inventory, Inventory.status, SUM(Books.quantity) as TotalBooks FROM Inventory INNER JOIN Books ON (Inventory.id = Books.inventoryid) GROUP BY id";
$list = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
<!--TITLE-->
<title>Book Inventory || Admin Panel</title>

<!--SHORTCUT ICON-->
<link rel="shortcut icon" href="images/#">

<!--META TAGS-->
<meta charset="UTF-8">
<meta name="language" content="ES">
<meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

<!--FONT AWESOME-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<!--GOOGLE FONTS-->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;500;600;700&family=Montserrat:wght@100;200;300;400;500;600;700;800;900&family=Mukta:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet"> 

<!--PLUGIN-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

<!--STYLE SHEET-->
<link rel="stylesheet" href="../assets/css/main.css">
<link rel="stylesheet" href="../assets/css/panel.css">
</head>
<body class="animate-bottom" id="body">

<!--MENU-->
<menu class="flex">
    <section class="flex-content">
        <span class="parallelogram">
            <a href="#" class="skew-fix"><i class="fa fa-map-pin"></i> Stones Corner, Queensland, Australia</a>
        </span>
    </section>
    <section class="flex-content">
        <span>
            <a href="emailto:support@inventory.books"><i class="fa fa-envelope-o"></i> support@inventory.books</a>
            <a href="tel:0000000000"><i class="fa fa-headphones"></i> 1234 567 890</a>
        </span>
        <span>
            <a href="#"><i class="fa fa-facebook-square"></i></a>
            <a href="#"><i class="fa fa-instagram"></i></a>
            <a href="#"><i class="fa fa-twitter"></i></a>
            <a href="#"><i class="fa fa-youtube"></i></a>
        </span>
    </section>
</menu>


<!--NAV-->
<nav class="flex">
    <section class="flex-content">
        <a href="#"><img src="" alt="LOGO."></a>
    </section>
    <section class="flex-content flex">
        <a href="#" class="active">Home</a>
        <a href="#open-modal" class="modal inventor"><i class="fa fa-plus"></i> Inventory</a>
        <a href="#open-modal" class="modal book"><i class="fa fa-plus"></i> Book</a>
    </section>
    <section class="flex-content">
        <a href="#"><i class="fa fa-user"></i></a>
        <a href="javascript:{}" class="btn1 logout">LogOut</a>
    </section>
</nav>


<!--MAIN-->
<main class="padding_2x">
    <form id="Inventory_display_form">
    <table>
        <tr>
            <th><input type="checkbox" name="select_all" class="all_selection_box" id="select_all"></th>
            <th>Slno.</th>
            <th>Inventory</th>
            <th>Books</th>
            <th>Status</th>
        </tr>
        <?php
        if ($list->num_rows > 0) {
            while($row = $list->fetch_assoc()) {
                $list_count++;
                $row["status"] == "1" ? $status = '<i class="fa fa-check-circle-o"></i>' : $status ='<i class="fa fa-times-circle-o"></i>';
                echo '
                    <tr>
                        <td><input type="checkbox" name="Inventory_action[]" value="'.$row["id"].'" class="selection_box"></td>
                        <td>'.$list_count.'</td>
                        <td><a href="#open-modal" class="modal book_display">'.$row["inventory"].'</a></td>
                        <td>'.$row["TotalBooks"].'</td>
                        <td>'.$status.'</td>
                    </tr>
                ';
            }
        } else {
            echo '
                <tr>
                    <td></td>
                    <td>0</td>
                    <td>No Inventories Found</td>
                    <td>0</td>
                    <td class="tooltip">
                        <span class="tooltiptext">Either the Inventories or Books in the Inventory will be empty.</span>
                        <i class="fa fa-question-circle-o"></i>
                    </td>
                </tr>
            ';
        }
        ?>
    </table>
</main>


<!--Actions-->
<div class="action" id="action_btns">
    <a href="javascript:{}" title="Delete" onclick="Crud_Inventory(3)"><i class="fa fa-trash"></i></a>
    <a href="javascript:{}" title="Activate" onclick="Crud_Inventory(4)"><i class="fa fa-check"></i></a>
    <a href="javascript:{}" title="Deactivate" onclick="Crud_Inventory(5)"><i class="fa fa-times"></i></a>
</div>


<!--JQUERY PLUGIN-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<!--JAVASCRIPT-->
<script type="text/javascript" src="../assets/js/main.js"></script>
<script type="text/javascript" src="../assets/js/panel.js"></script>
</body>
</html>
