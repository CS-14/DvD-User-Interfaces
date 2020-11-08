<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
<title>Login Page</title>
<link rel ="stylesheet" href ="css/style.css">

</head>
<body style ="background-image: url('image/im1.jpg');">
  <div id ="main-wrapper">
    <center>
      <h2>Login Form</h2>
      <img src ="image/avatar.png" class ="avatar" />
    </center>
        
        <form class ="myform" action ="loginaction.php" method ="post">
        <p style ="color:red;text-align:center;font-weight: bold" ><?php if( $_SESSION['error'] == 1 )echo "Invalid Username / Password !";  ?></p>

        <label><b>Username:</b></label><br>
        <input type ="text" name ="username"  class = "inputvalues" placeholder="Type your username" required/><br>

        <label><b>Password:</b></label><br>
        <input type ="password" name ="password" class ="inputvalues" placeholder="Type your password" required/><br>

        <input type ="submit"  name ="loginbtn" id = "login_btn" value="Login"/><br>

        <input type ="submit" name ="backbtn" id = "back_btn" value ="Back"/>
    </form>
  </div>
</body>
</html>

