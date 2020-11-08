<!DOCTYPE html>
<html>
<head>
<title>Registration Page</title>
<link rel ="stylesheet" href ="css/style.css">

</head>
<body style ="background-image: url('image/im1.jpg');">
  <div id ="main-wrapper">
    <center>
      <h2>Registration Form</h2>
      <img src ="image/avatar.png" class ="avatar" />
    </center>
  

    <form class ="myform" action ="registeraction.php"  method ="post">
        <label><b>User Type:</b></label><br>
        <input type ="text" name ="utype" class = "inputvalues" placeholder="If you are a customer enter as customer"/><br>

        <label><b>First Name:</b></label><br>
        <input type ="text" name ="fname" class = "inputvalues" placeholder="Type your firstname"/><br>

        <label><b>Last Name:</b></label><br>
        <input type ="text" name ="lname" class = "inputvalues" placeholder="Type your lastname"/><br>

        <label><b>Username:</b></label><br>
        <input type ="text" name ="uname" class = "inputvalues" placeholder="Type your username"/><br>

        <label><b>NIC:</b></label><br>
        <input type ="text" name ="uid" class = "inputvalues" placeholder="Type your NIC"/><br>

        <label><b>Email:</b></label><br>
        <input type ="text" name ="email" class = "inputvalues" placeholder="Type your email"/><br>

        <label><b>Telephone:</b></label><br>
        <input type ="text" name ="tele" class = "inputvalues" placeholder="Type your phone number"/><br>

        <label><b>Address:</b></label><br>
        <input type ="text" name ="addr" class = "inputvalues" placeholder="Type your Address"/><br>

        <label><b>Password:</b></label><br>
        <input type ="password" name ="pass" class ="inputvalues" placeholder="Type your password"/><br>

        <label><b>Confirm Password:</b></label><br>
        <input type ="password" name ="repass" class ="inputvalues" placeholder="Type your password"/><br>
        

        <input type ="submit"  name ="submit" id = "signup_btn" value="Sign Up"/><br>
        <input type ="submit"  name ="back_btn" id = "back_btn" value ="Back"/>
       
        
    </form>
  </div>



</body>
</html>
