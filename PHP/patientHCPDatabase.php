<?php
    // patientHCPDatabase.php
    // Patient finding HCP to share PHR
    session_start();

    // when shared
    if(isset($_SESSION['successSharePatientPHR'])){
        alert("PHR has been Shared with HCP");
        unset($_SESSION['successSharePatientPHR']);
    }
    
    $currentUser = $_SESSION['currentUser'];

    $mysql_host = 'localhost';
	$mysql_user = 'root';
	$mysql_db = 'healthchaindb';
	
	$connection_mysql = mysqli_connect($mysql_host,$mysql_user,"");

    mysqli_select_db($connection_mysql,"healthchaindb") or die("Cannot connect to database");

    $boolHospital = false;
    $boolLocation = false;
    $boolProfession = false;
    $boolName = false;
    $boolOrganization = false;
    $boolOffice = false;
    
    $boolPK = false;

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

    // get search
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $submitHospital = isset($_POST['submitHospital']);
        $submitLocation = isset($_POST['submitLocation']);
        $submitProfession = isset($_POST['submitProfession']);
        $submitName = isset($_POST['submitName']);
        $submitOrganization = isset($_POST['submitOrganization']);
        $submitOffice = isset($_POST['submitOffice']);

        // search by hospital
        if($submitHospital){
            $searchHospital = $_POST['searchHospital'];
            if($searchHospital){
                $boolHospital = true;

                $sql = mysqli_query($connection_mysql,"SELECT * FROM healthcareproinfo WHERE hospital = '" .$searchHospital ."'");
                $row = mysqli_fetch_row($sql);
                if($row <= 0){
                    $boolHospital = false;
                    alert("No Results");
                }else{
                    $sql = mysqli_query($connection_mysql,"SELECT * FROM healthcareproinfo WHERE hospital = '" .$searchHospital ."'");
                }

            }else{
                alert("No Results");
            }
        }

        // search by location
        if($submitLocation){
            $searchLocation = $_POST['searchLocation'];
            if($searchLocation){
                $boolLocation = true;

                $sql = mysqli_query($connection_mysql,"SELECT * FROM healthcareproinfo WHERE city = '" .$searchLocation ."'");
                $row = mysqli_fetch_row($sql);
                if($row <= 0){
                    $boolLocation = false;
                    alert("No Results");
                }else{
                    $sql = mysqli_query($connection_mysql,"SELECT * FROM healthcareproinfo WHERE city = '" .$searchLocation ."'");
                }
            }else{
                alert("No Results");
            }
        }
        // search by Profession
        if($submitProfession){
            $searchProfession = $_POST['searchProfession'];
            if($searchProfession){
                $boolProfession = true;

                $sql = mysqli_query($connection_mysql,"SELECT * FROM healthcareproinfo WHERE profession = '" .$searchProfession ."'");
                $row = mysqli_fetch_row($sql);
                if($row <= 0){
                    $boolProfession = false;
                    alert("No Results");
                }else{
                    $sql = mysqli_query($connection_mysql,"SELECT * FROM healthcareproinfo WHERE profession = '" .$searchProfession ."'");
                }
            }else{
                alert("No Results");
            }
        }
        // search by Name
        if($submitName){
            $searchName = $_POST['searchName'];
            if(str_word_count($searchName) != 2){
                alert("No Results");
            }else{
                $pieces = explode(" ",$searchName);
                if($searchName){
                    $boolName = true;
    
                    $sql = mysqli_query($connection_mysql,"SELECT * FROM healthcareproinfo WHERE firstname = '" .$pieces[0] ."' AND lastname = '" .$pieces[1] ."'");
                    $row = mysqli_fetch_row($sql);
                    if($row <= 0){
                        $boolName = false;
                        alert("No Results");
                    }else{
                        $sql = mysqli_query($connection_mysql,"SELECT * FROM healthcareproinfo WHERE firstname = '" .$pieces[0] ."' AND lastname = '" .$pieces[1] ."'");
                    }
                }else{
                    alert("No Results");
                }
            }
        }
        // search by Organization
        if($submitOrganization){
            $searchOrganization = $_POST['searchOrganization'];
            if($searchOrganization){
                $boolOrganization = true;

                $sql = mysqli_query($connection_mysql,"SELECT * FROM healthcareproinfo WHERE organization = '" .$searchOrganization ."'");
                $row = mysqli_fetch_row($sql);
                if($row <= 0){
                    $boolOrganization = false;
                    alert("No Results");
                }else{
                    $sql = mysqli_query($connection_mysql,"SELECT * FROM healthcareproinfo WHERE organization = '" .$searchOrganization ."'");
                }
            }else{
                alert("No Results");
            }
        }
        // search by Office
        if($submitOffice){
            $searchOffice = $_POST['searchOffice'];
            if($searchOffice){
                $boolOffice = true;

                $sql = mysqli_query($connection_mysql,"SELECT * FROM healthcareproinfo WHERE office = '" .$searchOffice ."'");
                $row = mysqli_fetch_row($sql);
                if($row <= 0){
                    $boolOffice = false;
                    alert("No Results");
                }else{
                    $sql = mysqli_query($connection_mysql,"SELECT * FROM healthcareproinfo WHERE office = '" .$searchOffice ."'");
                }
            }else{
                alert("No Results");
            }
        }
    }

    // PAGE MOVES
    if(isset($_GET['code'])){
        $val = $_GET['code'];
        if($val == 1){
            // View PHR
            header("Location: patientViewPHRPK.php");
        }else if($val == 2){
            // Patient Home
            header("Location: patientHome.php");
        }else if($val == 3){
            // Account
            header("Location: patientAccount.php");
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
            header("Location: patientPermissions.php");
        }else if($val == 9){
            // Search Results
            $hcpidS = $_GET['code1'];
            $_SESSION['healthcareProSearchId'] = $hcpidS;
            header("Location: patientPHRPermission.php");
        }else if($val == 10){
            // Accessibility
            header("Location: patientAccessibility.php");
        }else if($val == 11){
            // Accessibility
            header("Location: patientContact.php");
        }
    }


