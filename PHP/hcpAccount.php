<?php
    // hcpAccount.php
    // HCP Account Information
    session_start();

    // when updated
    if(isset($_SESSION['successA'])){
        alert("Updated");
        unset($_SESSION['successA']);
    }
    if(isset($_SESSION['incorrectusername'])){
        alert("Invalid Username");
        unset($_SESSION['incorrectusername']);
    }
    if(isset($_SESSION['incorrectemail'])){
        alert("Invalid E-mail");
        unset($_SESSION['incorrectemail']);
    }
    if(isset($_SESSION['incorrectfname'])){
        alert("Invalid First Name");
        unset($_SESSION['incorrectfname']);
    }
    if(isset($_SESSION['incorrectlname'])){
        alert("Invalid Last Name");
        unset($_SESSION['incorrectlname']);
    }
    if(isset($_SESSION['incorrectphone'])){
        alert("Invalid Phone Number");
        unset($_SESSION['incorrectphone']);
    }
    if(isset($_SESSION['incorrectcity'])){
        alert("Invalid City");
        unset($_SESSION['incorrectcity']);
    }

    $currentUser = $_SESSION['currentUser'];

    $mysql_host = 'localhost';
	$mysql_user = 'root';
	$mysql_db = 'healthchaindb';
	
	$connection_mysql = mysqli_connect($mysql_host,$mysql_user,"");

    mysqli_select_db($connection_mysql,"healthchaindb") or die("Cannot connect to database");

    // HCP info
    $sql = mysqli_query($connection_mysql,"SELECT * FROM healthcarepro WHERE username = '" .$currentUser ."'");
    while($row = mysqli_fetch_array($sql)){
        $userid = $row['healthcareproid'];
        $email = $row['email'];
        $dateCreated = $row['datecreated'];
    }

    // HCP info
    $sql = mysqli_query($connection_mysql,"SELECT * FROM healthcareproinfo WHERE healthcareproid = " .$userid);
    while($row = mysqli_fetch_array($sql)){
        $firstname = $row['firstname'];
        $lastname = $row['lastname'];
        $phone = $row['phonenumber'];
        $city = $row['city'];
        $prov = $row['province'];
        $profession = $row['profession'];
        $hospital = $row['hospital'];
        $organization = $row['organization'];
        $office = $row['office'];
    }

    if(!isset($hospital)){
        $hospital = "";
    }
    if(!isset($organization)){
        $organization = "";
    }
    if(!isset($office)){
        $office = "";
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $doneInfo = isset($_POST['doneInfo']);

        // update info if selected
        if($doneInfo){
            $usernameNew = $_POST['username'];
            $emailNew = $_POST['email'];
            $firstNew = $_POST['firstname'];
            $lastNew = $_POST['lastname'];
            $phoneNew = $_POST['phone'];
            $cityNew = $_POST['city'];
            $provNew = $_POST['province'];
            $professionNew = $_POST['profession'];
            $hospitalNew = $_POST['hospital'];
            $organizationNew = $_POST['organization'];
            $officeNew = $_POST['office'];
            $successBool = false;

            // Change Username
            $usernameEmpty = false;
            $usernameLength = false;
            $usernameExists = false;
            if($usernameNew != $currentUser){
                if(empty($usernameNew)){
                    $usernameEmpty = true;
                }
                if((strlen($usernameNew) < 4) || (strlen($usernameNew) > 40)){
                    $usernameLength = true;
                }
                $query = mysqli_query($connection_mysql, "SELECT * FROM healthcarepro");
                while($row = mysqli_fetch_array($query)){
                    $table_users = $row['username'];
                    
                    if($usernameNew == $table_users){
                        $usernameExists = true;
                        break;
                    }
                }
                if(!$usernameEmpty && !$usernameLength && !$usernameExists){
                    $sql = "UPDATE healthcarepro SET username='" .$usernameNew ."' WHERE healthcareproid=" .$userid;
                    $connection_mysql -> query($sql);            
                    $connection_mysql->commit();

                    $_SESSION['successA'] = 1;
                    $_SESSION['currentUser'] = $usernameNew;
                }else{
                    $_SESSION['incorrectusername'] = 1;
                    header("Location: hcpAccount.php");
                }
            }

            // Change E-mail
            $emailEmpty = false;
            $emaiValid = false;
            $emailExists = false;
            if($emailNew != $email){
                if(empty($emailNew)){
                    $emailEmpty = true;
                }
                if (!filter_var($emailNew, FILTER_VALIDATE_EMAIL)) {
                    $emaiValid = true;
                }
                $query = mysqli_query($connection_mysql, "SELECT * FROM healthcarepro");
                while($row = mysqli_fetch_array($query)){
                    $table_email = $row['email'];
                    
                    if($email == $table_email){
                        $emailExists = true;
                        break;
                    }
                }
                if(!$emailEmpty && !$emaiValid && !$emailExists){
                    $sql = "UPDATE healthcarepro SET email='" .$emailNew ."' WHERE healthcareproid=" .$userid;
                    $connection_mysql -> query($sql);            
                    $connection_mysql->commit();

                    $_SESSION['successA'] = 1;
                }else{
                    $_SESSION['incorrectemail'] = 1;
                    header("Location: hcpAccount.php");
                }
            }

            // Change First Name
            $firstEmpty = false;
            $firstLetter = false;
            $firstLength = false;
            if($firstNew != $firstname){
                if(empty($firstNew)){
                    $firstEmpty = true;
                }
                if(!ctype_alpha($firstNew)){
                    $firstLetter = true;
                }
                if((strlen($firstNew) < 2) || (strlen($firstNew) > 30)){
                    $firstLength = true;
                }
                if(!$firstEmpty && !$firstLetter && !$firstLength){
                    $sql = "UPDATE healthcareproinfo SET firstname='" .$firstNew ."' WHERE healthcareproid=" .$userid;
                    $connection_mysql -> query($sql);            
                    $connection_mysql->commit();

                    $_SESSION['successA'] = 1;
                }else{
                    $_SESSION['incorrectfname'] = 1;
                    header("Location: hcpAccount.php");
                }
            }

            // Change Last Name
            $lastEmpty = false;
            $lastLetter = false;
            $lastLength = false;
            if($lastname != $lastNew){
                if(empty($lastNew)){
                    $lastEmpty = true;
                }
                if(!ctype_alpha($lastNew)){
                    $lastLetter = true;
                }
                if((strlen($lastNew) < 2) || (strlen($lastNew) > 30)){
                    $lastLength = true;
                }
                if(!$lastEmpty && !$lastLetter && !$lastLength){
                    $sql = "UPDATE healthcareproinfo SET lastname='" .$lastNew ."' WHERE healthcareproid=" .$userid;
                    $connection_mysql -> query($sql);            
                    $connection_mysql->commit();

                    $_SESSION['successA'] = 1;
                }else{
                    $_SESSION['incorrectlname'] = 1;
                    header("Location: hcpAccount.php");
                }
            }

            // Change Phone Number
            $phoneEmpty = false;
            $phoneNumber = false;
            if($phone != $phoneNew){
                if(empty($phoneNew)){
                    $phoneEmpty = true;
                }
                if(!preg_match("/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/", $phoneNew)){
                    $phoneNumber = true;
                }
                if(!$phoneEmpty && !$phoneNumber){
                    $sql = "UPDATE healthcareproinfo SET phonenumber='" .$phoneNew ."' WHERE healthcareproid=" .$userid;
                    $connection_mysql -> query($sql);            
                    $connection_mysql->commit();

                    $_SESSION['successA'] = 1;
                }else{
                    $_SESSION['incorrectphone'] = 1;
                    header("Location: hcpAccount.php");
                }
            }

            // Change City
            $cityEmpty = false;
            $cityLetter = false;
            if($city != $cityNew){
                if(empty($cityNew)){
                    $cityEmpty = true;
                }
                if(!ctype_alpha($cityNew)){
                    $cityLetter = true;
                }
                if(!$cityEmpty && !$cityLetter){
                    $sql = "UPDATE healthcareproinfo SET city='" .$cityNew ."' WHERE healthcareproid=" .$userid;
                    $connection_mysql -> query($sql);            
                    $connection_mysql->commit();

                    $_SESSION['successA'] = 1;
                }else{
                    $_SESSION['incorrectcity'] = $city;
                    header("Location: hcpAccount.php");
                }
    
            }

            // Change Province
            if($prov != $provNew){
                $sql = "UPDATE healthcareproinfo SET province='" .$provNew ."' WHERE healthcareproid=" .$userid;
                $connection_mysql -> query($sql);            
                $connection_mysql->commit();

                $_SESSION['successA'] = 1;
            }

            // Change Profession
            if($profession != $professionNew){
                $sql = "UPDATE healthcareproinfo SET profession='" .$professionNew ."' WHERE healthcareproid=" .$userid;
                $connection_mysql -> query($sql);            
                $connection_mysql->commit();

                $_SESSION['sucessA'] = 1;
            }

            // Change Hospital
            if($hospital != $hospitalNew){
                $sql = "UPDATE healthcareproinfo SET hospital='" .$hospitalNew ."' WHERE healthcareproid=" .$userid;
                $connection_mysql -> query($sql);            
                $connection_mysql->commit();

                $_SESSION['successA'] = 1;
            }

            // Change Organization
            if($organization != $organizationNew){
                $sql = "UPDATE healthcareproinfo SET organization='" .$organizationNew ."' WHERE healthcareproid=" .$userid;
                $connection_mysql -> query($sql);            
                $connection_mysql->commit();

                $_SESSION['successA'] = 1;
            }

            // Change Office
            if($office != $officeNew){
                $sql = "UPDATE healthcareproinfo SET office='" .$officeNew ."' WHERE healthcareproid=" .$userid;
                $connection_mysql -> query($sql);            
                $connection_mysql->commit();

                $_SESSION['sucessA'] = 1;
            }

            if(isset($_SESSION['successA'])){
                header("Location: hcpAccount.php");
            }
        }
    }

    // links
    if(isset($_GET['code'])){
        $val = $_GET['code'];
        if($val == 1){
            // Patient Database
            header("Location: hcpPatientDatabase.php");
        }else if($val == 2){
            // Home
            header("Location: hcpHome.php");
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
        }else{}
    }
