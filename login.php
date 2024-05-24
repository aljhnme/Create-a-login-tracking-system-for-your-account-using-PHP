<!DOCTYPE html>
<html>
  <?php
   session_start();

   if (isset($_SESSION['user_id'])) 
   {
       header('location:index.php');
   }

  ?>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/loginRegisterStyle.css">
	<title>LOGIN</title>
</head>
<body>
 <div class="container">
 	<h2>Login</h2>
 	 <input type="text" name="username" id="username" placeholder="Username" required>
     <br>
     <input type="password" name="password" id="password" placeholder="Password" required>
     <br>
     <input type="submit" value="login" id="login">
 </div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
        $("#login").click(function(){
             
             var password = $("#password").val();
             var username = $("#username").val();
             var action = 'login';     

             $.ajax({
                url:"action.php",
                type:"POST",
                data:{password:password , username:username , action:action},
                success:function(data)
                {
                  if (data == 'Login successful') {

                  	window.location.href = 'index.php';
                  }
                }
             });        
        });     
	});
</script>
</html>