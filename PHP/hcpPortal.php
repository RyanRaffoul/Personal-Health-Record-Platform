<?php
    // hcpPortal.php
    // get HCP private key so they do not need to enter it each time
    session_start();
    
    if(isset($_SESSION['errorhcpPK'])){
        alert("Incorrect Private Key");
        unset($_SESSION['errorhcpPK']);
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
                $_SESSION['hcpPrivateKey'] = $privateKey;
                
                $sql = mysqli_query($connection_mysql,"SELECT * FROM healthcarepro WHERE username = '" .$currentUser ."'");
                while($row = mysqli_fetch_array($sql)){
                    $userid = $row['healthcareproid'];
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
                    $_SESSION['errorhcpPK'] = 1;
                    header("Location: hcpPortal.php");
                }else{
                    $sql = mysqli_query($connection_mysql,"SELECT * FROM healthcareaccess WHERE healthcareproid = " .$userid ." AND notify=1");
                    while($row = mysqli_fetch_array($sql)){
                        $patientid = $row['patientid'];

                        $sql1 = mysqli_query($connection_mysql,"SELECT * FROM healthcarephr WHERE healthcareproid = " .$userid ." AND patientid = " .$patientid);
                        while($row1 = mysqli_fetch_array($sql1)){
                            $PHRdata = $row1['encryptedphr'];
                            $PHRdata = base64_decode($PHRdata);

                            $iv = base64_decode($iv);
                            $encryptedData = openssl_encrypt($PHRdata, AES_256_CBC, $symmetric_key, 0, $iv);

                            $sql2 = "UPDATE healthcarephr SET encryptedphr = '" .$encryptedData ."' WHERE healthcareproid = " .$userid ." AND patientid = " .$patientid;
                            $connection_mysql -> query($sql2);            
                            $connection_mysql->commit();
                        }
                        $sql2 = "UPDATE healthcareaccess SET notify = 0 WHERE healthcareproid = " .$userid ." AND patientid = " .$patientid;
                        $connection_mysql -> query($sql2);            
                        $connection_mysql->commit();
                        $boolNotify = true;
                    }
                    if($boolNotify){
                        $_SESSION['patientSharedPHR'] = 1;
                        header("Location: hcpHome.php");
                    }else{
                        header("Location: hcpHome.php");
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
        <link href="../css/hcpPortal.css" rel="stylesheet">
    </head>
    <body>
        <form method="POST">
            <div class="header">
                <img src="../images/hc.jpg" alt="Healthchain Logo" />
                <h1>Healthchain</h1>
            </div>
            <div class="container">
                <h1 class="patientTitle">View Patient PHRs</h1>
                <p> Please Enter your Private Key Below to view Patient PHRs </p>
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