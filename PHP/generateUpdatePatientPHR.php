<?php
    // generateUpdatePatientPHR.php
    // Create Updated PHR

    session_start();
    
    $mysql_host = 'localhost';
	$mysql_user = 'root';
	$mysql_db = 'healthchaindb';
	
	$connection_mysql = mysqli_connect($mysql_host,$mysql_user,"");
    mysqli_select_db($connection_mysql,"healthchaindb") or die("Cannot connect to database");

    $currentUser = $_SESSION['currentUser'];
    $patientPHR = $_SESSION['patientUpdatePHR'];
    $bool = false;

    $privateKey = $_SESSION['patientPK'];

    $sql = mysqli_query($connection_mysql,"SELECT * FROM patient WHERE username = '" .$currentUser ."'");
    while($row = mysqli_fetch_array($sql)){
        $userid = $row['patientid'];
    }
    $sql = mysqli_query($connection_mysql,"SELECT publickey,symkey,helper FROM patient WHERE patientid = " .$userid);
    while($row = mysqli_fetch_array($sql)){
        $publicKey = $row['publickey'];
        $symmetric_keyEncrypted = $row['symkey'];
        $iv = $row['helper'];
    }

    $symmetric_keyEncrypted = base64_decode($symmetric_keyEncrypted);

    $privateKey = "-----BEGIN PRIVATE KEY-----\n" .wordwrap($privateKey, 64, "\n",true) ."\n-----END PRIVATE KEY-----";
    $a = openssl_pkey_get_private($privateKey);
    $symmetric_key = "";
    openssl_private_decrypt($symmetric_keyEncrypted, $symmetric_key, $a);

    // Encrypt PHR and send to DB
    define('AES_256_CBC', 'aes-256-cbc');
    $iv = base64_decode($iv);
    $encryptedData = openssl_encrypt($patientPHR, AES_256_CBC, $symmetric_key, 0, $iv);

    $currentdate = date("Y-m-d");
    $sql = "UPDATE patientphr SET encryptedphr='" .$encryptedData ."', datecreated = '" .$currentdate ."' WHERE patientid=" .$userid;
    $connection_mysql -> query($sql);            
    $connection_mysql->commit();

    $sql = "UPDATE phrstats SET phrscreated = phrscreated + 1 WHERE patientid=" .$userid;
    $connection_mysql -> query($sql);            
    $connection_mysql->commit();

    // get hash
    $shaHash = sha1($patientPHR);

    $sql = mysqli_query($connection_mysql,"SELECT phrid FROM patientphr WHERE patientid = " .$userid);
    while($row = mysqli_fetch_array($sql)){
        $dbIndex = $row['phrid'];
    }
    $bool = true;
?>
<script src="https://cdn.jsdelivr.net/npm/web3@latest/dist/web3.min.js"></script>
<script type="text/javascript">
    <?php if($bool){ ?>
                // get data to add to blockchain
                var publicKey = `<?php echo $publicKey; ?>`;
                var phrHash = "<?php echo $shaHash; ?>";
                var dbIndex = "<?php echo $dbIndex; ?>";
                
                // blockchain running on localhost
                try{
                    var web3 = new Web3('http://localhost:8545');
                }catch(ex){
                    alert(ex);
                }

                // open ABI
                var request = new XMLHttpRequest();
                request.open("GET", "patientPHRABI.json", false);
                request.send(null);
                var parsed = JSON.parse(request.responseText);

                // open smart contract
                try{
                    var phrContract = new web3.eth.Contract(parsed,"0x503B27aBe9175b8fAd5e2C6841589F357D1F35C3");
                }catch(ex){
                    alert(ex);
                }
            
                // set updated PHR
                try{
                    phrContract.methods.setPHR(publicKey, phrHash, dbIndex).send({from: '0x8b9118E67ee0f9ED4Ef5E733eFA9cBac0A884c1A'}).then(function(receipt){
                        <?php $_SESSION['successCreate1'] = 1; ?>
                        location.replace("patientHome.php");
                    });
                }catch(ex){
                    alert(ex);
                }
            
            <?php } ?>
</script>