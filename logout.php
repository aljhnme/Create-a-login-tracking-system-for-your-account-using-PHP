<?php
session_start();
session_destroy();
session_unset();

if (isset($_GET['ByEndingTheSession'])) 
{
   $location = 'location:login.php?SessionHasEnded';
}else{
   $location = 'location:login.php';
}

header($location);
?>