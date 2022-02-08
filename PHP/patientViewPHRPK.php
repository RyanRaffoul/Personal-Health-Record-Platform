<?php
    // patientViewPHRPK.php
    // get private key to view Patient PHR
    session_start();
    
    $mysql_host = 'localhost';
	$mysql_user = 'root';
	$mysql_db = 'healthchaindb';
	
	$connection_mysql = mysqli_connect($mysql_host,$mysql_user,"");
    mysqli_select_db($connection_mysql,"healthchaindb") or die("Cannot connect to database");

    $currentUser = $_SESSION['currentUser'];
    $bool = false;

    $privateKey = $_SESSION['patientPK'];
                
    $sql = mysqli_query($connection_mysql,"SELECT * FROM patient WHERE username = '" .$currentUser ."'");
    while($row = mysqli_fetch_array($sql)){
        $userid = $row['patientid'];
        $symkey = $row['symkey'];
        $iv = $row['helper'];
        $publicKey = $row['publickey'];
    }

    $sql = mysqli_query($connection_mysql,"SELECT * FROM patientphr WHERE patientid = " .$userid);
    while($row = mysqli_fetch_array($sql)){
        $encryptedPHR = $row['encryptedphr'];
        $dbIndex = $row['phrid'];
    }

    $symkey = base64_decode($symkey);

    define('AES_256_CBC', 'aes-256-cbc');

    $privateKey = "-----BEGIN PRIVATE KEY-----\n" .wordwrap($privateKey, 64, "\n",true) ."\n-----END PRIVATE KEY-----";
    
    $a = openssl_pkey_get_private($privateKey);
    $symmetric_key = NULL;
    openssl_private_decrypt($symkey, $symmetric_key, $a);

    // decrypt phr
    $encryptedPHR = $encryptedPHR .":" .$iv;
    $parts = explode(':', $encryptedPHR);
    $decryptedPHR = openssl_decrypt($parts[0], AES_256_CBC, $symmetric_key, 0, base64_decode($parts[1]));

    $bool = true;
    $shaHash = sha1($decryptedPHR);
?>
<script src="https://cdn.jsdelivr.net/npm/web3@latest/dist/web3.min.js"></script>
<script type="text/javascript">
    <?php if($bool){ ?>
                // get data for blockchain
                var publicKey = `<?php echo $publicKey; ?>`;
                var phrHash = "<?php echo $shaHash; ?>";
                var dbIndex = "<?php echo $dbIndex; ?>";
                var patientDBIndex;
                var patientShaHash;

                // blockchain running on localhost
                try{
                    var web3 = new Web3('http://localhost:8545');
                }catch(ex){
                    alert(ex);
                }

                // get ABI
                var request = new XMLHttpRequest();
                request.open("GET", "patientPHRABI.json", false);
                request.send(null);
                var parsed = JSON.parse(request.responseText);
                
                // get smart contract
                try{
                    var phrContract = new web3.eth.Contract(parsed,"0x503B27aBe9175b8fAd5e2C6841589F357D1F35C3");
                }catch(ex){
                    alert(ex);
                }
            
                // get data and check
                try{
                    phrContract.methods.getPatientDBIndex(publicKey).call(function(err,res){
                        patientDBIndex = res;
                        phrContract.methods.getPatientPHR(publicKey).call(function(err1,res1){
                            patientShaHash = res1;

                            if((phrHash === patientShaHash) && (dbIndex == patientDBIndex)){
                                <?php $_SESSION['patientPHRContent'] = $decryptedPHR; ?>
                                location.replace("patientViewPHR.php");
                            }
                        });
                    });
                }catch(ex){
                    alert(ex);
                }
            
            <?php } ?>
</script>