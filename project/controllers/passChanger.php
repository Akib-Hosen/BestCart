<?php
session_start();
require_once('../models/userModel.php');


if (!isset($_SESSION['email'])) {
    header("Location: ../views/login.php");
    exit;

}


if (isset($_POST['submit'])) {
    
    $email = $_SESSION['email'];  
    $currentPassword = $_POST['currentPassword'];  
    $newPassword = $_POST['newPass'];  
    $confirmPassword = $_POST['confirmPass'];  


    $user = ['email' => $email, 'password' => $currentPassword];
    $status = login($user);  

    if ($status) {
        
        $updateStatus = updatePassword($email, $newPassword);

        if ($updateStatus) {
            echo "Password successfully updated!";
            header("Location: ../views/profile.php");  
            exit;
        } else {
            echo "Error updating the password.";
        }
    } 
    else {
        echo "Incorrect current password.";
    }
} 
else {
    header("Location: ../views/login.php");
    exit;
}
?>