?>
<html>
    <head>
        <title>Healthchain</title>
        <link rel = "stylesheet" href="../css/hcpAccount.css">
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
                        <a href="?code=2">Healthchain</a>
                        <a href="?code=1">Patient Database</a>
                        <a href="#">Account</a>
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
                <a href="?code=2"><img class = "userPic" src = "../images/hc.jpg" width = "25px" height = "25px"><div class = "sidebarContent">&nbsp  &nbsp Healthchain</div></a>
                <div class="sidebarMiddleContent">
                    <a href="?code=1"> <i id="contentSidebar" class="fa fa-eye"></i> <div class = "sidebarContent">&nbsp  &nbsp View PHRs</div></a>
                    <a href="?code=1"> <i id="contentSidebar" class="fa fa-database"></i> <div class = "sidebarContent">&nbsp  &nbsp Patient Database</div></a>
                    <a href="#" class="active"> <i id="contentSidebar" class="fa fa-sign-in"></i> <div class = "sidebarContent">&nbsp  &nbsp Account</div></a> 
                </div>
                <a href="?code=5" class="logoutSidebar"><img class = "userPic" src = "../images/hc.jpg" width = "25px" height = "25px"> <div class = "sidebarContent">&nbsp  &nbsp Logout</div></a>
            </div>
            <div class="middleContent">


                <a href="#" id="searchOutline">
                    <a href="#" id="accountInfo">
                        <div class="accountBox">
                            <div class="upper">
                            </div>
                            <div class="user">
                                <div class="profile"> 
                                    <img src="../images/hcp.png"> 
                                </div>
                            </div>
                            <div class="patientInfo">
                                <h1><b>Username:</b> <?php Print $currentUser; ?></h1>
                                <h1><b>E-mail:</b> <?php Print $email; ?></h1>
                                <h1><b>Date Created:</b> <?php Print $dateCreated; ?></h1>
                                <h1><b>First Name:</b> <?php Print $firstname; ?></h1>
                                <h1><b>Last Name:</b> <?php Print $lastname; ?></h1>
                                <h1><b>Phone Number:</b> <?php Print $phone; ?></h1>
                                <h1><b>City:</b> <?php Print $city; ?></h1>
                                <h1><b>Province:</b> <?php Print $prov; ?></h1>
                                <h1><b>Profession:</b> <?php Print $profession; ?></h1>
                                <h1><b>Hospital:</b> <?php Print $hospital; ?></h1>
                                <h1><b>Office:</b> <?php Print $office; ?></h1>
                                <h1><b>Organization:</b> <?php Print $organization; ?></h1>

                                <div class="submitInfo" onclick="openInfoOverlay()" >Edit</div>

                            </div>
                        </div>
                    </a>

                <div class = "footer">
                    <a href="?code=4">About</a>
                    <a href="?code=3">Help</a>
                    <a href="?code=6">Accessibility</a>
                    <a href="?code=7">Contact Us</a>
                </div>
            </div>
            <!-- Edit Info Overlay -->
            <div class="rightLine">
            </div>

            <div id="infooverlay">
                <div class = "infooverlaycontent">
                    <a href="#" class="none">
                        <div onclick="closeInfoOverlay()">
                            <i class="fa fa-times" id="closeO"></i>
                        </div>
                    </a>
                    <h2>Edit Healthcare Professional Account<h2>
                    <p>Username</p>
                    <input type="text" name = "username" placeholder="Username" value="<?php Print $currentUser; ?>"/>
                    <p>E-mail</p>
                    <input type="text" name = "email" placeholder="E-mail" value="<?php Print $email; ?>"/>
                    <p>First Name</p>
                    <input type="text" name = "firstname" placeholder="First Name" value="<?php Print $firstname; ?>"/>
                    <p>Last Name</p>
                    <input type="text" name = "lastname" placeholder="Last Name" value="<?php Print $lastname; ?>"/>
                    <p>Phone Number</p>
                    <input type="text" name = "phone" placeholder="Phone Number (XXX-XXX-XXXX)" value="<?php Print $phone; ?>"/>
                    <p>City</p>
                    <input type="text" name = "city" placeholder="City" value="<?php Print $city; ?>"/>
                    <p>Province</p>
                    <input type="text" name = "province" placeholder="Province (2 Letter)" value="<?php Print $prov; ?>"/>
                    <p>Profession</p>
                    <input type="text" name = "profession" placeholder="Profession" value="<?php Print $profession; ?>"/>
                    <p>Hospital</p>
                    <input type="text" name = "hospital" placeholder="Hospital" value="<?php Print $hospital; ?>"/>
                    <p>Office</p>
                    <input type="text" name = "office" placeholder="Office" value="<?php Print $office; ?>"/>
                    <p>Organization</p>
                    <input type="text" name = "organization" placeholder="Organization" value="<?php Print $organization; ?>"/>

                    <input class="doneInfo" name="doneInfo" type="submit" value="Done"/>
                </div>
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

        function openInfoOverlay(){
            document.getElementById("infooverlay").style.display = "block";
        }

        function closeInfoOverlay(){
            document.getElementById("infooverlay").style.display = "none";
        }
    </script>
</html>
<?php
	function alert($msg) {
		echo "<script type='text/javascript'>alert('$msg');</script>";
	}
?>