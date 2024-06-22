<?php
// File upload handling
function aploads($files){
    global $uploadOk, $targetFile ;
    $targetDir = "../uploads/"; // Directory where uploaded files will be stored
    $targetFile = $targetDir . basename($files);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));
    
    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($files);
        if($check !== false) {
            // File is an image
            $uploadOk = 1;
        } else {
            // File is not an image
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }
    
    // Check if file already exists
    
    
    // Allow certain file formats (optional)
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
}


?>