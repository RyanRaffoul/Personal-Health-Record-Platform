<?php
    // patientPermissions.php
    // Patient HCP PHR Permissions
    session_start();

    // permission deleted
    if(isset($_SESSION['successDel'])){
        alert("Permission Deleted");
        unset($_SESSION['successDel']);
    }

    $currentUser = $_SESSION['currentUser'];

    $mysql_host = 'localhost';
	$mysql_user = 'root';
	$mysql_db = 'healthchaindb';
	
	$connection_mysql = mysqli_connect($mysql_host,$mysql_user,"");

    mysqli_select_db($connection_mysql,"healthchaindb") or die("Cannot connect to database");

    // stats
    $phrscreated = 0;
    $shares = 0;
    $sql = mysqli_query($connection_mysql,"SELECT * FROM patient WHERE username = '" .$currentUser ."'");
    while($row = mysqli_fetch_array($sql)){
        $userid = $row['patientid'];
    }

    $sql = mysqli_query($connection_mysql,"SELECT phrscreated,shares FROM phrstats WHERE patientid = " .$userid);
    while($row = mysqli_fetch_array($sql)){
        $phrscreated = $row['phrscreated'];
        $shares = $row['shares'];
    }

    // links
    if(isset($_GET['code'])){
        $val = $_GET['code'];
        if($val == 1){
            // View PHR
            header("Location: patientViewPHRPK.php");
        }else if($val == 2){
            // HCP Database
            header("Location: patientHCPDatabase.php");
        }else if($val == 3){
            // Account
            header("Location: patientHome.php");
        }else if($val == 4){
            // About
            header("Location: patientAbout.php");
        }else if($val == 5){
            // Help
            header("Location: patientHelp.php");
        }else if($val == 6){
            // Log Out
            session_unset();
            header("Location: launch.php");
        }else if($val == 7){
            // Update PHR
            header("Location: patientUpdatePHRPK.php");
        }else if($val == 8){
            // Permissions
            header("Location: patientAccount.php");
        }else if($val == 9){
            // Accessibility
            header("Location: patientAccessibility.php");
        }else if($val == 10){
            // Contact
            header("Location: patientContact.php");
        }else if($val == 11){
            // Remove Access
            $hcpidR = $_GET['code1'];

            $sql = "DELETE FROM healthcarephr WHERE healthcareproid=" .$hcpidR ." AND patientid=" .$userid;
            $connection_mysql -> query($sql);            
            $connection_mysql->commit();

            $sql = "DELETE FROM healthcareaccess WHERE healthcareproid=" .$hcpidR ." AND patientid=" .$userid;
            $connection_mysql -> query($sql);            
            $connection_mysql->commit();

            $_SESSION['successDel'] = 1;
            header("Location: patientPermissions.php");
        }else{}
    }
?>
<html>
    <head>
        <title>Healthchain</title>
        <link rel = "stylesheet" href="../css/patientPermissions.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    </head>
    <body>
        <form method="POST">
            <header>
                <div class="container">
                    <a href = "?code=3"><span><img id="logo" src="../images/hc.jpg"></span></a>
                    <nav>
                        <a href="?code=3">Healthchain</a>
                        <a href="?code=1" class="move">View PHR</a>
                        <a href="?code=2">HCP Database</a>
                        <a href="?code=8">Account</a>
                        <a href="javascript:openArrowMenu()"> <i id="downArrow" class="fa fa-caret-down"></i> </a>
                        <div id="arrowDropdown" class="arrowDropdown-content">
                            <a href ="?code=4"><i class="fa fa-address-card"></i><div class = "sidebarContent">&nbsp &nbsp About</div></a>
                            <a href="?code=5"><i class="fa fa-question-circle"></i><div class = "sidebarContent">&nbsp &nbsp Help</div></a>
                            <a href="?code=6"><i class="fa fa-power-off"></i><div class = "sidebarContent">&nbsp &nbsp Log Out</div></a>
                        </div>
                    </nav>
                </div>
            </header>
            <div class="sidebar">
                <a href="?code=3"><img class = "userPic" src = "../images/hc.jpg" width = "25px" height = "25px"><div class = "sidebarContent">&nbsp  &nbsp Healthchain</div></a>
                <div class="sidebarMiddleContent">
                    <a href="?code=1"> <i id="contentSidebar" class="fa fa-eye"></i> <div class = "sidebarContent">&nbsp  &nbsp View PHR</div></a>
                    <a href="?code=7"> <i id="contentSidebar" class="fa fa-refresh"></i> <div class = "sidebarContent">&nbsp  &nbsp Update PHR</div></a>
                    <a href="#" class="active"> <i id="contentSidebar" class="fa fa-lock"></i> <div class = "sidebarContent">&nbsp  &nbsp Permissions</div></a>
                    <a href="?code=8"> <i id="contentSidebar" class="fa fa-sign-in"></i> <div class = "sidebarContent">&nbsp  &nbsp Account</div></a>
                    <a href="?code=2"> <i id="contentSidebar" class="fa fa-database"></i> <div class = "sidebarContent">&nbsp  &nbsp HCP Database</div></a>
                </div>
                <a href="?code=6" class="logoutSidebar"><img class = "userPic" src = "../images/hc.jpg" width = "25px" height = "25px"> <div class = "sidebarContent">&nbsp  &nbsp Logout</div></a>
            </div>
            <div class="middleContent">

                <a href="#">
                    <div class="permissionHeader">
                        <h1> Healthcare Professional PHR Permissions </h1>
                    </div>
                </a>
                <?php $sql = mysqli_query($connection_mysql,"SELECT * FROM healthcareaccess WHERE patientid=" .$userid);
                      while($row = mysqli_fetch_array($sql)){
                            $hcpid = $row['healthcareproid'];

                            $sql1 = mysqli_query($connection_mysql,"SELECT * FROM healthcareproinfo WHERE healthcareproid=" .$hcpid);
                            while($row1 = mysqli_fetch_array($sql1)){
                                $name = $row1['firstname'] ." " .$row1['lastname'];
                                $phone = $row1['phonenumber'];
                                $profession = $row1['profession'];
                                $city = $row1['city'];
                                $prov = $row1['province']; ?>
                                <a href="#">
                                    <div class = "searchResults">
                                        <img src="../images/hcp.png" alt="HCP Logo" />
                                        <h2>Name: <?php Print $name; ?> </h2>
                                        <h2>Phone Number: <?php Print $phone; ?> </h2>
                                        <h2>Profession: <?php Print $profession; ?> </h2>
                                        <h2>City: <?php Print $city; ?> </h2>
                                        <h2>Province: <?php Print $prov; ?> </h2>
                                    </div>
                                </a>
                                <a href="?code=11&code1=<?php Print $hcpid; ?>">
                                    <div class="underResults">
                                        <i class="fa fa-trash" id="trash"></i><div class="removeT"> Remove </div>
                                    </div>
                                </a>
                            <?php }
                      } ?>

                <div class = "footer">
                    <a href="?code=4">About</a>
                    <a href="?code=5">Help</a>
                    <a href="?code=9">Accessibility</a>
                    <a href="?code=10">Contact Us</a>
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