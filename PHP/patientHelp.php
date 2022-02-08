<?php
    // patientHelp.php
    // Healthchain Help
    session_start();

    $currentUser = $_SESSION['currentUser'];

    $mysql_host = 'localhost';
	$mysql_user = 'root';
	$mysql_db = 'healthchaindb';
	
	$connection_mysql = mysqli_connect($mysql_host,$mysql_user,"");

    mysqli_select_db($connection_mysql,"healthchaindb") or die("Cannot connect to database");

    $sql = mysqli_query($connection_mysql,"SELECT * FROM patient WHERE username = '" .$currentUser ."'");
    while($row = mysqli_fetch_array($sql)){
        $userid = $row['patientid'];
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
            header("Location: patientAccount.php");
        }else if($val == 4){
            // About
            header("Location: patientAbout.php");
        }else if($val == 5){
            // Help
            header("Location: patientHome.php");
        }else if($val == 6){
            // Log Out
            session_unset();
            header("Location: launch.php");
        }else if($val == 7){
            // Update PHR
            header("Location: patientUpdatePHRPK.php");
        }else if($val == 8){
            // Permissions
            header("Location: patientPermissions.php");
        }else if($val == 9){
            // Accessibility
            header("Location: patientAccessibility.php");
        }else if($val == 10){
            // Contact
            header("Location: patientContact.php");
        }else{}
    }
?>
<html>
    <head>
        <title>Healthchain</title>
        <link rel = "stylesheet" href="../css/patientHelp.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    </head>
    <body>
        <form method="POST">
            <header>
                <div class="container">
                    <a href="?code=5"><span><img id="logo" src="../images/hc.jpg"></span></a>
                    <nav>
                        <a href="?code=5">Healthchain</a>
                        <a href="?code=1" class="move">View PHR</a>
                        <a href="?code=2">HCP Database</a>
                        <a href="?code=3">Account</a>
                        <a href="javascript:openArrowMenu()"> <i id="downArrow" class="fa fa-caret-down"></i> </a>
                        <div id="arrowDropdown" class="arrowDropdown-content">
                            <a href ="?code=4"><i class="fa fa-address-card"></i><div class = "sidebarContent">&nbsp &nbsp About</div></a>
                            <a href="#"><i class="fa fa-question-circle"></i><div class = "sidebarContent">&nbsp &nbsp Help</div></a>
                            <a href="?code=6"><i class="fa fa-power-off"></i><div class = "sidebarContent">&nbsp &nbsp Log Out</div></a>
                        </div>
                    </nav>
                </div>
            </header>
            <div class="sidebar">
                <a href="?code=5"><img class = "userPic" src = "../images/hc.jpg" width = "25px" height = "25px"><div class = "sidebarContent">&nbsp  &nbsp Healthchain</div></a>
                <div class="sidebarMiddleContent">
                    <a href="?code=1"> <i id="contentSidebar" class="fa fa-eye"></i> <div class = "sidebarContent">&nbsp  &nbsp View PHR</div></a>
                    <a href="?code=7"> <i id="contentSidebar" class="fa fa-refresh"></i> <div class = "sidebarContent">&nbsp  &nbsp Update PHR</div></a>
                    <a href="?code=8"> <i id="contentSidebar" class="fa fa-lock"></i> <div class = "sidebarContent">&nbsp  &nbsp Permissions</div></a>
                    <a href="?code=3"> <i id="contentSidebar" class="fa fa-sign-in"></i> <div class = "sidebarContent">&nbsp  &nbsp Account</div></a>
                    <a href="?code=2"> <i id="contentSidebar" class="fa fa-database"></i> <div class = "sidebarContent">&nbsp  &nbsp HCP Database</div></a>
                </div>
                <a href="?code=6" class="logoutSidebar"><img class = "userPic" src = "../images/hc.jpg" width = "25px" height = "25px"> <div class = "sidebarContent">&nbsp  &nbsp Logout</div></a>
            </div>
            <div class="middleContent">
                <a href="#">
                    <div class="aboutHeader">
                        <h1>Help</h1>
                    </div>
                </a>
                <a href="#">
                    <div class="about">
                        <h3>Create PHR</h3>
                        <p>1. Click each module to create different PHR data.</p>
                        <p>2. Click done on each module when completed.</p>
                        <p>3. When done creating your PHR, click create.</p>
                        <p>4. Enter your Private Key to create.</p>
                        <p>5. PHR has now been created.</p>
                    </div>
                    <div class="about">
                        <h3>View PHR</h3>
                        <p>1. Enter your Private Key to view your PHR.</p>
                        <p>2. You can now see your PHR.</p>
                        <p>3. View in module form on scroll to the bottom and view in PDF form.</p>
                    </div>
                    <div class="about">
                        <h3>Update PHR</h3>
                        <p>1. Enter your Private Key to update your PHR.</p>
                        <p>2. You can now see your PHR.</p>
                        <p>3. To update, select the module you wish to change and change the data and then click done.</p>
                        <p>4. To finish the update, scroll down and select update.</p>
                        <p>5. Enter your Private Key to update.</p>
                        <p>6. PHR has now been updated.</p>
                    </div>
                    <div class="about">
                        <h3>Permissions</h3>
                        <p>1. View the list of Healthcare Professionals who can view your PHR.</p>
                        <p>2. To delete a Permission, simply select remove.</p>
                        <p>3. Healthcare Professional can now not view your PHR.</p>
                    </div>
                    <div class="about">
                        <h3>Account</h3>
                        <p>1. You can view all Account info as well as PHR stats.</p>
                        <p>2. To change Account info, select edit.</p>
                        <p>3. Edit any information and select edit.</p>
                        <p>4. Information will now be edited.</p>
                    </div>
                    <div class="about">
                        <h3>HCP Database</h3>
                        <p>1. Search any way you like to find a Healthcare Professional.</p>
                        <p>2. Enter your Private Key to give permission to a Healthcare Profession to view your PHR.</p>
                        <p>3. Healthcare Professional can now view your PHR.</p>
                    </div>
                    <div class="about">
                        <h3>Private Key</h3>
                        <p>1. Copy your Private Key when registering into a safe place.</p>
                        <p>2. When entering, Private Key must be exact.</p>
                        <p>3. Only enter Private Key, not --- BEGIN PRIVATE KEY --- and --- END PRIVATE KEY ---.</p>
                    </div>
                </a>
                <div class = "footer">
                    <a href="?code=4">About</a>
                    <a href="#">Help</a>
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