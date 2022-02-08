<?php
    // launch.php
    // Launch Page
    session_start();

    session_unset();

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $patient = isset($_POST['patientPortal']);
        $hcp = isset($_POST['healthcarePortal']);

        if($patient){
            header('Location: patientLogin.php');
        }else if($hcp){
            header('Location: hcpLogin.php');
        }else{}
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Healthchain</title>
        <link rel = "stylesheet" href="../css/launch.css">
        <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    </head>
    <body>
        <form method="POST">
            <div class="header">
                <img class = "logo" src="../images/hc.jpg" alt="HealthChain Logo" />
                <h1 class="title">Welcome to Healthchain</h1>
                <p class = "goal">Store and view Personal Health Record data in a safe and secure way using Blockchain technology</p>
                <hr class = "line">
            </div>
            <div class ="patient">
                <img class = "patientlogo" src="../images/patient.png" alt="Patient logo" />
                <input type="submit" name = "patientPortal" value="Patient">
            </div>
            <div class ="hcp">
                <img class = "hcplogo" src="../images/hcp.png" alt="HCP logo" />
                <input type="submit" name = "healthcarePortal" value="Healthcare Pro">
            <div>
        </form>
    </body>
</html>