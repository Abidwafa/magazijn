<?php 
include 'config/connection.php';
include 'common_service/common_functions.php';
if(!(isset($_SESSION['user_id']))) {
    header("location:index");
    exit;
}

if(isset($_POST['submit'])) {
    $userId = $_POST['hidden_id'];
    $userName = trim($_POST['user_name']);
    $userPassword = trim($_POST['user_password']);
    $userFullName = trim($_POST['user_full_name']);
    $userEmail = trim($_POST['user_email']);
    $message = '';

    $uploadFile = $_FILES['profile_picture']['name'];
    $imageType = $_FILES["profile_picture"]["type"];
    $imageExt = '';

    //create file extension in variable $imagetype
    if ($imageType == "image/jpg") {
        $imageExt = ".jpg";
    } elseif ($imageType == "image/jpeg") {
        $imageExt = ".jpeg";
    } elseif ($imageType == "image/bmp") {
        $imageExt = ".bmp";
    } elseif ($imageType == "image/png") {
        $imageExt = ".png";
    }
    $allowedExts = array("jpeg", "jpg", "png", "bmp");
    $extensionArr = explode(".", $_FILES["profile_picture"]["name"]);
    $extension = end($extensionArr);

    

    if (in_array($extension, $allowedExts)) {
        $dateTime = time();
        //below is the file name to be stored in db
        $uploadFile = $dateTime . $imageExt;
        move_uploaded_file($_FILES['profile_picture']['tmp_name'], "user_images/" . $uploadFile);
        try {
            $con->beginTransaction();

            $query = "update `users` set 
            `user_name` = '$userName', 
            `full_name` = '$userFullName', 
            `email` = '$userEmail',
            `profile_picture`='$uploadFile' 
            where `id` = $userId;";
            
            
            
            $stmt = $con->prepare($query);
            $stmt->execute();
        
        
            if($userPassword != '') {
            $query = "update `users` set 
            `password` = '$userPassword' 
            where `id` = $userId;";
            $stmt = $con->prepare($query);
            $stmt->execute();
        }

        $con->commit();
        $message = "user has been updated successfully.";
        
        } catch(PDOException $ex) {
            $con->rollback();
            echo $ex->getMessage();
            echo $ex->getTraceAsString();
            exit;
    }
}
    $goto = "users";
    header("location:congratulation?go_to=".$goto."&success_message=".$message); 
    exit;
}

$userId = 0;
$userName = '';
$userPassword = '';
$userFullName = '';
$userEmail = '';
if(isset($_GET['id'])) {
    $userId = $_GET['id'];
    $userName = $_GET['user_name'];
    $userPassword = $_GET['password'];
    $userFullName = $_GET['user_full_name'];
    $userEmail = $_GET['user_email'];
}
?>
<!DOCTYPE html>
<html>
    <head>
        <?php include 'config/site-css.php';?>
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            <?php include 'config/top-bar.php';?>

            <?php include 'config/sidebar.php';?>

            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        User
                    </h1>
                </section>

                <!-- Main content -->
                <section class="content">

                    <div class="box">
                        <div class="box-header with-border bg-primary">
                            <h3 class="box-title text-white">Update User</h3>
                            <div class="box-tools pull-right">
                                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="box-body">
                            <form method="post" onsubmit="return validate();" enctype="multipart/form-data">
                                <input type="hidden" name="hidden_id" value="<?php echo $userId;?>" />
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label>User Name</label>
                                        <input type="text" id="user_name" 
                                               name="user_name" required 
                                               class="form-control" maxlength="50"
                                               value="<?php echo $userName;?>" />
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label>Password</label>
                                        <input type="password" id="user_password" 
                                               name="user_password" 
                                               class="form-control" maxlength="50"
                                               value="" />
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                        <label>Full Name</label>
                                        <input type="text" id="user_full_name" 
                                               name="user_full_name" required 
                                               class="form-control" maxlength="50"
                                               value="<?php echo $userFullName;?>" />
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                        <label>Email</label>
                                        <input type="text" id="user_email" 
                                               name="user_email" required 
                                               class="form-control" maxlength="50"
                                               value="<?php echo $userEmail;?>" />
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <label>Profile Picture</label>
                                        <input type="file" id="profile_picture" 
                                        name="profile_picture" 
                                        class="form-control" maxlength="50"/>

                                    </div>
                                    <div class="clearfix">&nbsp;</div>
                                    <div class="col-lg-2 col-md-3 col-sm-6 col-xs-12">
                                        <label>&nbsp;</label>
                                        <button type="submit" id="submit" name="submit" 
                                                class="btn btn-primary btn-block" 
                                                data-toggle="confirmation" data-placement="top" title="" data-original-title="Are you sure?">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="clearfix">&nbsp;</div>


                </section>
            </div>
            <?php include 'config/site-js.php';?>
            <?php include 'config/footer.php';?>

            <div class="control-sidebar-bg"></div>
        </div>


        <!-- Page script -->
        <script>
 $(document).ready(function() {
                showMenuSelected("#mnu_misc", "#mi_users");
            });
        </script>
    </body>
</html>
