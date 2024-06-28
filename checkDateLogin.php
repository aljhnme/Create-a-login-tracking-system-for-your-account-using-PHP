<?php
 
 include 'mysqli.php';
 session_start();

 $query = 'SELECT * FROM `log-ofuserslogin` WHERE LoginID = :SessionID';

 $statement = $conn->prepare($query);
 $statement->execute([':SessionID' => $_SESSION['LoginSessionID']]);
 $rowcount = $statement->rowcount();

 if ($rowcount == 0) 
 {
    echo "SessionISover";
 }else{
  
     $query = 'SELECT * FROM `log-ofuserslogin` WHERE user_id = :user_id ORDER BY id DESC LIMIT 1';

     $statement = $conn->prepare($query);
     $statement->execute([':user_id' => $_SESSION['user_id']]);

     $row = $statement->Fetch(PDO::FETCH_ASSOC);

     $currentDate = new DateTime(gmdate('Y-m-d H:i'));
     $lastLoginDate = new DateTime($row['Last_login_date']);
     $lastLoginDate->modify('+1 minutes');

     if ($row['LoginID'] != $_SESSION['LoginSessionID']) {
 	 
 	  if ($currentDate < $lastLoginDate) 
 	  {
 	  	 echo "someone";
 	  }
 	}
 }

?>