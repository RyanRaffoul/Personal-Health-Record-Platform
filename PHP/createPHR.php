<?php
    // createPHR.php
    // Patient Creates PHR with info

    session_start();

    $mysql_host = 'localhost';
	$mysql_user = 'root';
	$mysql_db = 'healthchaindb';
	
	$connection_mysql = mysqli_connect($mysql_host,$mysql_user,"");
    mysqli_select_db($connection_mysql,"healthchaindb") or die("Cannot connect to database");

    $currentUser = $_SESSION['currentUser'];

    $privateKey = $_SESSION['patientPK'];

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // get when done entering
        $personal = isset($_POST['donePersonalInfo']);
        $doctor = isset($_POST['doneDoctors']);
        $emergency = isset($_POST['doneEmergency']);
        $covid = isset($_POST['doneCovid']);
        $allergy = isset($_POST['doneAllergy']);
        $medication = isset($_POST['doneMedication']);
        $illness = isset($_POST['doneIllness']);
        $surgery = isset($_POST['doneSurgery']);
        $healthp = isset($_POST['doneHealthProblem']);
        $exercise = isset($_POST['doneExercise']);
        $diet = isset($_POST['doneDietaryHabit']);
        $healthg = isset($_POST['doneHealthGoal']);

        $createPHR = isset($_POST['create']);

        // Create PHR
        if($createPHR){

            $result = "";
            // personal info
            $pifname = "";
            $pilname = "";
            $pigender = "";
            $piage = "";
            $pibirthday = "";
            $piphone = "";
            $piemail = "";
            $picity = "";
            $piprov = "";
            if(isset($_SESSION['pifname'])){
                $pifname = $_SESSION['pifname'];
                unset($_SESSION['pifname']);
            }
            if(isset($_SESSION['pilname'])){
                $pilname = $_SESSION['pilname'];
                unset($_SESSION['pilname']);
            }
            if(isset($_SESSION['pigender'])){
                $pigender = $_SESSION['pigender'];
                unset($_SESSION['pigender']);
            }
            if(isset($_SESSION['piage'])){
                $piage = $_SESSION['piage'];
                unset($_SESSION['piage']);
            }
            if(isset($_SESSION['pibirthday'])){
                $pibirthday = $_SESSION['pibirthday'];
                unset($_SESSION['pibirthday']);
            }
            if(isset($_SESSION['piphone'])){
                $piphone = $_SESSION['piphone'];
                unset($_SESSION['piphone']);
            }
            if(isset($_SESSION['piemail'])){
                $piemail = $_SESSION['piemail'];
                unset($_SESSION['piemail']);
            }
            if(isset($_SESSION['picity'])){
                $picity = $_SESSION['picity'];
                unset($_SESSION['picity']);
            }
            if(isset($_SESSION['piprov'])){
                $piprov = $_SESSION['piprov'];
                unset($_SESSION['piprov']);
            }
            $personalInfo = "PERSONAL INFO First Name: " .$pifname ." Last Name: " .$pilname ." Gender: " .$pigender ." Age: " .$piage ." Birthday: " .$pibirthday ." Phone: " .$piphone ." Email: " .$piemail ." City: " .$picity ." Province: " .$piprov ." PERSONAL INFO  ";

            // doctor
            $d1prof = "null";        
            $d1doct = "null";
            $d1phone = "null";
            $d1city = "null";
            $d1prov = "null";
            $d2prof = "null";
            $d2doct = "null";
            $d2phone = "null"; 
            $d2city = "null";
            $d2prov = "null";
            $d3prof = "null";
            $d3doct = "null";
            $d3phone = "null";
            $d3city = "null";
            $d3prov = "null";
            if(isset($_SESSION['d1prof'])){
                $d1prof = $_SESSION['d1prof'];
                unset($_SESSION['d1prof']);
            }
            if(isset($_SESSION['d1doct'])){
                $d1doct = $_SESSION['d1doct'];
                unset($_SESSION['d1doct']);
            }
            if(isset($_SESSION['d1phone'])){
                $d1phone = $_SESSION['d1phone'];
                unset($_SESSION['d1phone']);
            }
            if(isset($_SESSION['d1city'])){
                $d1city = $_SESSION['d1city'];
                unset($_SESSION['d1city']);
            }
            if(isset($_SESSION['d1prov'])){
                $d1prov = $_SESSION['d1prov'];
                unset($_SESSION['d1prov']);
            }
            if(isset($_SESSION['d2prof'])){
                $d2prof = $_SESSION['d2prof'];
                unset($_SESSION['d2prof']);
            }
            if(isset($_SESSION['d2doct'])){
                $d2doct = $_SESSION['d2doct'];
                unset($_SESSION['d2doct']);
            }
            if(isset($_SESSION['d2phone'])){
                $d2phone = $_SESSION['d2phone'];
                unset($_SESSION['d2phone']);
            }
            if(isset($_SESSION['d2city'])){
                $d2city = $_SESSION['d2city'];
                unset($_SESSION['d2city']);
            }
            if(isset($_SESSION['d2prov'])){
                $d2prov = $_SESSION['d2prov'];
                unset($_SESSION['d2prov']);
            }
            if(isset($_SESSION['d3prof'])){
                $d3prof = $_SESSION['d3prof'];
                unset($_SESSION['d3prof']);
            }
            if(isset($_SESSION['d3doct'])){
                $d3doct = $_SESSION['d3doct'];
                unset($_SESSION['d3doct']);
            }
            if(isset($_SESSION['d3phone'])){
                $d3phone = $_SESSION['d3phone'];
                unset($_SESSION['d3phone']);
            }
            if(isset($_SESSION['d3city'])){
                $d3city = $_SESSION['d3city'];
                unset($_SESSION['d3city']);
            }
            if(isset($_SESSION['d3prov'])){
                $d3prov = $_SESSION['d3prov'];
                unset($_SESSION['d3prov']);
            }
            $doctorInfo = "DOCTORS Doctor 1 Profession: " .$d1prof ." Name: " .$d1doct ." Phone: " .$d1phone ." City: " .$d1city ." Province: " .$d1prov ." Doctor 2 Profession: " .$d2prof ." Name: " .$d2doct ." Phone: " .$d2phone ." City: " .$d2city ." Province: " .$d2prov ." Doctor 3 Profession: " .$d3prof ." Name: " .$d3doct ." Phone: " .$d3phone ." City: " .$d3city ." Province: " .$d3prov ." DOCTORS  ";

            // emergency
            $em1name = "null";
            $em1phone = "null";
            $em1rel = "null";
            $em2name = "null";
            $em2phone = "null";
            $em2rel = "null";
            if(isset($_SESSION['em1name'])){
                $em1name = $_SESSION['em1name'];
                unset($_SESSION['em1name']);
            }
            if(isset($_SESSION['em1phone'])){
                $em1phone = $_SESSION['em1phone'];
                unset($_SESSION['em1phone']);
            }
            if(isset($_SESSION['em1rel'])){
                $em1rel = $_SESSION['em1rel'];
                unset($_SESSION['em1rel']);
            }
            if(isset($_SESSION['em2name'])){
                $em2name = $_SESSION['em2name'];
                unset($_SESSION['em2name']);
            }
            if(isset($_SESSION['em2phone'])){
                $em2phone = $_SESSION['em2phone'];
                unset($_SESSION['em2phone']);
            }
            if(isset($_SESSION['em2rel'])){
                $em2rel = $_SESSION['em2rel'];
                unset($_SESSION['em2rel']);
            }
            $emergencyInfo = "EMERGENCY CONTACTS Emergency Contact 1 Name: " .$em1name ." Phone: " .$em1phone ." Relation: " .$em1rel ." Emergency Contact 2 Name: " .$em2name ." Phone: " .$em2phone ." Relation: " .$em2rel ." EMERGENCY CONTACTS  ";

            // covid
            $covidS = "";
            if(isset($_SESSION['covidS'])){
                $covidS = $_SESSION['covidS'];
                unset($_SESSION['covidS']);
            }
            $covidVacInfo = "COVID VACCINATION STATUS " .$covidS ." COVID VACCINATION STATUS  ";

            // allergy
            $allergy1 = "null";
            $allergy2 = "null";
            $allergy3 = "null";
            $allergy4 = "null";
            $allergy5 = "null";
            if(isset($_SESSION['allergy1'])){
                $allergy1 = $_SESSION['allergy1'];
                unset($_SESSION['allergy1']);
            }
            if(isset($_SESSION['allergy2'])){
                $allergy2 = $_SESSION['allergy2'];
                unset($_SESSION['allergy2']);
            }
            if(isset($_SESSION['allergy3'])){
                $allergy3 = $_SESSION['allergy3'];
                unset($_SESSION['allergy3']);
            }
            if(isset($_SESSION['allergy4'])){
                $allergy4 = $_SESSION['allergy4'];
                unset($_SESSION['allergy4']);
            }
            if(isset($_SESSION['allergy5'])){
                $allergy5 = $_SESSION['allergy5'];
                unset($_SESSION['allergy5']);
            }
            $allergyInfo = "ALLERGIES Allergy 1: " .$allergy1 ." Allergy 2: " .$allergy2 ." Allergy 3: " .$allergy3 ." Allergy 4: " .$allergy4 ." Allergy 5: " .$allergy5 ." ALLERGIES  ";

            // medication
            $meds = "";
            if(isset($_SESSION['meds'])){
                $meds = $_SESSION['meds'];
                unset($_SESSION['meds']);
            }
            $medicationInfo = "MEDICATIONS " .$meds ." MEDICATIONS  ";

            // illness
            $ill = "null";
            if(isset($_SESSION['ill'])){
                $ill = $_SESSION['ill'];
                unset($_SESSION['ill']);
            }
            $illInfo = "ILLNESSES " .$ill ." ILLNESSES  ";

            // surgery
            $surg = "null";
            if(isset($_SESSION['surg'])){
                $surg = $_SESSION['surg'];
                unset($_SESSION['surg']);
            }
            $surgeryInfo = "SURGERIES " .$surg ." SURGERIES  ";

            // health problem
            $healthp = "null";
            if(isset($_SESSION['healthp'])){
                $healthp = $_SESSION['healthp'];
                unset($_SESSION['healthp']);
            }
            $healthProblemsInfo = "HEALTH PROBLEMS " .$healthp ." HEALTH PROBLEMS  ";

            // exercise
            $exerh = "null";
            $exerw = "null";
            $exeri = "null";
            if(isset($_SESSION['exerh'])){
                $exerh = $_SESSION['exerh'];
                unset($_SESSION['exerh']);
            }
            if(isset($_SESSION['exerw'])){
                $exerw = $_SESSION['exerw'];
                unset($_SESSION['exerw']);
            }
            if(isset($_SESSION['exeri'])){
                $exeri = $_SESSION['exeri'];
                unset($_SESSION['exeri']);
            }
            $exerciseInfo = "EXERCISE Hours Per Day: " .$exerh ." Days Per Week: " .$exerw . " Intensity: " .$exeri ." EXERCISE  ";

            // dietary habits
            $dieth = "null";
            if(isset($_SESSION['dieth'])){
                $dieth = $_SESSION['dieth'];
                unset($_SESSION['dieth']);
            }
            $dietInfo = "DIETARY HABITS " .$dieth . " DIETARY HABITS  ";

            // health goal
            $healthgoal = "null";
            if(isset($_SESSION['healthgoal'])){
                $healthgoal = $_SESSION['healthgoal'];
                unset($_SESSION['healthgoal']);
            }
            $healthInfo = "HEALTH GOALS " .$healthgoal ." HEALTH GOALS  ";

            // create here
            $createPHRInfo = $personalInfo .$doctorInfo .$emergencyInfo .$covidVacInfo .$allergyInfo .$medicationInfo .$illInfo .$surgeryInfo .$healthProblemsInfo .$exerciseInfo .$dietInfo .$healthInfo;

            session_unset();
            $_SESSION['currentUser'] = $currentUser;

            $_SESSION['patientPHR'] = $createPHRInfo;

            $_SESSION['patientPK'] = $privateKey;

            header("Location: generatePatientPHR.php");
        }

        // personal info
        if($personal){
            if(isset($_POST['personalfirstname'])){
                $_SESSION['pifname'] = $_POST['personalfirstname'];
            }
            if(isset($_POST['personallastname'])){
                $_SESSION['pilname'] = $_POST['personallastname'];
            }
            if(isset($_POST['personalgender'])){
                $_SESSION['pigender'] = $_POST['personalgender'];
            }
            if(isset($_POST['personalage'])){
                $_SESSION['piage'] = $_POST['personalage'];
            }
            if(isset($_POST['personalbirthday'])){
                $_SESSION['pibirthday'] = $_POST['personalbirthday'];
            }
            if(isset($_POST['personalphone'])){
                $_SESSION['piphone'] = $_POST['personalphone'];
            }
            if(isset($_POST['personalemail'])){
                $_SESSION['piemail'] = $_POST['personalemail'];
            }            
            if(isset($_POST['personalcity'])){
                $_SESSION['picity'] = $_POST['personalcity'];
            }
            if(isset($_POST['personalprovince'])){
                $_SESSION['piprov'] = $_POST['personalprovince'];
            }
            $_SESSION['personalinfoClick'] = 1;
            alert("Added to PHR");
        }

        // doctor
        if($doctor){
            if(isset($_POST['doctor1Profession'])){
                $_SESSION['d1prof'] = $_POST['doctor1Profession'];
            }
            if(isset($_POST['doctor1Name'])){
                $_SESSION['d1doct'] = $_POST['doctor1Name'];
            }
            if(isset($_POST['doctor1Phone'])){
                $_SESSION['d1phone'] = $_POST['doctor1Phone'];
            }
            if(isset($_POST['doctor1City'])){
                $_SESSION['d1city'] = $_POST['doctor1City'];
            }
            if(isset($_POST['doctor1Province'])){
                $_SESSION['d1prov'] = $_POST['doctor1Province'];
            }
            if(isset($_POST['doctor2Profession'])){
                $_SESSION['d2prof'] = $_POST['doctor2Profession'];
            }
            if(isset($_POST['doctor2Name'])){
                $_SESSION['d2doct'] = $_POST['doctor2Name'];
            }
            if(isset($_POST['doctor2Phone'])){
                $_SESSION['d2phone'] = $_POST['doctor2Phone'];
            }
            if(isset($_POST['doctor2City'])){
                $_SESSION['d2city'] = $_POST['doctor2City'];
            }
            if(isset($_POST['doctor2Province'])){
                $_SESSION['d2prov'] = $_POST['doctor2Province'];
            }
            if(isset($_POST['doctor3Profession'])){
                $_SESSION['d3prof'] = $_POST['doctor3Profession'];
            }
            if(isset($_POST['doctor3Name'])){
                $_SESSION['d3doct'] = $_POST['doctor3Name'];
            }
            if(isset($_POST['doctor3Phone'])){
                $_SESSION['d3phone']= $_POST['doctor3Phone'];
            }
            if(isset($_POST['doctor3City'])){
                $_SESSION['d3city'] = $_POST['doctor3City'];
            }
            if(isset($_POST['doctor3Province'])){
                $_SESSION['d3prov'] = $_POST['doctor3Province'];
            }
            $_SESSION['doctorClick'] = 1;
            alert("Added to PHR");
        }

        // emergency
        if($emergency){
            if(isset($_POST['emergency1Name'])){
                $_SESSION['em1name'] = $_POST['emergency1Name'];
            }
            if(isset($_POST['emergency1Phone'])){
                $_SESSION['em1phone'] = $_POST['emergency1Phone'];
            }
            if(isset($_POST['emergency1Relation'])){
                $_SESSION['em1rel'] = $_POST['emergency1Relation'];
            }
            if(isset($_POST['emergency2Name'])){
                $_SESSION['em2name'] = $_POST['emergency2Name'];
            }
            if(isset($_POST['emergency2Phone'])){
                $_SESSION['em2phone'] = $_POST['emergency2Phone'];
            }
            if(isset($_POST['emergency2Relation'])){
                $_SESSION['em2rel'] = $_POST['emergency2Relation'];
            }
            $_SESSION['emergencyClick'] = 1;
            alert("Added to PHR");
        }

        // covid
        if($covid){
            if(isset($_POST['covidvaccination'])){
                $_SESSION['covidS'] = $_POST['covidvaccination'];
            }
            $_SESSION['covidClick'] = 1;
            alert("Added to PHR");
        }

        // allergy
        if($allergy){
            if(isset($_POST['allergy1'])){
                $_SESSION['allergy1'] = $_POST['allergy1'];
            }
            if(isset($_POST['allergy2'])){
                $_SESSION['allergy2'] = $_POST['allergy2'];
            }
            if(isset($_POST['allergy3'])){
                $_SESSION['allergy3'] = $_POST['allergy3'];
            }
            if(isset($_POST['allergy4'])){
                $_SESSION['allergy4'] = $_POST['allergy4'];
            }
            if(isset($_POST['allergy5'])){
                $_SESSION['allergy5'] = $_POST['allergy5'];
            }
            $_SESSION['allergyClick'] = 1;
            alert("Added to PHR");
        }

        // medication
        if($medication){
            if(isset($_POST['medications'])){
                $meds = $_POST['medications'];
                $meds= trim($meds);
                $meds = stripslashes($meds);
                $meds = htmlspecialchars($meds);
                $_SESSION['meds'] = $meds;
            }
            $_SESSION['medicationClick'] = 1;
            alert("Added to PHR");
        }

        // illness
        if($illness){
            if(isset($_POST['illnesses'])){
                $ill = $_POST['illnesses'];
                $ill= trim($ill);
                $ill = stripslashes($ill);
                $ill = htmlspecialchars($ill);
                $_SESSION['ill'] = $ill;
            }
            $_SESSION['illnessClick'] = 1;
            alert("Added to PHR");
        }

        // surgery
        if($surgery){
            if(isset($_POST['surgeries'])){
                $surg = $_POST['surgeries'];
                $surg= trim($surg);
                $surg = stripslashes($surg);
                $surg = htmlspecialchars($surg);
                $_SESSION['surg'] = $surg;
            }
            $_SESSION['surgeryClick'] = 1;
            alert("Added to PHR");
        }

        // health problem
        if($healthp){
            if(isset($_POST['healthproblems'])){
                $healthp = $_POST['healthproblems'];
                $healthp = trim($healthp);
                $healthp = stripslashes($healthp);
                $healthp = htmlspecialchars($healthp);
                $_SESSION['healthp'] = $healthp;
            }
            $_SESSION['healthpClick'] = 1;
            alert("Added to PHR");
        }

        // exercise
        if($exercise){
            if(isset($_POST['exercisehours'])){
                $_SESSION['exerh'] = $_POST['exercisehours'];
            }
            if(isset($_POST['exerciseweek'])){
                $_SESSION['exerw'] = $_POST['exerciseweek'];
            }
            if(isset($_POST['exerciseintense'])){
                $_SESSION['exeri'] = $_POST['exerciseintense'];
            }
            $_SESSION['exerciseClick'] = 1;
            alert("Added to PHR");
        }

        // diet
        if($diet){
            if(isset($_POST['dietaryhabits'])){
                $dieth = $_POST['dietaryhabits'];
                $dieth = trim($dieth);
                $dieth = stripslashes($dieth);
                $dieth = htmlspecialchars($dieth);
                $_SESSION['dieth'] = $dieth;
            }
            $_SESSION['dietClick'] = 1;
            alert("Added to PHR");
        }

        // health goal
        if($healthg){
            if(isset($_POST['healthgoals'])){
                $healthgoal = $_POST['healthgoals'];
                $healthgoal = trim($healthgoal);
                $healthgoal = stripslashes($healthgoal);
                $healthgoal = htmlspecialchars($healthgoal);
                $_SESSION['healthgoal'] = $healthgoal;
            }
            $_SESSION['healthgoalClick'] = 1;
            alert("Added to PHR");
        }

    }
