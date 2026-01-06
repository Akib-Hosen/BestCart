<?php


function uploadImage($file) {
   
    if (!isset($file['name']) || $file['name'] == "") {
        return "default.png"; 
    }

   
    $targetDir = "../uploads/";

    
    $fileName = time() . "_" . basename($file['name']);
    $targetFile = $targetDir . $fileName;

   
    if (move_uploaded_file($file['tmp_name'], $targetFile)) {
        return $fileName; 
    } else {
        return "default.png"; 
    }
}
?>