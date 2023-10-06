<?php 
include 'config/connection.php';
include 'common_service/common_functions.php';

if(!(isset($_SESSION['user_id']))) {
    header("location:index");
    exit;
}

if(isset($_POST['submit'])) {
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    $serialNumber = trim($_POST['serial_number']);
    $lintOut = $_POST['lint_out'];
    $toWho = trim($_POST['to_who']);
    $dateTime = $_POST['date_time'];
    $tested = $_POST['tested'];
    $byWho = trim($_POST['by_who']);
    $dateTimeTested = $_POST['date_time_tested'];
    $problem = trim($_POST['problem']);
    $message = '';
    
    try {

        $con->beginTransaction();

        $query = "insert into `form`(`name`,`description`,`serial_number`,`lint_out`,`to_who`,`date_time`,`tested`,`by_who`,`date_time_tested`,`problem`) 
        values('$name','$description','$serialNumber','$lintOut','$toWho','$dateTime','$tested','$byWho','$dateTimeTested','$problem');";
        $statement = $con->prepare($query);
        $statement->execute();
        
        
        $con->commit();
        
        $message = 'Form registered Successfully.';
        
    } catch(PDOException $ex) {
        $con->rollback();
        echo $ex->getMessage();
        echo $ex->getTraceAsString();
    
    }
    $goto = "registration";
   header("location:congratulation?go_to=".$goto."&success_message=".$message); 
    
}

$query = "select * from `form` 
order by `name` asc;";
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
                Product
                </h1>

            </section>

            <!-- Main content -->
            <section class="content">
                <div class="box">
                    <div class="box-header with-border bg-primary">
                        <h3 class="box-title text-white">Toevoegen Product</h3>
                        <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <form method="post" onsubmit="return validate();">
                            <div class="row">
                                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                                    <label>Naam</label>
                                    <input type="text" id="name" name="name" required class="form-control"
                                        maxlength="30" />
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                    <label>Beschrijving</label>
                                    <input type="text" id="description" name="description" required class="form-control"
                                        maxlength="30" />
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                                    <label>Serie_Nummer</label>
                                    <input type="text" id="serial_number" name="serial_number" required
                                        class="form-control" maxlength="30" />
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                                    <label>Uitgeleend</label>
                                    <select class="form-control" id="lint_out" name="lint_out">
                                        <option value="">Select</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                                    <label>Aan_Wie</label>
                                    <input type="text" id="to_who" name="to_who" required class="form-control"
                                        maxlength="30" />
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                    <label>Datum_Tijd</label>
                                    <input type="datetime-local" id="date_time" name="date_time"
                                        value="YYYY-MM-DDThh:mm" required class="form-control" maxlength="30" />
                                </div>

                                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                                    <label>Getest</label>
                                    <select class="form-control " id="tested" name="tested">
                                        <option value="">Select</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                                    <label>Door_Wie</label>
                                    <input type="text" id=" by_who" name=" by_who" required class="form-control"
                                        maxlength="30" />
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                    <label>Datum_Tijd_Getest</label>
                                    <input type="datetime-local" id=" date_time_tested" name=" date_time_tested"
                                        value="YYYY-MM-DDThh:mm" required class="form-control" maxlength="30" />
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                                    <label> Probleem</label>
                                    <input type="text" id=" problem" name=" problem" required class="form-control"
                                        maxlength="30" />
                                </div>
                                <div class="clearfix">&nbsp;</div>
                                <div class="col-lg-2 col-md-3 col-sm-6 col-xs-12">

                                    <button type="submit" id="submit" name="submit" class="btn btn-primary btn-block"
                                        data-toggle="confirmation" data-placement="top" title=""
                                        data-original-title="Are you sure?">Register</button>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="clearfix">&nbsp;</div>
                <div class="box">
                    <div class="box-header with-border bg-primary">
                        <h3 class="box-title text-white">Producten</h3>
                        <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-12 table-responsive">
                                <table id="all_entries_table" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>S/N</th>
                                            <th>Naam</th>
                                            <th>Beschrijving</th>
                                            <th>Serie_Nummer</th>
                                            <th>Uitgeleend</th>
                                            <th>Aan_Wie</th>
                                            <th>Datum_Tijd</th>
                                            <th>Getest</th>
                                            <th>Door_Wie</th>
                                            <th>Datum_Tijd_Getest</th>
                                            <th>Probleem</th>
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
                                            <td><?php echo $r['name'];?></td>
                                            <td><?php echo $r['description'];?></td>
                                            <td><?php echo $r['serial_number'];?></td>
                                            <td><?php echo $r['lint_out'];?></td>
                                            <td><?php echo $r['to_who'];?></td>
                                            <td><?php echo $r['date_time'];?></td>
                                            <td><?php echo $r['tested'];?></td>
                                            <td><?php echo $r['by_who'];?></td>
                                            <td><?php echo $r['date_time_tested'];?></td>
                                            <td><?php echo $r['problem'];?></td>
                                            <td>
                                                <a
                                                    href="update_registration_entry?id=<?php echo $r['id'];?>&name=<?php echo $r['name'];?>&description=<?php echo $r['description'];?>&serial_number=<?php echo $r['serial_number'];?>&lint_out=<?php echo $r['lint_out'];?>&to_who=<?php echo $r['to_who'];?>&date_time=<?php echo $r['date_time'];?>&tested=<?php echo $r['tested'];?>&by_who=<?php echo $r['by_who'];?>&date_time_tested=<?php echo $r['date_time_tested'];?>&problem=<?php echo $r['problem'];?>"><i
                                                        class="fa fa-edit fa-lg" style="padding:5px;"></i></a>
                                                <a href="delete_entry?id=<?php echo $r['id'];?>"
                                                    data-toggle="confirmation" data-placement="top" title=""
                                                    data-original-title="Are you sure?"><i class="fa fa-trash-o fa-lg"
                                                        style="color:red;"></i></a>
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
        $("#all_entries_table").DataTable();
        showMenuSelected("#mnu_entry", "#mi_registration");
    });
    </script>
</body>

</html>