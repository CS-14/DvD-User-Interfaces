<!DOCTYPE html>
<html>
<head>
    <title>Registration Page</title>
    <link rel ="stylesheet" href ="css/style2.css">
    <link rel="stylesheet" href="css/dvd.css" >
    <link rel="stylesheet" href="css/GalleryMainPage.css" >
</head>
<body style ="background-image: url('image/Sherlock2.jpg');">
<header>
    <a href="#" class="logo"><h2>Sign-up</h2></a>
    <div class="toggleMenu" onmouseover="toggleMenu();"></div>
    <ul class="navigation">
        <li><a href="Home.php">Home</a></li>
        <li><a href="service.php" >Services</a></li>
        <li><a href="contact.php" >Contact</a></li>
        <li><a href="loginform.php" >Log-In</a></li>
        <li><a href="registerform.php" >Sign-Up</a></li>
    </ul>

</header>
<div id ="main-wrapper">
    <center>
        <img src ="image/avatar.png" class ="avatar" />
    </center>


    <form class ="myform" action ="registeraction.php"  method ="post">
        <p style ="color:red;text-align:center;font-weight: bold" ><?php if( $_SESSION['error'] == 1 )echo "Invalid Username / Password !";  ?></p>

        <label><b>First Name:</b></label><br>
        <input type ="text" name ="fname" class = "inputvalues" placeholder="Type your firstname"/><br>

        <label><b>Last Name:</b></label><br>
        <input type ="text" name ="lname" class = "inputvalues" placeholder="Type your lastname"/><br>

        <label><b>NIC:</b></label><br>
        <input type ="text" name ="uid" class = "inputvalues" placeholder="Type your NIC"/><br>

        <label><b>Email:</b></label><br>
        <input type ="text" name ="email" class = "inputvalues" placeholder="Type your email"/><br>

        <label><b>Telephone:</b></label><br>
        <input type ="text" name ="tele" class = "inputvalues" placeholder="Type your phone number"/><br>

        <label><b>Street Address:</b></label><br>
        <input type ="text" name ="straddr" class = "inputvalues" placeholder="Type your StreerAddress"/><br>

        <label><b>city:</b></label><br>
        <input type ="text" name ="city" class = "inputvalues" placeholder="Type your city"/><br>

        <label><b>Password:</b></label><br>
        <input type ="password" name ="pass" class ="inputvalues" placeholder="Type your password"/><br>

        <label><b>Confirm Password:</b></label><br>
        <input type ="password" name ="repass" class ="inputvalues" placeholder="Type your password"/><br>


        <input type ="submit"  name ="submit" id = "signup_btn" value="Sign Up"/><br>



    </form>
</div>



</body>
</html>