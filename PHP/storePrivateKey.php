<?php
    // storePrivateKey.php
    // Send Patient Private Key to store
    session_start();

    $privateKey = $_SESSION['privateKey'];

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $done = isset($_POST['done']);

        if($done){
            unset($_SESSION["privateKey"]);
			$_SESSION['patientStatusCreate'] = 1;
            header("Location: patientPortal.php");
        }
    }
?>
<html>
    <head>
        <title>Healthchain</title>
        <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <link href="../css/storePrivateKey.css" rel="stylesheet">
    </head>
    <body>
        <form method="POST">
            <div class="header">
                <img src="../images/hc.jpg" alt="Healthchain Logo" />
                <h1>Healthchain</h1>
            </div>
            <div class="container">
                <h1 class="patientTitle">Private Key</h1>
                <p> Below is your Private Key. We will not store this anywhere on our system so please save this in a save place as it will need to be entered to unlock your PHR. </p>
                <br />
                <p><?php Print "$privateKey" ?></p>
                <br />
                <input name = "done" type="submit" value = "Done">
            </div>
        </form>
    </body>
</html>