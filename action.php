<?php

include 'mysqli.php';
session_start();

if ($_POST['action'] == 'register') 
{
  $query = 'INSERT INTO `users`(`username`, `password`) VALUES (:username , :password)';

  $statement = $conn->prepare($query);
  $statement->execute([ ':username' => $_POST['username'] , ':password' => $_POST['password']]);

  echo "Insertion succeeded";
}

if ($_POST['action'] == 'login') 
{
	$query = 'SELECT * FROM `users` WHERE username = :username';

    $statement = $conn->prepare($query);
    $statement->execute([ ':username' => $_POST['username'] ]);
    
    $rowCount = $statement->rowcount();
    $row = $statement->Fetch(PDO::FETCH_ASSOC);

    if ($rowCount > 0) 
    {
    	if ($row['password'] == $_POST['password']) 
    	{  
        $LOGINID = mt_rand(1000 , 9999);

    		$query = 'INSERT INTO `log-ofuserslogin`(`user_id`, `Last_login_date`, `LoginID`) VALUES (:user_id , :LastDate , :LoginID)';

        $statement = $conn->prepare($query);
        $statement->execute([ ':user_id' =>  $row['user_id'] , ':LastDate' => gmdate("Y-m-d H:i") , ':LoginID' => $LOGINID ]);  

        $_SESSION['LoginSessionID'] = $LOGINID;
        $_SESSION['user_id'] = $row['user_id'];

        echo "Login successful";
    	}
    }
}

?>