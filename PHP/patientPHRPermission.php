<?php
    // patientPHRPermission.php
    // Patient PHR permission
    session_start();
    
    $mysql_host = 'localhost';
	$mysql_user = 'root';
	$mysql_db = 'healthchaindb';
	
	$connection_mysql = mysqli_connect($mysql_host,$mysql_user,"");
    mysqli_select_db($connection_mysql,"healthchaindb") or die("Cannot connect to database");

    $currentUser = $_SESSION['currentUser'];
    $healthcareproid = $_SESSION['healthcareProSearchId'];
    $bool = false;

    $sql = mysqli_query($connection_mysql,"SELECT * FROM healthcareproinfo WHERE healthcareproid = " .$healthcareproid);
    while($row = mysqli_fetch_array($sql)){
        $hcpName = $row['firstname'] ." " .$row['lastname'];
    }

    $privateKey = $_SESSION['patientPK'];

    $sql = mysqli_query($connection_mysql,"SELECT * FROM patient WHERE username = '" .$currentUser ."'");
    while($row = mysqli_fetch_array($sql)){
        $userid = $row['patientid'];
        $publicKey = $row['publickey'];
        $symkey = $row['symkey'];
        $iv = $row['helper'];
    }
    $sql = mysqli_query($connection_mysql,"SELECT * FROM patientinfo WHERE patientid = " .$userid);
    while($row = mysqli_fetch_array($sql)){
        $name = $row['firstname'] ." " .$row['lastname'];
    }

    $sql = mysqli_query($connection_mysql,"SELECT * FROM patientphr WHERE patientid = " .$userid);
    while($row = mysqli_fetch_array($sql)){
        $encryptedPHR = $row['encryptedphr'];
        $phrid = $row['phrid'];
    }

    $sql = mysqli_query($connection_mysql,"SELECT * FROM healthcarepro WHERE healthcareproid = " .$healthcareproid);
    while($row = mysqli_fetch_array($sql)){
        $hcpPublicKey = $row['publickey'];
        $hcpSymKey = $row['symkey'];
        $hcpHelper = $row['helper'];
    }

    define('AES_256_CBC', 'aes-256-cbc');
    $symkey = base64_decode($symkey);

    $privateKey = "-----BEGIN PRIVATE KEY-----\n" .wordwrap($privateKey, 64, "\n",true) ."\n-----END PRIVATE KEY-----";
    $a = openssl_pkey_get_private($privateKey);
    $symmetric_key = "";
    openssl_private_decrypt($symkey, $symmetric_key, $a);

    // decrypt phr
    $encryptedPHR = $encryptedPHR .":" .$iv;
    $parts = explode(':', $encryptedPHR);
    $decryptedPHR = openssl_decrypt($parts[0], AES_256_CBC, $symmetric_key, 0, base64_decode($parts[1]));

    $shaHash = sha1($decryptedPHR);
    $bool = true;

    $boolDB = false;
        $sql = mysqli_query($connection_mysql,"SELECT * FROM healthcareaccess WHERE healthcareproid = " .$healthcareproid ." AND patientid = " .$userid);
        while($row = mysqli_fetch_array($sql)){
            $boolDB = true;
        }

        if($boolDB){
            // Update hca
            $sql = "UPDATE healthcareaccess SET notify = 1 WHERE healthcareproid = " .$healthcareproid ." AND patientid = " .$userid;
            $connection_mysql -> query($sql);            
            $connection_mysql->commit();

            // Update phr
            $sql = "UPDATE healthcarephr SET encryptedphr = '" .base64_encode($decryptedPHR) ."' WHERE healthcareproid = " .$healthcareproid ." AND patientid = " .$userid;
            $connection_mysql -> query($sql);            
            $connection_mysql->commit();

            // increment stats
            $sql = "UPDATE phrstats SET shares = shares + 1 WHERE patientid = " .$userid;
            $connection_mysql -> query($sql);            
            $connection_mysql->commit();
        }else{
            // insert hca
            $sql = "INSERT INTO healthcareaccess(patientid, healthcareproid, notify) VALUES (" .$userid ."," .$healthcareproid .",1)";
            $connection_mysql -> query($sql);            
            $connection_mysql->commit();

            // insert phr
            $sql = "INSERT INTO healthcarephr(phrpid, healthcareproid, patientid, publickey, encryptedphr) VALUES (" .$phrid ."," .$healthcareproid ."," .$userid .",'" .$hcpPublicKey ."','" .base64_encode($decryptedPHR) ."')";
            $connection_mysql -> query($sql);            
            $connection_mysql->commit();

            // increment stats
            $sql = "UPDATE phrstats SET shares = shares + 1 WHERE patientid = " .$userid;
            $connection_mysql -> query($sql);            
            $connection_mysql->commit();
        }
        $hcpPublicKey1 = $hcpPublicKey ."" .$phrid;
?>
<script src="https://cdn.jsdelivr.net/npm/web3@latest/dist/web3.min.js"></script>
<script type="text/javascript">
    <?php if($bool){ ?>
                // get data for blockchain
                var patientpublickey = `<?php echo $publicKey; ?>`;
                var hcppublickey = `<?php echo $hcpPublicKey1; ?>`;
                var patientName = "<?php echo $name; ?>";
                var phrHash = "<?php echo $shaHash; ?>";
                var dbIndex = "<?php echo $phrid; ?>";
                var patientShaHash;
                var patientDBIndex;

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
            
                // get and add to phrshare smart contract
                try{
                    phrContract.methods.getPatientDBIndex(patientpublickey).call(function(err,res){
                        patientDBIndex = res;
                        phrContract.methods.getPatientPHR(patientpublickey).call(function(err1,res1){
                            patientShaHash = res1;

                            if((phrHash === patientShaHash) && (dbIndex == patientDBIndex)){
                                request = new XMLHttpRequest();
                                request.open("GET", "PHRShareABI.json", false);
                                request.send(null)
                                parsed = JSON.parse(request.responseText);
                                try{
                                    phrContract = new web3.eth.Contract(parsed,"0x53449Ce5E9573B7Ce5f36A92114cF755255F5726");
                                }catch(ex){
                                    alert(ex);
                                }
                                try{
                                    phrContract.methods.setPHR(hcppublickey, phrHash, dbIndex, patientpublickey, patientName).send({from: '0x8b9118E67ee0f9ED4Ef5E733eFA9cBac0A884c1A'}).then(function(receipt){
                                    <?php $_SESSION['successSharePatientPHR'] = 1; ?>
                                    location.replace("patientHCPDatabase.php");
                                    });
                                }catch(ex){
                                    alert(ex);
                                }
                            }
                        });
                    });
                }catch(ex){
                    alert(ex);
                }
    <?php }?>
</script>