?>
<html>
    <head>
        <title>Healthchain</title>
        <link rel = "stylesheet" href="../css/patientHCPDatabase.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    </head>
    <body>
        <form method="POST">
            <header>
                <div class="container">
                    <a href="?code=2"><span><img id="logo" src="../images/hc.jpg"></span></a>
                    <nav>
                        <a href="?code=2">Healthchain</a>
                        <a href="?code=1" class="move">View PHR</a>
                        <a href="#">HCP Database</a>
                        <a href="?code=3">Account</a>
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
                <a href="?code=2" class="sidebarHighlight"><img class = "userPic" src = "../images/hc.jpg" width = "25px" height = "25px"><div class = "sidebarContent">&nbsp  &nbsp Healthchain</div></a>
                <div class="sidebarMiddleContent">
                    <a href="?code=1"> <i id="contentSidebar" class="fa fa-eye"></i> <div class = "sidebarContent">&nbsp  &nbsp View PHR</div></a>
                    <a href="?code=7"> <i id="contentSidebar" class="fa fa-refresh"></i> <div class = "sidebarContent">&nbsp  &nbsp Update PHR</div></a>
                    <a href="?code=8"> <i id="contentSidebar" class="fa fa-lock"></i> <div class = "sidebarContent">&nbsp  &nbsp Permissions</div></a>
                    <a href="?code=3"> <i id="contentSidebar" class="fa fa-sign-in"></i> <div class = "sidebarContent">&nbsp  &nbsp Account</div></a>
                    <a href="#" class="active"> <i id="contentSidebar" class="fa fa-database"></i> <div class = "sidebarContent">&nbsp  &nbsp HCP Database</div></a>
                </div>
                <a href="?code=6" class="logoutSidebar"><img class = "userPic" src = "../images/hc.jpg" width = "25px" height = "25px"> <div class = "sidebarContent">&nbsp  &nbsp Logout</div></a>
            </div>
            <div class="middleContent">
                <a href="#" id="searchOutline">
                    <div class="hcpDB">
                        <h1> Healthcare Professional Database </h1>
                    </div>
                </a>    
                <a href="#" id="searchOutline">
                    <div class="searchDB" onclick="openHospitalOverlay()">
                        <h2> Search By Hospital </h2>
                    </div>
                </a>
                <a href="#" id="searchOutline">
                    <div class="searchDB" onclick="openLocationOverlay()">
                        <h2> Search By Location </h2>
                    </div>
                </a>    
                <a href="#" id="searchOutline">
                    <div class="searchDB" onclick="openProfessionOverlay()">
                        <h2> Search By Profession </h2>
                    </div>
                </a>
                <a href="#" id="searchOutline">    
                    <div class="searchDB" onclick="openNameOverlay()">
                        <h2> Search By Name </h2>
                    </div>
                </a>    
                <a href="#" id="searchOutline">
                    <div class="searchDB" onclick="openOrganizationOverlay()">
                        <h2> Search By Organization </h2>
                    </div>
                </a>   
                <a href="#" id="searchOutline">
                    <div class="searchDB" onclick="openOfficeOverlay()">
                        <h2> Search By Office </h2>
                    </div>
                </a>
                <div class = "footer">
                    <a href="?code=4">About</a>
                    <a href="?code=5">Help</a>
                    <a href="?code=10">Accessibility</a>
                    <a href="?code=11">Contact Us</a>
                </div>
            </div>
            <div class="rightLine">
            </div>

            <!-- Hospital Search -->
            <div id="hospitaloverlay">
                <div class = "hospitaloverlaycontent">
                    <a href="#" class="none">
                        <div onclick="closeHospitalOverlay()">
                            <i class="fa fa-times" id="closeO"></i>
                        </div>
                    </a>
                    <h2>Healthcare Professional Database</h2>
                    <h3>Search By Hospital</h3>
                        <div class="search">
                            <input name="searchHospital" type="text" class="searchTerm" placeholder="Enter HCP Hospital">
                            <input name="submitHospital" type="submit" id="searchButton" class="fa" value="&#xf002"></input>
                        </div>
                </div>
            </div>

            <!-- Location Search -->
            <div id="locationoverlay">
                <div class = "locationoverlaycontent">
                    <a href="#" class="none">
                        <div onclick="closeLocationOverlay()">
                            <i class="fa fa-times" id="closeO"></i>
                        </div>
                    </a>
                    <h2>Healthcare Professional Database</h2>
                    <h3>Search By Location</h3>
                        <div class="search">
                            <input name="searchLocation" type="text" class="searchTerm" placeholder="Enter HCP City">
                            <input name="submitLocation" type="submit" id="searchButton" class="fa" value="&#xf002"></input>
                        </div>
                </div>
            </div>

            <!-- Profession Search -->
            <div id="professionoverlay">
                <div class = "professionoverlaycontent">
                    <a href="#" class="none">
                        <div onclick="closeProfessionOverlay()">
                            <i class="fa fa-times" id="closeO"></i>
                        </div>
                    </a>
                    <h2>Healthcare Professional Database</h2>
                    <h3>Search By Profession</h3>
                        <div class="search">
                            <input name="searchProfession" type="text" class="searchTerm" placeholder="Enter HCP Profession">
                            <input name="submitProfession" type="submit" id="searchButton" class="fa" value="&#xf002"></input>
                        </div>
                </div>
            </div>

            <!-- Name Search -->
            <div id="nameoverlay">
                <div class = "nameoverlaycontent">
                    <a href="#" class="none">
                        <div onclick="closeNameOverlay()">
                            <i class="fa fa-times" id="closeO"></i>
                        </div>
                    </a>
                    <h2>Healthcare Professional Database</h2>
                    <h3>Search By Name</h3>
                        <div class="search">
                            <input name="searchName" type="text" class="searchTerm" placeholder="Enter HCP First Name and Last Name">
                            <input name="submitName" type="submit" id="searchButton" class="fa" value="&#xf002"></input>
                        </div>
                </div>
            </div>

            <!-- Organization Search -->
            <div id="organizationoverlay">
                <div class = "organizationoverlaycontent">
                    <a href="#" class="none">
                        <div onclick="closeOrganizationOverlay()">
                            <i class="fa fa-times" id="closeO"></i>
                        </div>
                    </a>
                    <h2>Healthcare Professional Database</h2>
                    <h3>Search By Organization</h3>
                        <div class="search">
                            <input name="searchOrganization" type="text" class="searchTerm" placeholder="Enter HCP Organization">
                            <input name="submitOrganization" type="submit" id="searchButton" class="fa" value="&#xf002"></input>
                        </div>
                </div>
            </div>

            <!-- Office Search -->
            <div id="officeoverlay">
                <div class = "officeoverlaycontent">
                    <a href="#" class="none">
                        <div onclick="closeOfficeOverlay()">
                            <i class="fa fa-times" id="closeO"></i>
                        </div>
                    </a>
                    <h2>Healthcare Professional Database</h2>
                    <h3>Search By Office</h3>
                        <div class="search">
                            <input name="searchOffice" type="text" class="searchTerm" placeholder="Enter HCP Office">
                            <input name="submitOffice" type="submit" id="searchButton" class="fa" value="&#xf002"></input>
                        </div>
                </div>
            </div>

            <!-- Hospital Search Results -->
            <?php if($boolHospital){ ?>
                    <!-- Search Results-->
                    <div id="searchresultsoverlay">
                        <div class = "searchresultsoverlaycontent">
                            <a href="#" class="none">
                                <div onclick="closeSearchResultsOverlay()">
                                    <i class="fa fa-times" id="closeO"></i>
                                </div>
                            </a>
                            <h2>Share PHR</h2>
                            <h3>Search By Hospital</h3>
                        <?php while($row = mysqli_fetch_array($sql)){
                                    $hcpid = $row['healthcareproid'];
                                    $fname = $row['firstname'];
                                    $lname = $row['lastname'];
                                    $profession = $row['profession'];
                                    $city = $row['city'];
                                    $prov = $row['province'];
                                    $hospital = $row['hospital'];?>
                                <a href="?code=9&code1=<?php Print $hcpid ?>">
                                    <div class = "searchResults">
                                        <img src="../images/hcp.png" alt="HCP Logo" />
                                        <h2>Name: <?php Print $fname ." " .$lname?></h2>
                                        <h2>Profession: <?php Print $profession?></h2>
                                        <h2>Location: <?php Print $city ." " .$prov?></h2>
                                        <h2>Hospital: <?php Print $hospital ?></h2>
                                    </div>
                                </a>
                                <?php } ?>
                            </div>
                        </div>
                <?php } ?>

            <!-- Location Search Results -->
            <?php if($boolLocation){ ?>
                    <!-- Search Results-->
                    <div id="searchresultsoverlay">
                        <div class = "searchresultsoverlaycontent">
                            <a href="#" class="none">
                                <div onclick="closeSearchResultsOverlay()">
                                    <i class="fa fa-times" id="closeO"></i>
                                </div>
                            </a>
                            <h2>Share PHR</h2>
                            <h3>Search By Location</h3>
                        <?php while($row = mysqli_fetch_array($sql)){
                                    $hcpid = $row['healthcareproid'];
                                    $fname = $row['firstname'];
                                    $lname = $row['lastname'];
                                    $profession = $row['profession'];
                                    $city = $row['city'];
                                    $prov = $row['province']; ?>
                                <a href="?code=9&code1=<?php Print $hcpid ?>">
                                    <div class = "searchResults">
                                        <img src="../images/hcp.png" alt="HCP Logo" />
                                        <h2>Name: <?php Print $fname ." " .$lname?></h2>
                                        <h2>Profession: <?php Print $profession?></h2>
                                        <h2>City: <?php Print $city?></h2>
                                        <h2>Province: <?php Print $prov?></h2>
                                    </div>
                                </a>
                                <?php } ?>
                            </div>
                        </div>
                <?php } ?>

            <!-- Profession Search Results -->
            <?php if($boolProfession){ ?>
                    <!-- Search Results-->
                    <div id="searchresultsoverlay">
                        <div class = "searchresultsoverlaycontent">
                            <a href="#" class="none">
                                <div onclick="closeSearchResultsOverlay()">
                                    <i class="fa fa-times" id="closeO"></i>
                                </div>
                            </a>
                            <h2>Share PHR</h2>
                            <h3>Search By Profession</h3>
                        <?php while($row = mysqli_fetch_array($sql)){
                                    $hcpid = $row['healthcareproid'];
                                    $fname = $row['firstname'];
                                    $lname = $row['lastname'];
                                    $profession = $row['profession'];
                                    $city = $row['city'];
                                    $prov = $row['province']; ?>
                                <a href="?code=9&code1=<?php Print $hcpid ?>">
                                    <div class = "searchResults">
                                        <img src="../images/hcp.png" alt="HCP Logo" />
                                        <h2>Name: <?php Print $fname ." " .$lname?></h2>
                                        <h2>Profession: <?php Print $profession?></h2>
                                        <h2>City: <?php Print $city?></h2>
                                        <h2>Province: <?php Print $prov?></h2>
                                    </div>
                                </a>
                                <?php } ?>
                            </div>
                        </div>
                <?php } ?>

            <!-- Name Search Results -->
            <?php if($boolName){ ?>
                    <!-- Search Results-->
                    <div id="searchresultsoverlay">
                        <div class = "searchresultsoverlaycontent">
                            <a href="#" class="none">
                                <div onclick="closeSearchResultsOverlay()">
                                    <i class="fa fa-times" id="closeO"></i>
                                </div>
                            </a>
                            <h2>Share PHR</h2>
                            <h3>Search By Name</h3>
                        <?php while($row = mysqli_fetch_array($sql)){ 
                                    $hcpid = $row['healthcareproid'];
                                    $fname = $row['firstname'];
                                    $lname = $row['lastname'];
                                    $profession = $row['profession'];
                                    $city = $row['city'];
                                    $prov = $row['province']; ?>
                                <a href="?code=9&code1=<?php Print $hcpid ?>">
                                    <div class = "searchResults">
                                        <img src="../images/hcp.png" alt="HCP Logo" />
                                        <h2>Name: <?php Print $fname ." " .$lname?></h2>
                                        <h2>Profession: <?php Print $profession?></h2>
                                        <h2>City: <?php Print $city?></h2>
                                        <h2>Province: <?php Print $prov?></h2>
                                    </div>
                                </a>
                                <?php } ?>
                            </div>
                        </div>
                <?php } ?>

            <!-- Organization Search Results -->
            <?php if($boolOrganization){ ?>
                    <!-- Search Results-->
                    <div id="searchresultsoverlay">
                        <div class = "searchresultsoverlaycontent">
                            <a href="#" class="none">
                                <div onclick="closeSearchResultsOverlay()">
                                    <i class="fa fa-times" id="closeO"></i>
                                </div>
                            </a>
                            <h2>Share PHR</h2>
                            <h3>Search By Organization</h3>
                        <?php while($row = mysqli_fetch_array($sql)){
                                    $hcpid = $row['healthcareproid'];
                                    $fname = $row['firstname'];
                                    $lname = $row['lastname'];
                                    $profession = $row['profession'];
                                    $city = $row['city'];
                                    $prov = $row['province']; 
                                    $organization = $row['organization'];?>
                                <a href="?code=9&code1=<?php Print $hcpid ?>">
                                    <div class = "searchResults">
                                        <img src="../images/hcp.png" alt="HCP Logo" />
                                        <h2>Name: <?php Print $fname ." " .$lname?></h2>
                                        <h2>Profession: <?php Print $profession?></h2>
                                        <h2>Location: <?php Print $city ." " .$prov?></h2>
                                        <h2>Organization: <?php Print $organization?></h2>
                                    </div>
                                </a>
                                <?php } ?>
                            </div>
                        </div>
                <?php } ?>

            <!-- Office Search Results -->
            <?php if($boolOffice){?>
                    <!-- Search Results-->
                    <div id="searchresultsoverlay">
                        <div class = "searchresultsoverlaycontent">
                            <a href="#" class="none">
                                <div onclick="closeSearchResultsOverlay()">
                                    <i class="fa fa-times" id="closeO"></i>
                                </div>
                            </a>
                            <h2>Share PHR</h2>
                            <h3>Search By Office</h3>
                        <?php while($row = mysqli_fetch_array($sql)){ 
                                    $hcpid = $row['healthcareproid'];
                                    $fname = $row['firstname'];
                                    $lname = $row['lastname'];
                                    $profession = $row['profession'];
                                    $city = $row['city'];
                                    $prov = $row['province']; 
                                    $office = $row['office'];?>
                                <a href="?code=9&code1=<?php Print $hcpid ?>">
                                    <div class = "searchResults">
                                        <img src="../images/hcp.png" alt="HCP Logo" />
                                        <h2>Name: <?php Print $fname ." " .$lname?></h2>
                                        <h2>Profession: <?php Print $profession?></h2>
                                        <h2>Location: <?php Print $city ." " .$prov?></h2>
                                        <h2>Office: <?php Print $office?></h2>
                                    </div>
                                </a>
                                <?php } ?>
                            </div>
                        </div>
                <?php } ?>
        </form>
    </body>
    <script>
        function closeSearchResultsOverlay(){
            document.getElementById("searchresultsoverlay").style.display="none";
        }

        function openHospitalOverlay() {
            document.getElementById("hospitaloverlay").style.display = "block";
        }
        function closeHospitalOverlay() {
            document.getElementById("hospitaloverlay").style.display = "none";
        }

        function openLocationOverlay() {
            document.getElementById("locationoverlay").style.display = "block";
        }
        function closeLocationOverlay() {
            document.getElementById("locationoverlay").style.display = "none";
        }

        function openProfessionOverlay() {
            document.getElementById("professionoverlay").style.display = "block";
        }
        function closeProfessionOverlay() {
            document.getElementById("professionoverlay").style.display = "none";
        }

        function openNameOverlay() {
            document.getElementById("nameoverlay").style.display = "block";
        }
        function closeNameOverlay() {
            document.getElementById("nameoverlay").style.display = "none";
        }

        function openOrganizationOverlay() {
            document.getElementById("organizationoverlay").style.display = "block";
        }
        function closeOrganizationOverlay() {
            document.getElementById("organizationoverlay").style.display = "none";
        }

        function openOfficeOverlay() {
            document.getElementById("officeoverlay").style.display = "block";
        }
        function closeOfficeOverlay() {
            document.getElementById("officeoverlay").style.display = "none";
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