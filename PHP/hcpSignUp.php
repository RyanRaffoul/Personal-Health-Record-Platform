<?php
    session_start();

	$mysql_host = 'localhost';
	$mysql_user = 'root';
	$mysql_db = 'healthchaindb';
	
	$connection_mysql = mysqli_connect($mysql_host,$mysql_user,"");
    mysqli_select_db($connection_mysql,"healthchaindb") or die("Cannot connect to database");

	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		
		// username checks
		$usernameEmpty = false;
		$usernameLength = false;
		$usernameExists = false;

		// password checks
		$passwordEmpty = false;
		$passwordLength = false;
		$passwordEqual = false;

		// email checks
		$emailEmpty = false;
		$emailValid = false;
		$emailExists = false;

		// first name and last name checks
		$firstEmpty = false;
		$firstLetter = false;
		$firstLength = false;
		$lastEmpty = false;
		$lastLetter = false;
		$lastLength = false;

		// phone number checks
		$phoneEmpty = false;
		$phoneNumber = false;

		// city checks
		$cityEmpty = false;
		$cityLetter = false;

		// province check
		$provinceCheck = false;

		// profession check
		$professionCheck = false;

		// hospital check
		$hospitalCheck = false;

		// organization check
		$organizationCheck = false;

		// office check
		$officeCheck = false;

		$signup = isset($_POST['signup']);

		if($signup){
			// get inputs
			if(isset($_POST['username'])){
				$username = $_POST['username'];
			}
			if(isset($_POST['password'])){
				$password = $_POST['password'];
			}
			if(isset($_POST['password1'])){
				$password1 = $_POST['password1'];
			}
			if(isset($_POST['email'])){
				$email = $_POST['email'];
			}
			if(isset($_POST['firstname'])){
				$firstname = $_POST['firstname'];
			}
			if(isset($_POST['lastname'])){
				$lastname = $_POST['lastname'];
			}
			if(isset($_POST['phone'])){
				$phone = $_POST['phone'];
			}
			if(isset($_POST['city'])){
				$city = $_POST['city'];
			}
			if(isset($_POST['province'])){
				$province = $_POST['province'];
			}else{
				$provinceCheck = true;
			}
			if(isset($_POST['profession'])){
				$profession = $_POST['profession'];
			}else{
				$professionCheck = true;
			}
			if(isset($_POST['hospital'])){
				$hospital = $_POST['hospital'];
			}else{
				$hospitalCheck = true;
			}
			if(isset($_POST['organization'])){
				$organization = $_POST['organization'];
			}else{
				$organizationCheck = true;
			}
			if(isset($_POST['office'])){
				$office = $_POST['office'];
			}else{
				$officeCheck = true;
			}

			// username checks
			if(empty($username)){
				$usernameEmpty = true;
			}
			if((strlen($username) < 4) || (strlen($username) > 40)){
                $usernameLength = true;
            }
			$query = mysqli_query($connection_mysql, "SELECT * FROM healthcarepro");
			while($row = mysqli_fetch_array($query)){
				$table_users = $row['username'];
				
				if($username == $table_users){
                    $usernameExists = true;
                    break;
				}
			}

			// password checks
			if(empty($password)){
                $passwordEmpty = true;
            }
            if((strlen($password) < 7) || (strlen($password) > 40)){
                $passwordLength = true;
            }
			if($password != $password1){
                $passwordEqual = true;
            }

			// email checks
			if(empty($email)){
                $emailEmpty = true;
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailValid = true;
            }
			$query = mysqli_query($connection_mysql, "SELECT * FROM healthcarepro");
			while($row = mysqli_fetch_array($query)){
				$table_email = $row['email'];
				
				if($email == $table_email){
                    $emailExists = true;
                    break;
				}
			}

			// first name checks
			if(empty($firstname)){
                $firstEmpty = true;
            }
            if(!ctype_alpha($firstname)){
                $firstLetter = true;
            }
            if((strlen($firstname) < 2) || (strlen($firstname) > 30)){
                $firstLength = true;
            }

			// last name checks
			if(empty($lastname)){
                $lastEmpty = true;
            }
            if(!ctype_alpha($lastname)){
                $lastLetter = true;
            }
            if((strlen($lastname) < 2) || (strlen($lastname) > 30)){
                $lastLength = true;
            }

			// phone checks
			if(empty($phone)){
                $phoneEmpty = true;
            }
            if(!preg_match("/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/", $phone)){
                $phoneNumber = true;
            }

			// city checks
			if(empty($city)){
                $cityEmpty = true;
            }
            if(!ctype_alpha($city)){
                $cityLetter = true;
            }

			// profession checks
			if(empty($profession)){
				$professionCheck = true;
			}

			$arrayCheck = array($usernameEmpty, $usernameLength, $usernameExists, $passwordEmpty, $passwordLength, $passwordEqual, $emailEmpty, $emailValid, $emailExists, $firstEmpty, $firstLength, $firstLetter, $lastEmpty, $lastLength, $lastLetter, $phoneEmpty, $phoneNumber, $cityEmpty, $cityLetter, $provinceCheck, $professionCheck);
			if(!in_array(true,$arrayCheck)){
				$passwordHash = password_hash($password, PASSWORD_DEFAULT);

				// generate the private and public key
				$privateKey = openssl_pkey_new(array(
					"digest_alg"=>'md5',
					"private_key_bits" => 2048,
					"private_key_type" => OPENSSL_KEYTYPE_RSA,
				 ));
				$details = openssl_pkey_get_details($privateKey);
				$publicKey = $details['key'];
				
				$r = openssl_pkey_get_private($privateKey);
				openssl_pkey_export($r, $pkeyout);

				define('AES_256_CBC', 'aes-256-cbc');
				$encryption_key = openssl_random_pseudo_bytes(32);
				$iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length(AES_256_CBC));

				$encryptedData = "";
				openssl_public_encrypt($encryption_key, $encryptedData, $publicKey);

				// insert into healthcarepro
				$sql = "INSERT INTO healthcarepro(username,password,email,publickey,symkey,helper) VALUES ('".$username."','".$passwordHash."','".$email."','" .$publicKey ."','" .base64_encode($encryptedData) ."','" .base64_encode($iv) ."')";
                $connection_mysql->query($sql);
                $connection_mysql->commit();

				// insert into healthcareproinfo
				$getUserId = mysqli_query($connection_mysql,"SELECT * FROM healthcarepro WHERE username = '" .$username ."'");
                while($row = mysqli_fetch_array($getUserId)){
                    $userid = $row['healthcareproid'];
                }
                $sql = "INSERT INTO healthcareproinfo(healthcareproid, firstname, lastname, phonenumber, city, province, profession) VALUES (".$userid .",'".$firstname ."','".$lastname ."','".$phone ."','".$city ."','".$province ."','" .$profession ."')";
                $connection_mysql->query($sql);
                $connection_mysql->commit();

				// add hospital if entered
				if(!$hospitalCheck){
					$sql = "UPDATE healthcareproinfo SET hospital = '".$hospital ."' WHERE healthcareproid = " .$userid;
					$connection_mysql->query($sql);
					$connection_mysql->commit();
				}
				// add organization if entered
				if(!$organizationCheck){
					$sql = "UPDATE healthcareproinfo SET organization = '".$organization ."' WHERE healthcareproid = " .$userid;
					$connection_mysql->query($sql);
					$connection_mysql->commit();
				}
				// add office if entered
				if(!$officeCheck){
					$sql = "UPDATE healthcareproinfo SET office = '".$office ."' WHERE healthcareproid = " .$userid;
					$connection_mysql->query($sql);
					$connection_mysql->commit();
				}

				$_SESSION['currentUser'] = $username;
				$_SESSION['privateKey'] = $pkeyout;

                $connection_mysql->close();

				header('Location: storePrivateKey1.php');

			}
		}
	}
