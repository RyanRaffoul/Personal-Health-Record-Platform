<?php
    // hcpHome.php
    // HCP Home Page 
    session_start();

    $currentUser = $_SESSION['currentUser'];
    $privateKey = $_SESSION['hcpPrivateKey'];

    $mysql_host = 'localhost';
	$mysql_user = 'root';
	$mysql_db = 'healthchaindb';
	
	$connection_mysql = mysqli_connect($mysql_host,$mysql_user,"");

    mysqli_select_db($connection_mysql,"healthchaindb") or die("Cannot connect to database");

    if(isset($_SESSION['patientSharedPHR'])){
        alert("Patient Has Shared Their PHR");
        unset($_SESSION['patientSharedPHR']);
    }

    $sql = mysqli_query($connection_mysql,"SELECT * FROM healthcarepro WHERE username = '" .$currentUser ."'");
    while($row = mysqli_fetch_array($sql)){
        $userid = $row['healthcareproid'];
    }

    // links
    if(isset($_GET['code'])){
        $val = $_GET['code'];
        if($val == 1){
            // Patient Database
            header("Location: hcpPatientDatabase.php");
        }else if($val == 2){
            // Account
            header("Location: hcpAccount.php");
        }else if($val == 3){
            // Help
            header("Location: hcpHelp.php");
        }else if($val == 4){
            // About
            header("Location: hcpAbout.php");
        }else if($val == 5){
            session_unset();
            header("Location: launch.php");
        }else if($val == 6){
            // Accessibility
            header("Location: hcpAccessibility.php");
        }else if($val == 7){
            // Contact Us
            header("Location: hcpContact.php");
        }else if($val == 8){
            // Patient PHR Here
            $patientID = $_GET['code1'];
            
            $_SESSION['patientPHRID'] = $patientID;
            header("Location: hcpGenerateViewPHR.php");
        }else{}
    }
?>
<html>
    <head>
        <title>Healthchain</title>
        <link rel = "stylesheet" href="../css/hcpHome.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    </head>
    <body>
        <form method="POST">
            <header>
                <div class="container">
                    <span><img id="logo" src="../images/hc.jpg"></span>
                    <nav>
                        <a href="#">Healthchain</a>
                        <a href="?code=1">Patient Database</a>
                        <a href="?code=2">Account</a>
                        <a href="?code=3">Help</a>
                        <a href="javascript:openArrowMenu()"> <i id="downArrow" class="fa fa-caret-down"></i> </a>
                        <div id="arrowDropdown" class="arrowDropdown-content">
                            <a href ="?code=4"><i class="fa fa-address-card"></i><div class = "sidebarContent">&nbsp &nbsp About</div></a>
                            <a href="?code=3"><i class="fa fa-question-circle"></i><div class = "sidebarContent">&nbsp &nbsp Help</div></a>
                            <a href="?code=5"><i class="fa fa-power-off"></i><div class = "sidebarContent">&nbsp &nbsp Log Out</div></a>
                        </div>
                    </nav>
                </div>
            </header>
            <div class="sidebar">
                <a href="#" class="active"><img class = "userPic" src = "../images/hc.jpg" width = "25px" height = "25px"><div class = "sidebarContent">&nbsp  &nbsp Healthchain</div></a>
                <div class="sidebarMiddleContent">
                    <a href="?code=1"> <i id="contentSidebar" class="fa fa-eye"></i> <div class = "sidebarContent">&nbsp  &nbsp View PHRs</div></a>
                    <a href="?code=1"> <i id="contentSidebar" class="fa fa-database"></i> <div class = "sidebarContent">&nbsp  &nbsp Patient Database</div></a>
                    <a href="?code=2"> <i id="contentSidebar" class="fa fa-sign-in"></i> <div class = "sidebarContent">&nbsp  &nbsp Account</div></a>
                </div>
                <a href="?code=5" class="logoutSidebar"><img class = "userPic" src = "../images/hc.jpg" width = "25px" height = "25px"> <div class = "sidebarContent">&nbsp  &nbsp Logout</div></a>
            </div>
            <div class="middleContent">
                <a href="?code=1">
                    <div class="hcpDB">
                        <h1>Search Approved Patient Database</h1>
                    </div>
                </a>
                <a href="#">
                <?php $sql = mysqli_query($connection_mysql,"SELECT * FROM healthcareaccess WHERE healthcareproid=" .$userid);
                      while($row = mysqli_fetch_array($sql)){
                            $patientid = $row['patientid'];

                            $sql1 = mysqli_query($connection_mysql,"SELECT * FROM patientinfo WHERE patientid=" .$patientid);
                            while($row1 = mysqli_fetch_array($sql1)){
                                $fname = $row1['firstname'];
                                $lname = $row1['lastname'];
                                $phone = $row1['phonenumber'];
                                $city = $row1['city'];
                                $prov = $row1['province']; ?>
                                <a href="?code=8&code1=<?php Print $patientid; ?>">
                                    <div class = "searchResults">
                                        <img src="../images/patient.png" alt="HCP Logo" />
                                        <h2>First Name: <?php Print $fname; ?> </h2>
                                        <h2>Last Name: <?php Print $lname; ?> </h2>
                                        <h2>Phone Number: <?php Print $phone; ?> </h2>
                                        <h2>City: <?php Print $city; ?> </h2>
                                        <h2>Province: <?php Print $prov; ?> </h2>
                                    </div>
                                </a>
                            <?php }
                      } ?>
                </a>
                <div class = "footer">
                    <a href="?code=4">About</a>
                    <a href="?code=3">Help</a>
                    <a href="?code=6">Accessibility</a>
                    <a href="?code=7">Contact Us</a>
                </div>
            </div>
            <div class="rightLine">
            </div>
        </form>
    </body>
    <script>
        function openArrowMenu() {
            document.getElementById("arrowDropdown").classList.toggle("show");
        }
        window.onclick = function(event) {
            if (!event.target.matches('.arrowDropdown')) {
                var dropdowns = document.getElementsByClassName("arrowDropdown-content");
                var i;
                for (i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }
            } 
        }
    </script>
</html>
<?php
	function alert($msg) {
		echo "<script type='text/javascript'>alert('$msg');</script>";
	}
?>