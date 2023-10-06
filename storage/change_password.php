<?php 
include 'config/connection.php';

if(!(isset($_SESSION['user_id']))) {
    header("location:index");
    exit;
}

if(isset($_POST['submit'])) {
    $userName = $_POST['user_name'];
    $password = $_POST['password'];
    $fullName = $_POST['full_name'];
    $email = $_POST['email'];
    $id = $_SESSION['user_id'];

    $message = '';
    $query = '';
    try {

        $con->beginTransaction();
        if($password == '') {
            $query = "update `users` set `user_name` = '$userName', 
            `full_name` = '$fullName', `email` = '$email' 
            where `id` = $id;";
        } else {
            $query = "update `users` set `user_name` = '$userName', 
            `full_name` = '$fullName', `email` = '$email', 
            `password` = '$password' 
            where `id` = $id;";
        }
        $statement = $con->prepare($query);
        $statement->execute();

        $con->commit();

        $message = 'User has been updated successfully.';

    } catch(PDOException $ex) {
        $con->rollback();
        echo $ex->getMessage();
        echo $ex->getTraceAsString();
        exit;
    }
    $goto = "users";
    header("location:congratulation?go_to=".$goto."&success_message=".$message); 
    exit;
}

$id = $_SESSION['user_id'];
$userName = $_SESSION['user_name'];
$email = $_SESSION['email'];
$fullName = $_SESSION['full_name']; 

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

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Change Password
                    </h1>

                </section>

                <!-- Main content -->
                <section class="content">

                    <div class="box">
                        <div class="box-header with-border bg-primary">
                            <h3 class="box-title text-white">Update User Account</h3>
                            <div class="box-tools pull-right">
                                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="box-body">
                            <form method="post" onsubmit="return validate();">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label>User Name</label>
                                        <input type="text" id="user_name" name="user_name" required class="form-control" value="<?php echo $userName;?>" maxlength="30" />
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label>Password</label>
                                        <input type="password" id="password" name="password" class="form-control" maxlength="80" />
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label>Full Name</label>
                                        <input value="<?php echo $fullName;?>" type="text" id="full_name" name="full_name" required class="form-control" maxlength="50" />
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label>Email</label>
                                        <input value="<?php echo $email;?>" type="text" id="email" name="email" required class="form-control" maxlength="30" />
                                    </div>
                                    <div class="clearfix">&nbsp;</div>

                                    <div class="col-lg-2 col-md-3 col-sm-6 col-xs-12">

                                        <button type="submit" id="submit" name="submit" 
                                                class="btn btn-primary btn-block" 
                                                data-toggle="confirmation" data-placement="top" title="" data-original-title="Are you sure?">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>            

                </section>
            </div>
            <?php include 'config/site-js.php';?>
            <?php include 'config/footer.php';?>

            <div class="control-sidebar-bg"></div>
        </div>


        <!-- Page script -->
        <script>

            function validate() {
                let status = false;
                let passwordStatus = false;
                let emailStatus = false;
                let passwordLength = $("#password").val().length;
                let email = $("#email").val().trim();

                let regex = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;

                if (email !== "") {
                    if (!regex.test(email)) {
                        showCustomMessage("Warning", "Invalid email / format.", 'error');
                    } else {
                        emailStatus = true;
                    }
                }

                if(passwordLength === 0) {
                    passwordStatus = true;
                } else {
                    if(passwordLength >= 4) {
                        passwordStatus = true;
                    } else {
                        showCustomMessage("Warning", "Password should be at least 4 characters.", 'error');
                    }
                }

                if(passwordStatus && emailStatus) {
                    status = true;
                }

                return status;
            }

        </script>
    </body>
</html>
