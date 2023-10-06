<?php
include 'config/connection.php';
if(!(isset($_SESSION['user_id']))) {
    header("location:index");
    exit;
}
if(isset($_GET['id'])) {
    $userId = $_GET['id'];
   
    try {
        $con->beginTransaction();

        $query = "delete from `form` 
            where `id` = '$userId';";
        $stmt = $con->prepare($query);
        $stmt->execute();

        $con->commit();
        $message = "entry has been deleted.";
        
    } catch(PDOException $ex) {
        $con->rollback();
        echo $ex->getMessage();
        echo $ex->getTraceAsString();
        exit;
    }

    $goto = "registration";
    header("location:congratulation?go_to=".$goto."&success_message=".$message); 
    exit;
}

?>