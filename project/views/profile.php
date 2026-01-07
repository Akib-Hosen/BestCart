<?php

include('../controllers/authCheck.php');
require_once('../models/userModel.php');


if(!isset($_SESSION['email'])){
    header("Location: ../views/login.php");
    exit;
}

$email = $_SESSION['email'];


$con = getConnection();
$sql = "SELECT username, phone, gender, address, email 
        FROM userinfo WHERE email='$email'";

$result = mysqli_query($con, $sql);

if(mysqli_num_rows($result) == 1){
    $currentUserData = mysqli_fetch_assoc($result);
}else{
    
    $currentUserData = [
        'username' => '',
        'email' => $email,
        'phone' => '',
        'address' => '',
        'gender' => ''
    ];
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/profileStyle.css">
    <title>Profile</title>
</head>

<body style="margin: 0;">

<nav class="pink">
    <a class="navLink" href="../views/home.php">Home</a>
    <a class="navLink" href="#">Help & Support</a>
</nav>

<section class="logoArea">
    <div class="logo">
        <img src="../assets/cart.png" height="70px">
        <h1>BestCart</h1>
    </div>
</section>

<section id="center">

<div class="options">
    <div>
        <p>My Profile</p>
        <a class="option" id="logout" href="../controllers/logout.php">Logout</a>
    </div>
</div>


<div id="optionDetails">
    <h2>My profile</h2>

    <div class="myProfile">

        <div>
            <h3>My full name</h3>
            <p><?php echo $currentUserData['username']; ?></p>

            <h3>Gender</h3>
            <p><?php echo $currentUserData['gender']; ?></p>

            <h3>Phone Number</h3>
            <p><?php echo $currentUserData['phone']; ?></p>
        </div>

        <div>
            <h3>My address</h3>
            <p><?php echo $currentUserData['address']; ?></p>

            <h3>Email</h3>
            <p><?php echo $currentUserData['email']; ?></p>
        </div>

    </div>


    
    <div class="btnGrp">

        <a href="../views/changePassword.php">
            <button class="profileBtn">
                <i class="hgi hgi-stroke hgi-key-01"></i>
                Change Password
            </button>
        </a>

        <a href="../views/editProfile.php">
            <button class="profileBtn">
                <i class="hgi hgi-stroke hgi-edit-02"></i>
                Edit Profile
            </button>
        </a>

    </div>

</div>

</section>

</body>
</html>