?>
<html>
	<head>
		<title>Healthchain</title>
		<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
		<link href="../css/hcpSignUp.css" rel="stylesheet">
	</head>
	<body>
		<form method="POST">
			<div class="container" id="container">
				<div class="form-container sign-in-container">
					<div class="signinSide" >
						<h1 class = "title">Create Account</h1>
						<input name = "username" type="username" placeholder="Username" />
						<input name = "password" type="password" placeholder="Password" />
						<input name = "password1" type="password" placeholder="Re-enter Password" />
						<input name = "email" placeholder="E-mail" />
						<input name = "firstname" placeholder="First Name" />
						<input name = "lastname" placeholder="Last Name" />
						<input name = "phone" placeholder="Phone Number (XXX-XXX-XXXX)" />
						<input name = "city" placeholder="City" />
						<select name="province">
							<option value="Province" disabled="disabled" selected="selected">Province</option>
							<option value="AB">Alberta</option>
							<option value="BC">British Columbia</option>
							<option value="MB">Manitoba</option>
							<option value="NB">New Brunswick</option>
							<option value="NL">Newfoundland and Labrador</option>
							<option value="NS">Nova Scotia</option>
							<option value="ON">Ontario</option>
							<option value="PE">Prince Edward Island</option>
							<option value="QC">Quebec</option>
							<option value="SK">Saskatchewan</option>
							<option value="NT">Northwest Territories</option>
							<option value="NU">Nunavut</option>
							<option value="YT">Yukon</option>
						</select>
                        <input name = "profession" placeholder="Profession" />
                        <input name = "hospital" placeholder="Hospital" />
                        <input name = "organization" placeholder="Organization" />
                        <input name = "office" placeholder="Office" />
						<input type ="submit" name="signup" class="button" value="Sign Up" >
					</div>
				</div>
				<div class="overlay-container">
					<div class="overlay">
						<div class="overlay-panel overlay-right">
							<h1 class="sideTitle">Healthchain</h1>
							<img src = "../images/hc.jpg" alt="HealChain Logo"/>
						</div>
				</div>
			</div>
		</div>
		</form>
	</body>
