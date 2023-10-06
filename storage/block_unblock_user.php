<?php 
include 'config/connection.php';

if(!(isset($_SESSION['user_id']))) {
    header("location:index");
    exit;
}

$id = $_GET['id'];
$isActive = $_GET['is_active']; //1/0  1 -> 0, 0 -> 1
/*$newStatus = 2;
if($isActive == 0) {
    $newStatus = 1;
} else {
    $newStatus = 0;
}
*/
$message = 'User account has been blocked.';

$newStatus = ($isActive + 1) % 2;
if($newStatus == 1) {
    $message = 'User account has been activated.';
}
$query = "update `users` set `is_active` = $newStatus 
where `id` = $id;";

    try {

        $con->beginTransaction();
        
        $stmt = $con->prepare($query);
        $stmt->execute();
        
        $con->commit();
        
 } catch(PDOException $ex) {
        $con->rollback();
        echo $ex->getMessage();
        echo $ex->getTraceAsString();
        exit;
    }
    $goto = "users";
    header("location:congratulation?go_to=".$goto."&success_message=".$message); 
    exit;
?>