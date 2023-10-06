<?php 

function getMedicines($con, $medicineId = 0) {
    $query= "select * from `medicines` 
        order by `medicine_name` asc;";
    $stmt = $con->prepare($query);
    $stmt->execute();

    $data = '<option value="">Select Medicine</option>';
    while($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
        if($r['id'] == $medicineId) {
            $data = $data.'<option selected value="'.$r['id'].'">'.$r['medicine_name'].'</option>';
        } else {
        $data = $data.'<option value="'.$r['id'].'">'.$r['medicine_name'].'</option>';
        }
    }
    
    return $data;
}


function changeDateToMysql($date) {
    $dateArr = explode("/", $date);
    //12/01/2022
    //0  1   2
    $mysqlDate = $dateArr[2]."-".$dateArr[0]."-".$dateArr[1];
    return $mysqlDate;
}

function getPatients($con, $patientId = 0) {
    $query= "select `id`, `patient_name`, `phone_number` 
        from `patients` 
        order by `patient_name` asc;";
    $stmt = $con->prepare($query);
    $stmt->execute();

    $data = '<option value="">Select Patient</option>';
    while($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $p = $r['patient_name'].' ('.$r['phone_number'].')';
        if($r['id'] == $patientId) {
            $data = $data.'<option selected value="'.$r['id'].'">'.$p.'</option>';
        } else {
        $data = $data.'<option value="'.$r['id'].'">'.$p.'</option>';
        }
    }
    
    return $data;
}


function getDiseases($con) {
    $query= "select `id`, `disease_name` 
        from `diseases` 
        order by `disease_name` asc;";
    $stmt = $con->prepare($query);
    $stmt->execute();

    $data = '<option value="">Select Disease</option>';
    while($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $p = $r['disease_name'];
        $data = $data.'<option value="'.$r['id'].'">'.$p.'</option>';
    }
    
    return $data;
}

 function getLabTests($con) {
    $query= "select `id`, `test_name` 
        from `laboratory_tests` 
        order by `test_name` asc;";
    $stmt = $con->prepare($query);
    $stmt->execute();

    $data = '<option value="">Select LAb Test</option>';
    while($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $p = $r['test_name'];
        $data = $data.'<option value="'.$r['id'].'">'.$p.'</option>';
    }
    
    return $data;
}   
?>