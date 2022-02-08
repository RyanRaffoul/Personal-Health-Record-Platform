<?php
    // patientUpdate.php
    // Update PHR page
    session_start();

    $currentUser = $_SESSION['currentUser'];

    $mysql_host = 'localhost';
	$mysql_user = 'root';
	$mysql_db = 'healthchaindb';
	
	$connection_mysql = mysqli_connect($mysql_host,$mysql_user,"");

    mysqli_select_db($connection_mysql,"healthchaindb") or die("Cannot connect to database");

    $currentUser = $_SESSION['currentUser'];
    $patientPHR = $_SESSION['patientPHRUpdateContent'];

    $sql = mysqli_query($connection_mysql,"SELECT * FROM patient WHERE username = '" .$currentUser ."'");
    while($row = mysqli_fetch_array($sql)){
        $userid = $row['patientid'];
    }

    $personalInfoBool = false;
    $doctorBool1 = false;
    $doctorBool2 = false;
    $doctorBool3 = false;
    $emergencyBool1 = false;
    $emergencyBool2 = false;
    $covidBool = false;
    $allergyBool1 = false;
    $allergyBool2 = false;
    $allergyBool3 = false;
    $allergyBool4 = false;
    $allergyBool5 = false;
    $medicationBool = false;
    $illnessBool = false;
    $surgeryBool = false;
    $healthPBool = false;
    $hoursBool = false;
    $weekBool = false;
    $intensityBool = false;
    $dietBool = false;
    $healthGBool = false;

    // Personal Info
    $personalinfofname = "";
    $personalinfolname = "";
    $personalinfogender = "";
    $personalinfoage = "";
    $personalinfobirthday = "";
    $personalinfophone = "";
    $personalinfoemail = "";
    $personalinfocity = "";
    $personalinfoprovince = "";

    // Doctors
    $doct1pro = "";
    $doct1name = "";
    $doct1phone = "";
    $doct1city = "";
    $doct1prov = "";
    $doct2pro = "";
    $doct2name = "";
    $doct2phone = "";
    $doct2city = "";
    $doct2prov = "";
    $doct3pro = "";
    $doct3name = "";
    $doct3phone = "";
    $doct3city = "";
    $doct3prov = "";

    // Emergency Contacts
    $em1name = "";
    $em1phone = "";
    $em1rel = "";
    $em2name = "";
    $em2phone = "";
    $em2rel = "";

    // Covid Vaccination Status
    $covidStatus = "";

    // Allergies
    $allergy1 = "";
    $allergy2 = "";
    $allergy3 = "";
    $allergy4 = "";
    $allergy5 = "";

    // Medication
    $medication = "";

    // Illnnesses
    $illness = "";

    // Surgeries
    $surgery = "";

    // Health Problems
    $healthP = "";

    // Exercise
    $hoursPD = "";
    $daysPW = "";
    $intensity = "";

    // Dietary Habits
    $diet = "";

    // Health Goals
    $healthG = "";
    
    $pieces = explode(" ",$patientPHR);
    $size = count($pieces);
    for($i = 0; $i < $size; $i++){
        // PERSONAL INFO
        if($personalInfoBool){
            $personalinfofname = $pieces[$i + 2];
            if($personalinfofname == "null"){
                $personalinfofname = "";
            }
            $personalinfolname = $pieces[$i + 5];
            if($personalinfolname == "null"){
                $personalinfolname = "";
            }
            $personalinfogender = $pieces[$i + 7];
            if($personalinfogender == "null"){
                $personalinfogender = "";
            }
            $personalinfoage = $pieces[$i + 9];
            if($personalinfoage == "null"){
                $personalinfoage = "";
            }
            $personalinfobirthday = $pieces[$i + 11];
            if($personalinfobirthday == "null"){
                $personalinfobirthday = "";
            }
            $personalinfophone = $pieces[$i + 13];
            if($personalinfophone == "null"){
                $personalinfophone = "";
            }
            $personalinfoemail = $pieces[$i + 15];
            if($personalinfoemail == "null"){
                $personalinfoemail = "";
            }
            $personalinfocity = $pieces[$i + 17];
            if($personalinfocity == "null"){
                $personalinfocity = "";
            }
            $personalinfoprovince = $pieces[$i + 19];
            if($personalinfoprovince == "null"){
                $personalinfoprovince= "";
            }

            $personalInfoBool = false;
            continue;
        }

        // DOCTORS
        if($doctorBool1){
            if($pieces[$i + 3] == "Name:"){
                $doct1pro = $pieces[$i + 2];
                if($pieces[$i + 5] == "Phone"){
                    $doct1name = $pieces[$i + 4];
                    $doct1phone = $pieces[$i + 6];
                    $doct1city = $pieces[$i + 8];
                    $doct1prov = $pieces[$i + 10];
                }else{
                    $doct1name = $pieces[$i + 4] ." " .$pieces[$i + 5];
                    $doct1phone = $pieces[$i + 7];
                    $doct1city = $pieces[$i + 9];
                    $doct1prov = $pieces[$i + 11];
                }
            }else{
                $doct1pro = $pieces[$i + 2] ." " .$pieces[$i + 3];
                if($pieces[$i + 6] == "Phone"){
                    $doct1name = $pieces[$i + 5];
                    $doct1phone = $pieces[$i + 7];
                    $doct1city = $pieces[$i + 9];
                    $doct1prov = $pieces[$i + 11];
                }else{
                    $doct1name = $pieces[$i + 5] ." " .$pieces[$i + 6];
                    $doct1phone = $pieces[$i + 8];
                    $doct1city = $pieces[$i + 10];
                    $doct1prov = $pieces[$i + 12];
                }
            }

            if($doct1name == "null"){
                $doct1name = "";
            }
            if($doct1phone == "null"){
                $doct1phone = "";
            }
            if($doct1city == "null"){
                $doct1city = "";
            }
            if($doct1prov == "null"){
                $doct1prov = "";
            }
            $doctorBool1 = false;
            continue;
        }
        if($doctorBool2){
            $doct2pro = $pieces[$i + 2];
            if($pieces[$i + 5] == "Phone"){
                $doct2name = $pieces[$i + 4];
                $doct2phone = $pieces[$i + 6];
                $doct2city = $pieces[$i + 8];
                $doct2prov = $pieces[$i + 10];
            }else{
                $doct2name = $pieces[$i + 4] ." " .$pieces[$i + 5];
                $doct2phone = $pieces[$i + 7];
                $doct2city = $pieces[$i + 9];
                $doct2prov = $pieces[$i + 11];
            }

            
            if($doct2name == "null"){
                $doct2name = "";
            }
            if($doct2phone == "null"){
                $doct2phone = "";
            }
            if($doct2city == "null"){
                $doct2city = "";
            }
            if($doct2prov == "null"){
                $doct2prov = "";
            }
            $doctorBool2 = false;
            continue;
        }
        if($doctorBool3){
            $doct3pro = $pieces[$i + 2];
            if($pieces[$i + 5] == "Phone"){
                $doct3name = $pieces[$i + 4];
                $doct3phone = $pieces[$i + 6];
                $doct3city = $pieces[$i + 8];
                $doct3prov = $pieces[$i + 10];
            }else{
                $doct3name = $pieces[$i + 4] ." " .$pieces[$i + 5];
                $doct3phone = $pieces[$i + 7];
                $doct3city = $pieces[$i + 9];
                $doct3prov = $pieces[$i + 11];
            }

            if($doct3name == "null"){
                $doct1name = "";
            }
            if($doct3phone == "null"){
                $doct1phone = "";
            }
            if($doct3city == "null"){
                $doct1city = "";
            }
            if($doct3prov == "null"){
                $doct1prov = "";
            }
            $doctorBool3 = false;
            continue;
        }

        // Emergency Contacts
        if($emergencyBool1){
            if($pieces[$i + 4] == "Phone"){
                $em1name = $pieces[$i + 3];
                $em1phone = $pieces[$i + 5];
                $em1rel = $pieces[$i + 7];
            }else{
                $em1name = $pieces[$i + 3] ." " .$pieces[$i + 4];
                $em1phone = $pieces[$i + 6];
                $em1rel = $pieces[$i + 8];
            }

            
            if($em1name == "null"){
                $em1name = "";
            }
            if($em1phone == "null"){
                $em1phone = "";
            }
            if($em1rel == "null"){
                $em1rel = "";
            }
            $emergencyBool1 = false;
            continue;
        }
        if($emergencyBool2){
            if($pieces[$i + 4] == "Phone"){
                $em2name = $pieces[$i + 3];
                $em2phone = $pieces[$i + 5];
                $em2rel = $pieces[$i + 7];
            }else{
                $em2name = $pieces[$i + 3] ." " .$pieces[$i + 4];
                $em2phone = $pieces[$i + 6];
                $em2rel = $pieces[$i + 8];
            }

            if($em2name == "null"){
                $em2name = "";
            }
            if($em2phone == "null"){
                $em2phone = "";
            }
            if($em2rel == "null"){
                $em2rel = "";
            }
            $emergencyBool2 = false;
            continue;
        }

        // COVID VACCINATION STATUS
        if($covidBool){
            $covidStatus = $pieces[$i+2] ." " .$pieces[$i+3];

            if($covidStatus == "null"){
                $covidStatus = "";
            }
            $covidBool = false;
            continue;
        }

        // ALLERGIES
        if($allergyBool1){
            if($pieces[$i + 1] == "Allergy"){
                if($allergy1 == "null"){
                    $allergy1 = "";
                }
                $allergyBool1 = false;
                continue;
            }else{
                if($allergy1 == ""){
                    $allergy1 = $pieces[$i + 1];
                }else{
                    $allergy1 = $allergy1 ." " .$pieces[$i + 1];
                }
            }
        }
        if($allergyBool2){
            if($pieces[$i + 1] == "Allergy"){
                if($allergy2 == "null"){
                    $allergy2 = "";
                }
                $allergyBool2 = false;
                continue;
            }else{
                if($allergy2 == ""){
                    $allergy2 = $pieces[$i + 1];
                }else{
                    $allergy2 = $allergy2 ." " .$pieces[$i + 1];
                }
            }
        }
        if($allergyBool3){
            if($pieces[$i + 1] == "Allergy"){
                if($allergy3 == "null"){
                    $allergy3 = "";
                }
                $allergyBool3 = false;
                continue;
            }else{
                if($allergy3 == ""){
                    $allergy3 = $pieces[$i + 1];
                }else{
                    $allergy3 = $allergy3 ." " .$pieces[$i + 1];
                }
            }
        }
        if($allergyBool4){
            if($pieces[$i + 1] == "Allergy"){
                if($allergy4 == "null"){
                    $allergy4 = "";
                }
                $allergyBool4 = false;
                continue;
            }else{
                if($allergy4 == ""){
                    $allergy4 = $pieces[$i + 1];
                }else{
                    $allergy4 = $allergy4 ." " .$pieces[$i + 1];
                }
            }
        }
        if($allergyBool5){
            if($allergy5 == "null"){
                $allergy1 = "";
            }
            if($pieces[$i + 1] == "ALLERGIES"){
                $allergyBool5 = false;
                continue;
            }else{
                if($allergy5 == ""){
                    $allergy5 = $pieces[$i + 1];
                }else{
                    $allergy5 = $allergy5 ." " .$pieces[$i + 1];
                }
            }
        }

        // MEDICATIONS
        if($medicationBool){
            if($pieces[$i] == "MEDICATIONS"){
                if($medication == "null"){
                    $medication = "";
                }
                $medicationBool = false;
                continue;
            }else{
                if($medication == ""){
                    $medication = $pieces[$i];
                }else{
                    $medication = $medication ." " .$pieces[$i];
                }
            }
        }

        // ILLNESSES
        if($illnessBool){
            if($pieces[$i] == "ILLNESSES"){
                if($illness == "null"){
                    $illness = "";
                }
                $illnessBool = false;
                continue;
            }else{
                if($illness == ""){
                    $illness = $pieces[$i];
                }else{
                    $illness = $illness ." " .$pieces[$i];
                }
            }
        }

        // SURGERIES
        if($surgeryBool){
            if($pieces[$i] == "SURGERIES"){
                if($surgery == "null"){
                    $surgery = "";
                }
                $surgeryBool = false;
                continue;
            }else{
                if($surgery == ""){
                    $surgery = $pieces[$i];
                }else{
                    $surgery = $surgery ." " .$pieces[$i];
                }
            }
        }

        // HEALTH PROBLEMS
        if($healthPBool){
            if($pieces[$i+1] == "HEALTH"){
                if($healthP == "null"){
                    $healthP = "";
                }
                $healthPBool = false;
                continue;
            }else{
                if($healthP == ""){
                    $healthP = $pieces[$i+1];
                }else{
                    $healthP = $healthP ." " .$pieces[$i+1];
                }
            }
        }

        // Exercise
        if($hoursBool){
            $hoursPD = $pieces[$i + 2] ." " .$pieces[$i + 3] ." " .$pieces[$i + 4] ." " .$pieces[$i + 5];

            if($hoursPD == "null"){
                $hoursPD = "";
            }
            $hoursBool = false;
            continue;
        }
        if($weekBool){
            $daysPW = $pieces[$i + 2] ." " .$pieces[$i + 3] ." " .$pieces[$i + 4] ." " .$pieces[$i + 5];

            if($daysPW == "null"){
                $daysPW = "";
            }
            $weekBool = false;
            continue;
        }
        if($intensityBool){
            $intensity = $pieces[$i] ." " .$pieces[$i + 1];

            if($intensity == "null"){
                $intensity = "";
            }
            $intensityBool = false;
            continue;
        }

        // Dietary Habits
        if($dietBool){
            if($pieces[$i+1] == "DIETARY"){
                if($diet == "null"){
                    $diet = "";
                }
                $dietBool = false;
                continue;
            }else{
                if($diet == ""){
                    $diet = $pieces[$i+1];
                }else{
                    $diet = $diet ." " .$pieces[$i+1];
                }
            }
        }

        
        // Dietary Habits
        if($healthGBool){
            if($pieces[$i+1] == "HEALTH"){
                if($healthG == "null"){
                    $healthG= "";
                }
                $healthGBool = false;
                break;
            }else{
                if($healthG == ""){
                    $healthG = $pieces[$i+1];
                }else{
                    $healthG = $healthG ." " .$pieces[$i+1];
                }
            }
        }


        if($pieces[$i] == "PERSONAL"){
            if($pieces[++$i] == "INFO" && $pieces[$i + 2] != "DOCTORS"){
                $personalInfoBool = true;
            }
        }

        if($pieces[$i] == "Doctor" && $pieces[$i + 1] == "1"){
            $doctorBool1 = true;
        }
        if($pieces[$i] == "Doctor" && $pieces[$i + 1] == "2"){
            $doctorBool2 = true;
        }
        if($pieces[$i] == "Doctor" && $pieces[$i + 1] == "3"){
            $doctorBool3 = true;
        }

        if($pieces[$i] == "Emergency" && $pieces[$i + 1] == "Contact" && $pieces[$i + 2] == "1"){
            $emergencyBool1 = true;
        }
        if($pieces[$i] == "Emergency" && $pieces[$i + 1] == "Contact" && $pieces[$i + 2] == "2"){
            $emergencyBool2 = true;
        }

        if($pieces[$i] == "COVID" && $pieces[$i + 1] == "VACCINATION" && $pieces[$i + 2] == "STATUS" && $pieces[$i + 3] != ""){
            $covidBool = true;
        }

        if($pieces[$i] == "Allergy" && $pieces[$i + 1] == "1:"){
            $allergyBool1 = true;
        }
        if($pieces[$i] == "Allergy" && $pieces[$i + 1] == "2:"){
            $allergyBool2 = true;
        }
        if($pieces[$i] == "Allergy" && $pieces[$i + 1] == "3:"){
            $allergyBool3 = true;
        }
        if($pieces[$i] == "Allergy" && $pieces[$i + 1] == "4:"){
            $allergyBool4 = true;
        }
        if($pieces[$i] == "Allergy" && $pieces[$i + 1] == "5:"){
            $allergyBool5 = true;
        }

        if($pieces[$i] == "MEDICATIONS" && $pieces[$i+1] != "ILLNESSES"){
            $medicationBool = true;
        }

        if($pieces[$i] == "ILLNESSES" && $pieces[$i+1] != "SURGERIES"){
            $illnessBool = true;
        }

        if($pieces[$i] == "SURGERIES" && $pieces[$i+1] != "HEALTH"){
            $surgeryBool = true;
        }

        if($pieces[$i] == "HEALTH" && $pieces[$i+1] == "PROBLEMS" && $pieces[$i+2] != ""){
            $healthPBool = true;
        }

        if($pieces[$i] == "Hours" && $pieces[$i + 1] == "Per" && $pieces[$i + 2] == "Day:"){
            $hoursBool = true;
        }
        if($pieces[$i] == "Days" && $pieces[$i + 1] == "Per" && $pieces[$i + 2] == "Week:"){
            $weekBool = true;
        }
        if($pieces[$i] == "Intensity:"){
            $intensityBool = true;
        }

        if($pieces[$i] == "DIETARY" && $pieces[$i+1] == "HABITS" && $pieces[$i+2] != ""){
            $dietBool = true;
        }

        if($pieces[$i] == "HEALTH" && $pieces[$i+1] == "GOALS"){
            $healthGBool = true;
        }

    }

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $personalSet = isset($_POST['donePersonalInfo']);
        $doctorSet = isset($_POST['doneDoctors']);
        $emergencySet = isset($_POST['doneEmergency']);
        $covidSet = isset($_POST['doneCovid']);
        $allergySet = isset($_POST['doneAllergy']);
        $medicationSet = isset($_POST['doneMedication']);
        $illnessSet = isset($_POST['doneIllness']);
        $surgerySet = isset($_POST['doneSurgery']);
        $healthpSet = isset($_POST['doneHealthProblem']);
        $exerciseSet = isset($_POST['doneExercise']);
        $dietSet = isset($_POST['doneDietaryHabit']);
        $healthgSet = isset($_POST['doneHealthGoal']);

        $createPHR = isset($_POST['update']);

        // Update PHR
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
            }else{
                $pifname = $personalinfofname;
            }
            if(isset($_SESSION['pilname'])){
                $pilname = $_SESSION['pilname'];
                unset($_SESSION['pilname']);
            }else{
                $pilname = $personalinfolname;
            }
            if(isset($_SESSION['pigender'])){
                $pigender = $_SESSION['pigender'];
                unset($_SESSION['pigender']);
            }else{
                $pigender = $personalinfogender;
            }
            if(isset($_SESSION['piage'])){
                $piage = $_SESSION['piage'];
                unset($_SESSION['piage']);
            }else{
                $piage = $personalinfoage;
            }
            if(isset($_SESSION['pibirthday'])){
                $pibirthday = $_SESSION['pibirthday'];
                unset($_SESSION['pibirthday']);
            }else{
                $pibirthday = $personalinfobirthday;
            }
            if(isset($_SESSION['piphone'])){
                $piphone = $_SESSION['piphone'];
                unset($_SESSION['piphone']);
            }else{
                $piphone = $personalinfophone;
            }
            if(isset($_SESSION['piemail'])){
                $piemail = $_SESSION['piemail'];
                unset($_SESSION['piemail']);
            }else{
                $piemail = $personalinfoemail;
            }
            if(isset($_SESSION['picity'])){
                $picity = $_SESSION['picity'];
                unset($_SESSION['picity']);
            }else{
                $picity = $personalinfocity;
            }
            if(isset($_SESSION['piprov'])){
                $piprov = $_SESSION['piprov'];
                unset($_SESSION['piprov']);
            }else{
                $piprov = $personalinfoprovince;
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
            }else{
                $d1prof = $doct1pro;
            }
            if(isset($_SESSION['d1doct'])){
                $d1doct = $_SESSION['d1doct'];
                unset($_SESSION['d1doct']);
            }else{
                $d1doct = $doct1name;
            }
            if(isset($_SESSION['d1phone'])){
                $d1phone = $_SESSION['d1phone'];
                unset($_SESSION['d1phone']);
            }else{
                $d1phone = $doct1phone;
            }
            if(isset($_SESSION['d1city'])){
                $d1city = $_SESSION['d1city'];
                unset($_SESSION['d1city']);
            }else{
                $d1city = $doct1city;
            }
            if(isset($_SESSION['d1prov'])){
                $d1prov = $_SESSION['d1prov'];
                unset($_SESSION['d1prov']);
            }else{
                $d1prov = $doct1prov;
            }
            if(isset($_SESSION['d2prof'])){
                $d2prof = $_SESSION['d2prof'];
                unset($_SESSION['d2prof']);
            }else{
                $d2prof = $doct2pro;
            }
            if(isset($_SESSION['d2doct'])){
                $d2doct = $_SESSION['d2doct'];
                unset($_SESSION['d2doct']);
            }else{
                $d2doct = $doct2name;
            }
            if(isset($_SESSION['d2phone'])){
                $d2phone = $_SESSION['d2phone'];
                unset($_SESSION['d2phone']);
            }else{
                $d2phone = $doct2phone;
            }
            if(isset($_SESSION['d2city'])){
                $d2city = $_SESSION['d2city'];
                unset($_SESSION['d2city']);
            }else{
                $d2city = $doct2city;
            }
            if(isset($_SESSION['d2prov'])){
                $d2prov = $_SESSION['d2prov'];
                unset($_SESSION['d2prov']);
            }else{
                $d2prov = $doct2prov;
            }
            if(isset($_SESSION['d3prof'])){
                $d3prof = $_SESSION['d3prof'];
                unset($_SESSION['d3prof']);
            }else{
                $d3prof = $doct3pro;
            }
            if(isset($_SESSION['d3doct'])){
                $d3doct = $_SESSION['d3doct'];
                unset($_SESSION['d3doct']);
            }else{
                $d3doct = $doct3name;
            }
            if(isset($_SESSION['d3phone'])){
                $d3phone = $_SESSION['d3phone'];
                unset($_SESSION['d3phone']);
            }else{
                $d3phone= $doct3phone;
            }
            if(isset($_SESSION['d3city'])){
                $d3city = $_SESSION['d3city'];
                unset($_SESSION['d3city']);
            }else{
                $d3city = $doct3city;
            }
            if(isset($_SESSION['d3prov'])){
                $d3prov = $_SESSION['d3prov'];
                unset($_SESSION['d3prov']);
            }else{
                $d3prov = $doct3prov;
            }
            $doctorInfo = "DOCTORS Doctor 1 Profession: " .$d1prof ." Name: " .$d1doct ." Phone: " .$d1phone ." City: " .$d1city ." Province: " .$d1prov ." Doctor 2 Profession: " .$d2prof ." Name: " .$d2doct ." Phone: " .$d2phone ." City: " .$d2city ." Province: " .$d2prov ." Doctor 3 Profession: " .$d3prof ." Name: " .$d3doct ." Phone: " .$d3phone ." City: " .$d3city ." Province: " .$d3prov ." DOCTORS  ";

            // emergency
            $em1namee = "null";
            $em1phonee = "null";
            $em1rell = "null";
            $em2namee = "null";
            $em2phonee = "null";
            $em2rell = "null";
            if(isset($_SESSION['em1name'])){
                $em1name = $_SESSION['em1name'];
                unset($_SESSION['em1name']);
            }else{
                $em1namee = $em1name;
            }
            if(isset($_SESSION['em1phone'])){
                $em1phone = $_SESSION['em1phone'];
                unset($_SESSION['em1phone']);
            }else{
                $em1phonee = $em1phone;
            }
            if(isset($_SESSION['em1rel'])){
                $em1rel = $_SESSION['em1rel'];
                unset($_SESSION['em1rel']);
            }else{
                $em1rell = $em1rel;
            }
            if(isset($_SESSION['em2name'])){
                $em2name = $_SESSION['em2name'];
                unset($_SESSION['em2name']);
            }else{
                $em2namee = $em2name;
            }
            if(isset($_SESSION['em2phone'])){
                $em2phone = $_SESSION['em2phone'];
                unset($_SESSION['em2phone']);
            }else{
                $em2phonee = $em2phone;
            }
            if(isset($_SESSION['em2rel'])){
                $em2rel = $_SESSION['em2rel'];
                unset($_SESSION['em2rel']);
            }else{
                $em2rell = $em2rel;
            }
            $emergencyInfo = "EMERGENCY CONTACTS Emergency Contact 1 Name: " .$em1namee ." Phone: " .$em1phonee ." Relation: " .$em1rell ." Emergency Contact 2 Name: " .$em2namee ." Phone: " .$em2phonee ." Relation: " .$em2rell ." EMERGENCY CONTACTS  ";

            // covid
            $covidS = "";
            if(isset($_SESSION['covidS'])){
                $covidS = $_SESSION['covidS'];
                unset($_SESSION['covidS']);
            }else{
                $covidS = $covidStatus;
            }
            $covidVacInfo = "COVID VACCINATION STATUS " .$covidS ." COVID VACCINATION STATUS  ";

            // allergy
            $allergy11 = "null";
            $allergy22 = "null";
            $allergy33 = "null";
            $allergy44 = "null";
            $allergy55 = "null";
            if(isset($_SESSION['allergy1'])){
                $allergy11 = $_SESSION['allergy1'];
                unset($_SESSION['allergy1']);
            }else{
                $allergy11 = $allergy1;
            }
            if(isset($_SESSION['allergy2'])){
                $allergy22 = $_SESSION['allergy2'];
                unset($_SESSION['allergy2']);
            }else{
                $allergy22 = $allergy2;
            }
            if(isset($_SESSION['allergy3'])){
                $allergy33 = $_SESSION['allergy3'];
                unset($_SESSION['allergy3']);
            }else{
                $allergy33 = $allergy3;
            }
            if(isset($_SESSION['allergy4'])){
                $allergy44 = $_SESSION['allergy4'];
                unset($_SESSION['allergy4']);
            }else{
                $allergy44 = $allergy4;
            }
            if(isset($_SESSION['allergy5'])){
                $allergy55 = $_SESSION['allergy5'];
                unset($_SESSION['allergy5']);
            }else{
                $allergy55 = $allergy5;
            }
            $allergyInfo = "ALLERGIES Allergy 1: " .$allergy11 ." Allergy 2: " .$allergy22 ." Allergy 3: " .$allergy33 ." Allergy 4: " .$allergy44 ." Allergy 5: " .$allergy55 ." ALLERGIES  ";

            // medication
            $meds = "null";
            if(isset($_SESSION['meds'])){
                $meds = $_SESSION['meds'];
                unset($_SESSION['meds']);
            }else{
                $meds = $medication;
            }
            $medicationInfo = "MEDICATIONS " .$meds ." MEDICATIONS  ";

            // illness
            $ill = "null";
            if(isset($_SESSION['ill'])){
                $ill = $_SESSION['ill'];
                unset($_SESSION['ill']);
            }else{
                $ill = $illness;
            }
            $illInfo = "ILLNESSES " .$ill ." ILLNESSES  ";

            // surgery
            $surg = "null";
            if(isset($_SESSION['surg'])){
                $surg = $_SESSION['surg'];
                unset($_SESSION['surg']);
            }else{
                $surg = $surgery;
            }
            $surgeryInfo = "SURGERIES " .$surg ." SURGERIES  ";

            $healthP = "";
            $pieces = explode(" ",$patientPHR);
            $size = count($pieces);
            for($i = 0; $i < $size; $i++){
                if($healthPBool){
                    if($pieces[$i+1] == "HEALTH"){
                        if($healthP == "null"){
                            $healthP = "";
                        }
                        $healthPBool = false;
                        break;
                    }else{
                        if($healthP == ""){
                            $healthP = $pieces[$i+1];
                        }else{
                            $healthP = $healthP ." " .$pieces[$i+1];
                        }
                    }
                }
                if($pieces[$i] == "HEALTH" && $pieces[$i+1] == "PROBLEMS" && $pieces[$i+2] != ""){
                    $healthPBool = true;
                }
            }
            // health problem
            $healthpp = "null";
            if(isset($_SESSION['healthp'])){
                $healthpp = $_SESSION['healthp'];
                unset($_SESSION['healthp']);
            }else{
                $healthpp = $healthP;
            }
            $healthProblemsInfo = "HEALTH PROBLEMS " .$healthpp ." HEALTH PROBLEMS  ";

            // exercise
            $exerh = "null";
            $exerw = "null";
            $exeri = "null";
            if(isset($_SESSION['exerh'])){
                $exerh = $_SESSION['exerh'];
                unset($_SESSION['exerh']);
            }else{
                $exerh = $hoursPD;
            }
            if(isset($_SESSION['exerw'])){
                $exerw = $_SESSION['exerw'];
                unset($_SESSION['exerw']);
            }else{
                $exerw = $daysPW;
            }
            if(isset($_SESSION['exeri'])){
                $exeri = $_SESSION['exeri'];
                unset($_SESSION['exeri']);
            }else{
                $exeri = $intensity;
            }
            $exerciseInfo = "EXERCISE Hours Per Day: " .$exerh ." Days Per Week: " .$exerw . " Intensity: " .$exeri ." EXERCISE  ";

            // dietary habits
            $dieth = "null";
            if(isset($_SESSION['dieth'])){
                $dieth = $_SESSION['dieth'];
                unset($_SESSION['dieth']);
            }else{
                $dieth = $diet;
            }
            $dietInfo = "DIETARY HABITS " .$dieth . " DIETARY HABITS  ";

            // health goal
            $healthgoal = "null";
            if(isset($_SESSION['healthgoal'])){
                $healthgoal = $_SESSION['healthgoal'];
                unset($_SESSION['healthgoal']);
            }else{
                $healthgoal = $healthG;
            }
            $healthInfo = "HEALTH GOALS " .$healthgoal ." HEALTH GOALS  ";

            // create here
            $createPHRInfo = $personalInfo .$doctorInfo .$emergencyInfo .$covidVacInfo .$allergyInfo .$medicationInfo .$illInfo .$surgeryInfo .$healthProblemsInfo .$exerciseInfo .$dietInfo .$healthInfo;

            $_SESSION['currentUser'] = $currentUser;
            $_SESSION['patientUpdatePHR'] = $createPHRInfo;

            header("Location: generateUpdatePatientPHR.php");

        }

        // personal info
        if($personalSet){
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
            alert("Added");
        }

        // doctor
        if($doctorSet){
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
            alert("Added");
        }

        // emergency
        if($emergencySet){
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
            alert("Added");
        }

        // covid
        if($covidSet){
            if(isset($_POST['covidvaccination'])){
                $_SESSION['covidS'] = $_POST['covidvaccination'];
            }
            $_SESSION['covidClick'] = 1;
            alert("Added");
        }

        // allergy
        if($allergySet){
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
            alert("Added");
        }

        // medication
        if($medicationSet){
            if(isset($_POST['medications'])){
                $meds = $_POST['medications'];
                $meds= trim($meds);
                $meds = stripslashes($meds);
                $meds = htmlspecialchars($meds);
                $_SESSION['meds'] = $meds;
            }
            $_SESSION['medicationClick'] = 1;
            alert("Added");
        }

        // illness
        if($illnessSet){
            if(isset($_POST['illnesses'])){
                $ill = $_POST['illnesses'];
                $ill= trim($ill);
                $ill = stripslashes($ill);
                $ill = htmlspecialchars($ill);
                $_SESSION['ill'] = $ill;
            }
            $_SESSION['illnessClick'] = 1;
            alert("Added");
        }

        // surgery
        if($surgerySet){
            if(isset($_POST['surgeries'])){
                $surg = $_POST['surgeries'];
                $surg= trim($surg);
                $surg = stripslashes($surg);
                $surg = htmlspecialchars($surg);
                $_SESSION['surg'] = $surg;
            }
            $_SESSION['surgeryClick'] = 1;
            alert("Added");
        }

        // health problem
        if($healthpSet){
            if(isset($_POST['healthproblems'])){
                $healthp = $_POST['healthproblems'];
                $healthp = trim($healthp);
                $healthp = stripslashes($healthp);
                $healthp = htmlspecialchars($healthp);
                $_SESSION['healthp'] = $healthp;
            }
            $_SESSION['healthpClick'] = 1;
            alert("Added");
        }

        // exercise
        if($exerciseSet){
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
            alert("Added");
        }

        // diet
        if($dietSet){
            if(isset($_POST['dietaryhabits'])){
                $dieth = $_POST['dietaryhabits'];
                $dieth = trim($dieth);
                $dieth = stripslashes($dieth);
                $dieth = htmlspecialchars($dieth);
                $_SESSION['dieth'] = $dieth;
            }
            $_SESSION['dietClick'] = 1;
            alert("Added");
        }

        // health goal
        if($healthgSet){
            if(isset($_POST['healthgoals'])){
                $healthgoal = $_POST['healthgoals'];
                $healthgoal = trim($healthgoal);
                $healthgoal = stripslashes($healthgoal);
                $healthgoal = htmlspecialchars($healthgoal);
                $_SESSION['healthgoal'] = $healthgoal;
            }
            $_SESSION['healthgoalClick'] = 1;
            alert("Added");
        }
    }

    // links
    if(isset($_GET['code'])){
        $val = $_GET['code'];
        if($val == 1){
            // View PHR
            header("Location: patientHome.php");
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
            header("Location: patientHelp.php");
        }else if($val == 6){
            // Log Out
            session_unset();
            header("Location: launch.php");
        }else if($val == 7){
            // View PHR
            header("Location: patientViewPHRPK.php");
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
        <link rel = "stylesheet" href="../css/patientUpdatePHR.css">
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
                        <a href="?code=7" class="move">View PHR</a>
                        <a href="?code=2">HCP Database</a>
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
                <a href="?code=1" class="sidebarHighlight"><img class = "userPic" src = "../images/hc.jpg" width = "25px" height = "25px"><div class = "sidebarContent">&nbsp  &nbsp Healthchain</div></a>
                <div class="sidebarMiddleContent">
                    <a href="?code=7"> <i id="contentSidebar" class="fa fa-eye"></i> <div class = "sidebarContent">&nbsp  &nbsp View PHR</div></a>
                    <a href="#" class="active"> <i id="contentSidebar" class="fa fa-refresh"></i> <div class = "sidebarContent">&nbsp  &nbsp Update PHR</div></a>
                    <a href="?code=8"> <i id="contentSidebar" class="fa fa-lock"></i> <div class = "sidebarContent">&nbsp  &nbsp Permissions</div></a>
                    <a href="?code=3"> <i id="contentSidebar" class="fa fa-sign-in"></i> <div class = "sidebarContent">&nbsp  &nbsp Account</div></a>
                    <a href="?code=2"> <i id="contentSidebar" class="fa fa-database"></i> <div class = "sidebarContent">&nbsp  &nbsp HCP Database</div></a>
                </div>
                <a href="?code=6" class="logoutSidebar"><img class = "userPic" src = "../images/hc.jpg" width = "25px" height = "25px"> <div class = "sidebarContent">&nbsp  &nbsp Logout</div></a>
            </div>
            <div class="middleContent">
                <a href="#" onclick="openPersonalInfoOverlay()"> 
                    <div class="variables" id="vars">
                        <i class="fa fa-genderless" id = "icon"></i>
                        <h4>Personal Info</h4>
                    </div>
                </a>
                <a href="#" onclick="openDoctorOverlay()" id="doctorClose"> 
                    <div class="variables" id="vars">
                        <i class="fa fa-genderless" id = "icon"></i>
                        <h4>Doctors</h4>
                    </div>
                </a>
                <a href="#" onclick="openEmergencyOverlay()" id="emergencyClose"> 
                    <div class="variables" id="vars">
                        <i class="fa fa-genderless" id = "icon"></i>
                        <h4>Emergency Contacts</h4>
                    </div>
                </a>
                <br />
                <a href="#" onclick="openCovidOverlay()" id="covidClose"> 
                    <div class="variables" id="vars">
                        <i class="fa fa-genderless" id = "icon"></i>
                        <h4>Covid Vaccination Status</h4>
                    </div>
                </a>
                <a href="#" onclick="openAllergiesOverlay()" id="allergyClose"> 
                    <div class="variables" id="vars">
                        <i class="fa fa-genderless" id = "icon"></i>
                        <h4>Allergies</h4>
                    </div>
                </a>
                <a href="#" onclick="openMedicationOverlay()" id="medicationClose"> 
                    <div class="variables" id="vars">
                        <i class="fa fa-genderless" id = "icon"></i>
                        <h4>Medications</h4>
                    </div>
                </a>
                <br />
                <a href="#" onclick="openIllnessesOverlay()" id="illnessClose"> 
                    <div class="variables" id="vars">
                        <i class="fa fa-genderless" id = "icon"></i>
                        <h4>Illnesses</h4>
                    </div>
                </a>
                <a href="#" onclick="openSurgeriesOverlay()" id="surgeryClose"> 
                    <div class="variables" id="vars">
                        <i class="fa fa-genderless" id = "icon"></i>
                        <h4>Surgeries</h4>
                    </div>
                </a>
                <a href="#" onclick="openHealthProblemsOverlay()" id="healthpClose"> 
                    <div class="variables" id="vars">
                        <i class="fa fa-genderless" id = "icon"></i>
                        <h4>Health Problems</h4>
                    </div>
                </a>
                <br />
                <a href="#" onclick="openExerciseOverlay()" id="exerciseClose"> 
                    <div class="variables" id="vars">
                        <i class="fa fa-genderless" id = "icon"></i>
                        <h4>Exercise</h4>
                    </div>
                </a>
                <a href="#" onclick="openDietaryHabitsOverlay()" id="dietClose"> 
                    <div class="variables" id="vars">
                        <i class="fa fa-genderless" id = "icon"></i>
                        <h4>Dietary Habits</h4>
                    </div>
                </a>
                <a href="#" onclick="openHealthGoalsOverlay()" id="healthgoal"> 
                    <div class="variables" id="vars">
                        <i class="fa fa-genderless" id = "icon"></i>
                        <h4>Health Goals</h4>
                    </div>
                </a>

                <input class="create" name = "update" type="submit" placeholder="update" value = "Update">

                <div class = "footer">
                    <a href="?code=4">About</a>
                    <a href="?code=5">Help</a>
                    <a href="?code=9">Accessibility</a>
                    <a href="?code=10">Contact Us</a>
                </div>
            </div>
            <div class="rightLine">
            </div>

            <!-- Personal Info -->
            <div id="personalinfooverlay">
                <div class = "personalinfooverlaycontent">
                    <a href="#" class="none">
                        <div onclick="closePersonalInfoOverlay()">
                            <i class="fa fa-times" id="closeO"></i>
                        </div>
                    </a>
                    <h2>Personal Info</h2>
                    <p>First Name</p>
                    <input name = "personalfirstname" placeholder="First Name" value="<?php Print $personalinfofname; ?>" />
                    <p>Last Name</p>
                    <input name = "personallastname" placeholder="Last Name" value="<?php Print $personalinfolname; ?>" />
                    <p>Gender</p>
                    <input name = "personalgender" placeholder="Gender" value="<?php Print $personalinfogender; ?>" />
                    <p>Age</p>
                    <input name = "personalage" placeholder="Age" value="<?php Print $personalinfoage; ?>" />
                    <p>Birthday</p>
                    <input name = "personalbirthday" placeholder="Birthday" value="<?php Print $personalinfobirthday; ?>" />
                    <p>Phone</p>
                    <input name = "personalphone" placeholder="Phone" value="<?php Print $personalinfophone; ?>" />
                    <p>E-mail</p>
                    <input name = "personalemail" placeholder="Email" value="<?php Print $personalinfoemail; ?>" />
                    <p>City</p>
                    <input name = "personalcity" placeholder="City" value="<?php Print $personalinfocity; ?>" />
                    <p>Province</p>
                    <input name = "personalprovince" placeholder="Province 2 Letter" value="<?php Print $personalinfoprovince; ?>" />

                    <input class="viewB1" name = "donePersonalInfo" type="submit" placeholder="view" value = "Done">
                </div>
            </div>

            <!-- Doctor Info -->
            <div id="doctoroverlay">
                <div class = "doctoroverlaycontent">
                    <a href="#" class="none">
                        <div onclick="closeDoctorOverlay()">
                            <i class="fa fa-times" id="closeO"></i>
                        </div>
                    </a>
                    <h2>Doctors</h2>
                    <!-- Doctor 1 -->
                    <h3>Doctor 1</h3>
                    <p>Profession</p>
                    <input name = "doctor1Profession" placeholder="Profession" value="<?php Print $doct1pro; ?>" />
                    <p>Name</p>
                    <input name = "doctor1Name" placeholder="Name" value="<?php Print $doct1name; ?>" />
                    <p>Phone</p>
                    <input name = "doctor1Phone" placeholder="Phone" value="<?php Print $doct1phone; ?>" />
                    <p>City</p>
                    <input name = "doctor1City" placeholder="City" value="<?php Print $doct1city; ?>" />
                    <p>Province</p>
                    <input name = "doctor1Province" placeholder="Province" value="<?php Print $doct1prov; ?>" />

                    <!-- Doctor 2 -->
                    <h3>Doctor 2</h3>
                    <p>Profession</p>
                    <input name = "doctor2Profession" placeholder="Profession" value="<?php Print $doct2pro; ?>" />
                    <p>Name</p>
                    <input name = "doctor2Name" placeholder="Name" value="<?php Print $doct2name; ?>" />
                    <p>Phone</p>
                    <input name = "doctor2Phone" placeholder="Phone" value="<?php Print $doct2phone; ?>" />
                    <p>City</p>
                    <input name = "doctor2City" placeholder="City" value="<?php Print $doct2city; ?>" />
                    <p>Province</p>
                    <input name = "doctor2Province" placeholder="Province 2 Letter" value="<?php Print $doct2prov; ?>" />

                    <!-- Doctor 1 -->
                    <h3>Doctor 3</h3>
                    <p>Profession</p>
                    <input name = "doctor3Profession" placeholder="Profession" value="<?php Print $doct3pro; ?>" />
                    <p>Name</p>
                    <input name = "doctor3Name" placeholder="Name" value="<?php Print $doct3name; ?>" />
                    <p>Phone</p>
                    <input name = "doctor3Phone" placeholder="Phone" value="<?php Print $doct3phone; ?>" />
                    <p>City</p>
                    <input name = "doctor3City" placeholder="City" value="<?php Print $doct3city; ?>" />
                    <p>Province</p>
                    <input name = "doctor3Province" placeholder="Province 2 Letter" value="<?php Print $doct3prov; ?>" />

                    <input class="viewB1" name = "doneDoctor" type="submit" placeholder="view" value = "Done">
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
                    <h3>Emergency Contact 1</h3>
                    <p>Name</p>
                    <input name = "emergency1Name" placeholder="Name" value="<?php Print $em1name; ?>" />
                    <p>Phone</p>
                    <input name = "emergency1Phone" placeholder="Phone" value="<?php Print $em1phone; ?>" />
                    <p>Relation</p>
                    <input name = "emergency1Relation" placeholder="Relation" value="<?php Print $em1rel; ?>" />

                    <!-- Emergency Contact 2 -->
                    <h3>Emergency Contact 2</h3>
                    <p>Name</p>
                    <input name = "emergency2Name" placeholder="Name" value="<?php Print $em2name; ?>" />
                    <p>Phone</p>
                    <input name = "emergency2Phone" placeholder="Phone" value="<?php Print $em2phone; ?>" />
                    <p>Relation</p>
                    <input name = "emergency2Relation" placeholder="Relation" value="<?php Print $em2rel; ?>" />

                    <input class="viewB1" name = "doneEmergency" type="submit" placeholder="view" value = "Done">
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
                    <?php if($covidStatus == "Fully Vaccinated"){ ?>
                        <select name="covidvaccination">
                            <option value="VaccinationStatus" disabled="disabled">Select</option>
                            <option value="Fully Vaccinated" selected="selected" >Fully Vaccinated</option>
                            <option value="Partially Vaccinated">Partially Vaccinated</option>
                            <option value="Not Vaccinated">Not Vaccinated</option>
                        </select>
                    <?php }else if($covidStatus == "Partially Vaccinated"){ ?>
                        <select name="covidvaccination">
                            <option value="VaccinationStatus" disabled="disabled">Select</option>
                            <option value="Fully Vaccinated">Fully Vaccinated</option>
                            <option value="Partially Vaccinated" selected="selected" >Partially Vaccinated</option>
                            <option value="Not Vaccinated">Not Vaccinated</option>
                        </select>
                    <?php }else if($covidStatus == "Not Vaccinated"){ ?>
                        <select name="covidvaccination">
                            <option value="VaccinationStatus" disabled="disabled">Select</option>
                            <option value="Fully Vaccinated">Fully Vaccinated</option>
                            <option value="Partially Vaccinated">Partially Vaccinated</option>
                            <option value="Not Vaccinated" selected="selected" >Not Vaccinated</option>
                        </select>
                    <?php }else{ ?>
                        <select name="covidvaccination">
                            <option value="VaccinationStatus" disabled="disabled" selected="selected" >Select</option>
                            <option value="Fully Vaccinated">Fully Vaccinated</option>
                            <option value="Partially Vaccinated">Partially Vaccinated</option>
                            <option value="Not Vaccinated">Not Vaccinated</option>
                        </select>
                    <?php } ?>

                    <input class="viewB1" name = "doneCovid" type="submit" placeholder="view" value = "Done">
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

                    <p>Allergy 1</p>
                    <input name = "allergy1" placeholder="Allergy 1" value="<?php Print $allergy1; ?>" />
                    <p>Allergy 2</p>
                    <input name = "allergy2" placeholder="Allergy 2" value="<?php Print $allergy2; ?>" />
                    <p>Allergy 3</p>
                    <input name = "allergy3" placeholder="Allergy 3" value="<?php Print $allergy3; ?>" />
                    <p>Allergy 4</p>
                    <input name = "allergy4" placeholder="Allergy 4" value="<?php Print $allergy4; ?>" />
                    <p>Allergy 5</p>
                    <input name = "allergy5" placeholder="Allergy 5" value="<?php Print $allergy5; ?>" />

                    <input class="viewB1" name = "doneAllergy" type="submit" placeholder="view" value = "Done">
                </div>
            </div>

            <!-- Medications -->
            <div id="medicationoverlay">
                <div class = "medicationoverlaycontent">
                    <a href="#" class="none">
                        <div onclick="closeMedicationOverlay()">
                            <i class="fa fa-times" id="closeO"></i>
                        </div>
                    </a>
                    <h2>Medications</h2>
                    <p>Enter each Medication on a new line</p>
                    <textarea name="medications" placeholder="Enter Medications"><?php Print $medication ?></textarea>

                    <input class="viewB1" name = "doneMedication" type="submit" placeholder="Done" value = "Done">
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
                    <textarea name="illnesses" placeholder="Enter Illnesses"><?php Print $illness ?></textarea>

                    <input class="viewB1" name = "doneIllnesses" type="submit" placeholder="Done" value = "Done">
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
                    <textarea name="surgeries" placeholder="Enter Surgery"><?php Print $surgery ?></textarea>

                    <input class="viewB1" name = "doneSurgery" type="submit" placeholder="Done" value = "Done">
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
                    <textarea name="healthproblems" placeholder="Enter Health Problem"><?php Print $healthP ?></textarea>

                    <input class="viewB1" name = "doneHealthProblem" type="submit" placeholder="Done" value = "Done">
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
                    <p>Hours Per Day</p>
                    <?php if($hoursPD == "0 hours"){ ?>
                        <select name="exercisehours">
                            <option value="select" disabled="disabled">Select</option>
                            <option value="0 Hours" selected="selected">0 hours</option>
                            <option value="1 to 3 Hours">1 to 3 hours</option>
                            <option value="4 to 6 Hours">4 to 6 hours</option>
                            <option value="6 or more Hours">6 or more hours</option>
                        </select>
                    <?php }else if($hoursPD == "1 to 3 Hours"){ ?>
                        <select name="exercisehours">
                            <option value="select" disabled="disabled">Select</option>
                            <option value="0 Hours">0 hours</option>
                            <option value="1 to 3 Hours" selected="selected">1 to 3 hours</option>
                            <option value="4 to 6 Hours">4 to 6 hours</option>
                            <option value="6 or more Hours">6 or more hours</option>
                        </select>
                    <?php }else if($hoursPD == "4 to 6 Hours"){ ?>
                        <select name="exercisehours">
                            <option value="select" disabled="disabled">Select</option>
                            <option value="0 Hours">0 hours</option>
                            <option value="1 to 3 Hours">1 to 3 hours</option>
                            <option value="4 to 6 Hours" selected="selected">4 to 6 hours</option>
                            <option value="6 or more Hours">6 or more hours</option>
                        </select>
                    <?php }else if($hoursPD == "6 or more Hours"){ ?>
                        <select name="exercisehours">
                            <option value="select" disabled="disabled">Select</option>
                            <option value="0 Hours">0 hours</option>
                            <option value="1 to 3 Hours">1 to 3 hours</option>
                            <option value="4 to 6 Hours">4 to 6 hours</option>
                            <option value="6 or more Hours" selected="selected">6 or more hours</option>
                        </select>
                    <?php }else{ ?>
                        <select name="exercisehours">
                            <option value="select" disabled="disabled">Select</option>
                            <option value="0 Hours">0 hours</option>
                            <option value="1 to 3 Hours" selected="selected">1 to 3 hours</option>
                            <option value="4 to 6 Hours">4 to 6 hours</option>
                            <option value="6 or more Hours">6 or more hours</option>
                        </select>
                    <?php } ?>
                    <p>Days Per Week</p>
                    <?php if($daysPW == "0 Times"){ ?>
                        <select name="exerciseweek">
                            <option value="select" disabled="disabled">Select</option>
                            <option value="0 Times" selected="selected" >0 times</option>
                            <option value="1 to 3 Times">1 to 3 times</option>
                            <option value="4 to 6 Times">4 to 6 times</option>
                            <option value="Daily">Daily</option>
                        </select>
                    <?php }else if($daysPW == "1 to 3 Times"){ ?>
                        <select name="exerciseweek">
                            <option value="select" disabled="disabled" >Select</option>
                            <option value="0 Times">0 times</option>
                            <option value="1 to 3 Times" selected="selected" >1 to 3 times</option>
                            <option value="4 to 6 Times">4 to 6 times</option>
                            <option value="Daily">Daily</option>
                        </select>
                    <?php }else if($daysPW == "4 to 6 Times"){ ?>
                        <select name="exerciseweek">
                            <option value="select" disabled="disabled" >Select</option>
                            <option value="0 Times">0 times</option>
                            <option value="1 to 3 Times">1 to 3 times</option>
                            <option value="4 to 6 Times" selected="selected">4 to 6 times</option>
                            <option value="Daily">Daily</option>
                        </select>
                    <?php }else if($daysPW == "Daily"){ ?>
                        <select name="exerciseweek">
                            <option value="select" disabled="disabled" >Select</option>
                            <option value="0 Times">0 times</option>
                            <option value="1 to 3 Times">1 to 3 times</option>
                            <option value="4 to 6 Times">4 to 6 times</option>
                            <option value="Daily" selected="selected">Daily</option>
                        </select>
                    <?php }else{ ?>
                        <select name="exerciseweek">
                            <option value="select" disabled="disabled" selected="selected">Select</option>
                            <option value="0 Times">0 times</option>
                            <option value="1 to 3 Times">1 to 3 times</option>
                            <option value="4 to 6 Times">4 to 6 times</option>
                            <option value="Daily">Daily</option>
                        </select>
                    <?php } ?>
                    <p>Intensity</p>
                    <?php if($intensity == "Low Intensity"){ ?>
                        <select name="exerciseintense">
                            <option value="select" disabled="disabled" >Select</option>
                            <option value="Low Intensity" selected="selected">Low Intensity</option>
                            <option value="Moderate Intensity">Moderate Intensity</option>
                            <option value="High Intensity">High Intensity</option>
                        </select>
                    <?php }else if($intensity == "Moderate Intensity"){ ?>
                        <select name="exerciseintense">
                            <option value="select" disabled="disabled">Select</option>
                            <option value="Low Intensity">Low Intensity</option>
                            <option value="Moderate Intensity" selected="selected">Moderate Intensity</option>
                            <option value="High Intensity">High Intensity</option>
                        </select>
                    <?php }else if($intensity == "High Intensity"){ ?>
                        <select name="exerciseintense">
                            <option value="select" disabled="disabled">Select</option>
                            <option value="Low Intensity">Low Intensity</option>
                            <option value="Moderate Intensity">Moderate Intensity</option>
                            <option value="High Intensity" selected="selected">High Intensity</option>
                        </select>
                     <?php }else{ ?>
                        <select name="exerciseintense">
                            <option value="select" disabled="disabled" selected="selected">Select</option>
                            <option value="Low Intensity">Low Intensity</option>
                            <option value="Moderate Intensity">Moderate Intensity</option>
                            <option value="High Intensity">High Intensity</option>
                        </select>
                    <?php } ?>
                    <input class="viewB1" name = "doneExercise" type="submit" placeholder="Done" value = "Done">
                </div>
            </div>

            <!-- Dietary Habits -->
            <div id="dietaryhabitsoverlay">
                <div class = "dietaryhabitsoverlaycontent">
                    <a href="#" class="none">
                        <div onclick="closeDietaryHabitsOverlay()">
                            <i class="fa fa-times" id="closeO"></i>
                        </div>
                    </a>
                    <h2>Dietary Habits</h2>
                    <textarea name="dietaryhabits" placeholder="Enter Dietary Habits"><?php Print $diet ?></textarea>

                    <input class="viewB1" name = "doneDietaryHabit" type="submit" placeholder="Done" value = "Done">
                </div>
            </div>

            <!-- Health Goals -->
            <div id="healthgoalsoverlay">
                <div class = "healthgoalsoverlaycontent">
                    <a href="#" class="none">
                        <div onclick="closeHealthGoalsOverlay()">
                            <i class="fa fa-times" id="closeO"></i>
                        </div>
                    </a>
                    <h2>Health Goals</h2>
                    <textarea name="healthgoals" placeholder="Enter Health Goals"><?php Print $healthG ?></textarea>

                    <input class="viewB1" name = "doneHealthGoal" type="submit" placeholder="Done" value = "Done">
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