?>
<html>
    <head>
        <title>Healthchain</title>
        <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <link href="../css/createPHR.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://cdn.jsdelivr.net/npm/web3@latest/dist/web3.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/fs.js@0.0.1/fs.js"></script>
    </head>
    <body>
        <form method="POST">
            <div class="header">
                <img src="../images/hc.jpg" alt="Healthchain Logo" />
                <h1>Healthchain</h1>
                <br />
                <br />
                <br />
                <h2>Create Personal Health Record</h2>
            </div>
            <div class="container">
                <a href="#" onclick="openPersonalInfoOverlay()" id="personalinfoClose">
                    <div class="variables" id="vars">
                        <i class="fa fa-genderless" id = "icon"></i>
                        <h3>Personal Info</h3>
                    </div>
                </a>
                <a href="#" onclick="openDoctorOverlay()" id="doctorClose">
                    <div class="variables">
                        <i class="fa fa-genderless" id = "icon"></i>
                        <h3>Doctors</h3>
                    </div>
                </a>
                <a href="#" onclick="openEmergencyOverlay()" id="emergencyClose">
                    <div class="variables">
                        <i class="fa fa-genderless" id = "icon"></i>
                        <h3>Emergency Contacts</h3>
                    </div>
                </a>
                <a href="#" onclick="openCovidOverlay()" id="covidClose">
                    <div class="variables">
                        <i class="fa fa-genderless" id = "icon"></i>
                        <h3>Covid Vaccination Status</h3>
                    </div>
                </a>
                <br />
                <a href="#" onclick="openAllergiesOverlay()" id="allergyClose">
                    <div class="variables">
                        <i class="fa fa-genderless" id = "icon"></i>
                        <h3>Allergies</h3>
                    </div>
                </a>
                <a href="#" onclick="openMedicationOverlay()" id="medicationClose">
                    <div class="variables">
                        <i class="fa fa-genderless" id = "icon"></i>
                        <h3>Medications</h3>
                    </div>
                </a>
                <a href="#">
                    <div class="variables" onclick="openIllnessesOverlay()" id="illnessClose">
                        <i class="fa fa-genderless" id = "icon"></i>
                        <h3>Illnesses</h3>
                    </div>
                </a>
                <a href="#">
                    <div class="variables" onclick="openSurgeriesOverlay()" id="surgeryClose">
                        <i class="fa fa-genderless" id = "icon"></i>
                        <h3>Surgeries</h3>
                    </div>
                </a>
                <br />
                <a href="#">
                    <div class="variables" onclick="openHealthProblemsOverlay()" id="healthpClose">
                        <i class="fa fa-genderless" id = "icon"></i>
                        <h3>Health Problems</h3>
                    </div>
                </a>
                <a href="#" onclick="openExerciseOverlay()" id="exerciseClose">
                    <div class="variables">
                        <i class="fa fa-genderless" id = "icon"></i>
                        <h3>Exercise</h3>
                    </div>
                </a>
                <a href="#" onclick="openDietaryHabitsOverlay()" id="dietClose">
                    <div class="variables">
                        <i class="fa fa-genderless" id = "icon"></i>
                        <h3>Dietary Habits</h3>
                    </div>
                </a>
                <br />
                <a href="#">
                    <div class="variables" onclick="openHealthGoalsOverlay()" id="healthgoal"> 
                        <i class="fa fa-genderless" id = "icon"></i>
                        <h3>Health Goals</h3>
                    </div>
                </a>
            </div>
            <input class="create" name = "create" type="submit" placeholder="create" value = "Create">

            <!-- Personal Info -->
            <div id="personalinfooverlay">
                <div class = "personalinfooverlaycontent">
                    <a href="#" class="none">
                        <div onclick="closePersonalInfoOverlay()">
                            <i class="fa fa-times" id="closeO"></i>
                        </div>
                    </a>
                    <h2>Personal Info</h2>
                    <input name = "personalfirstname" placeholder="First Name" />
                    <input name = "personallastname" placeholder="Last Name" />
                    <select name="personalgender">
                        <option value="Gender" disabled="disabled" selected="selected" >Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>
                    <input name = "personalage" placeholder="Age" />
                    <input name = "personalbirthday" placeholder="Birthday (DD-MM-YYYY)" />
                    <input name = "personalphone" placeholder="Phone Number (XXX-XXX-XXXX)" />
                    <input name = "personalemail" placeholder="E-mail" />
                    <input name = "personalcity" placeholder="City" />
                    <select name="personalprovince">
                        <option value="Province" disabled="disabled" selected="selected" >Province</option>
                        <option value="AB">Alberta</option>
                        <option value="BC">British Columbia</option>
                        <option value="MB">Manitoba</option>
                        <option value="NB">New Brunswick</option>
                        <option value="NL">Newfoundland and Labrador</option>
                        <option value="NS">Nova Scotia</option>
                        <option value="ON">Ontario</option>
                        <option value="PE">Prince Edward Island</option>
                        <option value="QC">Quebec</option>
                        <option value="SK">Saskatchewan</option>
                        <option value="NT">Northwest Territories</option>
                        <option value="NU">Nunavut</option>
                        <option value="YT">Yukon</option>
                    </select>
                    <input class="done" name = "donePersonalInfo" type="submit" placeholder="Done" value = "Done">
                </div>
            </div>

            <div id="doctoroverlay">
                <div class = "doctoroverlaycontent">
                    <a href="#" class="none">
                        <div onclick="closeDoctorOverlay()">
                            <i class="fa fa-times" id="closeO"></i>
                        </div>
                    </a>
                    <h2>Doctors</h2>

                    <!-- Doctor 1 -->
                    <p>Doctor 1</p>
                    <input name = "doctor1Profession" placeholder="Profession" />
                    <input name = "doctor1Name" placeholder="Name" />
                    <input name = "doctor1Phone" placeholder="Phone Number (XXX-XXX-XXXX)" />
                    <input name = "doctor1City" placeholder="City" />
                    <select name="doctor1Province">
                        <option value="Province" disabled="disabled" selected="selected" >Province</option>
                        <option value="AB">Alberta</option>
                        <option value="BC">British Columbia</option>
                        <option value="MB">Manitoba</option>
                        <option value="NB">New Brunswick</option>
                        <option value="NL">Newfoundland and Labrador</option>
                        <option value="NS">Nova Scotia</option>
                        <option value="ON">Ontario</option>
                        <option value="PE">Prince Edward Island</option>
                        <option value="QC">Quebec</option>
                        <option value="SK">Saskatchewan</option>
                        <option value="NT">Northwest Territories</option>
                        <option value="NU">Nunavut</option>
                        <option value="YT">Yukon</option>
                    </select>

                    <!-- Doctor 2 -->
                    <p>Doctor 2</p>
                    <input name = "doctor2Profession" placeholder="Profession" />
                    <input name = "doctor2Name" placeholder="Name" />
                    <input name = "doctor2Phone" placeholder="Phone Number (XXX-XXX-XXXX)" />
                    <input name = "doctor2City" placeholder="City" />
                    <select name="doctor2Province">
                        <option value="Province" disabled="disabled" selected="selected">Province</option>
                        <option value="AB">Alberta</option>
                        <option value="BC">British Columbia</option>
                        <option value="MB">Manitoba</option>
                        <option value="NB">New Brunswick</option>
                        <option value="NL">Newfoundland and Labrador</option>
                        <option value="NS">Nova Scotia</option>
                        <option value="ON">Ontario</option>
                        <option value="PE">Prince Edward Island</option>
                        <option value="QC">Quebec</option>
                        <option value="SK">Saskatchewan</option>
                        <option value="NT">Northwest Territories</option>
                        <option value="NU">Nunavut</option>
                        <option value="YT">Yukon</option>
                    </select>

                    <!-- Doctor 3 -->
                    <p>Doctor 3</p>
                    <input name = "doctor3Profession" placeholder="Profession" />
                    <input name = "doctor3Name" placeholder="Name" />
                    <input name = "doctor3Phone" placeholder="Phone Number (XXX-XXX-XXXX)" />
                    <input name = "doctor3City" placeholder="City" />
                    <select name="doctor3Province">
                        <option value="Province" disabled="disabled" selected="selected">Province</option>
                        <option value="AB">Alberta</option>
                        <option value="BC">British Columbia</option>
                        <option value="MB">Manitoba</option>
                        <option value="NB">New Brunswick</option>
                        <option value="NL">Newfoundland and Labrador</option>
                        <option value="NS">Nova Scotia</option>
                        <option value="ON">Ontario</option>
                        <option value="PE">Prince Edward Island</option>
                        <option value="QC">Quebec</option>
                        <option value="SK">Saskatchewan</option>
                        <option value="NT">Northwest Territories</option>
                        <option value="NU">Nunavut</option>
                        <option value="YT">Yukon</option>
                    </select>

                    <input class="done" name = "doneDoctors" type="submit" placeholder="Done" value = "Done">
                </div>
            </div>

            <!-- Emergency Contacts -->
            <div id="emergencyoverlay">
                <div class = "emergencyoverlaycontent">
                    <a href="#" class="none">
                        <div onclick="closeEmergencyOverlay()">
                            <i class="fa fa-times" id="closeO"></i>
                        </div>
                    </a>
                    <h2>Emergency Contacts</h2>

                    <!-- Emergency Contact 1 -->
                    <p>Emergency Contact 1</p>
                    <input name = "emergency1Name" placeholder="Name" />
                    <input name = "emergency1Phone" placeholder="Phone Number (XXX-XXX-XXXX)" />
                    <input name = "emergency1Relation" placeholder="Relation" />

                    <!-- Emergency Contact 2 -->
                    <p>Emergency Contact 2</p>
                    <input name = "emergency2Name" placeholder="Name" />
                    <input name = "emergency2Phone" placeholder="Phone Number (XXX-XXX-XXXX)" />
                    <input name = "emergency2Relation" placeholder="Relation" />

                    <input class="done" name = "doneEmergency" type="submit" placeholder="Done" value = "Done">
                </div>
            </div>

            <!-- Covid Vaccination Status -->
            <div id="covidoverlay">
                <div class = "covidoverlaycontent">
                    <a href="#" class="none">
                        <div onclick="closeCovidOverlay()">
                            <i class="fa fa-times" id="closeO"></i>
                        </div>
                    </a>
                    <h2>Covid Vaccination Status</h2>
                    <select name="covidvaccination">
                        <option value="VaccinationStatus" disabled="disabled" selected="selected" >Select</option>
                        <option value="Fully Vaccinated">Fully Vaccinated</option>
                        <option value="Partially Vaccinated">Partially Vaccinated</option>
                        <option value="Not Vaccinated">Not Vaccinated</option>
                    </select>
                    <input class="done" name = "doneCovid" type="submit" placeholder="Done" value = "Done">
                </div>
            </div>

            <!-- Allergies -->
            <div id="allergiesoverlay">
                <div class = "allergiesoverlaycontent">
                <a href="#" class="none">
                    <div onclick="closeAllergiesOverlay()">
                            <i class="fa fa-times" id="closeO"></i>
                        </div>
                    </a>
                    <h2>Allergies</h2>
                    <input name = "allergy1" placeholder="Allergy 1" />
                    <input name = "allergy2" placeholder="Allergy 2" />
                    <input name = "allergy3" placeholder="Allergy 3" />
                    <input name = "allergy4" placeholder="Allergy 4" />
                    <input name = "allergy5" placeholder="Allergy 5" />
                    <input class="done" name = "doneAllergy" type="submit" placeholder="Done" value = "Done">
                </div>
            </div>

            <!-- Medication -->
            <div id="medicationoverlay">
                <div class = "medicationoverlaycontent">
                    <a href="#" class="none">
                        <div onclick="closeMedicationOverlay()">
                            <i class="fa fa-times" id="closeO"></i>
                        </div>
                    </a>
                    <h2>Medications</h2>
                    <p>Enter each Medication on a new line</p>
                    <textarea name="medications" placeholder="Enter Medications"></textarea>

                    <input class="done" name = "doneMedication" type="submit" placeholder="Done" value = "Done">
                </div>
            </div>

            <!-- Illnesses -->
            <div id="illnessesoverlay">
                <div class = "illnessesoverlaycontent">
                    <a href="#" class="none">
                        <div onclick="closeIllnessesOverlay()">
                            <i class="fa fa-times" id="closeO"></i>
                        </div>
                    </a>
                    <h2>Illnesses</h2>
                    <p>Enter each Illness on a new line</p>
                    <textarea name="illnesses" placeholder="Enter Illnesses"></textarea>

                    <input class="done" name = "doneIllness" type="submit" placeholder="Done" value = "Done">
                </div>
            </div>

            <!-- Surgeries -->
            <div id="surgeriesoverlay">
                <div class = "surgeriesoverlaycontent">
                    <a href="#" class="none">
                        <div onclick="closeSurgeriesOverlay()">
                            <i class="fa fa-times" id="closeO"></i>
                        </div>
                    </a>
                    <h2>Surgeries</h2>
                    <p>Enter each Surgery on a new line</p>
                    <textarea name="surgeries" placeholder="Enter Surgeries"></textarea>

                    <input class="done" name = "doneSurgery" type="submit" placeholder="Done" value = "Done">
                </div>
            </div>    
            
            <!-- Health Problems -->
            <div id="healthproblemsoverlay">
                <div class = "healthproblemsoverlaycontent">
                <a href="#" class="none">
                        <div onclick="closeHealthProblemsOverlay()">
                            <i class="fa fa-times" id="closeO"></i>
                        </div>
                    </a>
                    <h2>Health Problems</h2>
                    <p>Enter each Health Problem on a new line</p>
                    <textarea name="healthproblems" placeholder="Enter Health Problems"></textarea>

                    <input class="done" name = "doneHealthProblem" type="submit" placeholder="Done" value = "Done">
                </div>
            </div>           
            
            <!-- Exercise -->
            <div id="exerciseoverlay">
                <div class = "exerciseoverlaycontent">
                    <a href="#" class="none">
                        <div onclick="closeExerciseOverlay()">
                            <i class="fa fa-times" id="closeO"></i>
                        </div>
                    </a>
                    <h2>Exercise</h2>
                    <p>How many hours do you exercise per day?</p>
                    <select name="exercisehours">
                        <option value="select" disabled="disabled" selected="selected" >Select</option>
                        <option value="0 Hours">0 hours</option>
                        <option value="1 to 3 Hours">1 to 3 hours</option>
                        <option value="4 to 6 Hours">4 to 6 hours</option>
                        <option value="6 or more Hours">6 or more hours</option>
                    </select>
                    <p>How many times a week do you exercise?</p>
                    <select name="exerciseweek">
                        <option value="select" disabled="disabled" selected="selected" >Select</option>
                        <option value="0 Times">0 times</option>
                        <option value="1 to 3 Times">1 to 3 times</option>
                        <option value="4 to 6 Times">4 to 6 times</option>
                        <option value="Daily">Daily</option>
                    </select>
                    <p>How intense is this exercise?</p>
                    <select name="exerciseintense">
                        <option value="select" disabled="disabled" selected="selected" >Select</option>
                        <option value="Low Intensity">Low Intensity</option>
                        <option value="Moderate Intensity">Moderate Intensity</option>
                        <option value="High Intensity">High Intensity</option>
                    </select>
                    <input class="done" name = "doneExercise" type="submit" placeholder="Done" value = "Done">
                </div>
            </div>  

            <!-- Dietary Habits Problems -->
            <div id="dietaryhabitsoverlay">
                <div class = "dietaryhabitsoverlaycontent">
                    <a href="#" class="none">
                        <div onclick="closeDietaryHabitsOverlay()">
                            <i class="fa fa-times" id="closeO"></i>
                        </div>
                    </a>
                    <h2>Dietary Habits</h2>
                    <p>Enter each Dietary Habit on a new line</p>
                    <textarea name="dietaryhabits" placeholder="Enter Dietary Habits"></textarea>
                    <input class="done" name = "doneDietaryHabit" type="submit" placeholder="Done" value = "Done">
                </div>
            </div>

            <!-- Health Goals Problems -->
            <div id="healthgoalsoverlay">
                <div class = "healthgoalsoverlaycontent">
                    <a href="#" class="none">
                        <div onclick="closeHealthGoalsOverlay()">
                            <i class="fa fa-times" id="closeO"></i>
                        </div>
                    </a>
                    <h2>Health Goals</h2>
                    <p>Enter each Health Goal on a new line</p>
                    <textarea name="healthgoals" placeholder="Enter Health Goals"></textarea>

                    <input class="done" name = "doneHealthGoal" type="submit" placeholder="Done" value = "Done">
                </div>
            </div>   

        </form>
    </body>
    <script>
        function openPersonalInfoOverlay() {
          document.getElementById("personalinfooverlay").style.display = "block";
        }
        function closePersonalInfoOverlay() {
          document.getElementById("personalinfooverlay").style.display = "none";
        }

        function openDoctorOverlay() {
          document.getElementById("doctoroverlay").style.display = "block";
        }
        function closeDoctorOverlay() {
          document.getElementById("doctoroverlay").style.display = "none";
        }

        function openEmergencyOverlay() {
          document.getElementById("emergencyoverlay").style.display = "block";
        }
        function closeEmergencyOverlay() {
          document.getElementById("emergencyoverlay").style.display = "none";
        }

        function openCovidOverlay() {
          document.getElementById("covidoverlay").style.display = "block";
        }
        function closeCovidOverlay() {
          document.getElementById("covidoverlay").style.display = "none";
        }

        function openAllergiesOverlay() {
          document.getElementById("allergiesoverlay").style.display = "block";
        }
        function closeAllergiesOverlay() {
          document.getElementById("allergiesoverlay").style.display = "none";
        }

        function openMedicationOverlay(){
            document.getElementById("medicationoverlay").style.display = "block";
        }
        function closeMedicationOverlay() {
          document.getElementById("medicationoverlay").style.display = "none";
        }

        function openIllnessesOverlay(){
            document.getElementById("illnessesoverlay").style.display = "block";
        }
        function closeIllnessesOverlay() {
          document.getElementById("illnessesoverlay").style.display = "none";
        }

        function openSurgeriesOverlay(){
            document.getElementById("surgeriesoverlay").style.display = "block";
        }
        function closeSurgeriesOverlay() {
          document.getElementById("surgeriesoverlay").style.display = "none";
        }

        function openHealthProblemsOverlay(){
            document.getElementById("healthproblemsoverlay").style.display = "block";
        }
        function closeHealthProblemsOverlay() {
          document.getElementById("healthproblemsoverlay").style.display = "none";
        }

        function openExerciseOverlay(){
            document.getElementById("exerciseoverlay").style.display = "block";
        }
        function closeExerciseOverlay() {
          document.getElementById("exerciseoverlay").style.display = "none";
        }

        function openDietaryHabitsOverlay(){
            document.getElementById("dietaryhabitsoverlay").style.display = "block";
        }
        function closeDietaryHabitsOverlay() {
          document.getElementById("dietaryhabitsoverlay").style.display = "none";
        }

        function openHealthGoalsOverlay(){
            document.getElementById("healthgoalsoverlay").style.display = "block";
        }
        function closeHealthGoalsOverlay() {
          document.getElementById("healthgoalsoverlay").style.display = "none";
        }
    </script>
