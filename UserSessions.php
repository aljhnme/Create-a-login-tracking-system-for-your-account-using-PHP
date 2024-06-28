<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/ListUserSessions.css">
	<link rel="stylesheet" type="text/css" href="css/navbarStyle.css">
	<title>User Sessions</title>
</head>
<body>

<?php
  include 'navbar.php';
  include 'mysqli.php';
?>

<div class="container">
	<h1>User Sessions</h1>
	<ul class="user-list">
	 <?php
    
        $query = 'SELECT * FROM `log-ofuserslogin` WHERE user_id = :user_id';

        $statement = $conn->prepare($query);
        $statement->execute([':user_id' => $_SESSION['user_id']]);
        $result = $statement->FetchAll();

        foreach ($result as $row) 
        {
          ?>
          <li class="user-session <?php echo $row['LoginID'];?>">
          	<div class="session-info">
          	   <p>Session ID: <?php echo $row['LoginID'];?></p>
               <p>Start Time:<span id="<?php echo $row['LoginID']; ?>"><?php echo $row['Last_login_date'];?></span></p>
          	</div>

          	<?php
             if ($_SESSION['LoginSessionID'] != $row['LoginID']) 
             {
             	?>
                 <button class="delete-btn" onclick="confirmLogout(<?php echo $row['LoginID'] ?>)">sign out</button>
             	<?php
             }else{

                ?>
                 <span>YOU</span>
                <?php
             }
          	?>
          	
          </li>
          <?php
        }

      ?>
	</ul>
</div>

 <div id="delete-warning" class="modal">
     <div class="modal-content">
       <p>For security reasons, you cannot log out of previous sessions</p>
       <button id="cancel-delete-btn">OK</button>
     </div>
 </div>

</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script type="text/javascript">

	let sessionToDelete;
	
	function confirmLogout(sessionID)
	{
       var mySessionID = '<?php echo $_SESSION['LoginSessionID']; ?>';

       var date1 = new Date($("#"+mySessionID).text());
       var date2 = new Date($("#"+sessionID).text());

       if (date1 > date2) {

           sessionToDelete = sessionID.parentElement;
           document.getElementById('delete-warning').style.display = 'block';
       }else{

       	  var action = 'logoutOfTheSession';

       	  $.ajax({
              
              url:"action.php",
              type:"POST",
              data:{sessionID:sessionID , action:action},
              success:function()
              {
                $("."+sessionID).html('<p style="color:green">The session has just been logged out</p>');
              }
       	  });
       }
	}

   document.getElementById('cancel-delete-btn').onclick = function(){
   	   document.getElementById('delete-warning').style.display = 'none';
   }

</script>
</html>