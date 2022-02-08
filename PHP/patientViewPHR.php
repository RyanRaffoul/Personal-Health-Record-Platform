<?php
    // patientViewPHR.php
    // Patient viewing a PHR
    session_start();

    $currentUser = $_SESSION['currentUser'];

    $mysql_host = 'localhost';
	$mysql_user = 'root';
	$mysql_db = 'healthchaindb';
	
	$connection_mysql = mysqli_connect($mysql_host,$mysql_user,"");

    mysqli_select_db($connection_mysql,"healthchaindb") or die("Cannot connect to database");

    $currentUser = $_SESSION['currentUser'];
    $patientPHR = $_SESSION['patientPHRContent'];

    $sql = mysqli_query($connection_mysql,"SELECT * FROM patient WHERE username = '" .$currentUser ."'");
    while($row = mysqli_fetch_array($sql)){
        $userid = $row['patientid'];
    }

    $sql = mysqli_query($connection_mysql,"SELECT * FROM patientphr WHERE patientid = " .$userid);
    while($row = mysqli_fetch_array($sql)){
        $datecreated = $row['datecreated'];
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
            if($pieces[$i + 4] == "Days"){
                $hoursPD = $pieces[$i + 2] ." " .$pieces[$i + 3];
            }else{
                $hoursPD = $pieces[$i + 2] ." " .$pieces[$i + 3] ." " .$pieces[$i + 4] ." " .$pieces[$i + 5];
            }

            if($hoursPD == "null"){
                $hoursPD = "";
            }
            $hoursBool = false;
            continue;
        }
        if($weekBool){
            if($pieces[$i + 3] == "Intensity:"){
                $daysPW = $pieces[$i + 2];
            }else if($pieces[$i + 4] == "Intensity:"){
                $daysPW = $pieces[$i + 2] ." " .$pieces[$i + 3];
            }else{
                $daysPW = $pieces[$i + 2] ." " .$pieces[$i + 3] ." " .$pieces[$i + 4] ." " .$pieces[$i + 5];
            }

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

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $viewphrPDF = isset($_POST['viewPHRButton']);

            if($viewphrPDF){
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

                $sql = mysqli_query($connection_mysql,"SELECT * FROM patientinfo WHERE patientid = " .$userid);
                while($row = mysqli_fetch_array($sql)){
                    $patientName = $row['firstname'] ." " .$row['lastname'];
                }
                
                require_once('tcpdf_min/config/tcpdf_config.php');
                require_once('tcpdf_min/tcpdf.php');

                $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

                $pdf->SetCreator(PDF_CREATOR);
                $pdf->SetAuthor($currentUser);
                $title = $patientName . " Personal Health Record";
                $pdf->SetTitle($title);
                $pdf->SetSubject('Personal Health Record');
                $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

                // remove default header/footer
                $pdf->setPrintHeader(false);
                $pdf->setPrintFooter(false);

                // set default monospaced font
                $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

                // set margins
                $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);

                // set auto page breaks
                $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

                // set image scale factor
                $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

                // set font
                $pdf->SetFont('times', '', 12);

                // add a page
                $pdf->AddPage();

                // set some text to print
                $html = <<<EOD
                    <h1 style="text-align:center">$patientName Personal Health Record</h1>

                    <h2 style="text-align:center">Personal Info</h2>
                    <p>First Name: $personalinfofname</p>
                    <p>Last Name: $personalinfolname </p>
                    <p>Gender: $personalinfogender </p>
                    <p>Age: $personalinfoage </p>
                    <p>Birthday: $personalinfobirthday </p>
                    <p>Phone: $personalinfophone </p>
                    <p>E-mail: $personalinfoemail </p>
                    <p>City: $personalinfocity </p>
                    <p>Province: $personalinfoprovince </p>

                    <h2 style="text-align:center">Doctors</h2>
                    <h3>Doctor 1</h3>
                    <p>Profession: $doct1pro</p>
                    <p>Name: $doct1name</p>
                    <p>Phone: $doct1phone </p>
                    <p>City: $doct1city </p>
                    <p>Province: $doct1prov </p>
                    <h3>Doctor 2</h3>
                    <p>Profession: $doct2pro</p>
                    <p>Name: $doct2name</p>
                    <p>Phone: $doct2phone </p>
                    <p>City: $doct2city </p>
                    <p>Province: $doct2prov </p>
                    <h3>Doctor 3</h3>
                    <p>Profession: $doct3pro</p>
                    <p>Name: $doct3name</p>
                    <p>Phone: $doct3phone </p>
                    <p>City: $doct3city </p>
                    <p>Province: $doct3prov </p>

                    <h2 style="text-align:center">Emergency Contacts</h2>
                    <h3>Emergency Contact 1</h3>
                    <p>Name: $em1name</p>
                    <p>Phone: $em1phone</p>
                    <p>Relation: $em1rel </p>
                    <h3>Emergency Contact 2</h3>
                    <p>Name: $em2name</p>
                    <p>Phone: $em2phone </p>
                    <p>Relation: $em2rel </p>

                    <h2 style="text-align:center">Covid Vaccination Status</h2>
                    <p>$covidStatus</p>

                    <h2 style="text-align:center">Allergies</h2>
                    <p>Allergy 1: $allergy1</p>
                    <p>Allergy 2: $allergy2</p>
                    <p>Allergy 3: $allergy3 </p>
                    <p>Allergy 4: $allergy4</p>
                    <p>Allergy 5: $allergy5 </p>

                    <h2 style="text-align:center">Medications</h2>
                    <p>$medication</p>

                    <h2 style="text-align:center">Illnesses</h2>
                    <p>$illness</p>

                    <h2 style="text-align:center">Surgeries</h2>
                    <p>$surgery</p>

                    <h2 style="text-align:center">Health Problems</h2>
                    <p>$healthP</p>

                    <h2 style="text-align:center">Exercise</h2>
                    <p>Hours Per Day: $hoursPD</p>
                    <p>Days Per Week: $daysPW</p>
                    <p>Intensity: $intensity </p>

                    <h2 style="text-align:center">Dietary Habits</h2>
                    <p>$diet</p>

                    <h2 style="text-align:center">Health Goals</h2>
                    <p>$healthG</p>

                EOD;

                // print a block of text using Write()
                $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

                // ---------------------------------------------------------

                //Close and output PDF document

                $filename = $currentUser ."PHR.pdf";
                $pdf->Output($filename,'D');

            }
        }

    }

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
        <link rel = "stylesheet" href="../css/patientViewPHR.css">
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
                        <a href="#" class="move">View PHR</a>
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
                    <a href="#" class="active"> <i id="contentSidebar" class="fa fa-eye"></i> <div class = "sidebarContent">&nbsp  &nbsp View PHR</div></a>
                    <a href="?code=7"> <i id="contentSidebar" class="fa fa-refresh"></i> <div class = "sidebarContent">&nbsp  &nbsp Update PHR</div></a>
                    <a href="?code=8"> <i id="contentSidebar" class="fa fa-lock"></i> <div class = "sidebarContent">&nbsp  &nbsp Permissions</div></a>
                    <a href="?code=3"> <i id="contentSidebar" class="fa fa-sign-in"></i> <div class = "sidebarContent">&nbsp  &nbsp Account</div></a>
                    <a href="?code=2"> <i id="contentSidebar" class="fa fa-database"></i> <div class = "sidebarContent">&nbsp  &nbsp HCP Database</div></a>
                </div>
                <a href="?code=6" class="logoutSidebar"><img class = "userPic" src = "../images/hc.jpg" width = "25px" height = "25px"> <div class = "sidebarContent">&nbsp  &nbsp Logout</div></a>
            </div>
            <div class="middleContent">
                <p class="dateCreated">Date Created: <?php Print $datecreated ?></p>
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

                <input class="viewB" name = "viewPHRButton" type="submit" placeholder="view" value = "PDF Version">

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
                    <h4><?php Print $personalinfofname; ?></h4>
                    <p>Last Name</p>
                    <h4><?php Print $personalinfolname; ?></h4>
                    <p>Gender</p>
                    <h4><?php Print $personalinfogender; ?></h4>
                    <p>Age</p>
                    <h4><?php Print $personalinfoage; ?></h4>
                    <p>Birthday</p>
                    <h4><?php Print $personalinfobirthday; ?></h4>
                    <p>Phone</p>
                    <h4><?php Print $personalinfophone; ?></h4>
                    <p>E-mail</p>
                    <h4><?php Print $personalinfoemail; ?></h4>
                    <p>City</p>
                    <h4><?php Print $personalinfocity; ?></h4>
                    <p>Province</p>
                    <h4><?php Print $personalinfoprovince; ?></h4>
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
                    <h4><?php Print $doct1pro; ?></h4>
                    <p>Name</p>
                    <h4><?php Print $doct1name; ?></h4>
                    <p>Phone</p>
                    <h4><?php Print $doct1phone; ?></h4>
                    <p>City</p>
                    <h4><?php Print $doct1city; ?></h4>
                    <p>Province</p>
                    <h4><?php Print $doct1prov; ?></h4>

                    <!-- Doctor 2 -->
                    <h3>Doctor 2</h3>
                    <p>Profession</p>
                    <h4><?php Print $doct2pro; ?></h4>
                    <p>Name</p>
                    <h4><?php Print $doct2name; ?></h4>
                    <p>Phone</p>
                    <h4><?php Print $doct2phone; ?></h4>
                    <p>City</p>
                    <h4><?php Print $doct2city; ?></h4>
                    <p>Province</p>
                    <h4><?php Print $doct2prov; ?></h4>

                    <!-- Doctor 1 -->
                    <h3>Doctor 3</h3>
                    <p>Profession</p>
                    <h4><?php Print $doct3pro; ?></h4>
                    <p>Name</p>
                    <h4><?php Print $doct3name; ?></h4>
                    <p>Phone</p>
                    <h4><?php Print $doct3phone; ?></h4>
                    <p>City</p>
                    <h4><?php Print $doct3city; ?></h4>
                    <p>Province</p>
                    <h4><?php Print $doct3prov; ?></h4>
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
                    <h4><?php Print $em1name; ?></h4>
                    <p>Phone</p>
                    <h4><?php Print $em1phone; ?></h4>
                    <p>Relation</p>
                    <h4><?php Print $em1rel; ?></h4>

                    <!-- Emergency Contact 2 -->
                    <h3>Emergency Contact 2</h3>
                    <p>Name</p>
                    <h4><?php Print $em2name; ?></h4>
                    <p>Phone</p>
                    <h4><?php Print $em2phone; ?></h4>
                    <p>Relation</p>
                    <h4><?php Print $em2rel; ?></h4>
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
                    <h4><?php Print $covidStatus; ?></h4>
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
                    <h4><?php Print $allergy1; ?></h4>
                    <p>Allergy 2</p>
                    <h4><?php Print $allergy2; ?></h4>
                    <p>Allergy 3</p>
                    <h4><?php Print $allergy3; ?></h4>
                    <p>Allergy 4</p>
                    <h4><?php Print $allergy4; ?></h4>
                    <p>Allergy 5</p>
                    <h4><?php Print $allergy5; ?></h4>
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
                    <h4><?php Print $medication; ?></h4>
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
                    <h4><?php Print $illness ?></h4>
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
                    <h4><?php Print $surgery ?></h4>
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
                    <h4><?php Print $healthP; ?></h4>
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
                    <h4><?php Print $hoursPD; ?></h4>
                    <p>Days Per Week</p>
                    <h4><?php Print $daysPW; ?></h4>
                    <p>Intensity</p>
                    <h4><?php Print $intensity; ?></h4>
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
                    <h4><?php Print $diet ?></h4>
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
                    <h4><?php Print $healthG; ?></h4>
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