<?php
    // patientLogin.php
    // Patient Login
    session_start();

    $mysql_host = 'localhost';
	$mysql_user = 'root';
	$mysql_db = 'healthchaindb';
	
	$connection_mysql = mysqli_connect($mysql_host,$mysql_user,"");
    mysqli_select_db($connection_mysql,"healthchaindb") or die("Cannot connect to database");

    // get login credentials and check if valid
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $login = isset($_POST['login']);
        $register = isset($_POST['register']);

        if($login){
            $bool = false;
            if(isset($_POST['username'])){
                $username = $_POST['username'];
            }
            if(isset($_POST['password'])){
                $password = $_POST['password'];
            }

            $query = mysqli_query($connection_mysql, "SELECT * FROM patient");

			while($row = mysqli_fetch_array($query)){
				$table_users = $row['username'];
				$table_password = $row['password'];
				
				if($username == $table_users && password_verify($password,$table_password)){
					$_SESSION['currentUser'] = $username;
					$bool = true;
                    break;
				}
			}

            if($bool){
               header('Location: patientPortal.php');
            }
        }else if($register){
            header('Location: patientSignUp.php');
        }else{}
    }
?>
<html>
    <head>
        <title>Healthchain</title>
        <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <link href="../css/patientLogin.css" rel="stylesheet">
    </head>
    <body>
        <form method="POST">
            <div class="header">
                <img src="../images/hc.jpg" alt="Healthchain Logo" />
                <h1>Healthchain</h1>
            </div>
            <div class="container">
                <h1 class="patientTitle">Patient Log In</h1>
                <input name = "username" type="text" placeholder="Username">
                <input name = "password" type="password" placeholder="Password">
                <input name = "login" type="submit" placeholder="Log In" value = "Log In">
                <input name = "register" type="submit" placeholder="Register" value = "Register">
            </div>
        </form>
    </body>
</html>
<?php
	if(isset($_POST['login'])){
		if(!$bool){
			alert("Username Password combination not found");
		}else{}
	}

	function alert($msg) {
		echo "<script type='text/javascript'>alert('$msg');</script>";
	}
?>