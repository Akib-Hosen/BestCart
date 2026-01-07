<?php
session_start();
require_once('../models/userModel.php'); 


if (!isset($_SESSION['email'])) {
    header("Location: ../views/login.php");  
    exit;
}


$email = $_SESSION['email'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $username = $_POST['username'];
    $phoneNumber = $_POST['phoneNumber'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];

    
    if (empty($username) || empty($phoneNumber) || empty($gender) || empty($address)) {
        echo "All fields are required.";
        exit();
    }

    
    $userData = [
        'email' => $email,
        'username' => $username,
        'phone' => $phoneNumber,
        'gender' => $gender,
        'address' => $address
    ];

    
    $insertStatus = insertOrUpdateProfile($userData);

    if ($insertStatus) {
        echo "Profile updated successfully!";
        
        header("Location: ../views/profile.php");
        exit();
    } else {
        echo "Error updating profile.";
    }
}


$currentUserData = getUserProfile($email);

?>