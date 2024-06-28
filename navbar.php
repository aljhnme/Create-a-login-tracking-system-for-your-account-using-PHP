  <?php
  
   session_start();

   if (!isset($_SESSION['user_id'])) 
   {
       header('location:login.php');
   }

  ?>
  <nav>
    <ul>
      <li><a href="#">Home</a></li>
      <li><a href="#">change the password</a></li>
      <li><a href="UserSessions.php">List of other sessions</a></li>
      <li><a href="logout.php">LogOut</a></li>
    </ul>
  </nav>

  <div class="warning-box" id="warning-box" style="display:none;">
    <p>There is someone logged in</p>
  </div>

  <script type="text/javascript">
    const disappearWarning_box = document.getElementById('warning-box');

    disappearWarning_box.addEventListener('mouseover' , () => { 
       disappearWarning_box.parentNode.removeChild(disappearWarning_box);
    });

    setInterval(function(){
   
     $.ajax({
       
        url:"checkDateLogin.php",
        success:function(data)
        {
          if (data == "someone") 
          {
            $(".warning-box").show();
          }

          if (data == "SessionISover") 
          {
            window.location.href = 'logout.php?ByEndingTheSession=yes';
          }
        }
     });

    } ,1000);
  </script>