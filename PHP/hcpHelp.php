<?php
    // hcpHelp.php
    // Healthchain Help Page
    session_start();

    $currentUser = $_SESSION['currentUser'];

    $mysql_host = 'localhost';
	$mysql_user = 'root';
	$mysql_db = 'healthchaindb';
	
	$connection_mysql = mysqli_connect($mysql_host,$mysql_user,"");

    mysqli_select_db($connection_mysql,"healthchaindb") or die("Cannot connect to database");

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
            header("Location: hcpHome.php");
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
        }else{}
    }
?>
<html>
    <head>
        <title>Healthchain</title>
        <link rel = "stylesheet" href="../css/hcpHelp.css">
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
                        <a href="?code=3">Healthchain</a>
                        <a href="?code=1">Patient Database</a>
                        <a href="?code=2">Account</a>
                        <a href="#">Help</a>
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
                <a href="?code=3"><img class = "userPic" src = "../images/hc.jpg" width = "25px" height = "25px"><div class = "sidebarContent">&nbsp  &nbsp Healthchain</div></a>
                <div class="sidebarMiddleContent">
                    <a href="?code=1"> <i id="contentSidebar" class="fa fa-eye"></i> <div class = "sidebarContent">&nbsp  &nbsp View PHRs</div></a>
                    <a href="?code=1"> <i id="contentSidebar" class="fa fa-database"></i> <div class = "sidebarContent">&nbsp  &nbsp Patient Database</div></a>
                    <a href="?code=2"> <i id="contentSidebar" class="fa fa-sign-in"></i> <div class = "sidebarContent">&nbsp  &nbsp Account</div></a>
                </div>
                <a href="?code=5" class="logoutSidebar"><img class = "userPic" src = "../images/hc.jpg" width = "25px" height = "25px"> <div class = "sidebarContent">&nbsp  &nbsp Logout</div></a>
            </div>
            <div class="middleContent">
                <a href="#">
                    <div class="aboutHeader">
                        <h1>Help</h1>
                    </div>
                </a>
                <a href="#">
                    <div class="about">
                        <h3>View PHR</h3>
                        <p>1. Find a PHR you have access to by using the Patient Database.</p>
                        <p>2. You can now see the PHR you have access to.</p>
                    </div>
                    <div class="about">
                        <h3>Permissions</h3>
                        <p>1. Users give you Permission to see their PHR.</p>
                        <p>2. A notification is given when they give you Permission.</p>
                    </div>
                    <div class="about">
                        <h3>Account</h3>
                        <p>1. You can view all Account info.</p>
                        <p>2. To change Account info, select edit.</p>
                        <p>3. Edit any information and select edit.</p>
                        <p>4. Information will now be edited.</p>
                    </div>
                    <div class="about">
                        <h3>Patient Database</h3>
                        <p>1. Search any way you like to find a Patient's PHR you have access to.</p>
                        <p>2. Select the PHR you have access to and wish to view.</p>
                        <p>3. You can now view the PHR in module format or pdf format.</p>
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