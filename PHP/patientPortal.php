<?php
    // patientPortal.php
    // get HCP private key so they do not need to enter it each time
    session_start();
    
    if(isset($_SESSION['errorpatientPK'])){
        alert("Incorrect Private Key");
        unset($_SESSION['errorpatientPK']);
    }
    $mysql_host = 'localhost';
	$mysql_user = 'root';
	$mysql_db = 'healthchaindb';
	
	$connection_mysql = mysqli_connect($mysql_host,$mysql_user,"");
    mysqli_select_db($connection_mysql,"healthchaindb") or die("Cannot connect to database");

    $currentUser = $_SESSION['currentUser'];
    $bool = false;

    $boolNotify = false;
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $done = isset($_POST['done']);

        if($done){
            if(isset($_POST['privatekey'])){
                $privateKey = $_POST['privatekey'];
                $_SESSION['patientPK'] = $privateKey;
                
                $sql = mysqli_query($connection_mysql,"SELECT * FROM patient WHERE username = '" .$currentUser ."'");
                while($row = mysqli_fetch_array($sql)){
                    $userid = $row['patientid'];
                    $symkey = $row['symkey'];
                    $iv = $row['helper'];
                    $publicKey = $row['publickey'];
                }

                $symkey = base64_decode($symkey);

                define('AES_256_CBC', 'aes-256-cbc');

                $privateKey = "-----BEGIN PRIVATE KEY-----\n" .wordwrap($privateKey, 64, "\n",true) ."\n-----END PRIVATE KEY-----";
                
                // decrypt with private key
                $a = openssl_pkey_get_private($privateKey);
                $symmetric_key = NULL;
                openssl_private_decrypt($symkey, $symmetric_key, $a);

                if($symmetric_key == NULL){
                    $_SESSION['errorpatientPK'] = 1;
                    header("Location: patientPortal.php");
                }else{
                    if(isset($_SESSION['patientStatusCreate'])){
                        header("Location: createPHR.php");
                    }else{
                        header("Location: patientHome.php");
                    }
                }
            }
        }
    }
?>
<html>
    <head>
        <title>Healthchain</title>
        <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <link href="../css/patientPortal.css" rel="stylesheet">
    </head>
    <body>
        <form method="POST">
            <div class="header">
                <img src="../images/hc.jpg" alt="Healthchain Logo" />
                <h1>Healthchain</h1>
            </div>
            <div class="container">
                <h1 class="patientTitle">Unlock PHR</h1>
                <p>Please Enter your Private Key Below to unlock your PHR</p>
                <br />
                <textarea name="privatekey" placeholder="Enter Private Key"></textarea>
                <br />
                <input name = "done" type="submit" value = "Done">
            </div>
        </form>
    </body>
</html>
<?php
	function alert($msg) {
		echo "<script type='text/javascript'>alert('$msg');</script>";
	}
?>