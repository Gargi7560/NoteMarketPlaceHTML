<?php

    //Settings from Config file
    include '../common/configuration.php';

    //Session start
    include 'manage_user_session.php';

    global $error;
    $current_note_id = 0;
    $attachment_folder_name = "";
    
    //Import database configuration
    require_once("../common/dbcontroller.php");
	$db_handle = new DBController();
    
    if(!empty($_GET["note_id"]) && $_GET["note_id"] > 0){
        $current_note_id = $_GET["note_id"];
        $folder_name = $uploadPath.$_SESSION['user_id']."/".$current_note_id."/";
        
        $note_detail_query = "SELECT NoteDetailID,SellerID,StatusID,ActionByID, AdminRemarks,PublishedDate,Title,CategoryID,DisplayPicture,NoteTypeID,NumberOfPages,Description,UniversityName,CountryID,Course,CourseCode,Professor,SellingModeID,SellingPrice,NotesPreview FROM notedetails WHERE NoteDetailID = ".$_GET["note_id"]." AND SellerID = ". $_SESSION['user_id'];
        
        $note_detail_result = $db_handle->runQuery($note_detail_query);
        
        if(!empty($note_detail_result)){
            $note_attachment_query = "SELECT NotesAttachmentID,NoteDetailID,FileName,FilePath FROM notesattachments WHERE NoteDetailID = ".$_GET["note_id"];

            $note_attachment_result = $db_handle->runQuery($note_attachment_query);

            $All_note_attachment = "";

            if(!empty($note_attachment_result)){
                foreach($note_attachment_result as  $item){
                    if(empty($All_note_attachment)){
                        $All_note_attachment = str_replace($folder_name,"",$item['FileName']);                   
                    } else{
                        $All_note_attachment = $All_note_attachment." ". str_replace($folder_name,"",$item['FileName']);   
                    }                       
                }       
            }
        }
    }

    if(isset($_REQUEST['save'])){
    
    //Server Side Validation
    function validate() {
        $error=0;
        $errorMessages = [];
                
        if(isset($_POST['title'])){            
            $title=$_POST['title'];
            if($title==""){
                $error=1;
                $errorMessages[] = 'Please fill the title field.';
            }
        }
        if(isset($_POST['catType'])){
            $catType=$_POST['catType'];
            if($catType==""){
                $error=1;
                $errorMessages[] = 'Please fill the category type.';
            }
        }
        if(isset($_POST['hdnDisplayPicPath']) && empty($_POST['hdnDisplayPicPath'])){
            if(isset($_FILES['displayPicture']['name'])){
                if (!empty($_FILES['displayPicture']['name'])){
                    if(!empty($_FILES['displayPicture']['type']) && $_FILES['displayPicture']['type'] != 'image/jpeg' && $_FILES['displayPicture']['type'] != 'image/jpg' && $_FILES['displayPicture']['type'] != 'image/png') {
                        $error=1;
                        $errorMessages[] = 'Please upload jpeg, jpg, png files only.';
                    }     
                }
            }
        }
        if(isset($_POST['hdnUploadNotePath']) && empty($_POST['hdnUploadNotePath'])){
            if(isset($_FILES['uploadNote']['name'])){
                //$uploadNote=$_FILES['uploadNote']['name'];
                if (empty($_FILES['uploadNote']['name'][0])){
                    $error=1;
                    $errorMessages[] = 'Please upload files.';
                }
                else {

                    foreach($_FILES['uploadNote']['name'] as $key => $tmp_name)
                    {                    
                        if(!empty($_FILES['uploadNote']['type'][$key]) && $_FILES['uploadNote']['type'][$key] != 'application/pdf'){                                   
                        $error=1;
                        $errorMessages[] = 'Please upload pdf files only.';
                            break;
                        }
                    }

                }
            }
        }
        if(isset($_POST['description'])){
            $description=$_POST['description'];
            if($description==""){
                $error=1;
                $errorMessages[] = 'Please write the description for your notes';
            }
        }
        if(isset($_POST['sellPrice'])){
            $sellPrice=$_POST['sellPrice'];
            if($sellPrice==""){
                $error=1;
                $errorMessages[] = 'Please write the price for notes';
            }
        }
        if($error){
            return $errorMessages;
            
        } else{
            $errorMessages[] = 'success';
            return $errorMessages;        
        }
    }
    }

    if(isset($_REQUEST['save'])){
        
    $validate = validate();

    if($validate[0] == 'success'){
        unset($validate);
        if(isset($_POST['title'],$_POST['catType'],$_POST['selectType'],$_POST['numPage'],$_POST['description'],$_POST['country'],$_POST['insName'],$_POST['courseName'],$_POST['courseCode'],$_POST['ProfName'],$_POST['sellFor'],$_POST['sellPrice'])) {
        
            $title = $_POST['title'];
            $catType = $_POST['catType'];
            $selectType = !empty($_POST['selectType']) && (int)$_POST['selectType'] > 0 ? $_POST['selectType'] : "NULL";
            $numPage = $_POST['numPage'];
            $description = $_POST['description'];
            $country = !empty($_POST['country']) && (int)$_POST['country'] > 0  ? $_POST['country'] : "NULL";
            $insName = $_POST['insName'];
            $courseName = $_POST['courseName'];
            $courseCode = $_POST['courseCode'];
            $ProfName = $_POST['ProfName'];
            $sellFor = $_POST['sellFor'];
            $sellPrice = $_POST['sellPrice'];
           
            $current_note_id = $_POST['current_note_id'];
           
            if($current_note_id == 0){
            
                $query = "INSERT INTO notedetails (SellerID,StatusID,ActionByID,Title,CategoryID,NoteTypeID,NumberOfPages,Description,UniversityName,CountryID,Course,CourseCode,Professor,SellingModeID,SellingPrice,CreatedDate,CreatedBy,ModifiedDate,ModifiedBy,IsActive) VALUES
                (".$_SESSION['user_id'].",".$draftID.",".$defaultUserID.",'".$title."',".$catType.",".$selectType.",'".$numPage."','".$description."','".$insName."',".$country.",'".$courseName."','".$courseCode."','".$ProfName."','".$sellFor."','".$sellPrice."',NOW(),'".$_SESSION['user_id']."',NOW(),'".$_SESSION['user_id']."',1) " ;
            
                $current_note_id = $db_handle->insertQuery($query);
                
                if(!empty($current_note_id)){

                    $new_Display_Pic_File_Name = "";
                    $full_Note_Upload_Files = "";
                    $new_Note_Preview_Name = "";
                    $folder_name = $uploadPath.$_SESSION['user_id']."/".$current_note_id."/";
                    if (!file_exists($folder_name)) {
                            mkdir($folder_name);
                    }
                    /*Upload Display Picture*/
                    if(!empty($_FILES['displayPicture']['name'])){
                        $path_parts = pathinfo($_FILES['displayPicture']['name']);
                        $display_Pic_Extension = $path_parts['extension']; 
                         $new_Display_Pic_File_Name=$folder_name."DP_Note_".$current_note_id .".".$display_Pic_Extension;

                        if (!move_uploaded_file($_FILES['displayPicture']['tmp_name'], $new_Display_Pic_File_Name)) {
                            $validate[] = "Display Picture Upload Failed!";
                        }    
                    } else {
                        
                        $defaultDisplayPicQuery = "SELECT `Key` ,`Value`  FROM systemconfiguration WHERE `Key` = 'DefaultDisplayPicture'";

                        $defaultDisplayPicResult = $db_handle->runQuery($defaultDisplayPicQuery);
                        
                        $path_parts = pathinfo($defaultDisplayPicResult[0]['Value']);
                        
                        $display_Pic_Extension = $path_parts['extension']; 
                         $new_Display_Pic_File_Name=$folder_name."DP_Note_".$current_note_id .".".$display_Pic_Extension;

                        if (!copy($defaultDisplayPicResult[0]['Value'], $new_Display_Pic_File_Name)) {
                            $validate[] = "Display Picture Upload Failed!";
                        }
                    }

                    /*Upload Notes*/
                    if(!empty($_FILES['uploadNote']['name'])){
                        $uploadNote_cnt = 0;
                         
                        $attachment_folder_name = $folder_name."Attachments/";    
                            if (!file_exists($attachment_folder_name)) {
                            mkdir($attachment_folder_name);
                        }
                        foreach($_FILES['uploadNote']['name'] as $key => $tmp_name){                    
                            if(!empty($_FILES['uploadNote']['name'][$key])){

                            $uploadNote_cnt++; 
                            $path_parts = pathinfo($_FILES['uploadNote']['name'][$key]);

                            $upload_Notes_Extension = $path_parts['extension'];              
                            $new_Upload_Pdf_File_Name = "UN_".$uploadNote_cnt."_User_".$_SESSION['user_id']."_Note_".$current_note_id .".".$upload_Notes_Extension;

                            if (!move_uploaded_file($_FILES['uploadNote']['tmp_name'][$key], $attachment_folder_name.$new_Upload_Pdf_File_Name)) {
                                $validate[] = "Notes Upload Failed!";
                            } 
                            $multipleNotes[] = $attachment_folder_name.$new_Upload_Pdf_File_Name;
                            }
                        }
                    }
                
                    /*Note Preview*/
                    if(!empty($_FILES['notePre']['name'])){
                        $path_parts = pathinfo($_FILES['notePre']['name']);
                        $note_Preview_Extension = $path_parts['extension'];             
                        $new_Note_Preview_Name=$folder_name."NP_Note_".$current_note_id .".".$note_Preview_Extension;

                        if (!move_uploaded_file($_FILES['notePre']['tmp_name'], $new_Note_Preview_Name)) {
                            $validate[] = "Note Preview Upload Failed!";
                        } 
                    }
                
                    //Update Path in to DB.
                    if(!empty($new_Display_Pic_File_Name) || !empty($multipleNotes) || !empty($note_Preview_Extension)) {

                        $sql = "UPDATE notedetails set DisplayPicture = '".$new_Display_Pic_File_Name."' ,NotesPreview = '".$new_Note_Preview_Name."' WHERE NoteDetailID=" . $current_note_id;

                        $count = $db_handle->updateQuery($sql); 

                        foreach($multipleNotes as $value){
                            $only_File_Name = str_replace($attachment_folder_name, "", $value);

                            $multipleSql = "INSERT INTO notesattachments (NoteDetailID, FileName, FilePath, CreatedDate, CreatedBy, ModifiedDate, ModifiedBy, IsActive) VALUES(".$current_note_id.",'".$only_File_Name."','".$value."',NOW(),'".$defaultUserID."',NOW(),'".$defaultUserID."',1) ";
                            $current_note_attachment_id = $db_handle->insertQuery($multipleSql);
                        }
                    }
                    $message = "successfully inserted!";
                
                    $note_edit_link = $http_protocol.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/add_notes.php?note_id=" . $current_note_id;
                    header("location:".$note_edit_link);  
                } else {
                    $validate[] = "insert again!";
                }
            } else{
                $updateQuery = "UPDATE notedetails SET Title = '".$title."' ,CategoryID = ".$catType." ,NoteTypeID = ".$selectType." ,NumberOfPages = '".$numPage."' ,Description = '".$description."' ,CountryID = ".$country." ,UniversityName = '".$insName."' ,Course = '".$courseName."' ,CourseCode = '".$courseCode."' ,Professor = '".$ProfName."' ,SellingModeID = ".$sellFor." ,SellingPrice = '".$sellPrice."' WHERE NoteDetailID = ".$current_note_id;
                
                $update_note_id = $db_handle->updateQuery($updateQuery);
            
                $folder_name = $uploadPath.$_SESSION['user_id']."/".$current_note_id."/";
                
                if (!file_exists($folder_name)) {
                    mkdir($folder_name);
                }
                /*Update Display Picture*/
                if(isset($_POST['hdnDisplayPicPath']) && empty($_POST['hdnDisplayPicPath'])){
                    if(!empty($_FILES['displayPicture']['name'])){
                        $path_parts = pathinfo($_FILES['displayPicture']['name']);
                        $display_Pic_Extension = $path_parts['extension']; 
                         $new_Display_Pic_File_Name=$folder_name."DP_Note_".$current_note_id .".".$display_Pic_Extension;

                        if (!move_uploaded_file($_FILES['displayPicture']['tmp_name'], $new_Display_Pic_File_Name)) {
                            $validate[] = "Display Picture Upload Failed!";
                        } 
                    }
                    $sqlUpdateDisplayPic = "UPDATE notedetails set DisplayPicture = '".$new_Display_Pic_File_Name."'  WHERE NoteDetailID=" . $current_note_id;

                    $sqlUpdateDisplayPicResult = $db_handle->updateQuery($sqlUpdateDisplayPic); 
                }
                
                /*Update Note Preview*/
                if(isset($_POST['hdnNotePrePath']) && empty($_POST['hdnNotePrePath'])){
                    if(!empty($_FILES['notePre']['name'])){
                        $path_parts = pathinfo($_FILES['notePre']['name']);
                        $note_Preview_Extension = $path_parts['extension'];             
                        $new_Note_Preview_Name=$folder_name."NP_Note_".$current_note_id .".".$note_Preview_Extension;

                        if (!move_uploaded_file($_FILES['notePre']['tmp_name'], $new_Note_Preview_Name)) {
                            $validate[] = "Note Preview Upload Failed!";
                        } 
                    }
                    $sqlNotePreview = "UPDATE notedetails set NotesPreview = '".$new_Note_Preview_Name."' WHERE NoteDetailID=" .$current_note_id;

                    $sqlNotePreviewResult = $db_handle->updateQuery($sqlNotePreview); 
                }
                
                /*Update Upload Notes*/
                if(isset($_POST['hdnUploadNotePath']) && empty($_POST['hdnUploadNotePath'])){
                    if(!empty($_FILES['uploadNote']['name'])){
                        $uploadNote_cnt = 0;

                        $attachment_folder_name = $folder_name."Attachments/";    
                            if (!file_exists($attachment_folder_name)) {
                            mkdir($attachment_folder_name,0777,true);
                            }
                        $files = glob($attachment_folder_name.'/*');  
                            foreach($files as $file) { 
                                if(is_file($file))  
                                    unlink($file);  
                            } 
                        foreach($_FILES['uploadNote']['name'] as $key => $tmp_name){                    
                            if(!empty($_FILES['uploadNote']['name'][$key])){

                            $uploadNote_cnt++; 
                            $path_parts = pathinfo($_FILES['uploadNote']['name'][$key]);
                            $upload_Notes_Extension = $path_parts['extension'];              
                            
                            $new_Upload_Pdf_File_Name = "UN_".$uploadNote_cnt."_User_".$_SESSION['user_id']."_Note_".$current_note_id .".".$upload_Notes_Extension;

                            if (!move_uploaded_file($_FILES['uploadNote']['tmp_name'][$key], $attachment_folder_name.$new_Upload_Pdf_File_Name)){
                                $validate[] = "Notes Upload Failed!";
                            } 
                            $multipleNotes[] = $attachment_folder_name.$new_Upload_Pdf_File_Name;
                            }
                        }
                    }
                    $sqlDeleteAttachment = "DELETE FROM notesattachments WHERE NoteDetailID = ".$current_note_id;
                
                    $Delete_all = $db_handle->deleteQuery($sqlDeleteAttachment);
                    
                    foreach($multipleNotes as $value){
                        $only_File_Name = str_replace($attachment_folder_name, "", $value);
                        
                        $multipleSql = "INSERT INTO notesattachments (NoteDetailID, FileName, FilePath, CreatedDate, CreatedBy, ModifiedDate, ModifiedBy, IsActive) VALUES(".$current_note_id.",'".$only_File_Name."','".$value."',NOW(),'".$defaultUserID."',NOW(),'".$defaultUserID."',1) ";
                        $current_note_attachment_id = $db_handle->insertQuery($multipleSql);
                        
                    }
                }
                
                $note_edit_link = $http_protocol.$_SERVER[HTTP_HOST].dirname($_SERVER['PHP_SELF'])."/add_notes.php?note_id=" . $current_note_id;
                header("location:".$note_edit_link);   
            }
        } else {
            echo 'Data not inserted';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <!--important meta tags-->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--Title-->
    <title>Notes MarketPlace</title>

    <!--Favicon-->
    <link rel="shortcut icon" href="images/login/favicon.ico">

    <!--JQuery-->
    <script src="js/jquery.min.js"></script>

    <!--Popper JS-->
    <script src="js/popper/popper.min.js"></script>

    <!--Bootstrap JS-->
    <script src="js/bootstrap/bootstrap.min.js"></script>

    <!-- Custom JS -->
    <script src="js/script.js"></script>

    <!--Google Fonts-->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">

    <!--Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">

    <!--Custom CSS-->
    <link rel="stylesheet" href="css/style.css">

    <!--Responsive CSS-->
    <link rel="stylesheet" href="css/responsive.css">

    <script type="text/javascript">
        
        reOnlyAlphabet = /^[A-Za-z]+$/;
        reForEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        reForPassword = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[#$@!%&*?])[A-Za-z\d#$@!%&*?]{6,24}$/;
        
        function validateTitle() {

            isValidTitle = false;

            if ($("#title").val() == "" || $("#title").val() == null) {
                $("#title").focusin();
                $("#title").addClass("borderHighlight");
                $("#titleVal").css("visibility", "visible");
                $("#titleVal").html("Please fill out this field.");
                isValidTitle = false;
            } else {
                $("#title").removeClass("borderHighlight");
                $("#titleVal").css("visibility", "hidden");
                isValidTitle = true;
            }
            return isValidTitle;
        }

        function validateCatType() {

            isValidCatType = false;

            if ($("#catType").val() == 0) {
                $("#catType").focusin();
                $("#catType").addClass("borderHighlight");
                $("#catTypeVal").css("visibility", "visible");
                $("#catTypeVal").html("Please select anyone.");
                isValidCatType = false;
            } else {
                $("#catType").removeClass("borderHighlight");
                $("#catTypeVal").css("visibility", "hidden");
                isValidCatType = true;
            }
            return isValidCatType;
        }

        function validateDisplayPicture() {

            isValidDisplayPicture = false;

            if ($("#hdnDisplayPicPath").val() == "") {
                if ($("#displayPicture")[0].files.length != 0) {
                    var ext = $('#displayPicture').val().split('.').pop().toLowerCase();
                    if ($.inArray(ext, ['png', 'jpg', 'jpeg']) == -1) {
                        $("#displayPicture").addClass("borderHighlight");
                        $("#displayPictureVal").css("visibility", "visible");
                        $("#displayPictureVal").html("Please upload jpg, jpeg, png files.");
                        isValidDisplayPicture = false;
                    } else {
                        $("#displayPicture").removeClass("borderHighlight");
                        $("#displayPictureVal").css("visibility", "hidden");
                        isValidDisplayPicture = true;
                    }
                } else {
                    $("#displayPicture").removeClass("borderHighlight");
                    $("#displayPictureVal").css("visibility", "hidden");
                    isValidDisplayPicture = true;
                }
            } else {
                $("#displayPicture").removeClass("borderHighlight");
                $("#displayPictureVal").css("visibility", "hidden");
                isValidDisplayPicture = true;
            }
            return isValidDisplayPicture;
        }

        function validateNotes() {

            isValidNotes = false;
            var ext = $('#uploadNote').val().split('.').pop().toLowerCase();

            if ($("#hdnUploadNotePath").val() == "") {
                if ($("#uploadNote")[0].files.length == 0) {
                    //$("#uploadNote").focusin();
                    $("#uploadNote").addClass("borderHighlight");
                    $("#uploadNoteVal").css("visibility", "visible");
                    $("#uploadNoteVal").html("Please upload files.");
                    isValidNotes = false;
                } else if ($.inArray(ext, ['pdf']) == -1) {
                    $("#uploadNote").addClass("borderHighlight");
                    $("#uploadNoteVal").css("visibility", "visible");
                    $("#uploadNoteVal").html("Please upload pdf files.");
                    isValidNotes = false;
                } else {
                    $("#uploadNote").removeClass("borderHighlight");
                    $("#uploadNoteVal").css("visibility", "hidden");
                    isValidNotes = true;
                }
            } else {
                $("#uploadNote").removeClass("borderHighlight");
                $("#uploadNoteVal").css("visibility", "hidden");
                isValidNotes = true;
            }
            return isValidNotes;
        }

        function validateDescription() {

            isValidDescription = false;

            if ($("#description").val() == "" || $("#description").val() == null) {
                $("#description").focusin();
                $("#description").addClass("borderHighlight");
                $("#descriptionVal").css("visibility", "visible");
                $("#descriptionVal").html("Please fill the description field.");
                isValidDescription = false;
            } else {
                $("#description").removeClass("borderHighlight");
                $("#descriptionVal").css("visibility", "hidden");
                isValidDescription = true;
            }
            return isValidDescription;
        }

        function validateSellPrice() {

            isValidSellPrice = false;

            if ($("#sellPrice").val() == "" || $("#sellPrice").val() == null) {
                $("#sellPrice").focusin();
                $("#sellPrice").addClass("borderHighlight");
                $("#sellPriceVal").css("visibility", "visible");
                $("#sellPriceVal").html("Please fill the sell price.");
                isValidSellPrice = false;
            } else {
                $("#sellPrice").removeClass("borderHighlight");
                $("#sellPriceVal").css("visibility", "hidden");
                isValidSellPrice = true;
            }
            return isValidSellPrice;
        }

        function validateAddNoteForm() {

            isvalidAddNoteForm = false;

            isValidTitle = validateTitle();
            isValidCatType = validateCatType();
            isValidDisplayPicture = validateDisplayPicture();
            isValidNotes = validateNotes();
            isValidDescription = validateDescription();
            isValidSellPrice = validateSellPrice();
            //isValidNotePreview = validateNotePreview();

            if (isValidTitle && isValidCatType && isValidDisplayPicture && isValidNotes && isValidDescription && isValidSellPrice) {
                isvalidAddNoteForm = true;
            }
            return isvalidAddNoteForm;
        }
        
        function updateNoteStatus(noteID) {
            $.ajax({
                type: "GET",
                url: "changeNoteStatus.php",
                data: {
                    noteID: noteID
                },
                success: function(data) {
                    $("#updateNoteModal").modal('toggle');
                    window.location.replace("user_dashboard-1.php");
                }
            });
        }
        $(document).ready(function() {
            $('input[type=file]').change(function() {
                if ($(this)[0].files.length > 0) {
                    filename = "";
                    $.each($(this)[0].files, function(index, item) {
                        filename += item.name + "   ";
                    });
                    $(this).parent().find('.filename').html(filename);
                } else {
                    $(this).parent().find('.filename').html("");
                }
                $(this).parent().find('input[type=hidden]').val("");
            });
        });
    </script>
</head>

<body data-spy="scroll" class="overflow-auto sticky-header">
    <div class="wrapper">

        <!--Header Start-->
        <?php include 'sticky_header.php';?>
        <!--Header End-->

        <!--Add Notes Start-->
        <section id="add_notes">
            <div class="common-top pad_100_for_pages">
                <div class="content-box-lg">
                    <div class="container">
                        <span class="common-heading-1 center_heading-1 main_heading">Add Notes</span>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="content-box-sm">

                    <?php if(isset($message)){ ?>
                    <p class="successMsg"><img src="images/login/SUCCESS.png" alt="success">
                        <?php echo $message ;?>
                    </p>
                    <?php } ?>
                    <?php
                    if(isset($validate) && $validate[0] != 'success'){
                            foreach($validate as $error){
                    ?>
                    <p style="color:#ea4748"><?php echo $error ; ?></p>
                    <?php
                            }
                        }
                    ?>
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" id="dd1" method="POST" enctype="multipart/form-data" onsubmit="return validateAddNoteForm();">
                        <input type="hidden" name="current_note_id" value="<?php echo $current_note_id;?>" />
                        <span class="common-heading-1 left_heading-1 common-head-pad">Basic Note Details</span>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group form-common">
                                    <label for="title">Title * </label>
                                    <input type="text" class="form-control input_val" id="title" name="title" <?php if($current_note_id != 0){
                                        echo " value ='".$note_detail_result[0]["Title"]."'";
                                    }
                                    ?> placeholder="Enter your first notes title" onblur="validateTitle();">

                                    <span id="titleVal" class="spnValMsg"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-common">
                                    <label for="catType">Category *</label>
                                    <?php 
                                    
                                    $categoryQuery = "SELECT NoteCategoryID,  CategoryName FROM notecategories";
                                    $categoryResult = $db_handle->runQuery($categoryQuery);
                                    
                                    ?>
                                    <select class="form-control dropdown-control" id="catType" name="catType" onblur="validateCatType();">

                                        <option value="0">Select your category</option>

                                        <?php                   
                                            foreach($categoryResult as $categoryRow){
                                                echo "<option value='" . $categoryRow['NoteCategoryID']."'";
                                            
                                                if($current_note_id != 0 && !empty($note_detail_result[0]["CategoryID"]) && $note_detail_result[0]["CategoryID"] > 0 && $categoryRow['NoteCategoryID'] == $note_detail_result[0]["CategoryID"]){
                                                    echo " selected";
                                                }
                                                echo ">".$categoryRow['CategoryName']."</option>";
                                            }
                                        ?>
                                    </select>
                                    <span id="catTypeVal" class="spnValMsg"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-common">
                                    <label for="displayPicture">Display Picture</label>
                                    <input type="file" class="form-control input_val" id="displayPicture" name="displayPicture" accept="image/jpg,image/png,image/jpeg" onsubmit="return validateDisplayPicture();" />
                                    <label class="picture_bottom">Upload a picture</label>
                                    <?php 
                                        if($current_note_id != 0 && !empty($note_detail_result[0]["DisplayPicture"])){
                                            echo '<input type="hidden" name="hdnDisplayPicPath" id="hdnDisplayPicPath" value = "'.$note_detail_result[0]["DisplayPicture"].'"/>
                                        <span class="filename" style="float:left;">'.str_replace($folder_name,"",$note_detail_result[0]["DisplayPicture"]).'</span>';
                                        } else{
                                             echo '<input type="hidden" name="hdnDisplayPicPath" id="hdnDisplayPicPath"/>
                                            <span class="filename" style="float:left;"></span>';
                                        }
                                    ?>
                                    <span id="displayPictureVal" class="spnValMsg"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-common">
                                    <label for="uploadNote">Upload Notes *</label>
                                    <input type="file" class="form-control input_val" id="uploadNote" name="uploadNote[]" accept="application/pdf" onsubmit="return  (validateNotes());" multiple>
                                    <label class="picture_bottom">Upload your notes</label>
                                    <?php if($current_note_id != 0 && !empty($All_note_attachment)){           
                                        echo '<input type="hidden" name="hdnUploadNotePath" id="hdnUploadNotePath" value = "'.$All_note_attachment.'"/>
                                        <span class="filename" style="float:left;">'.$All_note_attachment.'</span>';
                                        } else {
                                            echo '<input type="hidden" name="hdnUploadNotePath" id="hdnUploadNotePath"/>
                                            <span class="filename" style="float:left;"></span>';
                                        }
                                    ?>
                                    <span id="uploadNoteVal" class="spnValMsg"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-common">
                                    <label for="selectType">Type</label>
                                    <?php 
                                    
                                    $typeQuery = "select NoteTypeID,  TypeName from notetypes";
                                    $typeResult = $db_handle->runQuery($typeQuery);
                                    
                                    ?>
                                    <select class="form-control dropdown-control" id="selectType" name="selectType">
                                        <option value="0">Select your note type</option>
                                        <?php                   
                                            foreach($typeResult as $typeRow){
                                                echo "<option value='" . $typeRow['NoteTypeID'] . "'";
                                                if($current_note_id != 0 && !empty($note_detail_result[0]["NoteTypeID"]) && $note_detail_result[0]["NoteTypeID"] > 0 && $typeRow['NoteTypeID'] == $note_detail_result[0]["NoteTypeID"]){
                                                    echo " selected";
                                                }
                                                echo ">".$typeRow['TypeName']."</option>";
                                            }
                                        ?>
                                    </select>
                                    <span class="spnValMsg"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-common">
                                    <label for="numPage">Number of Pages </label>
                                    <input type="text" class="form-control input_val" id="numPage" name="numPage" 
                                        <?php if($current_note_id != 0 && !empty($note_detail_result[0]["NumberOfPages"]) && $note_detail_result[0]["NumberOfPages"] > 0){
                                            echo " value =".$note_detail_result[0]["NumberOfPages"];
                                        }
                                        ?> placeholder="Enter number of note pages">

                                    <span class="spnValMsg"></span>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group form-common" id="big_text_area">
                                    <label for="description">Description *</label>
                                    <textarea class="form-control input_val" id="description" rows="5" name="description" placeholder="Enter your description" onblur="validateDescription();"><?php if($current_note_id != 0){
                                        echo $note_detail_result[0]["Description"];
                                        }
                                    ?></textarea>

                                    <span id="descriptionVal" class="spnValMsg"></span>
                                </div>
                            </div>
                        </div>
                        <br>
                        <span class="common-heading-1 left_heading-1 common-head-pad">Institution Information</span>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group form-common">
                                    <label for="country">Country</label>
                                    <?php 
                                    
                                    $countryQuery = "select CountryID,  CountryName from countries";
                                    $countryResult = $db_handle->runQuery($countryQuery);
                                    
                                    ?>
                                    <select class="form-control dropdown-control" id="country" name="country">
                                        <option value="0">Select your country</option>
                                        <?php                   
                                            foreach($countryResult as $countryRow){
                                                echo "<option value='" . $countryRow['CountryID'] . "'";
                                                if($current_note_id != 0 && !empty($note_detail_result[0]["CountryID"]) && $note_detail_result[0]["CountryID"] > 0 && $countryRow["CountryID"] == $note_detail_result[0]["CountryID"]){
                                                    echo " selected";
                                                }
                                                echo ">".$countryRow['CountryName']."</option>";
                                            }
                                        ?>
                                    </select>

                                    <span class="spnValMsg"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-common">
                                    <label for="insName">Institution Name</label>
                                    <input type="text" class="form-control input_val" id="insName" name="insName" 
                                    <?php 
                                        if($current_note_id != 0 && !empty($note_detail_result[0]["UniversityName"])){
                                            echo " value = '".$note_detail_result[0]['UniversityName']."'";
                                        }
                                    ?> placeholder="Enter your institution name">

                                    <span class="spnValMsg"></span>
                                </div>
                            </div>
                        </div>
                        <br>
                        <span class="common-heading-1 left_heading-1 common-head-pad">Course Details</span>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group form-common">
                                    <label for="courseName">Course Name</label>
                                    <input type="text" class="form-control input_val" id="courseName" name="courseName" 
                                    <?php 
                                        if($current_note_id != 0 && !empty($note_detail_result[0]["Course"])){
                                            echo " value = ".$note_detail_result[0]['Course'];
                                        }
                                    ?> placeholder="Enter your course name">

                                    <span class="spnValMsg"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-common">
                                    <label for="courseCode">Course Code</label>
                                    <input type="text" class="form-control input_val" id="courseCode" name="courseCode" 
                                    <?php 
                                        if($current_note_id != 0 && !empty($note_detail_result[0]["CourseCode"])){
                                            echo " value = ".$note_detail_result[0]['CourseCode'];
                                        }
                                    ?> placeholder="Enter your course code">
                                    <span class="spnValMsg"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-common">
                                    <label for="ProfName">Professor/Lecturer</label>
                                    <input type="text" class="form-control input_val" id="ProfName" name="ProfName" 
                                    <?php 
                                        if($current_note_id != 0 && !empty($note_detail_result[0]["Professor"]) && $note_detail_result[0]["Professor"] > 0){
                                            echo " value = '".$note_detail_result[0]['Professor']."'";
                                        }
                                    ?> placeholder="Enter your professor name">

                                    <span class="spnValMsg"></span>
                                </div>
                            </div>
                        </div>
                        <br>
                        <span class="common-heading-1 left_heading-1 common-head-pad">Selling Information</span>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group form-common">
                                    <label for="sellFor">Sell For *</label>
                                    <?php
                                        $sellForQuery = "SELECT ReferenceDataID,  Value, DataValue FROM referencedata WHERE ReferenceCategory = 'SellingMode'";
                                        $sellForResult = $db_handle->runQuery($sellForQuery);
                                    ?>
                                    <div class="radio_for_page">
                                        <?php                   
                                        foreach($sellForResult as $sellForRow){
                                            echo "<div class=\"form-check form-check-inline\">
                                            <input class=\"form-check-input\" type=\"radio\" value=\"".$sellForRow['DataValue']."\" name=\"sellFor\" 
                                            "; 
                                            if($current_note_id == 0 && $sellForRow['DataValue'] == $sellForFree){
                                                echo " checked ";
                                            } else if ($current_note_id != 0 && !empty($note_detail_result[0]["SellingModeID"]) && $note_detail_result[0]["SellingModeID"] == $sellForRow['DataValue'] ){
                                                echo " checked ";
                                            }
                                            echo "/>
                                            <label class=\"form-check-label\" for=\"sellFor\">".$sellForRow['Value']."</label>
                                            </div>";
                                        }
                                        ?>
                                    </div>

                                </div>
                                <div class="form-group form-common">
                                    <label for="sellPrice">Sell Price *</label>
                                    <input type="text" class="form-control input_val" name="sellPrice" id="sellPrice" 
                                    <?php if($current_note_id != 0 && !empty($note_detail_result[0]['SellingPrice']) ) {
                                        echo " value = ".$note_detail_result[0]['SellingPrice'];
                                    }
                                    ?> placeholder="Enter your price" onblur="validateSellPrice();">

                                    <span id="sellPriceVal" class="spnValMsg"></span>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-common">
                                    <label for="notePre">Note Preview</label>
                                    <input type="file" class="form-control input_val" id="notePre" accept="application/pdf"  name="notePre">
                                    <label class="picture_bottom_note">Upload a picture</label>
                                    <?php 
                                        if($current_note_id != 0 && !empty($note_detail_result[0]["NotesPreview"])){
                                            echo '<input type="hidden" name="hdnNotePrePath" id="hdnNotePrePath"  value = "'.$note_detail_result[0]["NotesPreview"].'"/>
                                            <span class="filename" style="float:left;">'.str_replace($folder_name,"",$note_detail_result[0]["NotesPreview"]).'</span>';
                                        } else{
                                            echo '<input type="hidden" name="hdnNotePrePath" id="hdnNotePrePath"/>
                                            <span class="filename" style="float:left;"></span>';
                                        }
                                    ?>
                                    <span class="spnValMsg"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="small-btn general-btn">
                                    <input type="submit" class="btn btn-outline-primary btn-purple" value="SAVE" name="save">

                                    <?php 
                                        if($current_note_id > 0 && $note_detail_result[0]["StatusID"] == $draftID) { ?>
                                        <input type="button" class="btn btn-outline-primary btn-purple" data-toggle="modal" data-target="#updateNoteModal" value="PUBLISH" name="publish">
                                    <?php 
                                        }
                                    ?>

                                </div>

                                <!-- Modal -->
                                <div class="modal fade" id="updateNoteModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true"><img src="images/Notes_Details/close.png" alt="close" class="close-btn"></span>
                                                </button>
                                                <div class="common_popup">
                                                    <h4 class="common-heading-1 center_heading-1">Are you sure you want to publish?</h4>
                                                    <p class="val_content">Publishing this note will send note to administrator for review, once administrator review and approve then this note will be published to portal. Press yes to continue.</p>
                                                    <input type="button" class="btn btn-outline-primary btn-purple" value="YES" name="updateStatus" id="updateStatus" onclick="updateNoteStatus(<?php echo $current_note_id;?>);">
                                                    <input type="button" class="btn btn-outline-primary btn-purple" data-dismiss="modal" value="CANCEL" class="close-btn">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
        <!--Add Notes End-->

        <!--Footer Start-->
        <?php include 'footer.php';?>
        <!--Footer End-->

    </div>


</body>

</html>