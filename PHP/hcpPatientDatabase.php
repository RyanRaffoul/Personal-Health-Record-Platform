<?php
    // hcpPatientDatabase.php
    // HCP Patient Database
    session_start();
    
    $currentUser = $_SESSION['currentUser'];

    $mysql_host = 'localhost';
	$mysql_user = 'root';
	$mysql_db = 'healthchaindb';
	
	$connection_mysql = mysqli_connect($mysql_host,$mysql_user,"");

    mysqli_select_db($connection_mysql,"healthchaindb") or die("Cannot connect to database");

    if(isset($_SESSION['empty123'])){
        alert("Empty Search");
        unset($_SESSION['empty123']);
    }

    $sql = mysqli_query($connection_mysql,"SELECT * FROM healthcarepro WHERE username = '" .$currentUser ."'");
    while($row = mysqli_fetch_array($sql)){
        $userid = $row['healthcareproid'];
    }

    // searches for patients
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $submitName = isset($_POST['submitName']);
        $submitUsername = isset($_POST['submitUsername']);
        $submitCity = isset($_POST['submitCity']);

        if($submitName){
            $searchName = $_POST['searchName'];
            if(isset($searchName) && $searchName == ""){
                $_SESSION['empty123'] = 1;
                header("Location: hcpPatientDatabase.php");
            }else{
                $_SESSION['patientNameV'] = $searchName;
                header("Location: hcpResults.php");
            }
        }

        if($submitUsername){
            $searchUsername = $_POST['searchUsername'];
            if(isset($searchUsername) && $searchUsername == ""){
                $_SESSION['empty123'] = 1;
                header("Location: hcpPatientDatabase.php");
            }else{
                $_SESSION['patientUsernameV'] = $searchUsername;
                header("Location: hcpResults.php");
            }
        }

        if($submitCity){
            $searchCity = $_POST['searchCity'];
            if(isset($searchCity) && $searchCity == ""){
                $_SESSION['empty123'] = 1;
                header("Location: hcpPatientDatabase.php");
            }else{
                $_SESSION['patientCityV'] = $searchCity;
                header("Location: hcpResults.php");
            }
        }
    }

    // PAGE MOVES
    if(isset($_GET['code'])){
        $val = $_GET['code'];
        if($val == 1){
            // Patient Database
            header("Location: hcpHome.php");
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
            header("Location: hcpResults.php");
        }else{}
    }


?>
<html>
    <head>
        <title>Healthchain</title>
        <link rel = "stylesheet" href="../css/hcpPatientDatabase.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    </head>
    <body>
        <form method="POST">
            <header>
                <div class="container">
                    <a href="?code=1"><span><img id="logo" src="../images/hc.jpg"></span></a>
                    <nav>
                        <a href="?code=1">Healthchain</a>
                        <a href="#">Patient Database</a>
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
                <a href="?code=1"><img class = "userPic" src = "../images/hc.jpg" width = "25px" height = "25px"><div class = "sidebarContent">&nbsp  &nbsp Healthchain</div></a>
                <div class="sidebarMiddleContent">
                    <a href="#" class="active"> <i id="contentSidebar" class="fa fa-eye"></i> <div class = "sidebarContent">&nbsp  &nbsp View PHRs</div></a>
                    <a href="#" class="active"> <i id="contentSidebar" class="fa fa-database"></i> <div class = "sidebarContent">&nbsp  &nbsp Patient Database</div></a>
                    <a href="?code=2"> <i id="contentSidebar" class="fa fa-sign-in"></i> <div class = "sidebarContent">&nbsp  &nbsp Account</div></a>
                </div>
                <a href="?code=5" class="logoutSidebar"><img class = "userPic" src = "../images/hc.jpg" width = "25px" height = "25px"> <div class = "sidebarContent">&nbsp  &nbsp Logout</div></a>
            </div>
            <div class="middleContent">
                <a href="#" id="searchOutline">
                    <div class="hcpDB">
                        <h1> Patient Database </h1>
                    </div>
                </a>    
                <a href="?code=8" id="searchOutline">
                    <div class="searchDB" onclick="">
                        <h2> Search By List </h2>
                    </div>
                </a>
                <a href="#" id="searchOutline">
                    <div class="searchDB" onclick="openNameOverlay()">
                        <h2> Search By Name </h2>
                    </div>
                </a>
                <a href="#" id="searchOutline">
                    <div class="searchDB" onclick="openUsernameOverlay()">
                        <h2> Search By Username </h2>
                    </div>
                </a>    
                <a href="#" id="searchOutline">
                    <div class="searchDB" onclick="openCityOverlay()">
                        <h2> Search By City </h2>
                    </div>
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

            <!-- Name Search -->
            <div id="nameoverlay">
                <div class = "nameoverlaycontent">
                    <a href="#" class="none">
                        <div onclick="closeNameOverlay()">
                            <i class="fa fa-times" id="closeO"></i>
                        </div>
                    </a>
                    <h2>Patient Database</h2>
                    <h3>Search By Name</h3>
                        <div class="search">
                            <input name="searchName" type="text" class="searchTerm" placeholder="Enter Patient Name">
                            <input name="submitName" type="submit" id="searchButton" class="fa" value="&#xf002"></input>
                        </div>
                </div>
            </div>

            <!-- Username Search -->
            <div id="usernameoverlay">
                <div class = "usernameoverlaycontent">
                    <a href="#" class="none">
                        <div onclick="closeUsernameOverlay()">
                            <i class="fa fa-times" id="closeO"></i>
                        </div>
                    </a>
                    <h2>Patient Database</h2>
                    <h3>Search By Username</h3>
                        <div class="search">
                            <input name="searchUsername" type="text" class="searchTerm" placeholder="Enter Patient Username">
                            <input name="submitUsername" type="submit" id="searchButton" class="fa" value="&#xf002"></input>
                        </div>
                </div>
            </div>

            <!-- City Search -->
            <div id="cityoverlay">
                <div class = "cityoverlaycontent">
                    <a href="#" class="none">
                        <div onclick="closeCityOverlay()">
                            <i class="fa fa-times" id="closeO"></i>
                        </div>
                    </a>
                    <h2>Patient Database</h2>
                    <h3>Search By City</h3>
                        <div class="search">
                            <input name="searchCity" type="text" class="searchTerm" placeholder="Enter Patient City">
                            <input name="submitCity" type="submit" id="searchButton" class="fa" value="&#xf002"></input>
                        </div>
                </div>
            </div>

        </form>
    </body>
    <script>
        function closeSearchResultsOverlay(){
            document.getElementById("searchresultsoverlay").style.display="none";
        }

        function openNameOverlay() {
            document.getElementById("nameoverlay").style.display = "block";
        }
        function closeNameOverlay() {
            document.getElementById("nameoverlay").style.display = "none";
        }

        function openUsernameOverlay() {
            document.getElementById("usernameoverlay").style.display = "block";
        }
        function closeUsernameOverlay() {
            document.getElementById("usernameoverlay").style.display = "none";
        }

        function openCityOverlay() {
            document.getElementById("cityoverlay").style.display = "block";
        }
        function closeCityOverlay() {
            document.getElementById("cityoverlay").style.display = "none";
        }

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