</html>
<?php
	function alert($msg) {
		echo "<script type='text/javascript'>alert('$msg');</script>";
	}
    // close when clicked
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if(isset($_SESSION['personalinfoClick'])){
            echo "<script> document.getElementById(\"personalinfoClose\").removeAttribute(\"onclick\"); </script>";
        }
        if(isset($_SESSION['doctorClick'])){
            echo "<script> document.getElementById(\"doctorClose\").removeAttribute(\"onclick\"); </script>";
        }
        if(isset($_SESSION['emergencyClick'])){
            echo "<script> document.getElementById(\"emergencyClose\").removeAttribute(\"onclick\"); </script>";
        }
        if(isset($_SESSION['covidClick'])){
            echo "<script> document.getElementById(\"covidClose\").removeAttribute(\"onclick\"); </script>";
        }
        if(isset($_SESSION['allergyClick'])){
            echo "<script> document.getElementById(\"allergyClose\").removeAttribute(\"onclick\"); </script>";
        }
        if(isset($_SESSION['medicationClick'])){
            echo "<script> document.getElementById(\"medicationClose\").removeAttribute(\"onclick\"); </script>";
        }
        if(isset($_SESSION['illnessClick'])){
            echo "<script> document.getElementById(\"illnessClose\").removeAttribute(\"onclick\"); </script>";
        }
        if(isset($_SESSION['surgeryClick'])){
            echo "<script> document.getElementById(\"surgeryClose\").removeAttribute(\"onclick\"); </script>";
        }
        if(isset($_SESSION['healthpClick'])){
            echo "<script> document.getElementById(\"healthpClose\").removeAttribute(\"onclick\"); </script>";
        }
        if(isset($_SESSION['exerciseClick'])){
            echo "<script> document.getElementById(\"exerciseClose\").removeAttribute(\"onclick\"); </script>";
        }
        if(isset($_SESSION['dietClick'])){
            echo "<script> document.getElementById(\"dietClose\").removeAttribute(\"onclick\"); </script>";
        }
        if(isset($_SESSION['healthgoalClick'])){
            echo "<script> document.getElementById(\"personalinfoClose\").removeAttribute(\"onclick\"); </script>";
        }
    }
?>