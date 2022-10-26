//Selection box
var cb_count = 0, 
action_btn = document.getElementById("action_btns"), 
serialize, url = "root.php";
var selection_box = document.getElementsByClassName("selection_box");
for (var i=0; i < selection_box.length; i++) {
    selection_box[i].addEventListener('change', function(e) {
        e.target.checked ? cb_count++ : cb_count-- ;
        cb_count > 0 ? action_btn.style.right = "0" : action_btn.style.right = "-10%";
    });
}


//Detect Inventory & book insertion button click & open modal
$(".modal").click(function(){
    $(this).hasClass("inventor") ?
        $("#open-modal").html( '<div class="padding_2x"><a href="#" onclick="RemoveModal()"   title="Close" class="modal-close">Close</a><div><h1 class="small">Create Inventory</h1><form id="Inventory_form" enctype="multipart/form-data"><label><img id="preview" src="../assets/images/user.png" alt="preview" /><input type="file" name="cover" id="cover" onchange="Uploader(1)" oninput="preview.src=window.URL.createObjectURL(this.files[0])"></label><input type="text" name="inventory" placeholder="Inventory name" maxlength="150"><button class="btn1" id="Inventory_btn" onclick="Crud_Inventory(1)">Create Inventory</button></form></div></div>')
    :
    $.ajax({
    type: "POST",
    url: url,
    data: "&FormType=selection_options",
        success: function(message){
           $("#open-modal").html('<div class="padding_2x"><a href="#" onclick="RemoveModal()"   title="Close" class="modal-close">Close</a><div><h1 class="small">Add book to Inventory</h1><form id="Book_form"><select name="Inventory">'+message+'</select><input type="text" name="book" placeholder="Book name" maxlength="150"><input type="number" name="quantity" min="5" max="5" placeholder="Quantity available*"><input type="tel" name="cost" maxlength="5" placeholder="Cost per book*"><button class="btn1" id="Book_btn" onclick="Crud_Inventory(2)">Add Book</button></form></div></div>');
        }
    });       
});


//Detect select all checkboxes
$("#select_all").click(function(){
    if ($('input#select_all').is(':checked')) {
        $(':checkbox.selection_box').prop('checked', true); 
        cb_count = $('.selection_box').length;
    } else {
        $(':checkbox.selection_box').prop('checked', false);   
        cb_count = 0;
    }
    cb_count > 0 ? action_btn.style.right = "0" : action_btn.style.right = "-10%";
});
$('.selection_box').change(function(){
    cb_count = $('.selection_box').filter(':checked').length;
    if (cb_count == $('.selection_box').length){
        $('#select_all').prop('checked', true);   
    } else {
        $('#select_all').prop('checked', false);   
    }
});


//Create Inventory & add books
function Crud_Inventory(type){
    event.preventDefault();
    switch (type){
        case 1:
            type = "Inventory";
            operation = "create";
            break;
        case 2:
            type = "Book";
            operation = "create";
            break;
        case 3:
            type = "Inventory_display";
            operation = "delete";
            break;
        case 4:
            type = "Inventory_display";
            operation = "activate";
            break;
        case 5:
            type = "Inventory_display";
            operation = "deactivate";
            break;
        default:
            break;
    }
    serialize =  $("#" + type + "_form").serialize() +"&FormType="+type+"_"+operation;
    if (type == "Inventory" || type == "Book") {$('#' + type + "_btn").text('Processing...');}
    $.ajax({
    type: "POST",
    url: url,
    data: serialize,
        success: function(message){
            if (type == "Inventory" || type == "Book") {
                type == "Inventory" ? $('#' + type + "_btn").text('Create Inventory') : $('#' + type + "_btn").text('Add Book');
            }
            if (message.match(/success:/g)){
                setTimeout(function(){$('body').load(window.location.href + '#body')}, 5000);
            }
            popup(message);
        }
    });
}


//Uploader
function Uploader(type){
    switch (type){
        case 1:
            type = "Inventory";
            operation = "cover";
            break;
        default:
            break;
    }
    event.preventDefault();
    serialize = new FormData($("#"+type+"_form")[0]);
    serialize.append('FormType', type+"_"+operation);
    $.ajax({
    type: "POST",
    url: url,
    data: serialize,
    cache: false,
    contentType: false,
    processData: false,
    success: function(message){
            if (message.match(/success:/g)){
                setTimeout(function(){$('body').load(window.location.href + '#body')}, 5000);
            }
            popup(message);
        }
    });
}
