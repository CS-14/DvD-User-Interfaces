<?php
if (isset($_POST['submit'])) 
{
  header('Location:registerform.php');
}
?>

<!DOCTYPE html>
<html>
<head>
<title>example Page</title>
<link rel ="stylesheet" href ="css/style.css">

</head>
<body style ="background-image: url('image/im1.jpg');">
<div class="container">
    <div>
    <center>
      <h2>Login Form</h2>
      <img src ="image/avatar.png" class ="avatar" />
    </center>
    <form class ="myform" action ="example.php" method ="post">
        <label><b>Username:</b></label><br>
        <input type ="text" class = "inputvalues" placeholder="Type your username"/><br>
        <label><b>Password:</b></label><br>
        <input type ="password" class ="inputvalues" placeholder="Type your password"/><br>
        <input type ="submit" name ="submit"id = "login_btn" value="Login"/><br>
        <input type ="button" id = "register_btn" value ="Register"/>
    </form>
    </div>
</div>

  


</body>
</html>
