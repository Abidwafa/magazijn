<?php 
include 'config/connection.php';
include 'common_service/common_functions.php';

if(!(isset($_SESSION['user_id']))) {
    header("location:index");
    exit;
}

if(isset($_POST['submit'])) {
    $userName = trim($_POST['user_name']);
    $userPassword = trim($_POST['password']);
    $userFullName = trim($_POST['full_name']);
    $userEmail = trim($_POST['email']);
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

            $query = "insert into `users`(`user_name`, 
        `password`, `full_name`, 
        `email`, `profile_picture`)
        values('$userName', '$userPassword', 
        '$userFullName', '$userEmail', '$uploadFile');";
        
            $statement = $con->prepare($query);
            $statement->execute();

            $con->commit();

            $message = 'User has been saved successfully.';

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

$query = "select * from `users` 
order by `user_name` asc;";
$stmt = $con->prepare($query);
$stmt->execute();

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
                Gebruikers
                </h1>

            </section>

            <!-- Main content -->
            <section class="content">
                <div class="box">
                    <div class="box-header with-border bg-primary">
                        <h3 class="box-title text-white">Toevoegen Gebruikers </h3>
                        <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <form method="post" onsubmit="return validate();" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <label>Gebruikers Naam</label>
                                    <input type="text" id="user_name" name="user_name" required class="form-control"
                                        maxlength="30" />
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <label>Wachtwoord</label>
                                    <input type="password" id="password" name="password" required class="form-control"
                                        maxlength="80" />
                                </div>

                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <label>Voor-en achternaam</label>
                                        <input type="text" id="full_name" name="full_name" required class="form-control" maxlength="50" />
                                    </div>

                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <label>E-mail</label>
                                        <input type="text" id="email" name="email" required class="form-control" maxlength="30" />
                                    </div>

                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <label>Profielfoto</label>
                                        <input type="file" id="profile_picture" name="profile_picture" required class="form-control" />
                                    </div>
                                <div class="clearfix">&nbsp;</div>

                                <div class="col-lg-2 col-md-3 col-sm-6 col-xs-12">

                                    <button type="submit" id="submit" name="submit" class="btn btn-primary btn-block"
                                        data-toggle="confirmation" data-placement="top" title=""
                                        data-original-title="Are you sure?">Opslaan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="clearfix">&nbsp;</div>
                <div class="box">
                    <div class="box-header with-border bg-primary">
                        <h3 class="box-title text-white">Alle Gebruikers</h3>
                        <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 table-responsive">
                                <table id="all_users" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>S/N</th>
                                            <th>Gebruikersnaam</th>
                                            <th>Wachtwoord</th>
                                            <th>Voor-en Achternaam</th>
                                            <th>E-mail</th>
                                            <th>Actie</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $counter = 0;
                                            while($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                                $counter++;
                                            ?>
                                        <tr>
                                            <td><?php echo $counter;?></td>
                                            <td><?php echo $r['user_name'];?></td>
                                            <td><?php echo password_hash($r['password'], PASSWORD_BCRYPT);?></td>
                                            <td><?php echo $r['full_name'];?></td>
                                            <td><?php echo $r['email'];?></td>
                                            <td>
                                                <a href="update_user?id=<?php echo $r['id'];?>&user_name=<?php echo $r['user_name'];?>&password=<?php echo $r['password'];?>&user_full_name=<?php echo $r['full_name'];?>&user_email=<?php echo $r['email'];?>"
                                                    class="btn btn-primary"><i class="fa fa-edit"></i>
                                                </a>
                                                    <?php 
                                                $id = $r['id'];
                                                $isActive = $r['is_active'];
                                                $btnClass = 'btn-primary';
                                                $iconClass = "fa-unlock";

                                                if($isActive == 0) {
                                                    $btnClass = 'btn-danger';
                                                    $iconClass = "fa-lock";
                                                }
                                                    ?>
                                                    &nbsp;&nbsp;
                                                    <a class="btn <?php echo $btnClass;?>" href="block_unblock_user?id=<?php echo $id;?>&is_active=<?php echo $isActive;?>">
                                                        <i class="fa <?php echo $iconClass;?>"></i>
                                                    </a>
                                                </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>

                        </div>
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

        if (passwordLength >= 4) {
            passwordStatus = true;
        } else {
            showCustomMessage("Warning", "Password should be at least 4 characters.", 'error');
        }

        if (passwordStatus && emailStatus) {
            status = true;
        }

        return status;
    }

    $(document).ready(function() {
        $(".select2").select2();
        $("#all_users").DataTable();
        showMenuSelected("#mnu_entry", "#mi_users");
    });
    </script>
</body>

</html>