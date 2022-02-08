<?php
    // hcpGenerateView.php
    // HCP View PHRs
    session_start();

    $currentUser = $_SESSION['currentUser'];
    $privateKey = $_SESSION['hcpPrivateKey'];
    $patientid = $_SESSION['patientPHRID'];

    $mysql_host = 'localhost';
	$mysql_user = 'root';
	$mysql_db = 'healthchaindb';
	
	$connection_mysql = mysqli_connect($mysql_host,$mysql_user,"");

    mysqli_select_db($connection_mysql,"healthchaindb") or die("Cannot connect to database");

    $sql = mysqli_query($connection_mysql,"SELECT * FROM healthcarepro WHERE username = '" .$currentUser ."'");
    while($row = mysqli_fetch_array($sql)){
        $userid = $row['healthcareproid'];
    }

    $sql = mysqli_query($connection_mysql,"SELECT * FROM patientphr WHERE patientid = " .$patientid);
    while($row = mysqli_fetch_array($sql)){
        $phrid = $row['phrid'];
    }

    $sql = mysqli_query($connection_mysql,"SELECT * FROM healthcarepro WHERE healthcareproid = " .$userid);
    while($row = mysqli_fetch_array($sql)){
        $publickey = $row['publickey'];
        $symkey = $row['symkey'];
        $iv = $row['helper'];
    }

    $sql = mysqli_query($connection_mysql,"SELECT * FROM healthcarephr WHERE healthcareproid = " .$userid . " AND patientid = " .$patientid);
    while($row = mysqli_fetch_array($sql)){
        $encryptedPHR = $row['encryptedphr'];
    }

    define('AES_256_CBC', 'aes-256-cbc');
    $symkey = base64_decode($symkey);
    $iv = base64_decode($iv);

    $privateKey = "-----BEGIN PRIVATE KEY-----\n" .wordwrap($privateKey, 64, "\n",true) ."\n-----END PRIVATE KEY-----";

    $a = openssl_pkey_get_private($privateKey);
    $symmetric_key = "";
    openssl_private_decrypt($symkey, $symmetric_key, $a);

    // encrypt PHR and send to DB
    $encryptedPHR = $encryptedPHR .":" .base64_encode($iv);
    $parts = explode(':', $encryptedPHR);
    $decryptedPHR = openssl_decrypt($parts[0], AES_256_CBC, $symmetric_key, 0, base64_decode($parts[1]));

    // get hash
    $shaHash = sha1($decryptedPHR);
    $bool = true;

    // id is public key and phr id
    $id = $publickey .$phrid;
?>
<script src="https://cdn.jsdelivr.net/npm/web3@latest/dist/web3.min.js"></script>
<script type="text/javascript">
    <?php if($bool){ ?>
                // get data for blockchain
                var publicKey = `<?php echo $id; ?>`;
                var phrHash = "<?php echo $shaHash; ?>";
                var dbIndex = "<?php echo $phrid; ?>";
                var patientDBIndex;
                var patientShaHash;
                
                // blockchain running on local host
                try{
                    var web3 = new Web3('http://localhost:8545');
                }catch(ex){
                    alert(ex);
                }

                // open ABI
                var request = new XMLHttpRequest();
                request.open("GET", "PHRShareABI.json", false);
                request.send(null);
                var parsed = JSON.parse(request.responseText);

                // get smart contract
                try{
                    var phrContract = new web3.eth.Contract(parsed,"0x53449Ce5E9573B7Ce5f36A92114cF755255F5726");
                }catch(ex){
                    alert(ex);
                }
            
                // send to view
                try{
                    phrContract.methods.getPatientDBIndex(publicKey).call(function(err,res){
                        patientDBIndex = res;
                        phrContract.methods.getPatientPHR(publicKey).call(function(err1,res1){
                            patientShaHash = res1;

                            if((phrHash === patientShaHash) && (dbIndex == patientDBIndex)){
                                <?php $_SESSION['patientPHRContent'] = $decryptedPHR; ?>
                                location.replace("hcpViewPHR.php");
                            }
                        });
                    });

                }catch(ex){
                    alert(ex);
                }
            
            <?php } ?>
</script>
