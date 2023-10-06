<?php 
include 'config/connection.php';
$message = '';
if(isset($_POST['submit'])) {
    $userName = $_POST['user_name'];
    $password = $_POST['password'];

    $query = "select `id`, `user_name`, `full_name`, `email`,`profile_picture`  
from `users` 
where `user_name` = '$userName' and 
`password` = '$password' and 
`is_active` = 1;";
    $count = 0;
    $goto = "registration";
    $stmt = null;
    $message = '';
    try {
        $stmt = $con->prepare($query);
        $stmt->execute();
        $count = $stmt->rowCount();

    } catch(PDOException $ex) {
        echo $ex->getMessage();
        echo $ex->getTraceAsString();
        exit;
    }
  
    if($count > 0) {
        $r = $stmt->fetch(PDO::FETCH_ASSOC);

        $_SESSION['user_id'] = $r['id'];
        $_SESSION['user_name'] = $r['user_name'];
        $_SESSION['email'] = $r['email'];
        $_SESSION['full_name'] = $r['full_name'];
        $_SESSION['profile_picture'] = $r['profile_picture'];

        header("location:$goto");
        exit;
    } else{
            $message = 'Incorrect username or password.';
    }
   
}

?>
<!DOCTYPE html>
<html>
    <head>
        <?php include 'config/site-css.php';?>
    </head>
    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="login-logo">
                <a href="../../index2.html"><b>ITalent-Workspace Magazijn</b></a>
            </div><!-- /.login-logo -->
            <div class="login-box-body">
                <p class="login-box-msg">Sign in to start your session</p>
                <form method="post">
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" placeholder="Username" id="user_name" name="user_name">
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input id="password" name="password" type="password" class="form-control" placeholder="Password">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <div class="row">
                        <div class="col-xs-8">
                            <div class="checkbox icheck">
                            <label class="text-danger">
                                    &nbsp;<?php echo $message;?>
                                </label>
                            </div>
                        </div><!-- /.col -->
                        <div class="col-xs-4">
                            <button type="submit" class="btn btn-primary btn-block btn-flat" name="submit">Sign In</button>
                        </div><!-- /.col -->
                    </div>
                </form>


            </div><!-- /.login-box-body -->
        </div><!-- /.login-box -->

        <?php include 'config/site-js.php';?>


        <!-- Page script -->
        <script>
            $(function () {
                $('input').iCheck({
                    checkboxClass: 'icheckbox_square-blue',
                    radioClass: 'iradio_square-blue',
                    increaseArea: '20%' // optional
                });
            });
        </script>
    </body>
</html>