</html>
<?php
	// Errors
	if(isset($_POST['signup'])){
		if($usernameEmpty){
			alert("Error Creating Healthcare Pro Account: Username cannot be empty");
		}else if($usernameLength){
			alert("Error Creating Healthcare Pro Account: Username must be between 4 and 40 characters");
		}else if($usernameExists){
			alert("Error Creating Healthcare Pro Account: Username already exists");
		}else if($passwordEmpty){
			alert("Error Creating Healthcare Pro Account: Password cannot be empty");
		}else if($passwordLength){
			alert("Error Creating Healthcare Pro Account: Password must be between 7 and 40 characters");
		}else if($passwordEqual){
			alert("Error Creating Healthcare Pro Account: Passwords do not match");
		}else if($emailEmpty){
			alert("Error Creating Healthcare Pro Account: Email cannot be empty");
		}else if($emailValid){
			alert("Error Creating Healthcare Pro Account: Email must be valid");
		}else if($emailExists){
			alert("Error Creating Healthcare Pro Account: Email already exists");
		}else if($firstEmpty){
			alert("Error Creating Healthcare Pro Account: First Name cannot be empty");
		}else if($firstLetter){
			alert("Error Creating Healthcare Pro Account: First Name must be letters only");
		}else if($firstLength){
			alert("Error Creating Healthcare Pro Account: First Name must be between 2 and 30 characters");
		}else if($lastEmpty){
			alert("Error Creating Healthcare Pro Account: Last Name cannot be empty");
		}else if($lastLetter){
			alert("Error Creating Healthcare Pro Account: Last Name must be letters only");
		}else if($lastLength){
			alert("Error Creating Healthcare Pro Account: Last Name must be between 2 and 30 letters");
		}else if($phoneEmpty){
			alert("Error Creating Healthcare Pro Account: Phone Number cannot be empty");
		}else if($phoneNumber){
			alert("Error Creating Healthcare Pro Account: Phone Number must be in form (xxx-xxx-xxxx)");
		}else if($cityEmpty){
			alert("Error Creating Healthcare Pro Account: City cannot be empty");
		}else if($cityLetter){
			alert("Error Creating Healthcare Pro Account: City must be letters only");
		}else if($provinceCheck){
			alert("Error Creating Healthcare Pro Account: Must select a Province");
		}else if($professionCheck){
			alert("Error Creating Healthcare Pro Account: Must enter a Profession");
		}else{}
	}

	function alert($msg) {
		echo "<script type='text/javascript'>alert('$msg');</script>";
	}
?>